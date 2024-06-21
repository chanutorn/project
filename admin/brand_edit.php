<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tbl_brand WHERE brand_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>
<form action="brand_edit_db.php" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-2 control-label">
            ประเภทสินค้า :
        </div>
        <div class="col-sm-3">
            <input type="text" name="brand_name" required class="form-control" value="<?php echo $row['brand_name']; ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
            <input type="hidden" name="brand_id" value="<?php echo $ID; ?>" />
            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
            <a href="brand.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>