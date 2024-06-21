<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
	Header("Location: index.php");
}
$ID  = mysqli_real_escape_string($con, $_GET["ID"]);
$sql = "DELETE FROM tbl_product WHERE p_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));

$ID  = mysqli_real_escape_string($con, $_GET["ID"]);
$sql1 = "DELETE FROM tbl_productimg WHERE p_id=$ID";
$result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));

mysqli_close($con);

if ($result) {
	echo "<script type='text/javascript'>";
	echo "window.location = 'product.php?do=success'; ";
	echo "</script>";
} else {
	echo "<script type='text/javascript'>";
	echo "window.location = 'product.php?do=error'; ";
	echo "</script>";
}
?>