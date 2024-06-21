<?php include('h.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include('menutop.php'); ?>
    <?php include('menu_l.php'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="glyphicon glyphicon-list-alt hidden-xs"></i> <span class="hidden-xs">ข้อมูลรายการสินค้า</span>
          <a href="product.php?act=add" class="btn btn-primary btn-sm">เพิ่มสินค้า</a>
          <!-- <a href="product.php?act=image" class="btn btn-primary btn-sm">เพิ่มรายละเอียดรูปสินค้า</a> -->
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if ($act == 'add') {
                      include('product_add.php');
                    } elseif ($act == 'edit') {
                      include('product_edit.php');
                    } elseif ($act == 'image') {
                      include('product_image.php');
                    } else {
                      include('product_list.php');
                    }
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