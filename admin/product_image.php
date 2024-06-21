<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tbl_product AS p INNER JOIN tbl_productimg AS pi ON p.p_id = pi.p_id WHERE p.p_id = $ID" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
?>
<script type="text/javascript">
    function readURL(input, imgElement) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(imgElement).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<form action="product_image_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">

    <div class="form-group">
        <div class="col-sm-2 control-label">
            ชื่อสินค้า :
        </div>
        <div class="col-sm-3">
            <input type="text" name="p_name" required class="form-control" value="<?php echo $row['p_name']; ?>" disabled>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้า :
        </div>
        <div class="col-sm-4">
            <img src="../p_img/<?php echo $row['p_img']; ?>" width="100px">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้าที่ 1 :
        </div>
        <div class="col-sm-4">
            <img src="../p_img/p_img_a/<?php echo $row['p_img1']; ?>" width="100px">
            <input type="file" name="p_img1" class="form-control" accept="image/*;" onchange="readURL(this, '#blah1')" id="imgInput1">
            <img id="blah1" src="#" alt="" width="100px" class="img-rounded" style="margin-top: 10px;">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้าที่ 2 :
        </div>
        <div class="col-sm-4">
            <img src="../p_img/p_img_a/<?php echo $row['p_img2']; ?>" width="100px">
            <input type="file" name="p_img2" class="form-control" accept="image/*;" onchange="readURL(this, '#blah2')" id="imgInput2">
            <img id="blah2" src="#" alt="" width="100px" class="img-rounded" style="margin-top: 10px;">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้าที่ 3 :
        </div>
        <div class="col-sm-4">
            <img src="../p_img/p_img_a/<?php echo $row['p_img3']; ?>" width="100px">
            <input type="file" name="p_img3" class="form-control" accept="image/*;" onchange="readURL(this, '#blah3')" id="imgInput3">
            <img id="blah3" src="#" alt="" width="100px" class="img-rounded" style="margin-top: 10px;">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">
            รูปภาพสินค้าที่ 4 :
        </div>
        <div class="col-sm-4">
            <img src="../p_img/p_img_a/<?php echo $row['p_img4']; ?>" width="100px">
            <input type="file" name="p_img4" class="form-control" accept="image/*;" onchange="readURL(this, '#blah4')" id="imgInput4">
            <img id="blah4" src="#" alt="" width="100px" class="img-rounded" style="margin-top: 10px;">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-3">
            <input type="hidden" name="p_img1" value="<?php echo $row['p_img1']; ?>">
            <input type="hidden" name="p_img2" value="<?php echo $row['p_img2']; ?>">
            <input type="hidden" name="p_img3" value="<?php echo $row['p_img3']; ?>">
            <input type="hidden" name="p_img4" value="<?php echo $row['p_img4']; ?>">
            <input type="hidden" name="p_id" value="<?php echo $ID; ?>" />
            <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
            <a href="product.php" class="btn btn-danger">ยกเลิก</a>
        </div>
    </div>
</form>
<script>
    function readURL(input, imgElement) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(imgElement).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>