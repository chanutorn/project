<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
	Header("Location: index.php");
}
$ID  = mysqli_real_escape_string($con, $_GET["ID"]);
$sql = "DELETE FROM tbl_type WHERE type_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
mysqli_close($con);

if ($result) {
	echo "<script type='text/javascript'>";
	echo "window.location = 'type.php?del=success'; ";
	echo "</script>";
} else {
	echo "<script type='text/javascript'>";
	echo "window.location = 'type.php?do=error'; ";
	echo "</script>";
}
