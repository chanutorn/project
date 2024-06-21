<?php
session_start();

// เชื่อมต่อกับฐานข้อมูล
include('../condb.php');

// เรียกใช้งาน session ที่เก็บข้อมูลรายการสินค้าที่ถูกยกเลิก
if (isset($_SESSION["cancelled_order"])) {
    $cancelledOrderItems = $_SESSION["cancelled_order"];

    // แสดงข้อมูลรายการสินค้าที่ถูกยกเลิก
    echo "<pre>";
    print_r($cancelledOrderItems);
    echo "</pre>";

    // ล้างข้อมูลรายการสินค้าที่ถูกยกเลิกออกจาก session เมื่อไม่ต้องการใช้งานต่อ
    unset($_SESSION["cancelled_order"]);
} else {
    // ถ้าไม่มีข้อมูลรายการสินค้าที่ถูกยกเลิกใน session
    echo "<h2>ไม่มีข้อมูลรายการสินค้าที่ถูกยกเลิก</h2>";
}
?>