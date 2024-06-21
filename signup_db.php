<?php
session_start();
include('condb.php');

$m_level = 'member';
$m_user = mysqli_real_escape_string($con, $_POST["m_user"]);
$m_pass = mysqli_real_escape_string($con, $_POST["m_pass"]);
$confirm_pass = mysqli_real_escape_string($con, $_POST["confirm_pass"]);
$m_name = mysqli_real_escape_string($con, $_POST["m_name"]);
$m_tel = mysqli_real_escape_string($con, $_POST["m_tel"]);
$m_email = mysqli_real_escape_string($con, $_POST["m_email"]);
$m_address = mysqli_real_escape_string($con, $_POST["m_address"]);

// ตรวจสอบข้อมูลที่ไม่ได้รับค่า
if (empty($m_user) || empty($m_pass) || empty($confirm_pass) || empty($m_name) || empty($m_tel) || empty($m_email) || empty($m_address)) {
    echo json_encode(["status" => "error", "msg" => "โปรดกรอกข้อมูลให้ครบทุกช่อง"]);
    exit;
}

// ตรวจสอบรหัสผ่านยืนยัน
if ($m_pass !== $confirm_pass) {
    echo json_encode(["status" => "error", "msg" => "รหัสผ่านยืนยันไม่ตรงกับรหัสผ่านที่กรอก"]);
    exit;
}

// ตรวจสอบชื่อผู้ใช้ซ้ำ
$sql_check_user = "SELECT * FROM tbl_member WHERE m_user = ?";
$stmt = $con->prepare($sql_check_user);
$stmt->bind_param("s", $m_user);
$stmt->execute();
$result_check_user = $stmt->get_result();

if ($result_check_user->num_rows > 0) {
    echo json_encode(["status" => "error", "msg" => "มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว"]);
    exit;
}

// ตรวจสอบอีเมล์ซ้ำ
$sql_check_email = "SELECT * FROM tbl_member WHERE m_email = ?";
$stmt = $con->prepare($sql_check_email);
$stmt->bind_param("s", $m_email);
$stmt->execute();
$result_check_email = $stmt->get_result();

if ($result_check_email->num_rows > 0) {
    echo json_encode(["status" => "error", "msg" => "มีอีเมล์นี้อยู่ในระบบแล้ว"]);
    exit;
}

// ตรวจสอบเบอร์โทร
if (!preg_match("/^[0-9]{10}$/", $m_tel)) {
    echo json_encode(["status" => "error", "msg" => "โปรดกรอกเบอร์โทรศัพท์ 10 หลักที่เป็นตัวเลขเท่านั้น"]);
    exit;
}

// ตรวจสอบอีเมล์
if (!filter_var($m_email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["status" => "error", "msg" => "โปรดกรอกอีเมล์ให้ถูกต้อง"]);
    exit;
}

$hash_login_password = password_hash($m_pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO tbl_member (m_level, m_user, m_pass, m_name, m_tel, m_email, m_address) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("sssssss", $m_level, $m_user, $hash_login_password, $m_name, $m_tel, $m_email, $m_address);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "msg" => "สมัครสมาชิกสำเร็จ"]);
} else {
    echo json_encode(["status" => "error", "msg" => "สมัครสมาชิกไม่สำเร็จ"]);
}

$stmt->close();
$con->close();
?>
