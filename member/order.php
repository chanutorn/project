<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="../index_css/cart.css">
  <?php
  include('h.php');
  include("../condb.php");
  include('../boot4.php');
  include('../thai_date.php');
  ?>
</head>

<body>
  <?php
  include('navbar.php');
  $m_id = $_SESSION["member_id"];
  $sql = "SELECT * FROM tbl_order as o INNER JOIN tbl_product as p ON o.p_id = p.p_id WHERE o.m_id = $m_id GROUP BY o.o_code ORDER BY o.`date` DESC";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
  ?>
  <main class="table" id="cart_table">
    <section class="table__header">
      <h1>รายการสั่งซื้อ</h1>
    </section>
    <section class="table__body">
      <?php if (mysqli_num_rows($result) > 0) { ?>
        <table>
          <thead>
            <tr>
              <th> รหัสสั่งซื้อ </th>
              <th> วันที่สั่งซื้อ </th>
              <th> สถานะสั่งซื้อ </th>
              <th> รายละเอียด </th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_array($result)) { ?>
              <tr>
                <td><?php echo $row["o_code"] ?></td>
                <td><?php echo thai_date1(strtotime($row['date'])) ?></td>
                <td><?php echo $row["status"] ?></td>
                <td><a class="btn btn-secondary" href="order_detail.php?o_code=<?php echo $row["o_code"] ?>" role="button">รายละเอียด</a></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <section class="table__header">
          <div class="col" align="center">
            <h2 class="text-danger">ยังไม่มีรายการสั่งซื้อ</h2>
          </div>
        </section>
      <?php } ?>
    </section>
  </main>
</body>

</html>