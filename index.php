<!DOCTYPE html>
<html>

<head>
  <?php
  include('boot4.php');
  include('h.php');
  ?>

</head>

<body>
  <nav>
    <?php
    include('navbar.php');
    ?>
  </nav>
  <?php
  include('banner.php');
  include('button.php');
  ?>
  <div class="container">
    <div class="col-md-12" style="margin-top: 10px">
      <div class="row">
        <?php
        $act = (isset($_GET['act']) ? $_GET['act'] : '');
        $ace = (isset($_GET['ace']) ? $_GET['ace'] : '');
        $q = isset($_GET['s']) ? $_GET['s'] : '';
        if ($act == 'showbytype') {
          include('show_product_list.php');
        } else if ($ace == 'showbybrand') {
          include('show_product_brand.php');
        } else if ($q != '') {
          include("show_product_search.php");
        } else {
          include('show_product.php');
        }
        ?>
      </div>
    </div>
  </div>
  <?php
  // include('review_form.php');
  include('review.php');
  include('footer.php');
  ?>
</body>

</html>
<?php include('script4.php'); ?>