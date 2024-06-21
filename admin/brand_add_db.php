<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
    Header("Location: index.php");
}
$brand_name = mysqli_real_escape_string($con, $_POST["brand_name"]);
$check = "SELECT brand_name FROM tbl_brand WHERE brand_name = '$brand_name'";
$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
$num = mysqli_num_rows($result1);

if ($num > 0) {
    echo '<script>';
    echo "window.location='brand.php?act=add&do=d';";
    echo '</script>';
} else {
    $sql = "INSERT INTO tbl_brand (brand_name) VALUES ('$brand_name')";
    $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
}

mysqli_close($con);
if ($result) {
    echo '<script>';
    echo "window.location='brand.php?do=success';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='brand.php?act=add&do=f';";
    echo '</script>';
}
