<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_css/f_footer.css">
    <?php
    include('h.php');
    include('condb.php');
    include('thai_date.php');
    ?>
</head>

<body>
    <nav>
        <?php
        include('navbar.php');
        $query = "SELECT * FROM tbl_coupon WHERE coupon_date > NOW()" or die("Error:" . mysqli_error($con));
        $result = mysqli_query($con, $query);
        ?>
    </nav>
    <div class="f-container">
        <div class="box">
            <strong>สะดวกสบายและประหยัดกับคูปองส่วนลด</strong>
        </div>
        <div class="text">
            <p>ยินดีต้อนรับสู่ร้านค้ารองเท้าออนไลน์ของเรา! เรามีคูปองส่วนลดที่จะทำให้การช้อปปิ้งของคุณเป็นที่สุดยอดในทุกๆ ครั้ง</p>

            <strong>รายละเอียดคูปองส่วนลด:</strong>
            <ul>
                <li><strong>ลดราคาพิเศษ:</strong> ลดราคาสุดพิเศษในการซื้อรองเท้าคู่ถัดไปของคุณ</li>
                <li><strong>ส่วนลดพิเศษสำหรับสมาชิก:</strong> สมาชิกที่สมัครสมาชิกกับเราจะได้รับสิทธิพิเศษอื่นๆ อีกมากมาย</li>
            </ul>

            <strong>เงื่อนไขและข้อกำหนด:</strong>
            <ul>
                <li>คูปองส่วนลดใช้ได้ตามเงื่อนไขที่ระบุ</li>
                <li>ไม่สามารถใช้ร่วมกับโปรโมชั่นอื่นๆ ได้</li>
                <li>อาจมีวันหมดอายุที่กำหนด</li>
            </ul>

            <strong>การใช้งานง่าย:</strong>
            <ol>
                <li>เลือกสินค้าที่คุณต้องการซื้อและเพิ่มเข้าตะกร้า</li>
                <li>ใส่รหัสคูปองส่วนลดที่ช่องที่กำหนด</li>
                <li>ราคาสุดท้ายจะถูกลดตามที่คูปองระบุ</li>
            </ol>

            <p>พบความสะดวกสบายและประหยัดมากขึ้นกับคูปองส่วนลดของเรา ไม่ว่าคุณจะกำลังมองหารองเท้าสำหรับการใช้งานประจำวัน กิจกรรมกีฬา หรือแฟชั่น เรามั่นใจว่าคุณจะพบสิ่งที่ต้องการที่นี่</p>

            <?php if (mysqli_num_rows($result) > 0) : ?>
                <p><strong>รหัสคูปอง:</strong></p>
                <ul>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<li><strong>" . $row['coupon_code'] . " *ลด " . $row['coupon_discount'] . " บาท ใช้ได้ถึง " . thai_date2(strtotime($row['coupon_date'])) . "*</strong></li>";
                    }
                    ?>
                </ul>
            <?php endif; ?>

            <p>รหัสคูปองสามารถใช้ได้ครั้งเดียว</p>

            <strong>รองเท้าคุณภาพที่ดีที่สุด - ราคาที่คุ้มค่าที่สุด</strong>
        </div>
    </div>
</body>

</html>