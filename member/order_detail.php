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
  $o_code = mysqli_real_escape_string($con, $_GET["o_code"]);
  $sql = "SELECT * FROM tbl_order AS o
          INNER JOIN tbl_product AS p ON o.p_id = p.p_id
          WHERE o.o_code = '$o_code'";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
  $total = 0;

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm_delivery"])) {
    $o_id = mysqli_real_escape_string($con, $_POST["confirm_delivery"]);
    $update_query = "UPDATE tbl_order SET status = 'ส่งสินค้าแล้ว' WHERE o_id = '$o_id'";
    if (mysqli_query($con, $update_query)) {
      echo '<script>
              Swal.fire({
                title: "ยืนยันการส่งสินค้าแล้ว",
                icon: "success",
                confirmButtonText: "ตกลง"
              }).then(() => {
                window.location = "order_detail.php?o_code=' . $o_code . '";
              });
            </script>';
    } else {
      echo '<script>
              Swal.fire({
                title: "เกิดข้อผิดพลาดในการยืนยันการส่งสินค้า",
                icon: "error",
                confirmButtonText: "ตกลง"
              });
            </script>';
    }
  }
  ?>
</head>

<body>
  <?php include('navbar.php'); ?>

  <main class="table" id="cart_table">
    <section class="table__header">
      <h1>ตะกร้าสินค้า</h1>
    </section>
    <section class="table__body">
      <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
          <thead>
            <tr>
              <th>รหัสสินค้า</th>
              <th>ชื่อสินค้า</th>
              <th>รูปสินค้า</th>
              <th>ราคาสินค้า</th>
              <th>จำนวน</th>
              <th>รวม</th>
              <th>สถานะสั่งซื้อ</th>
              <?php
              $row = mysqli_fetch_assoc($result);
              if ($row["status"] == 'กำลังส่งสินค้า') {
                echo '<th>ยืนยันการส่ง</th>';
              }
              mysqli_data_seek($result, 0);
              ?>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
              <tr>
                <td><?php echo $row["type_id"] . $row["brand_id"] . $row["p_id"]; ?></td>
                <td><?php echo $row["p_name"]; ?></td>
                <td><?php echo "<img src='../p_img/" . $row['p_img'] . "' width='140' height='170'>"; ?></td>
                <td><?php echo number_format($row['p_price']); ?> บาท</td>
                <td><?php echo $row["qty"]; ?></td>
                <td><?php echo number_format($row["total"]); ?> บาท</td>
                <td><?php echo $row["status"]; ?></td>
                <?php if ($row["status"] == 'กำลังส่งสินค้า') { ?>
                  <td>
                    <form method="post">
                      <input type="hidden" name="confirm_delivery" value="<?php echo $row["o_id"]; ?>">
                      <button type="submit" class="btn btn-success btn-sm">ยืนยันการส่ง</button>
                    </form>
                  </td>
                <?php } ?>
              </tr>
            <?php
              $total += $row["total"];
              $slip = $row["slip"];
              $tracking = $row["tracking"];
              $delivery = $row["delivery"];
            } ?>
            <tr>
              <td>ราคารวมทั้งหมด</td>
              <td colspan="6"><?php echo number_format($total); ?> บาท</td>
            </tr>
            <tr>
              <td>รูปสลิปโอนเงิน</td>
              <?php if (!empty($slip)) { ?>
                <td colspan="6">
                  <img id="myImg" src="../image/slip/<?php echo $slip; ?>" width="140" height="170">
                  <div id="myModal" class="modal">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
                  </div>
                </td>
              <?php } else { ?>
                <td>
                  <form method="post" enctype="multipart/form-data">
                    <input type="file" accept="image/*" id="imgInput" name="slip" class="form-control" required>
                    <img id="previewImg" width="200" class="img-rounded" style="margin-top: 10px;">
                </td>
                <td colspan="5">
                  <input type="submit" value="เพิ่มรูป" name="add_slip" class="btn btn-primary btn-sm">
                  </form>
                  <?php
                  if (isset($_POST["add_slip"])) {
                    $name_file = $_FILES['slip']['name'];
                    $tmp_name = $_FILES['slip']['tmp_name'];
                    $locate_img = "../image/slip/";
                    move_uploaded_file($tmp_name, $locate_img . $name_file);
                    $q = mysqli_query($con, "UPDATE tbl_order SET slip = '$name_file' WHERE o_code = '$o_code'");
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
              <td>ขนส่ง</td>
              <td colspan="6"><?php echo $delivery; ?></td>
            </tr>
            <tr>
              <td>เลขพัสดุ</td>
              <td colspan="6"><?php echo $tracking; ?></td>
            </tr>
          </tfoot>
        </table>
      <?php } ?>
    </section>
  </main>
  <script src="../index_css/cart.js"></script>
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