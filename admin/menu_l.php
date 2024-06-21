 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel (optional) -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="../image/profile.png" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p>คุณ <?php echo $m_name; ?></p>
         <!-- Status -->
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>
     <br>
     <ul class="sidebar-menu" data-widget="tree">
       <li><a href="index.php"><i class="fa fa-home"></i><span> หน้าหลัก</span></a></li>
       <li><a href="member.php"><i class="fa fa-user"></i><span> จัดการข้อมูลสมาชิก</span></a></li>
       <li><a href="product.php"><i class="fa fa-shopping-bag"></i><span> จัดการข้อมูลสินค้า</span></a></li>
       <li><a href="type.php"><i class="fa fa-tasks"></i><span> จัดการประเภทสินค้า</span></a></li>
       <li><a href="brand.php"><i class="fa fa-tasks"></i><span> จัดการประเภทแบรนด์</span></a></li>
       <li><a href="coupon.php"><i class="fa fa-tag"></i><span> ข้อมูลรายการคูปอง</span></a></li>
       <li><a href="order.php"><i class="fa fa-shopping-cart"></i><span> จัดการรายการสั่งซื้อ</span></a></li>
       <li><a href="report.php"><i class="fa fa-calendar"></i><span> จัดการข้อมูลรายงาน</span></a></li>
       <li><a href="../logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');"><i class="glyphicon glyphicon-off"></i><span> ออกจากระบบ</span></a></li>
     </ul>
   </section>
   <!-- /.sidebar -->
 </aside>