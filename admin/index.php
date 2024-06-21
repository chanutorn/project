<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include('h.php'); ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <?php include('menutop.php'); ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php include('menu_l.php'); ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="glyphicon glyphicon-home"></i> <span class="hidden-xs">หน้าหลัก</span></h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php
                    include('i_list.php');
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
<?php include('footerjs.php'); ?>

</html>