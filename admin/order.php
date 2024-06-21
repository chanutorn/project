<?php include('h.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <?php include('menutop.php'); ?>

    <!-- Left side column. contains the logo and sidebar -->
    <?php include('menu_l.php'); ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="glyphicon glyphicon-shopping-cart"></i> <span class="hidden-xs">ข้อมูลรายการสั่งซื้อ</span></h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php include('order_list.php'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>

</html>
<?php include('footerjs.php'); ?>