<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");</script>';
    echo '<meta http-equiv="refresh" content="2;url=coupon.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">swal("", "ข้อมูลซ้ำ กรุณาเปลี่ยน  !!", "error");</script>';
    echo '<meta http-equiv="refresh" content="1;url=coupon.php?act=add" />';
}
?>
<form action="coupon_add_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            รหัสคูปอง :
        </div>
        <div class="col-sm-3">
            <input type="text" name="coupon_code" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            ส่วนลด :
        </div>
        <div class="col-sm-3">
            <input type="number" name="coupon_discount" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            วันหมดอายุ :
        </div>
        <div class="col-sm-3">
            <input type="date" name="coupon_date" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
            <a href="coupon.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>