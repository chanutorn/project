<?php
$ID = mysqli_real_escape_string($con, $_GET['ID']);
$sql = "SELECT * FROM tbl_member WHERE member_id=$ID";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$row = mysqli_fetch_array($result);
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
<form action="m_edit_db.php" method="post" class="form-horizontal" enctype="multipart/form-data">
  <div class="form-group">
    <div class="col-sm-2 control-label">
      สถานะ :
    </div>
    <div class="col-sm-2">
      <select name="m_level" class="form-control" required>
        <option value="<?php echo $row['m_level']; ?>" selected hidden><?php echo $row['m_level']; ?></option>
        <option value="" disabled>เลือกข้อมูล</option>
        <option value="admin">admin</option>
        <option value="member">member</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      Username :
    </div>
    <div class="col-sm-3">
      <input type="text" name="m_user" required class="form-control" value="<?php echo $row['m_user']; ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ชื่อ-นามสกุล :
    </div>
    <div class="col-sm-3">
      <input type="text" name="m_name" required class="form-control" value="<?php echo $row['m_name']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      เบอร์โทร :
    </div>
    <div class="col-sm-3">
      <input type="text" name="m_tel" required class="form-control" value="<?php echo $row['m_tel']; ?>" maxlength="10" pattern="^[0-9]+$" title="ตัวเลขเท่านั้น">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      อีเมล์ :
    </div>
    <div class="col-sm-3">
      <input type="email" name="m_email" required class="form-control" value="<?php echo $row['m_email']; ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-2 control-label">
      ที่อยู่ :
    </div>
    <div class="col-sm-3">
      <input type="text" name="m_address" required class="form-control" value="<?php echo $row['m_address']; ?>">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-3">
      <input type="hidden" name="member_id" value="<?php echo $ID; ?>" />
      <button type="submit" class="btn btn-success">แก้ไขข้อมูล</button>
      <a href="member.php" class="btn btn-danger">ยกเลิก</a>
    </div>
  </div>
</form>