<?php
session_start();

if (@$_GET['do'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ทำรายการสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
} else if (@$_GET['do'] == 'finish') {
  echo '<script type="text/javascript">
          swal("", "แก้ไขสำเร็จ", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
} else if (@$_GET['do'] == 'wrong') {
  echo '<script type="text/javascript">
          swal("", "รหัสผ่านใหม่ไม่ตรงกัน !!", "warning");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
} else if (@$_GET['do'] == 'error') {
  echo '<script type="text/javascript">
          swal("", "ผิดพลาด !!", "error");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
} else if (@$_GET['do'] == 'wrong1') {
  echo '<script type="text/javascript">
          swal("", "ไม่สามารถลบได้ !!", "error");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
} else if (@$_GET['del'] == 'success') {
  echo '<script type="text/javascript">
          swal("", "ลบข้อมูลสำเร็จ !!", "success");
          </script>';
  echo '<meta http-equiv="refresh" content="1;url=member.php" />';
}
$adminID = $_SESSION["member_id"];

$query = "SELECT * FROM tbl_member WHERE m_level !='super_admin'" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $query);
echo '<table id="example1" class="table table-bordered table-striped">';
echo "<thead>";
echo "<tr class=''>
      <th width='5%' class='hidden-xs'>ลำดับ</th>
      <th width='15%' class='hidden-xs'>username & password</th>
      <th width='20%'>ข้อมูลส่วนตัว</th>
      <th width='20%'>ที่อยู่อาศัย</th>
      <th width='10%' class='hidden-xs'>สถานะ</th>  
      <th width='5%'>แก้ไข</th>
      <th width='5%'>ลบ</th>
    </tr>";
echo "</thead>";
$num = 1;
while ($row = mysqli_fetch_array($result)) {
  $st = $row["m_level"];
  $sa = $row["m_user"];
  echo "<tr>";
  echo "<td align='center'>" . $num++ . "</td>";
  echo "<td> username: " . $row["m_user"] . "<br>
          <a href='resetpass_admin.php?member_id=" . $row['member_id'] . "'>
            <span class='label label-warning'>(เปลี่ยนรหัสผ่าน)</span>
          </a>
        </td> ";
  echo "<td><b>ชื่อ</b> " . $row["m_name"] . "<br>
            <b>เบอร์โทร</b> " . $row["m_tel"] . "<br>
            <b>mail</b> " . $row["m_email"] . "</td> ";
  echo "<td>" . $row["m_address"] . "</td>";
  echo "<td align='center'>";
  if ($st == 'admin') {
    echo "ผู้ดูแลระบบ" . "<br> <span class='label label-success'>(Admin)</span>";
  } elseif ($st == 'member') {
    echo "สมาชิก" . "<br> <span class='label label-info'>(Member)</span>";
  }
  echo "</td> ";
  if ($sa == 'admin') {
    echo "<td align='center'>
            <a href='member.php?act=edit&ID=$row[member_id]' class='btn btn-warning btn-xs'>
              <span class='glyphicon glyphicon-edit'></span>
            </a>
          </td> ";
    echo "<td align='center'>
            <a href='member.php?do=wrong1' class='btn btn-danger btn-xs'>
              <span class='glyphicon glyphicon-minus'></span>
            </a>
          </td> ";
  } else if ($st == 'admin') {
    echo "<td align='center'>
            <a href='member.php?act=edit&ID=$row[member_id]' class='btn btn-warning btn-xs'>
              <span class='glyphicon glyphicon-edit'></span>
            </a>
          </td> ";
    echo "<td align='center'>
            <a href='member_del_db.php?ID=$row[member_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'>
              <span class='glyphicon glyphicon-trash'></span>
            </a>
          </td> ";
  } else {
    echo "<td align='center'>
            <a href='member.php?act=edit&ID=$row[member_id]' class='btn btn-warning btn-xs'>
              <span class='glyphicon glyphicon-edit'></span>
            </a>
          </td> ";
    echo "<td align='center'>
            <a href='member_del_db.php?ID=$row[member_id]' onclick=\"return confirm('ยันยันการลบ')\" class='btn btn-danger btn-xs'>
              <span class='glyphicon glyphicon-trash'></span>
            </a>
          </td> ";
  }
}
echo "</table>";
mysqli_close($con);
?>