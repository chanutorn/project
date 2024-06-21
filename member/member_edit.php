<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  include('h.php');
  include("../condb.php");
  ?>
  <link rel="stylesheet" href="../index_css/m_edit.css">
</head>

<body style="background-color: #e4e9f7;">
  <?php
  include('navbar.php');
  include('../boot4.php');
  $m_id = $_GET["id"];
  $sql = "SELECT * FROM tbl_member WHERE member_id = '$m_id'";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <div class="form-wrapper">
          <form action="member_edit_db.php" method="post" class="form-horizontal">
            <div class="form-group">
              <label for="m_user">Username :</label>
              <input type="text" name="m_user" required class="form-control" value="<?php echo $row['m_user']; ?>" disabled>
            </div>
            <div class="form-group">
              <label for="m_name">ชื่อ-นามสกุล :</label>
              <input type="text" name="m_name" required class="form-control" value="<?php echo $row['m_name']; ?>">
            </div>
            <div class="form-group">
              <label for="m_tel">เบอร์โทร :</label>
              <input type="text" name="m_tel" required class="form-control" value="<?php echo $row['m_tel']; ?>" maxlength="10" pattern="[0-9]{10}" title="โปรดกรอกหมายเลขโทรศัพท์ 10 หลัก">
            </div>
            <?php if ($row['cheack_fb'] !== 'ผู้ใช้Facebook') { ?>
              <div class="form-group">
                <label for="m_email">อีเมล์ :</label>
                <input type="email" name="m_email" required class="form-control" value="<?php echo $row['m_email']; ?>">
              </div>
            <?php } ?>
            <div class="form-group">
              <label for="m_address">ที่อยู่ :</label>
              <textarea name="m_address" cols="40" rows="4"><?php echo $row['m_address']; ?></textarea>
            </div>
            <div class="form-group">
              <input type="hidden" name="member_id" value="<?php echo $_GET['id']; ?>" />
              <input type='submit' name="okay" value="แก้ไขข้อมูล" class="btn btn-success">
              <a href="index.php" class="btn btn-danger">ยกเลิก</a>
              <a href="resetpass.php?id=<?php echo $member_id; ?>" class="btn btn-warning">เปลี่ยนรหัสผ่าน</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include('script4.php'); ?>
</body>

</html>