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
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <?php
        $m_id = $_SESSION["member_id"];
        $sql = "SELECT * FROM tbl_order as o
              INNER JOIN tbl_product as p ON o.p_id = p.p_id
              WHERE o.m_id = $m_id
              GROUP BY o.o_code
              ORDER BY o.`date` DESC";
        $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
        ?>
        <div class="col-md-12">
          <h1 class="cart-h1">รายการสั่งซื้อ</h1>
          <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="custom-table table table-bordered table-striped">
              <thead class="text-center">
                <th>รหัสสั่งซื้อ</th>
                <th>วันที่สั่งซื้อ</th>
                <th>สถานะสั่งซื้อ</th>
                <th>รายละเอียด</th>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                  <tr>
                    <td><?php echo $row["o_code"] ?></td>
                    <td><?php echo thai_date1(strtotime($row['date'])) ?></td>
                    <td><?php echo $row["status"] ?></td>
                    <td><a class="btn btn-info" href="order_detail.php?o_code=<?php echo $row["o_code"] ?>" role="button">รายละเอียด</a></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          <?php } else { ?>
            <hr>
            <div class="col-sm-12" align="center">
              <h4 class="text-danger">ยังไม่มีรายการสั่งซื้อ</h4>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</body>
<?php include('script4.php'); ?>

</html>