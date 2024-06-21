<?php
include('../thai_date.php');

if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=coupon.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=coupon.php" />';
} else if (@$_GET['do'] == 'error') {
  echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=coupon.php" />';
} else if (@$_GET['del'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ลบข้อมูลสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=coupon.php" />';
}

$query = "SELECT * FROM tbl_coupon AS c" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr class=''>
      <th width='5%'>ลำดับ</th>
      <th width='10%'>รหัสคูปอง</th>
      <th width='10%'>ราคาที่ลด</th>
      <th width='25%'>วันที่สร้าง</th>
      <th width='25%'>วันหมดอายุ</th>
      <th width='5%'>ลบ</th>
    </tr>";
echo "</thead>";
// <th width='5%'>แก้ไข</th>
$num = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align='center'>" . $num++ . "</td>";
  echo "<td>" . $row["coupon_code"] . "</td> ";
  echo "<td>" . number_format($row["coupon_discount"], 2) . "</td> ";
  echo "<td>" . thai_date(strtotime($row['coupon_datesave'])) . "</td>";
  echo "<td> " . thai_date(strtotime($row['coupon_date'])) . "</td> ";
  // echo "<td align='center'>
  //         <a href='coupon.php?act=edit&ID=$row[coupon_id]' class='btn btn-warning btn-xs'>
  //           <span class='glyphicon glyphicon-edit'></span>
  //         </a>
  //       </td> ";
  echo "<td align='center'>
          <a href='coupon_del_db.php?ID=$row[coupon_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'>
            <span class='glyphicon glyphicon-trash'></span>
          </a>
        </td> ";
}
echo "</table>";
mysqli_close($con);
?>