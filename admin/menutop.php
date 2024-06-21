<header class="main-header">
  <!-- Logo -->
  <a href="" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="../image/icon_wj.png" width="25" height="25"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <img src="../image/icon_wj.png" width="25" height="25"></span>
  </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->

        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="../image/profile.png" width="25" height="25" class="img-circle user-image" alt="User Image">
            <span class="hidden-xs">Welcome Admin</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="../image/profile.png" class="img-circle" alt="User Image user-image">
              <p>
                Admin<br>
                <small>Name : <?php echo $m_name; ?>
                </small>
              </p>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="../logout.php" class="btn btn-default btn-flat" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?');">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="index.php">WJ Store รองเท้ามือสอง หาดใหญ่</a></li>

      </ul>
      </li>

      </ul>
    </div>
  </nav>
</header>