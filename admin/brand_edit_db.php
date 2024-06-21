<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
    Header("Location: index.php");
}
$brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);
$brand_name = mysqli_real_escape_string($con, $_POST["brand_name"]);
$sql = "UPDATE tbl_brand SET brand_name='$brand_name' WHERE brand_id=$brand_id";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));

mysqli_close($con);
if ($result) {
    echo '<script>';
    echo "window.location='brand.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='brand.php?act=add&do=f';";
    echo '</script>';
}
