<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if ($_SESSION['m_level'] != 'member') {
	Header("Location: index.php");
}
$member_id = mysqli_real_escape_string($con, $_POST['member_id']);
$m_name = mysqli_real_escape_string($con, $_POST["m_name"]);
$m_tel = mysqli_real_escape_string($con, $_POST["m_tel"]);
$m_email = mysqli_real_escape_string($con, $_POST["m_email"]);
$m_address = mysqli_real_escape_string($con, $_POST["m_address"]);


$date1 = date("Ymd_His");
$numrand = (mt_rand());

$sql = "UPDATE `tbl_member` SET 
    `member_id`='$member_id',
    `m_name`='$m_name',
    `m_email`='$m_email',
    `m_tel`='$m_tel',
    `m_address`='$m_address'
    WHERE member_id=$member_id
	 ";

echo $sql;

$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
mysqli_close($con);

if ($result) {
	echo '<script>';
	echo "alert(\" แก้ไขสำเร็จ\");";
	echo "window.history.back()";
	echo '</script>';
} else {
	echo '<script>';
	echo "alert(\" แก้ไขไม่สำเร็จ\");";
	echo "window.history.back()";
	echo '</script>';
}
