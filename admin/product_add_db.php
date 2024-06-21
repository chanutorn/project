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
$p_name = mysqli_real_escape_string($con, $_POST["p_name"]);
$type_id = mysqli_real_escape_string($con, $_POST["type_id"]);
$brand_id = mysqli_real_escape_string($con, $_POST["brand_id"]);
$p_detail = mysqli_real_escape_string($con, $_POST["p_detail"]);
$p_size = mysqli_real_escape_string($con, $_POST["p_size"]);
$p_price = mysqli_real_escape_string($con, $_POST["p_price"]);
$p_qty = mysqli_real_escape_string($con, $_POST["p_qty"]);
$p_sex = mysqli_real_escape_string($con, $_POST["p_sex"]);

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
$upload = $_FILES['p_img']['name'];
if ($upload != '') {
	$path = "../p_img/";
	$type = strrchr($_FILES['p_img']['name'], ".");
	$newname = $numrand . $date1 . $type;
	$path_copy = $path . $newname;
	$path_link = "../p_img/" . $newname;
	move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
}

$check = "SELECT  p_name FROM tbl_product WHERE p_name = '$p_name'";
$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
$num = mysqli_num_rows($result1);
if ($num > 0) {
	echo '<script>';
	echo "window.location='product.php?act=add&do=d';";
	echo '</script>';
} else {
	$sql = "INSERT INTO tbl_product (p_name, type_id, brand_id, p_detail, p_size, p_price, p_qty, p_sex, p_img)
	VALUES ('$p_name', '$type_id', '$brand_id', '$p_detail', '$p_size', '$p_price', '$p_qty', '$p_sex', '$newname')";

	$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
}
if ($result) {
	// ดึงรหัสแถวที่เพิ่มล่าสุดใน tbl_product
	$p_id = mysqli_insert_id($con);

	// เพิ่มข้อมูลในตาราง tbl_productimg
	$sql_image = "INSERT INTO tbl_productimg (p_id, p_img1, p_img2, p_img3, p_img4)
				  VALUES ('$p_id', '', '', '', '')";

	$result_image = mysqli_query($con, $sql_image) or die("Error in query: $sql_image " . mysqli_error($con));
} else {
	echo "Error adding data to tbl_product: " . mysqli_error($con);
}
mysqli_close($con);

if ($result) {
	echo '<script>';
	echo "window.location='product.php?do=success';";
	echo '</script>';
} else {
	echo '<script>';
	echo "window.location='product.php?act=add&do=d';";
	echo '</script>';
}
?>