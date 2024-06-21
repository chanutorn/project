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
                <h1><i class="glyphicon glyphicon-tasks hidden-xs"></i> <span class="hidden-xs">ข้อมูลรายการประเภทแบรนด์</span>
                    <a href="brand.php?act=add" class="btn btn-primary btn-sm">เพิ่มประเภทแบรนด์</a>
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
                                            include('brand_add.php');
                                        } elseif ($act == 'edit') {
                                            include('brand_edit.php');
                                        } else {
                                            include('brand_list.php');
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

</html>