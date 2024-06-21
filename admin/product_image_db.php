<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');

if ($_SESSION['m_level'] != 'admin' && $_SESSION['m_level'] != 'super_admin') {
    Header("Location: index.php");
}

$p_id = mysqli_real_escape_string($con, $_POST["p_id"]);

$date1 = date("Ymd_His");
$numrand1 = (mt_rand(1, 3));
$p_img1 = (isset($_POST['p_img1']) ? $_POST['p_img1'] : '');
$upload1 = $_FILES['p_img1']['name'];

$date2 = date("Ymd_His");
$numrand2 = (mt_rand(3, 6));
$p_img2 = (isset($_POST['p_img2']) ? $_POST['p_img2'] : '');
$upload2 = $_FILES['p_img2']['name'];

$date3 = date("Ymd_His");
$numrand3 = (mt_rand(6, 9));
$p_img3 = (isset($_POST['p_img3']) ? $_POST['p_img3'] : '');
$upload3 = $_FILES['p_img3']['name'];

$date4 = date("Ymd_His");
$numrand4 = (mt_rand(9, 12));
$p_img4 = (isset($_POST['p_img4']) ? $_POST['p_img4'] : '');
$upload4 = $_FILES['p_img4']['name'];

if ($upload1 != '') {
    $path1 = "../p_img/p_img_a/";
    $type1 = strrchr($_FILES['p_img1']['name'], ".");
    $newname1 = $numrand1 . $date1 . $type1;
    $path_copy1 = $path1 . $newname1;
    $path_link1 = "../p_img/p_img_a/" . $newname1;
    move_uploaded_file($_FILES['p_img1']['tmp_name'], $path_copy1);
} else {
    $newname1 = '';
}

if ($upload2 != '') {
    $path2 = "../p_img/p_img_a/";
    $type2 = strrchr($_FILES['p_img2']['name'], ".");
    $newname2 = $numrand2 . $date2 . $type2;
    $path_copy2 = $path2 . $newname2;
    $path_link2 = "../p_img/p_img_a/" . $newname2;
    move_uploaded_file($_FILES['p_img2']['tmp_name'], $path_copy2);
} else {
    $newname2 = '';
}

if ($upload3 != '') {
    $path3 = "../p_img/p_img_a/";
    $type3 = strrchr($_FILES['p_img3']['name'], ".");
    $newname3 = $numrand3 . $date3 . $type3;
    $path_copy3 = $path3 . $newname3;
    $path_link3 = "../p_img/p_img_a/" . $newname3;
    move_uploaded_file($_FILES['p_img3']['tmp_name'], $path_copy3);
} else {
    $newname3 = '';
}

if ($upload4 != '') {
    $path4 = "../p_img/p_img_a/";
    $type4 = strrchr($_FILES['p_img4']['name'], ".");
    $newname4 = $numrand4 . $date4 . $type4;
    $path_copy4 = $path4 . $newname4;
    $path_link4 = "../p_img/p_img_a/" . $newname4;
    move_uploaded_file($_FILES['p_img4']['tmp_name'], $path_copy4);
} else {
    $newname4 = '';
}

// เพิ่มไปยัง SQL query
$sql = "UPDATE tbl_productimg SET p_img1='$newname1', p_img2='$newname2', p_img3='$newname3', p_img4='$newname4' WHERE p_id=$p_id";

$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
mysqli_close($con);

if ($result) {
    echo '<script>';
    echo "window.location='product.php?do=finish';";
    echo '</script>';
} else {
    echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>