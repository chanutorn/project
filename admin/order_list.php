<?php
include('../thai_date.php');
include('../condb.php');

// Function to calculate the date difference
function dateDifference($date_1, $date_2, $differenceFormat = '%a')
{
  $datetime1 = date_create($date_1);
  $datetime2 = date_create($date_2);
  $interval = date_diff($datetime1, $datetime2);
  return $interval->format($differenceFormat);
}

// Update order status if pending for more than 7 days
$today = date("Y-m-d");
$checkOrders = mysqli_query($con, "SELECT o_id, o_code, date FROM tbl_order WHERE status = 'รอตรวจสอบ'");

while ($order = mysqli_fetch_assoc($checkOrders)) {
  $dateDifference = dateDifference($order['date'], $today);
  if ($dateDifference > 7) {
    $orderId = (int) $order['o_id'];
    $updateStatus = mysqli_query($con, "UPDATE tbl_order SET status = 'ยกเลิกออเดอร์' WHERE o_id = $orderId");

    // Update product quantity
    $orderDetails = mysqli_query($con, "SELECT p_id, qty FROM tbl_order WHERE o_id = $orderId");
    while ($details = mysqli_fetch_assoc($orderDetails)) {
      $productId = (int) $details['p_id'];
      $quantity = (int) $details['qty'];
      $updateProducts = mysqli_query($con, "UPDATE tbl_product SET p_qty = p_qty + $quantity WHERE p_id = $productId");
    }
  }
}

// Handle GET requests for order status updates
if (isset($_GET["tracking"])) {
  $o_code = mysqli_real_escape_string($con, $_GET['o_code']);
  $tracking = mysqli_real_escape_string($con, $_GET['tracking']);
  $delivery_option = mysqli_real_escape_string($con, $_GET['type_id']);

  mysqli_query($con, "UPDATE tbl_order SET status = 'กำลังส่งสินค้า', delivery = '$delivery_option', tracking = '$tracking' WHERE o_code = '$o_code'");
  echo '<script type="text/javascript">
          swal("", "กำลังส่งสินค้า !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=order.php" />';
}

if (isset($_GET["confirm"])) {
  $o_code = mysqli_real_escape_string($con, $_GET['o_code']);
  $delivery_option = mysqli_real_escape_string($con, $_GET['type_id']);

  mysqli_query($con, "UPDATE tbl_order SET status = 'รอเลขพัสดุ', delivery = '$delivery_option' WHERE o_code = '$o_code'");
  echo '<script type="text/javascript">
          swal("", "รอเลขพัสดุ !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=order.php" />';
}

if (isset($_GET["confirm1"])) {
  $o_code = mysqli_real_escape_string($con, $_GET['o_code']);
  mysqli_query($con, "UPDATE tbl_order SET status = 'กำลังเตรียมสินค้า' WHERE o_code = '$o_code'");
  echo '<script type="text/javascript">
          swal("", "กำลังเตรียมสินค้า !!", "success");
        </script>';
  echo '<meta http-equiv="refresh" content="1;url=order.php" />';
}

if (isset($_GET["cancel"])) {
  $o_code = mysqli_real_escape_string($con, $_GET['o_code']);
  $orderDetails = mysqli_query($con, "SELECT p_id, qty FROM tbl_order WHERE o_code = '$o_code'");
  while ($row = mysqli_fetch_assoc($orderDetails)) {
    $p_id = (int) $row['p_id'];
    $qty = (int) $row['qty'];
    mysqli_query($con, "UPDATE tbl_product SET p_qty = p_qty + $qty WHERE p_id = $p_id");
  }
  $o_id = (int) $_GET['cancel'];
  mysqli_query($con, "UPDATE tbl_order SET status = 'ยกเลิกออเดอร์' WHERE o_id = $o_id");
  echo '<script type="text/javascript">
          swal("", "ยกเลิกเรียบร้อย !!", "error").then(() => {
            window.location.href = "order.php";
          });
        </script>';
}

// Fetch and display order data
$sql = "SELECT tbl_order.*, tbl_member.m_name, tbl_product.p_name 
        FROM tbl_order 
        INNER JOIN tbl_member ON tbl_order.m_id = tbl_member.member_id 
        INNER JOIN tbl_product ON tbl_order.p_id = tbl_product.p_id 
        GROUP BY tbl_order.o_code 
        ORDER BY tbl_order.date DESC";

$result = mysqli_query($con, $sql);
if (!$result) {
  die("Error in query: " . mysqli_error($con));
}

echo '<table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr>
      <th>ลำดับ</th>
      <th>ชื่อผู้ใช้</th>
      <th>รหัสสั่งซื้อ</th>
      <th>วันที่สั่ง</th>
      <th>สถานะ</th>
    </tr>";
echo "</thead>";

$num = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align='center'>" . $num++ . "</td>";
  echo "<td><font color='blue'>" . htmlspecialchars($row["m_name"]) . "</font></td>";
  echo "<td>" . htmlspecialchars($row["o_code"]) . "<br>
            <a href='order_detail.php?o_code=" . htmlspecialchars($row['o_code']) . "' class='badge' style='background-color:#707B7C;'>
              <span class='glyphicon glyphicon-search'></span> รายละเอียด
            </a>
          </td> ";
  echo "<td>" . thai_date1(strtotime($row['date'])) . "</td> ";

  $status = htmlspecialchars($row['status']);
  switch ($status) {
    case 'รอตรวจสอบ':
      echo "<td align='center'>
                    <span class='badge' style='background-color:#F1C40F;'><b>$status</b></span><br><br>
                    <a href='?o_code=" . htmlspecialchars($row['o_code']) . "&confirm1' class='btn btn-success btn-xs'>
                      <span class='glyphicon glyphicon-ok'></span>
                    </a>
                    <a href='?o_code=" . htmlspecialchars($row['o_code']) . "&cancel=" . htmlspecialchars($row['o_id']) . "' class='btn btn-danger btn-xs'>
                      <span class='glyphicon glyphicon-remove'></span>
                    </a>
                  </td>";
      break;
    case 'กำลังเตรียมสินค้า':
      echo "<td align='center'>
                    <span class='badge' style='background-color:#20B2AA;'><b>$status</b></span><br><br>
                    <a href='?o_code=" . htmlspecialchars($row['o_code']) . "&confirm' class='btn btn-success btn-xs'>
                      <span class='glyphicon glyphicon-ok'></span>
                    </a>
                    <a href='?o_code=" . htmlspecialchars($row['o_code']) . "&cancel=" . htmlspecialchars($row['o_id']) . "' class='btn btn-danger btn-xs'>
                      <span class='glyphicon glyphicon-remove'></span>
                    </a>
                  </td>";
      break;
    case 'รอเลขพัสดุ':
      echo "<td align='center'>
              <span class='badge'>" . htmlspecialchars($status) . "</span><br>
              <form method='get'>
                กรอกเลขพัสดุ<br>
                  <input type='hidden' name='o_code' value='" . htmlspecialchars($row['o_code']) . "'>
                  <input type='text' name='tracking' required><br>
                  <select name='type_id' class='form-control' required>
                    <option value='' disabled selected>เลือกขนส่ง</option>";

      $delivery = [
        'J&T Express', 'Kerry Express', 'FLASH Express', 'ไปรษณีย์ไทย', 'SCG Express',
        'Grab Express', 'Lineman', 'TNT', 'Nim Express', 'DHL Express',
        'Alpha Fast', 'Lalamove', 'Niko’s Logistics', 'Ninja Van', 'Skootar'
      ];

      foreach ($delivery as $option) {
        echo "<option value='" . htmlspecialchars($option) . "'>" . htmlspecialchars($option) . "</option>";
      }

      echo "  </select><br>
                <input type='submit' value='บันทึก' class='btn btn-success btn-xs'>
              </form>
            </td>";
      break;

    case 'กำลังส่งสินค้า':
      echo "<td align='center'>
                      <span class='badge' style='background-color:#48C9B0;'><b>$status</b></span>
                    </td>";
      break;
    case 'ส่งสินค้าแล้ว':
      echo "<td align='center'>
                        <span class='badge' style='background-color:#00a65a;'><b>$status</b></span>
                      </td>";
      break;
    case 'ยกเลิกออเดอร์':
      echo "<td align='center'>
                    <span class='badge' style='background-color:#b30021;'><b>$status</b></span>
                  </td>";
      break;
  }
  echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>