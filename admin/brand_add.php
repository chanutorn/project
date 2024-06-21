<?php
if (@$_GET['do'] == 'f') {
    echo '<script type="text/javascript">swal("", "กรุณาใส่ข้อมูลให้ถูกต้อง !!", "warning");</script>';
    echo '<meta http-equiv="refresh" content="2;url=brand.php?act=add" />';
} elseif (@$_GET['do'] == 'd') {
    echo '<script type="text/javascript">swal("", "ข้อมูลซ้ำ กรุณาเปลี่ยน  !!", "error");</script>';
    echo '<meta http-equiv="refresh" content="1;url=brand.php?act=add" />';
}
?>
<form action="brand_add_db.php" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            ประเภทแบรนด์ :
        </div>
        <div class="col-sm-3">
            <input type="text" name="brand_name" required class="form-control" minlength="2">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success">เพิ่มข้อมูล</button>
            <a href="brand.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>