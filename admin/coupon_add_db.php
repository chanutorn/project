<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
  Header("Location: index.php");
}
$coupon_code = mysqli_real_escape_string($con, $_POST["coupon_code"]);
$coupon_date = mysqli_real_escape_string($con, $_POST["coupon_date"]);
$coupon_discount = mysqli_real_escape_string($con, $_POST["coupon_discount"]);
$check = "SELECT coupon_code FROM tbl_coupon WHERE coupon_code = '$coupon_code'";
$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
$num = mysqli_num_rows($result1);

if ($num > 0) {
  echo '<script>';
  echo "window.location='coupon.php?act=add&do=d';";
  echo '</script>';
} else {
  $sql = "INSERT INTO `tbl_coupon` (`coupon_code`, `coupon_date`, `coupon_discount`, `coupon_status`)
    VALUES ('$coupon_code', '$coupon_date', '$coupon_discount', 'ใช้งานได้')";
  $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
}

mysqli_close($con);
if ($result) {
  echo '<script>';
  echo "window.location='coupon.php?do=success';";
  echo '</script>';
} else {
  echo '<script>';
  echo "window.location='coupon.php?act=add&do=f';";
  echo '</script>';
}
