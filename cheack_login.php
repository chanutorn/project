<?php
session_start();
if (isset($_POST['m_user'])) {
    include("condb.php");

    // รับค่า user & mem_password
    $m_user = mysqli_real_escape_string($con, $_POST['m_user']);
    $m_pass = mysqli_real_escape_string($con, $_POST['m_pass']);

    // ตรวจสอบข้อมูลที่ไม่ได้รับค่า
    if (empty($m_user) || empty($m_pass)) {
        echo json_encode(["status" => "error", "msg" => "โปรดกรอกข้อมูลให้ครบทุกช่อง"]);
        exit;
    }

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM tbl_member WHERE m_user = '$m_user'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // ตรวจสอบรหัสผ่าน
        if (password_verify($m_pass, $row['m_pass'])) {
            $_SESSION["member_id"] = $row["member_id"];
            $_SESSION["m_level"] = $row["m_level"];
            $_SESSION["m_name"] = $row["m_name"];

            if ($row['m_level'] == "admin" || $row['m_level'] == "super_admin") {
                echo json_encode(["status" => "success", "location" => "admin/"]);
            } elseif ($row['m_level'] == "member") {
                echo json_encode(["status" => "success", "location" => "member/"]);
            }
        } else {
            echo json_encode(["status" => "error", "msg" => "User หรือ Password ไม่ถูกต้อง"]);
        }
    } else {
        echo json_encode(["status" => "error", "msg" => "User หรือ Password ไม่ถูกต้อง"]);
    }
} else {
    header("Location: index.php");
    exit();
}
?>