<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    session_start();
    include("../condb.php");
    ?>
</head>

<body>
    <?php

    $m_id = $_SESSION["member_id"];

    if (isset($_POST["pay"])) {
        //รหัส Order
        $o_code = $m_id . substr(date('Y'), -2) . date('mdHis');
        //เรียกใช้งานฐานข้อมูล tbl_member เพื่อตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        $sql_check_member = "SELECT * FROM tbl_member WHERE member_id = $m_id AND m_level = 'member' AND m_tel IS NOT NULL AND m_email IS NOT NULL AND m_address IS NOT NULL";
        $result_check_member = mysqli_query($con, $sql_check_member);
        //ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        if (mysqli_num_rows($result_check_member) > 0) {
            $total = 0;
            //วนลูปตะกร้าสินค้า
            foreach ($_SESSION["order"] as $data) {
                $qty = $data["qty"];
                $p_id = $data["p_id"];
                $product_total = $data["total"];

                $total += $product_total;

                $name_file =  $_FILES['slip']['name'];
                $tmp_name =  $_FILES['slip']['tmp_name'];
                $locate_img = "../image/slip/";
                move_uploaded_file($tmp_name, $locate_img . $name_file);

                //เพิ่มข้อมูลในฐานข้อมูล tbl_order
                $q = mysqli_query($con, "INSERT INTO `tbl_order`(`o_code`, `m_id`, `p_id`, `qty`, `total`, `status` , `slip`)
                    VALUES ('$o_code','$m_id','$p_id','$qty','$product_total','รอตรวจสอบ','$name_file')");
                //ลบจำนวนของสินค้าที่ซื้อไป
                mysqli_query($con, "UPDATE tbl_product SET p_qty = p_qty - $qty WHERE p_id = $p_id");

                if ($q) {
                    // ลบรายการในตะกร้าหากมีการทำรายการสำเร็จ
                    mysqli_query($con, "DELETE FROM tbl_cart WHERE m_id = $m_id");

                    echo "<script>
                        Swal.fire({
                            title: 'ทำรายการสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'ตกลง'
                        }).then(() => {
                            window.location='cart.php';
                        });
                    </script>";
                }
            }

            unset($_SESSION["order"]);
            //ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        } else {
            echo "<script>
                Swal.fire({
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วนก่อนชำระเงิน',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    window.location='member_edit.php?id=$member_id';
                });
            </script>";
        }
    }

    if (isset($_POST["coupon"])) {
        //รหัส Order
        $o_code = $m_id . substr(date('Y'), -2) . date('mdHis');
        //เรียกใช้งานฐานข้อมูล tbl_member เพื่อตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        $sql_check_member = "SELECT * FROM tbl_member WHERE member_id = $m_id AND m_level = 'member' AND m_tel IS NOT NULL AND m_email IS NOT NULL AND m_address IS NOT NULL";
        $result_check_member = mysqli_query($con, $sql_check_member);
        //ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        if (mysqli_num_rows($result_check_member) > 0) {
            $total = 0;
            //วนลูปตะกร้าสินค้า
            foreach ($_SESSION["order"] as $data) {
                $qty = $data["qty"];
                $p_id = $data["p_id"];
                $product_total = $data["total"];

                $coupon_code = mysqli_real_escape_string($con, $_POST["coupon_code"]);
                $coupon_discount = 0;
                //ถ้ามีการใส่คูปองให้ทำในเงื่อนไข
                if (!empty($coupon_code)) {
                    //เรียกใช้งานฐานข้อมูล tbl_checkcoupon เพื่อตรวจสอบ ชื่อคูปอง และรหัสลูกค้า
                    $sql_check_coupon = "SELECT * FROM tbl_checkcoupon WHERE c_name = '$coupon_code' AND m_id = $m_id";
                    $result_check_coupon = mysqli_query($con, $sql_check_coupon);

                    if (mysqli_num_rows($result_check_coupon) > 0) {
                        $check_coupon_data = mysqli_fetch_assoc($result_check_coupon);
                        //ถ้าคูปองถูกใช้งานแล้วให้ทำในเงื่อนไข
                        if ($check_coupon_data["c_name"] == $coupon_code) {
                            echo "<script>
                          Swal.fire({
                            title: 'รหัสคูปองถูกใช้งานแล้ว',
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                          }).then(() => {
                            window.location='pay.php';
                          });
                        </script>";
                            exit;
                        }

                        $coupon_discount = $check_coupon_data["coupon_discount"];
                        $coupon_discount_p = $product_total - $coupon_discount;

                        $coupon_id = $check_coupon_data["coupon_id"];
                        mysqli_query($con, "UPDATE `tbl_checkcoupon` SET `c_status` = 'ใช้งานแล้ว' WHERE `c_id` = $coupon_id");
                    }
                    //เรียกใช้งานฐานข้อมูล tbl_coupon
                    $sql_coupon = "SELECT * FROM tbl_coupon WHERE coupon_code = '$coupon_code'";
                    $result_coupon = mysqli_query($con, $sql_coupon);

                    if (mysqli_num_rows($result_coupon) > 0) {
                        $coupon_data = mysqli_fetch_assoc($result_coupon);

                        //ตรวจสอบถ้าวันที่เกินให้ทำในเงื่อนไข
                        if (strtotime($coupon_data["coupon_date"]) < strtotime(date('Y-m-d'))) {
                            echo "<script>
                          Swal.fire({
                            title: 'รหัสคูปองเกินเวลาที่กำหนด',
                            icon: 'error',
                            confirmButtonText: 'ตกลง'
                          }).then(() => {
                            window.location='pay.php';
                          });
                        </script>";
                            exit;
                        }

                        $coupon_discount = $coupon_data["coupon_discount"];
                        $coupon_discount_p = $product_total - $coupon_discount;

                        $coupon_id = $coupon_data["coupon_id"];
                        mysqli_query($con, "UPDATE `tbl_coupon` SET `coupon_status` = 'ใช้งานแล้ว' WHERE `coupon_id` = $coupon_id");
                        //ตรวจสอบถ้าคูปองไม่ถูกต้อง
                    } else {
                        echo "<script>
                        Swal.fire({
                          title: 'รหัสคูปองไม่ถูกต้อง',
                          icon: 'error',
                          confirmButtonText: 'ตกลง'
                        }).then(() => {
                          window.location='pay.php';
                        });
                      </script>";
                        exit;
                    }
                } else {
                    $coupon_discount_p = $product_total;
                }

                $total += $coupon_discount_p;

                $name_file =  $_FILES['slip']['name'];
                $tmp_name =  $_FILES['slip']['tmp_name'];
                $locate_img = "../image/slip/";
                move_uploaded_file($tmp_name, $locate_img . $name_file);
                //เพิ่มข้อมูลในฐานข้อมูล tbl_checkcoupon
                $q_coupon = mysqli_query($con, "INSERT INTO `tbl_checkcoupon`(`m_id`, `c_name`)
                VALUES ('$m_id','$coupon_code')");

                if (!empty($coupon_code)) {
                    echo "<script>
                      Swal.fire({
                        title: 'คูปองถูกใช้งาน ลดราคาสินค้า $coupon_discount บาท',
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                      }).then(() => {
                        window.location='pay.php';
                      });
                    </script>";
                }
            }

            unset($_SESSION["order"]);
            //ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        } else {
            echo "<script>
                  Swal.fire({
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วนก่อนชำระเงิน',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                  }).then(() => {
                    window.location='member_edit.php?id=$member_id';
                  });
                </script>";
        }
    }
    ?>
</body>

</html>