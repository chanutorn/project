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
  <?php
  $o_code = $_GET["o_code"];
  $sql = "SELECT * FROM tbl_order as o
      INNER JOIN tbl_product as p ON o.p_id=p.p_id
      WHERE o.o_code=$o_code";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
  $total = 0;
  ?>
</head>

<body>
  <?php
  // include('banner.php');
  include('navbar.php');
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="cart-h1">รายละเอียด</h1>
          <table class="custom-table table table-bordered table-striped">
            <thead class="text-center">
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>รูปสินค้า</th>
              <th>ราคาสินค้า</th>
              <th>จำนวน</th>
              <th>รวม</th>
              <th>สถานะสั่งซื้อ</th>
            </thead>
            <tbody class="text-center">
              <?php while ($row = mysqli_fetch_array($result)) { ?>
                <tr>
                  <td><?php echo $row["type_id"] . $row["brand_id"] . $row["p_id"]; ?></td>
                  <td><?php echo $row["p_name"] ?></td>
                  <td><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='140' height='170'>"; ?></td>
                  <td><?php echo number_format($row['p_price']) ?> บาท</td>
                  <td><?php echo $row["qty"] ?></td>
                  <td><?php echo number_format($row["total"]) ?> บาท</td>
                  <td><?php echo $row["status"] ?></td>
                </tr>
              <?php $total += $row["total"];
                $slip = $row["slip"];
                $tracking = $row["tracking"];
              } ?>

              <tr>
                <td class="text-center" style="background: #2E86C1;"><b>ราคารวมทั้งหมด</b></td>
                <td colspan="6" style="background: #2E86C1;" class="text-left"><?php echo number_format($total); ?> บาท</td>
              </tr>
              <tr>
                <td class="text-center"><b>รูปสลิปโอนเงิน</b></td>
                <?php if (!empty($slip)) { ?>
                  <td colspan="6" class="text-left">
                    <img id='myImg' src='../image/slip/<?php echo $slip; ?>' width='140' height='170'>
                    <div id='myModal' class='modal'>
                      <span class='close'>&times;</span>
                      <img class='modal-content' id='img01'>
                      <div id='caption'></div>
                    </div>
                  </td>
                <?php } else { ?>
                  <td class="text-left">
                    <form method='post' enctype='multipart/form-data'>
                      <input type="file" accept="image/*" id="imgInput" name="slip" class="form-control" required>
                      <img id="previewImg" width="200" class="img-rounded" style="margin-top: 10px;">
                  </td>
                  <td colspan="5" class="text-left">
                    <input type="submit" value="เพิ่มรูป" name="add_slip" class="btn btn-primary btn-sm">
                    </form>
                    <?php
                    if (isset($_POST["add_slip"])) {
                      $name_file =  $_FILES['slip']['name'];
                      $tmp_name =  $_FILES['slip']['tmp_name'];
                      $locate_img = "../image/slip/";
                      move_uploaded_file($tmp_name, $locate_img . $name_file);
                      $q = mysqli_query($con, "UPDATE tbl_order SET `slip` = '$name_file' WHERE `o_code` = '$o_code'");
                      if ($q) {
                    ?>
                        <script>
                          Swal.fire({
                            title: 'เพิ่มรูปสลิปสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                          }).then(() => {
                            window.location = 'order_detail.php?o_code=<?php echo $o_code; ?>';
                          });
                        </script>
                  <?php
                      }
                    }
                  }
                  ?>
                  </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="text-center"><b>เลขพัสดุ</b></td>
                <td colspan="6" class="text-left"><?php echo $tracking ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
</body>
<script>
  let imgInput = document.querySelector("#imgInput");
  let previewImg = document.querySelector("#previewImg");

  imgInput.onchange = evt => {
    const [file] = imgInput.files;
    if (file) {
      previewImg.src = URL.createObjectURL(file);
    }
  }
</script>
<?php include('script4.php'); ?>

</html>