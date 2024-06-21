<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="../index_css/cart.css">
  <?php
  include('h.php');
  include("../condb.php");
  include('../boot4.php');
  ?>
</head>

<body>
  <?php
  include('navbar.php');

  $m_id = $_SESSION["member_id"];
  if (isset($_POST["add"])) {
    $p_id = $_POST["p_id"];
    $qty = $_POST["qty"];
    $total = $_POST["price"] * $_POST["qty"];
    $check = mysqli_query($con, "SELECT * FROM tbl_cart WHERE p_id=$p_id and m_id=$m_id");
    if (mysqli_num_rows($check) > 0) {
      mysqli_query($con, "UPDATE tbl_cart set qty=qty+$qty WHERE p_id=$p_id and m_id=$m_id");
    } else {
      $q = mysqli_query($con, "INSERT INTO tbl_cart (m_id, p_id, qty, total) VALUES ($m_id, '$p_id', '$qty', '$total')");
    }
    header("Location: cart.php");
    exit;
  }

  if (isset($_GET["delete"])) {
    $p_id = $_GET["p_id"];
    $qty1 = 1;
    $del = mysqli_query($con, "UPDATE tbl_cart SET qty = qty - $qty1 WHERE p_id = $p_id AND m_id = $m_id");
    $result_d = mysqli_query($con, "SELECT * FROM tbl_cart WHERE m_id = $m_id AND p_id = $p_id");
    $row_d = mysqli_fetch_assoc($result_d);
    if ($row_d['qty'] == 0) {
      mysqli_query($con, "DELETE FROM tbl_cart WHERE p_id = $p_id AND m_id = $m_id");
    }
    if ($del) {
      echo "<script>
                Swal.fire({
                    title: 'ลดสินค้าแล้ว',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location='cart.php';
                });
            </script>";
    }
  }
  if (isset($_GET["deleteAll"])) {
    $del = mysqli_query($con, "DELETE FROM tbl_cart WHERE m_id = $m_id");
    if ($del) {
      echo "<script>
                Swal.fire({
                    title: 'ลบสินค้าแล้ว',
                    icon: 'success',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location='cart.php';
                });
            </script>";
    }
  }

  if (isset($_POST["update"])) {
    $p_id = $_POST["p_id"];
    $qty = $_POST["qty"];
    $total = $_POST["price"] * $_POST["qty"];
    $up = mysqli_query($con, "UPDATE tbl_cart SET qty = $qty, total = $total WHERE p_id = $p_id AND m_id = $m_id");
    echo '<meta http-equiv="refresh" content="0;url=cart.php" />';
  }

  $sql = "SELECT * FROM tbl_cart AS c
            INNER JOIN tbl_product AS p ON c.p_id = p.p_id
            WHERE c.m_id = $m_id";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
  $total = 0;
  ?>
  <main class="table" id="cart_table">
    <section class="table__header">
      <h1>ตะกร้าสินค้า</h1>
    </section>
    <section class="table__body">
      <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
          <thead>
            <tr>
              <!-- <th>ชื่อสินค้า <span class="icon-arrow">&UpArrow;</span></th>
              <th>รูปสินค้า <span class="icon-arrow">&UpArrow;</span></th>
              <th>ราคาสินค้า <span class="icon-arrow">&UpArrow;</span></th>
              <th>จำนวน <span class="icon-arrow">&UpArrow;</span></th>
              <th>รวม <span class="icon-arrow">&UpArrow;</span></th>
              <th>ลบ <span class="icon-arrow">&UpArrow;</span></th> -->
              <th> ชื่อสินค้า </th>
              <th> รูปสินค้า </th>
              <th> ราคาสินค้า </th>
              <th> จำนวน </th>
              <th> รวม </th>
              <th> ลบ </th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
              <tr>
                <td><?php echo $row["p_name"]; ?></td>
                <td class="Img-tb"><img src="../p_img/<?php echo $row['p_img']; ?>"></td>
                <td><?php echo number_format($row["p_price"]); ?></td>
                <td>
                  <?php echo $row["qty"]; ?>
                  <form method="post">
                    <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>">
                    <input type="hidden" name="price" value="<?php echo number_format($row["p_price"]); ?>">
                    <input type="hidden" name="qty" min="1" max="<?php echo $row["p_qty"]; ?>" value="<?php echo $row["qty"]; ?>">
                  </form>
                </td>
                <?php $total1 = $row["qty"] * $row["total"]; ?>
                <td><?php echo number_format($total1); ?></td>
                <td><a href="?delete&p_id=<?php echo $row["p_id"]; ?>" class="btn btn-info btn-sm">ลบ</a></td>
              </tr>
            <?php $total += $total1;
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <td>ราคารวมทั้งหมด</td>
              <td colspan="5"><?php echo number_format($total); ?></td>
            </tr>
          </tfoot>
        </table>
        <br>
        <a href="pay.php" class="btn btn-info btn-sm">ชำระเงิน</a>
        <a href="?deleteAll" class="btn btn-danger btn-sm">ลบทั้งหมด</a>
      <?php } else { ?>
        <section class="table__header">
          <div class="col" align="center">
            <h2 class="text-danger">ยังไม่มีสินค้าในตะกร้า</h2>
          </div>
        </section>
      <?php } ?>
    </section>
  </main>
  <script src="../index_css/cart.js"></script>
</body>

</html>