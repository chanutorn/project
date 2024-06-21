<?php
session_start();
include('../condb.php');

$pass = mysqli_real_escape_string($con, $_POST['m_subpass1']);
$subpass = mysqli_real_escape_string($con, $_POST['m_subpass2']);
$m_user = $_SESSION["member_id"];

if ($pass == $subpass) {
	$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

	$sql_resetpass = "UPDATE tbl_member SET
        m_pass = '$hashed_password'
        WHERE member_id = '$m_user'";

	$result_resetpass = mysqli_query($con, $sql_resetpass);

	if ($result_resetpass) {
		echo "<script>";
		echo "alert(\"แก้ไขสำเร็จ\");";
		echo "window.history.back()";
		echo "</script>";
	} else {
		echo "<script>";
		echo "alert(\"แก้ไขไม่สำเร็จ\");";
		echo "window.history.back()";
		echo "</script>";
	}
} else {
	echo "<script>";
	echo "alert(\"รหัสผ่านไม่ตรงกัน\");";
	echo "window.history.back()";
	echo "</script>";
}
