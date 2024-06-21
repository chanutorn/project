<?php
session_start();
include("../condb.php");

// print_r($_SESSION);
// exit();
// echo "<br>";

$member_id = $_SESSION['member_id'];
$m_name = $_SESSION['m_name'];
$m_level = $_SESSION['m_level'];

if ($m_level != 'member') {
    header("Location: ../logout.php");
}

$sql = "SELECT * FROM tbl_member WHERE member_id = $member_id";
$result = mysqli_query($con, $sql) or die("Error in query: $sql" . mysqli_error($con));
$row = mysqli_fetch_array($result);
extract($row);

$m_name = $row['m_name'];

// echo $sql;
// exit();

?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>WJ Store รองเท้ามือสอง หาดใหญ่</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link rel="shortcut icon" href="../image/icon_wj.png" type="image/x-icon">