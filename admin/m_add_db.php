<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
	Header("Location: index.php");
}
$m_level = mysqli_real_escape_string($con, $_POST["m_level"]);
$m_user = mysqli_real_escape_string($con, $_POST["m_user"]);
$m_pass = mysqli_real_escape_string($con, $_POST["m_pass"]);
$m_name = mysqli_real_escape_string($con, $_POST["m_name"]);
$m_tel = mysqli_real_escape_string($con, $_POST["m_tel"]);
$m_email = mysqli_real_escape_string($con, $_POST["m_email"]);
$m_address = mysqli_real_escape_string($con, $_POST["m_address"]);

$date1 = date("Ymd_His");
$numrand = (mt_rand());

$check = "
	SELECT m_user
	FROM tbl_member
	WHERE m_user = '$m_user'
	";
$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
$num = mysqli_num_rows($result1);

if ($num > 0) {
	echo '<script>';
	echo "window.location='member.php?act=add&do=d';";
	echo '</script>';
} else {

	$sql = "INSERT INTO tbl_member
	(
	m_level,
	m_user,
	m_pass,
	m_name,
	m_tel,
	m_email,
	m_address
	)
	VALUES
	(
	'$m_level',
	'$m_user',
	'$m_pass',
	'$m_name',
	'$m_tel',
	'$m_email',
	'$m_address'
	)";

	$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
}
mysqli_close($con);

if ($result) {
	echo '<script>';
	echo "window.location='member.php?do=success';";
	echo '</script>';
} else {
	echo '<script>';
	echo "window.location='member.php?act=add&do=f';";
	echo '</script>';
}
