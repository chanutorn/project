<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tbl_product AS p
        INNER JOIN tbl_type AS t ON p.type_id = t.type_id
        INNER JOIN tbl_brand AS b ON p.brand_id = b.brand_id
        WHERE p.p_id = $ID
        ORDER BY p.p_id DESC" or die("Error:" . mysqli_error($con));
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);

$sql1 = "SELECT * FROM tbl_type ORDER BY type_id DESC" or die("Error:" . mysqli_error($con));
$result_t = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));

$sql2 = "SELECT * FROM tbl_brand ORDER BY brand_id DESC" or die("Error:" . mysqli_error($con));
$result_b = mysqli_query($con, $sql2) or die("Error in query: $sql2 " . mysqli_error($con));

?>
<script type="text/javascript">
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>

<form action="product_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อสินค้า :
    </div>
    <div class="col-sm-3">
      <input type="text" name="p_name" required class="form-control" value="<?php echo $row['p_name']; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      ประเภทสินค้า :
    </div>
    <div class="col-sm-3">
      <select name="type_id" class="form-control" required>
        <option value="<?php echo $row['type_id']; ?>" selected hidden><?php echo $row['type_name']; ?></option>
        <option value="" disabled>เลือกประเภทสินค้า</option>
        <?php foreach ($result_t as $results) { ?>
          <option value="<?php echo $results["type_id"]; ?>">
            <?php echo $results["type_name"]; ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      ประเภทแบรนด์ :
    </div>
    <div class="col-sm-3">
      <select name="brand_id" class="form-control" required>
        <option value="<?php echo $row['brand_id']; ?>" selected hidden><?php echo $row['brand_name']; ?></option>
        <option value="" disabled>เลือกประเภทแบรนด์</option>
        <?php foreach ($result_b as $results) { ?>
          <option value="<?php echo $results["brand_id"]; ?>">
            <?php echo $results["brand_name"]; ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      รายละเอียด :
    </div>
    <div class="col-sm-3">
      <textarea name="p_detail" cols="60" rows="6"><?php echo $row['p_detail']; ?></textarea>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      ไซส์ :
    </div>
    <div class="col-sm-2">
      <input type="number" name="p_size" class="form-control" min="0" value="<?php echo $row['p_size']; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      ราคา :
    </div>
    <div class="col-sm-2">
      <input type="number" name="p_price" class="form-control" min="0" value="<?php echo $row['p_price']; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      จำนวน :
    </div>
    <div class="col-sm-1">
      <input type="number" name="p_qty" class="form-control" min="0" value="<?php echo $row['p_qty']; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      เพศ :
    </div>
    <div class="col-sm-3">
      <select name="p_sex" id="p_sex" class="form-control" required>
        <option value="<?php echo $row['p_sex']; ?>" selected hidden><?php echo $row['p_sex']; ?></option>
        <option value="" disabled>กรุณาเลือก</option>
        <option value="ชาย">ชาย</option>
        <option value="หญิง">หญิง</option>
        <option value="ได้ทั้งชายและหญิง">ได้ทั้งชายและหญิง</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2 control-label">
      รูปภาพสินค้า :
    </div>
    <div class="col-sm-4">
      ภาพเก่า <br>
      <img src="../p_img/<?php echo $row['p_img']; ?>" width="100px">
      <br>
      <input type="file" name="p_img" required class="form-control" accept="image/*;" onchange="readURL(this)" id="imgInput">
      <img id="blah" src="#" alt="" width="100px" class="img-rounded" style="margin-top: 10px;">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="p_img2" value="<?php echo $row['p_img']; ?>">
      <input type="hidden" name="p_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="product.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>