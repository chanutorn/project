<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../index_css/cart.css">
  <?php
  include('h.php');
  include("../condb.php");
  include('../boot4.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php
  include('navbar.php');

  $m_id = $_SESSION["member_id"];
  //ถ้ามีการกดชำระเงินให้ตรวจสอบเงื่อนไข
  if (isset($_POST["pay"])) {
    $sql1 = "SELECT * FROM tbl_cart as c INNER JOIN tbl_product as p ON c.p_id=p.p_id AND c.m_id=$m_id WHERE p.p_qty >= c.qty";
    $result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));
    if (mysqli_num_rows($result1) == 0) {
      foreach ($_SESSION["order"] as $data) {
        $p_id = $data["p_id"];
      }
      mysqli_query($con, "DELETE FROM tbl_cart WHERE m_id = $m_id AND p_id = $p_id");
      echo "<script>
                Swal.fire({
                  title: 'สินค้าไม่พอที่จะทำการสั่งซื้อ',
                  text: 'สินค้านี้ได้ถูกจำหน่ายแล้ว',
                  icon: 'error',
                  confirmButtonText: 'ตกลง'
                }).then(() => {
                  if (result.isConfirmed) {
                    window.location='index.php';
                  }
                });
              </script>";
      exit;
    } else {
      //รหัส Order
      $o_code = $m_id . substr(date('Y'), -2) . date('mdHis');
      //เรียกใช้งานฐานข้อมูล tbl_member เพื่อตรวจสอบว่ากรอกข้อมูลครบหรือไม่
      $check_member = "SELECT * FROM tbl_member WHERE member_id = $m_id AND m_level = 'member' AND m_tel IS NOT NULL AND m_email IS NOT NULL AND m_address IS NOT NULL";
      $check_member = mysqli_query($con, $check_member);
      if (mysqli_num_rows($check_member) > 0) {
        $total = 0;
        //วนลูปตะกร้าสินค้า
        foreach ($_SESSION["order"] as $data) {
          $qty = $data["qty"];
          $p_id = $data["p_id"];
          $product_total = $data["total"];

          $coupon_code = mysqli_real_escape_string($con, $_POST["coupon_code"]);
          $coupon_discount = 0;
          //ถ้ามีการใส่คูปองให้ทำในเงื่อนไข
          if (!empty($coupon_code)) {
            //เรียกใช้งานฐานข้อมูล tbl_checkcoupon เพื่อตรวจสอบ ชื่อคูปอง และรหัสลูกค้า
            $sql_check_coupon = "SELECT * FROM tbl_checkcoupon WHERE c_name = '$coupon_code' AND m_id = $m_id";
            $result_check_coupon = mysqli_query($con, $sql_check_coupon);

            if (mysqli_num_rows($result_check_coupon) > 0) {
              $check_coupon_data = mysqli_fetch_assoc($result_check_coupon);
              //ถ้าคูปองถูกใช้งานแล้วให้ทำในเงื่อนไข
              if ($check_coupon_data["c_name"] == $coupon_code) {
                echo "<script>
                      Swal.fire({
                        title: 'รหัสคูปองถูกใช้งานแล้ว',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                      }).then(() => {
                        if (result.isConfirmed) {
                          window.location='pay.php';
                        }
                      });
                    </script>";
                exit;
              }

              $coupon_discount = $check_coupon_data["coupon_discount"];
              $coupon_discount_p = $product_total - $coupon_discount;

              $coupon_id = $check_coupon_data["coupon_id"];
              mysqli_query($con, "UPDATE `tbl_checkcoupon` SET `c_status` = 'ใช้งานแล้ว' WHERE `c_id` = $coupon_id");
            }
            //เรียกใช้งานฐานข้อมูล tbl_coupon
            $sql_coupon = "SELECT * FROM tbl_coupon WHERE coupon_code = '$coupon_code'";
            $result_coupon = mysqli_query($con, $sql_coupon);

            if (mysqli_num_rows($result_coupon) > 0) {
              $coupon_data = mysqli_fetch_assoc($result_coupon);

              //ตรวจสอบคูปองให้ใช่งานได้ครับเดียว
              // if ($coupon_data["coupon_status"] == 'ใช้งานแล้ว') {
              //   echo "<script>
              //          Swal.fire({
              //           title: 'รหัสคูปองถูกใช้งานแล้ว',
              //           icon: 'success',
              //           confirmButtonText: 'ตกลง'
              //          }).then(() => {
              //           window.location='cart.php';
              //          });
              //         </script>";
              //   exit;
              // }

              //ตรวจสอบถ้าวันที่เกินให้ทำในเงื่อนไข
              if (strtotime($coupon_data["coupon_date"]) < strtotime(date('Y-m-d'))) {
                echo "<script>
                      Swal.fire({
                        title: 'รหัสคูปองเกินเวลาที่กำหนด',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                      }).then(() => {
                        if (result.isConfirmed) {
                          window.location='pay.php';
                        }
                      });
                    </script>";
                exit;
              }

              $coupon_discount = $coupon_data["coupon_discount"];
              $coupon_discount_p = $product_total - $coupon_discount;

              $coupon_id = $coupon_data["coupon_id"];
              mysqli_query($con, "UPDATE `tbl_coupon` SET `coupon_status` = 'ใช้งานแล้ว' WHERE `coupon_id` = $coupon_id");
              //ตรวจสอบถ้าคูปองไม่ถูกต้อง
            } else {
              echo "<script>
                    Swal.fire({
                      title: 'รหัสคูปองไม่ถูกต้อง',
                      icon: 'error',
                      confirmButtonText: 'ตกลง'
                    }).then(() => {
                      if (result.isConfirmed) {
                          window.location='pay.php';
                        }
                    });
                  </script>";
              exit;
            }
          } else {
            $coupon_discount_p = $product_total;
          }

          $total += $coupon_discount_p;

          $name_file =  $_FILES['slip']['name'];
          $tmp_name =  $_FILES['slip']['tmp_name'];
          $locate_img = "../image/slip/";
          move_uploaded_file($tmp_name, $locate_img . $name_file);
          //เพิ่มข้อมูลในฐานข้อมูล tbl_checkcoupon
          $q_coupon = mysqli_query($con, "INSERT INTO `tbl_checkcoupon`(`m_id`, `c_name`)
            VALUES ('$m_id','$coupon_code')");
          //เพิ่มข้อมูลในฐานข้อมูล tbl_order
          $q = mysqli_query($con, "INSERT INTO `tbl_order`(`o_code`, `m_id`, `p_id`, `qty`, `total`, `status`, `slip`, `tracking`)
            VALUES ('$o_code','$m_id','$p_id','$qty','$coupon_discount_p','รอตรวจสอบ','$name_file','')");
          //ลบจำนวนของสินค้าที่ซื้อไป
          mysqli_query($con, "UPDATE tbl_product SET p_qty = p_qty - $qty WHERE p_id = $p_id");

          if (!empty($coupon_code)) {
            // กรณีมีคูปองถูกใช้งาน
            mysqli_query($con, "DELETE FROM tbl_cart WHERE m_id = $m_id");
            echo "<script>
                  Swal.fire({
                    title: 'คูปองถูกใช้งาน ลดราคาสินค้า $coupon_discount บาท',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                  }).then(() => {
                    if (result.isConfirmed) {
                      window.location='cart.php';
                    }
                  });
                </script>";
          } else {
            // กรณีไม่มีคูปองถูกใช้งาน
            if ($q || $q_coupon) {
              // ลบรายการในตะกร้าหากมีการทำรายการสำเร็จ
              mysqli_query($con, "DELETE FROM tbl_cart WHERE m_id = $m_id");

              echo "<script>
                    Swal.fire({
                      title: 'ทำรายการสำเร็จ',
                      icon: 'success',
                      confirmButtonText: 'ตกลง'
                    }).then(() => {
                      if (result.isConfirmed) {
                        window.location='cart.php';
                      }
                    });
                  </script>";
            }
          }
        }

        unset($_SESSION["order"]);
        //ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
      } else {
        echo "<script>
              Swal.fire({
                title: 'กรุณากรอกข้อมูลให้ครบถ้วนก่อนชำระเงิน',
                icon: 'error',
                confirmButtonText: 'ตกลง'
              }).then(() => {
                if (result.isConfirmed) {
                  window.location='member_edit.php?id=$member_id';
                }
              });
            </script>";
      }
    }
  }
  $sql = "SELECT * FROM tbl_cart as c INNER JOIN tbl_product as p ON c.p_id=p.p_id AND c.m_id=$m_id WHERE p.p_qty >= c.qty";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
  $total = 0;
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="cart-h1">ชำระเงิน</h1>
          <table class="custom-table table table-bordered table-striped">
            <thead class="text-center">
              <th>ชื่อสินค้า</th>
              <th>รูปสินค้า</th>
              <th>ราคาสินค้า</th>
              <th>จำนวน</th>
              <th>รวม</th>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                  <td><?php echo $row["p_name"] ?></td>
                  <td class="text-center"><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='140' height='170'>"; ?></td>
                  <td class="text-center"><?php echo $row["p_price"] ?></td>
                  <td class="text-center"><?php echo $row["qty"] ?></td>
                  <?php $total1 = $row["qty"] * $row["total"] ?>
                  <td class="text-center"><?php echo number_format($total1) ?></td>
                </tr>
              <?php
                $total += $total1;
                $order = array(
                  "p_id" => $row["p_id"],
                  "qty" => $row["qty"],
                  "total" => $row["total"]
                );
                $orders[] = $order;
                $_SESSION["order"] = $orders;
              } ?>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center"><b>ราคารวมทั้งหมด</b></td>
                <td colspan="4"><?php echo number_format($total); ?></td>
              </tr>
            </tfoot>
            
          </table>
          <table class="custom-pay table table-bordered table-striped">
            <thead class="text-center">
              <th>ธนาคารกรุงเทพ</th>
              <th>ธนาคารกรุงไทย</th>
              <th>ธนาคารไทยพาณิชย์</th>
              <th>ธนาคารกสิกร</th>
              <th>ธนาคารออมสิน</th>
            </thead>
            <tbody class="text-center">
              <tr>
                <td>
                  <img src="https://f.ptcdn.info/801/022/000/1409170288-b60f8c1e0e-o.png" alt="Bangkok Bank" width="50px" height="50px" style="border-radius: 50%;">
                  123456789
                </td>
                <td>
                  <img src="https://upload.wikimedia.org/wikipedia/th/2/29/%E0%B8%98%E0%B8%99%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%A3%E0%B8%81%E0%B8%A3%E0%B8%B8%E0%B8%87%E0%B9%84%E0%B8%97%E0%B8%A2.png" alt="Krung Thai Bank" width="50px" height="50px" style="border-radius: 50%;">
                  123456789
                </td>
                <td>
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsVQR7tsW2yPvPfEQiGmZPlgaL5Z-TNrQYpA&usqp=CAU" alt="Thai PNB" width="50px" height="50px" style="border-radius: 50%;">
                  123456789
                </td>
                <td>
                  <img src="https://www.kasikornbank.com/SiteCollectionDocuments/about/img/logo/logo.png" alt="Kasikorn Bank" width="50px" height="50px" style="border-radius: 50%;">
                  123456789
                </td>
                <td>
                  <img src="https://i.pinimg.com/originals/fa/4b/4a/fa4b4a6ef2f95136051607a7fba619ba.png" alt="Government Savings Bank" width="50px" height="50px" style="border-radius: 50%;">
                  123456789
                </td>
              </tr>
            </tbody>
            <tfoot class="text-center">
              <tr>
                <td>นายชาณุธร ไทยนุกูล</td>
                <td>นายชาณุธร ไทยนุกูล</td>
                <td>นายกิตติพงศ์ อุดมประเสริฐกุล</td>
                <td>นายชาณุธร ไทยนุกูล</td>
                <td>นายธนพงษ์ วันแรก</td>
              </tr>
            </tfoot>
          </table>

          <!-- <img src="../image/bank.jpg" width='30%' height='40%'><br><br> -->

          <form class="pay" method="post" enctype="multipart/form-data">
            <div class="col-4">
              <label>ช่องกรอกคูปอง</label>
              <div class="checkbox-wrapper-2">
                <input type="checkbox" class="sc-gJwTLC ikxBAC">
              </div>
              <div class="coupon_code">
                <input type="text" name="coupon_code" class="form-control">
              </div>
              <label>อัพโหลดสลิปโอนเงิน</label>
              <input type="file" accept="image/*" id="imgInput" name="slip" class="form-control">
              <img id="previewImg" width="200" class="img-rounded" style="margin-top: 10px;"><br>
              <input type="submit" value="ชำระเงิน" name="pay" class="btn btn-warning btn-sm">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
  <br>
  <script>
    let imgInput = document.querySelector("#imgInput");
    let previewImg = document.querySelector("#previewImg");

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {
        previewImg.src = URL.createObjectURL(file);
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      var checkbox = document.querySelector('.sc-gJwTLC.ikxBAC');
      var checkboxWrapper = document.querySelector('.coupon_code');

      checkbox.addEventListener('click', function() {
        if (checkbox.checked) {
          checkboxWrapper.style.display = 'block';
        } else {
          checkboxWrapper.style.display = 'none';
        }
      });

      // ตรวจสอบสถานะเริ่มต้นของ checkbox และแสดงหรือซ่อนฟอร์มตามตรง
      if (checkbox.checked) {
        checkboxWrapper.style.display = 'block';
      } else {
        checkboxWrapper.style.display = 'none';
      }
    });
  </script>

  <?php include('script4.php'); ?>

</body>

</html>