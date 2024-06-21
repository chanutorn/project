<!DOCTYPE html>

<head>
  <?php
  include('../boot4.php');
  include('h.php');
  ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="../index_css/prd.css">
</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['member_id'])) {
    $m_id = $_SESSION['member_id'];
  }
  include("../condb.php");
  $p_id = $_GET["id"];
  include('navbar.php');
  ?>
  <div class="top-container">
    <div class="container">
      <div class="row">
        <?php
        $sql = "SELECT * FROM tbl_product as p INNER JOIN tbl_type  as t ON p.type_id=t.type_id AND p_id = $p_id";
        $result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
        $row = mysqli_fetch_array($result);

        $sql1 = "SELECT * FROM tbl_product AS p INNER JOIN tbl_cart AS t ON p.p_id = t.p_id WHERE p.p_id = $p_id";
        $result1 = mysqli_query($con, $sql1) or die("Error in query: $sql1 " . mysqli_error($con));
        $row1 = mysqli_fetch_array($result1);

        $sql2 = "SELECT * FROM tbl_product AS p INNER JOIN tbl_productimg AS pi ON p.p_id = pi.p_id WHERE p.p_id = $p_id";
        $result2 = mysqli_query($con, $sql2) or die("Error in query: $sql2 " . mysqli_error($con));
        $row2 = mysqli_fetch_array($result2);

        // $sql3 = "SELECT p_id, (CASE WHEN p_img1 IS NOT NULL AND p_img1 != '' THEN 1 ELSE 0 END + 
        // CASE WHEN p_img2 IS NOT NULL AND p_img2 != '' THEN 1 ELSE 0 END + 
        // CASE WHEN p_img3 IS NOT NULL AND p_img3 != '' THEN 1 ELSE 0 END + 
        // CASE WHEN p_img4 IS NOT NULL AND p_img4 != '' THEN 1 ELSE 0 END)
        // AS total_images FROM tbl_productimg WHERE p_id = $p_id";
        // $result3 = mysqli_query($con, $sql3) or die("Error in query: $sql3 " . mysqli_error($con));
        // $row3 = mysqli_fetch_array($result3);

        $sql_last_view = "SELECT p_view FROM tbl_product Where p_id = '" . $p_id . "'";
        $resalt_last_view = mysqli_query($con, $sql_last_view) or die("Error in query: $sql_last_view " . mysqli_error($con));
        $row_last_view = mysqli_fetch_assoc($resalt_last_view);
        //เรียกดูวิวของสินค้านั้นๆ
        $last_view = $row_last_view['p_view']++;
        $last_view++;
        //นำวิวสินค้าเดิมมา+1
        $update_view = "UPDATE `tbl_product` SET `p_view` = '" . $last_view . "' WHERE `p_id` ='" . $p_id . "'";
        $resalt_updateview = $con->query($update_view);
        //อัพเดทวิวสินค้าใหม่
        ?>
        <div class="col-md-12">
          <div class="container">
            <div class="row">
              <div class="col-md-6">

                <div class="mySlides">
                  <img src="../p_img/<?php echo $row['p_img']; ?>" width="100%" height="500px">
                </div>
                <?php if (!empty($row2['p_img1'])) : ?>
                  <div class="mySlides">
                    <img src="../p_img/p_img_a/<?php echo $row2['p_img1']; ?>" width="100%" height="500px">
                  </div>
                <?php endif; ?>
                <?php if (!empty($row2['p_img2'])) : ?>
                  <div class="mySlides">
                    <img src="../p_img/p_img_a/<?php echo $row2['p_img2']; ?>" width="100%" height="500px">
                  </div>
                <?php endif; ?>
                <?php if (!empty($row2['p_img3'])) : ?>
                  <div class="mySlides">
                    <img src="../p_img/p_img_a/<?php echo $row2['p_img3']; ?>" width="100%" height="500px">
                  </div>
                <?php endif; ?>
                <?php if (!empty($row2['p_img4'])) : ?>
                  <div class="mySlides">
                    <img src="../p_img/p_img_a/<?php echo $row2['p_img4']; ?>" width="100%" height="500px">
                  </div>
                <?php endif; ?>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>

                <div class="row">
                  <div class="column">
                    <img class="demo cursor" src="../p_img/<?php echo $row['p_img']; ?>" width="100%" height="100px" onclick="currentSlide(1)">
                  </div>
                  <?php if (!empty($row2['p_img1'])) : ?>
                    <div class="column">
                      <img class="demo cursor" src="../p_img/p_img_a/<?php echo $row2['p_img1']; ?>" width="100%" height="100px" onclick="currentSlide(2)">
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($row2['p_img2'])) : ?>
                    <div class="column">
                      <img class="demo cursor" src="../p_img/p_img_a/<?php echo $row2['p_img2']; ?>" width="100%" height="100px" onclick="currentSlide(3)">
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($row2['p_img3'])) : ?>
                    <div class="column">
                      <img class="demo cursor" src="../p_img/p_img_a/<?php echo $row2['p_img3']; ?>" width="100%" height="100px" onclick="currentSlide(4)">
                    </div>
                  <?php endif; ?>
                  <?php if (!empty($row2['p_img4'])) : ?>
                    <div class="column">
                      <img class="demo cursor" src="../p_img/p_img_a/<?php echo $row2['p_img4']; ?>" width="100%" height="100px" onclick="currentSlide(5)">
                    </div>
                  <?php endif; ?>
                </div>

                <!-- <div class="col-md-6">
                <?php echo "<img src='../p_img/" . $row['p_img'] . "'width='100%' height='500px' id='myImg'>"; ?>
              </div> -->
              </div>
              <div class="col-md-6">
                <div class="color-prd">
                  <br>
                  <h4><b><?php echo $row["p_name"]; ?></b></h4>
                  <p>
                    <b>ประเภท :</b> <?php echo $row["type_name"]; ?> <br>
                    <b>ราคา :</b> <?php echo number_format($row["p_price"]); ?> บาท <br>
                    <b>ไซส์ :</b> <?php echo $row["p_size"]; ?><br>
                    <?php
                    // Assuming $row['p_qty'] contains the available quantity of the product
                    if ($row['p_qty'] > 0) {
                      echo "<b>สถานะของสินค้า : </b><font style='color: red;'>สินค้ายังมีอยู่</font>";
                    } else {
                      echo "<b>สถานะของสินค้า : </b><font style='color: red;'>สินค้าหมด</font>";
                    }
                    ?>
                  </p>
                  <h5><b>รายละเอียด :</b></h5><br><?php echo $row["p_detail"]; ?>

                  <br><br><br>
                  <h5><b>จำนวนการเข้าชม <?php echo $row["p_view"] + 1; ?> ครั้ง </b></h5>

                  <?php
                  if ($row["p_qty"] == $row1["qty"]) : ?>
                    <input type="submit" value="มีสินค้าอยู่ในตะกร้า" class="btn btn-success btn-sm" disabled>
                  <?php else : ?>
                    <form action="cart.php" method="post">
                      <input type="hidden" name="p_id" value="<?php echo $row["p_id"]; ?>">
                      <input type="hidden" name="price" value="<?php echo $row["p_price"]; ?>">
                      <input type="hidden" name="qty" min="1" max="<?php echo $row["p_qty"]; ?>" value="1">
                      <input type="hidden" name="m_id" value="<?php echo $m_id; ?>"> <!-- เพิ่ม m_id ของผู้ใช้ที่เข้าสู่ระบบ -->
                      <input type="submit" name="add" value="เพิ่มเข้าตะกร้า" class="btn btn-success btn-sm">
                    </form>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include('script4.php'); ?>

  <script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
      showSlides(slideIndex += n);
    }

    function currentSlide(n) {
      showSlides(slideIndex = n);
    }

    function showSlides(n) {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      let dots = document.getElementsByClassName("demo");
      let captionText = document.getElementById("caption");
      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      captionText.innerHTML = dots[slideIndex - 1].alt;
    }
  </script>
</body>

</html>