<?php

if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=type.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=type.php" />';
} else if (@$_GET['do'] == 'wrong') {
  echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=type.php" />';
} else if (@$_GET['do'] == 'error') {
  echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=type.php" />';
} else if (@$_GET['del'] == 'success') {
  echo '<script type="text/javascript">
            swal("", "ลบข้อมูลสำเร็จ !!", "success");
            </script>';
  echo '<meta http-equiv="refresh" content="1;url=type.php" />';
}

$query = "SELECT * FROM tbl_type" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
?>
<table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr class=''>
      <th width='10%'>ลำดับ</th>
      <th width='12%'>รหัสประเภทสินค้า</th>
      <th width='60%'>ประเภทสินค้า</th>
      <th width='5%'>แก้ไข</th>
      <th width='5%'>ลบ</th>
    </tr>
  </thead>
  <?php
  $num = 1;
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <tr>
      <td align='center'><?= $num++ ?></td>
      <td align='center'><?= $row["type_id"] ?></td>
      <td><?= $row["type_name"] ?></td>
      <td align='center'>
        <a href='type.php?act=edit&ID=<?= $row["type_id"] ?>' class='btn btn-warning btn-xs'>
          <span class='glyphicon glyphicon-edit'></span>
        </a>
      </td>
      <td align='center'>
        <a href='type_del_db.php?ID=<?= $row["type_id"] ?>' onclick="return confirm('ยันยันการลบ')" class='btn btn-danger btn-xs'>
          <span class='glyphicon glyphicon-trash'></span>
        </a>
      </td>
    </tr>
  <?php } ?>
</table>
<?php
mysqli_close($con);
?>