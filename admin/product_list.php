<?php
include('../thai_date.php');

if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
} else if (@$_GET['do'] == 'error') {
  echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
} else if (@$_GET['del'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ลบข้อมูลสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=product.php" />';
}

$query = "SELECT * FROM tbl_product AS p
          INNER JOIN tbl_type AS t ON p.type_id = t.type_id
          INNER JOIN tbl_brand AS b ON p.brand_id = b.brand_id
          ORDER BY p.p_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr class=''>
        <th width='5%'>ลำดับ</th>
        <th width='10%'>รูป</th>
        <th width='17%'>ชื่อสินค้า</th>
        <th width='25%'>รายละเอียดสินค้า</th>
        <th width='14%'>ราคาสินค้า</th>
        <th width='19%'>วันที่เพิ่มสินค้า</th>
        <th width='10%'>เพิ่มรูป</th>
        <th width='5%'>แก้ไข</th>
        <th width='5%'>ลบ</th>
      </tr>";
echo "</thead>";
$num = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align='center'>" . $num++ . "</td>";
  echo "<td> <img src='../p_img/" . $row['p_img'] . "' width='100px'> </td>";
  echo "<td> ชื่อ: <font color='blue'>" . $row["p_name"] . "</font> <br>
          รหัสสินค้า: <font color='red'>" . $row["type_id"] . "" . $row["brand_id"] . $row["p_id"] . "</font> <br>
          ประเภท: <font color='blue'>" . $row["type_name"] . "</font> <br>
          แบรนด์: <font color='blue'>" . $row["brand_name"] . "</font> <br>
          ขนาดไซส์: <font color='blue'>" . $row["p_size"] . "</font> <br>
          เพศ: <font color='blue'> " . $row["p_sex"] . "</font> </td class='hidden-xs'>";
  echo "<td>" . $row["p_detail"] . "</td>";
  echo "<td> ราคาขาย: " . number_format($row["p_price"]) . " บาท <br>";
  if ($row["p_qty"] == 0) {
    echo "<span class='badge' style='background-color:#F1C40F;'>สินค้าหมด</span></b>";
  } else {
    echo "จำนวน " . $row["p_qty"] . " คู่ </td>";
  }
  echo "<td> " . thai_date(strtotime($row['datesave'])) . "</td> ";
  //เพิ่มรูปภาพส่วนอื่นๆ
  echo "<td align='center'>
          <a href='product.php?act=image&ID=$row[p_id]' class='btn btn-success btn-xs'>
            <span class='glyphicon glyphicon-cloud-upload'></span>
          </a>
        </td> ";
  //แก้ไขข้อมูล
  echo "<td align='center'>
          <a href='product.php?act=edit&ID=$row[p_id]' class='btn btn-warning btn-xs'>
            <span class='glyphicon glyphicon-edit'></span>
          </a>
        </td> ";
  //ลบข้อมูล
  echo "<td align='center'>
          <a href='product_del_db.php?ID=$row[p_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'>
            <span class='glyphicon glyphicon-trash'></span>
          </a>
        </td> ";
}
echo "</table>";
mysqli_close($con);
?>