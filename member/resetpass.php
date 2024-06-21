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

  $member_id = $_GET['member_id'];

  $sql_admin = "SELECT * FROM tbl_member WHERE member_id = ?";
  $stmt = mysqli_prepare($con, $sql_admin);
  mysqli_stmt_bind_param($stmt, "s", $member_id);
  mysqli_stmt_execute($stmt);
  $result_admin = mysqli_stmt_get_result($stmt);

  if (!$result_admin) {
    die("Error : " . mysqli_error($con));
  }

  $row = mysqli_fetch_array($result_admin);

  // echo "<pre>";
  // print_r($resault_admin);
  // echo "</pre>";
  // exit();
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <div class="form-wrapper">
          <form action="resetpass_db.php" method="POST" enctype="multipart/form-data" name="add" class="form-horizontal" id="add">
            <div class="form-group">
              <input type="hidden" name="member_id" id="member_id" class="form-control" value="<?php echo $member_id; ?>" readonly="readonly">
            </div>
            <div class="form-group">
              <div class="control-label"> Username </div>
              <div>
                <input type="text" name="m_user" id="" class="form-control" required value="<?php echo $m_user; ?>" disabled>
              </div>
            </div>

            <div class="form-group">
              <div class="control-label"> รหัสผ่านใหม่ </div>
              <div>
                <input type="password" name="m_subpass1" id="m_pass" class="form-control" required value="">
              </div>
            </div>

            <div class="form-group">
              <div class="control-label"> ยืนยันรหัสผ่านใหม่ </div>
              <div>
                <input type="password" name="m_subpass2" id="m_subpass" class="form-control" required value="">
              </div>
            </div>

            <div class="form-group">
              <input type="hidden" name="member_id" value="<?php echo $_GET['id']; ?>" />
              <input type='submit' name="edit" value="เปลี่ยนรหัสผ่าน" class="btn btn-success">
              <a href="javascript:history.back()" class="btn btn-danger">ยกเลิก</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include('script4.php'); ?>
</body>

</html>