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

$query = "SELECT * FROM tbl_product AS p INNER JOIN tbl_productimg AS pi ON p.p_id = pi.p_id ORDER BY p.p_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo ' <table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr class=''>
        <th width='5%'>ลำดับ</th>
        <th width='10%'>รูป</th>
        <th width='10%'>ชื่อ</th>
        <th width='10%'>รูป1</th>
        <th width='10%'>รูป2</th>
        <th width='10%'>รูป3</th>
        <th width='10%'>รูป4</th>
        <th width='7%'>เพิ่มรูป</th>
      </tr>";
echo "</thead>";
$num = 1;
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td align='center'>" . $num++ . "</td>";
  echo "<td><img src='../p_img/" . $row['p_img'] . "' width='100px'></td>";
  echo "<td>" . $row["p_name"] . "</td>";
  if (!$row["p_img1"]) {
    echo "<td>ไม่มีรูปภาพ</td>";
  } else {
    echo "<td> <img src='../p_img/p_img_a/" . $row['p_img1'] . "' width='100px'></td>";
  }

  if (!$row["p_img2"]) {
    echo "<td>ไม่มีรูปภาพ</td>";
  } else {
    echo "<td> <img src='../p_img/p_img_a/" . $row['p_img2'] . "' width='100px'></td>";
  }

  if (!$row["p_img3"]) {
    echo "<td>ไม่มีรูปภาพ</td>";
  } else {
    echo "<td> <img src='../p_img/p_img_a/" . $row['p_img3'] . "' width='100px'></td>";
  }

  if (!$row["p_img4"]) {
    echo "<td>ไม่มีรูปภาพ</td>";
  } else {
    echo "<td> <img src='../p_img/p_img_a/" . $row['p_img4'] . "' width='100px'></td>";
  }
  //เพิ่มรูปภาพส่วนอื่นๆ
  echo "<td align='center'>
          <a href='product.php?act=image&ID=$row[p_id]' class='btn btn-success btn-xs'>
            <span class='glyphicon glyphicon-cloud-upload'></span>
          </a>
        </td> ";
}
echo "</table>";
mysqli_close($con);
