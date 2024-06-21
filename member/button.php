<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../index_css/button.css">
  <style>
    /* Add your CSS styles here */
  </style>
</head>

<body>
  <!-- ปุ่มของประเภท -->
  <div class="top-container">
    <div class="button-container">
      <?php mysqli_data_seek($typeprd, 0); // ย้าย pointer กลับไปที่ตำแหน่งแรกของข้อมูล
      ?>
      <div><a class="btn" href="index.php">ทั้งหมด</a></div>
      <?php while ($row_typeprd = mysqli_fetch_assoc($typeprd)) { ?>
        <a class="btn" href="index.php?act=showbytype&type_id=<?php echo $row_typeprd['type_id']; ?>" onclick="redirectTo('')">
          <?php echo $row_typeprd['type_name']; ?>
        </a>
      <?php } ?>
    </div>
    <!-- ปุ่มของแบรนด์ -->
    <div class="button-container">
      <?php mysqli_data_seek($brandprd, 0); // ย้าย pointer กลับไปที่ตำแหน่งแรกของข้อมูล
      ?>
      <?php while ($row_brandprd = mysqli_fetch_assoc($brandprd)) { ?>
        <a class="btn" href="index.php?ace=showbybrand&brand_id=<?php echo $row_brandprd['brand_id']; ?>" onclick="redirectTo('')">
          <?php echo $row_brandprd['brand_name']; ?>
        </a>
      <?php } ?>
      <!-- ฟอร์มการค้นหา -->
      <form class="form-inline" name="qp" action="index.php" method="GET">
        <input class="form-control" type="text" placeholder="Search. . ." name="s">
        <button class="btn-search" type="submit">Search</button>
      </form>
    </div>
  </div>
</body>

</html>