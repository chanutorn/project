<?php require_once('../condb.php');
$query_typeprd = "SELECT * FROM tbl_type ORDER BY type_id ASC";
$typeprd = mysqli_query($con, $query_typeprd) or die("Error in query: $query_typeprd " . mysqli_error($con));
$query_brandprd = "SELECT * FROM tbl_brand ORDER BY brand_id ASC";
$brandprd = mysqli_query($con, $query_brandprd) or die("Error in query: $query_brandprd " . mysqli_error($con));
// echo($query_typeprd);
// exit();
error_reporting(0); // ปิดการแสดง error
$row_typeprd = mysqli_fetch_assoc($typeprd);
$row_brandprd = mysqli_fetch_assoc($brandprd);
$totalRows_typeprd = mysqli_num_rows($typeprd);
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- ===== CSS ===== -->
<link rel="stylesheet" href="../index_css/navbar.css">

<!-- ===== Boxicons CSS ===== -->
<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

<nav>
  <div class="nav-bar">
    <i class='bx bx-menu sidebarOpen'></i>
    <span class="logo navLogo"><a href="index.php"><img src="../image/icon_wj.png" width="60" height="60"></a></span>

    <div class="menu">
      <div class="logo-toggle">
        <span class="logo"><a href="index.php"><img src="../image/icon_wj.png" width="60" height="60"></a></span>
        <i class='bx bx-x siderbarClose'></i>
      </div>

      <ul class="nav-links">
        <li><a href="index.php">หน้าหลัก</a></li>
        <li><a href="order.php">รายการสั่งซื้อ</a></li>
        <li><a href="cart.php">ตระกร้าสินค้า <i class='bx bx-cart cart'></i>
            <span class="product-number">
              <?php
              $cart_num["num"] = 0;
              $q_cart_num = mysqli_query($con, "SELECT SUM(qty) as num FROM tbl_cart WHERE m_id=$member_id");
              $cart_num = mysqli_fetch_assoc($q_cart_num);
              echo number_format($cart_num["num"]);
              ?>
            </span>
          </a>
        </li>
        <li>
          <a href="member_edit.php?id=<?php echo $member_id; ?>">
            แก้ไขข้อมูล <i class='bx bx-user user'></i>
          </a>
        </li>
        <li><a href="../logout.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a></li>
      </ul>
    </div>

    <div class="darkLight-searchBox">
    </div>
  </div>
</nav>
<script>
  const body = document.querySelector("body"),
    nav = document.querySelector("nav"),
    sidebarOpen = document.querySelector(".sidebarOpen"),
    siderbarClose = document.querySelector(".siderbarClose");

  //   js code to toggle sidebar
  sidebarOpen.addEventListener("click", () => {
    nav.classList.add("active");
  });

  body.addEventListener("click", e => {
    let clickedElm = e.target;

    if (!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")) {
      nav.classList.remove("active");
    }
  });
</script>