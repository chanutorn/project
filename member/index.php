<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  include('h.php');
  include("../condb.php");
  include('../boot4.php');
  ?>
</head>

<body>
  <?php
  include('navbar.php');
  include('banner.php');
  include('button.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12 " style="margin-top: 10px">
        <div class="row">
          <?php
          // ตรวจสอบ m_level ก่อนแสดงหน้าเว็บ
          if (isset($_SESSION['m_level']) && $_SESSION['m_level'] == 'member') {
            $act = (isset($_GET['act']) ? $_GET['act'] : '');
            $ace = (isset($_GET['ace']) ? $_GET['ace'] : '');
            $q = (isset($_GET['s']) ? $_GET['s'] : '');

            if ($act == 'showbytype') {
              include('product_list.php');
            } else if ($ace == 'showbybrand') {
              include('product_brand.php');
            } else if ($q != '') {
              include("product_search.php");
            } else {
              include('product.php');
            }
          } else {
            // ถ้าไม่ใช่ member ให้ทำการเรียกหน้าเข้าสู่ระบบหรือหน้าอื่น ๆ ที่เหมาะสม
            // ตัวอย่างเช่น:
            echo "คุณไม่มีสิทธิ์เข้าถึงหน้านี้";
            // หรือทำการ redirect ไปยังหน้าที่เหมาะสม
            header('Location: ../login.php');
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
  include('review_form.php');
  include('review.php');
  include('footer.php');
  include('script4.php');
  ?>
</body>

</html>