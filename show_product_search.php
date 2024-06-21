<?php
$q = $_GET['s'];
include("condb.php");

// Query สินค้าทั้งหมด เรียงตาม p_id ในลำดับจากมากไปน้อย
$sql = "SELECT * FROM tbl_product as p INNER JOIN tbl_type as t ON p.type_id = t.type_id WHERE p.p_name LIKE '%$q%' OR t.type_name LIKE '%$q%' OR p.p_sex LIKE '%$q%' ORDER BY `p`.`p_qty` DESC";
$result = mysqli_query($con, $sql);

// Query สินค้าที่มี p_view มากที่สุด
$sql_v = "SELECT * FROM tbl_product AS p INNER JOIN tbl_type AS t ON p.type_id = t.type_id WHERE p.p_qty > 0 AND p.p_view > 40 AND p.p_name LIKE '%$q%' OR t.type_name LIKE '%$q%' OR p.p_sex LIKE '%$q%' ORDER BY p.p_view DESC LIMIT 1";
$result_v = mysqli_query($con, $sql_v);

// เช็คว่ามีสินค้าที่มี p_view มากที่สุดหรือไม่
$has_popular_product = mysqli_num_rows($result_v) > 0;

// สร้าง array เพื่อเก็บรายการที่ให้แสดงบน "ยอดนิยม"
$popular_product_ids = array();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index_css/product.css">
</head>

<body>

  <!-- แท็บ "ยอดนิยม" ด้านบนของหน้าเว็บ -->
  <?php if ($has_popular_product) { ?>
    <?php while ($row_v = mysqli_fetch_assoc($result_v)) { ?>
      <div class="col-sm-3" align="center">
        <div class="card mb-4" style="max-width: 16rem;">
          <span class="position-absolute top-0 end-100 translate-middle p-2 border border-light rounded-circle" style="background-color:#F9E79F;">
            <span class="visually-hidden">ยอดฮิต</span>
          </span>
          <div class="card-header bg-transparent">
            <a href="prd.php?id=<?php echo $row_v['p_id']; ?>">
              <img src="p_img/<?php echo $row_v['p_img']; ?>" width="140" height="170">
            </a>
          </div>
          <div class="card-body">
            <p>
              <a href="prd.php?id=<?php echo $row_v['p_id']; ?>" style="text-decoration: none;">
                <h6 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <span style="color: black;" class="name_pd"><?php echo $row_v["p_name"]; ?></span>
                </h6>
              </a>
              <br>
              <span style="color: black;" class="name_pd">ราคา <?php echo number_format($row_v["p_price"]); ?> บาท</span>
            </p>
          </div>
        </div>
      </div>
      <?php
      // เพิ่มรายการลงใน array เพื่อไม่ให้ซ้ำ
      $popular_product_ids[] = $row_v['p_id'];
      ?>
    <?php } ?>
  <?php } ?>

  <!-- สินค้าทั้งหมด (ยกเว้นที่มี p_view มากที่สุด) -->
  <?php if (mysqli_num_rows($result) > 0) { ?>
    <?php while ($row_prd = mysqli_fetch_assoc($result)) { ?>
      <?php if ($row_prd["p_qty"] > 0 && (!$has_popular_product || !in_array($row_prd['p_id'], $popular_product_ids))) { ?>
        <div class="col-sm-3" align="center">
          <div class="card mb-4" style="max-width: 16rem;">
            <div class="card-header bg-transparent">
              <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>">
                <img src="p_img/<?php echo $row_prd['p_img']; ?>" width="140" height="170">
              </a>
            </div>
            <div class="card-body">
              <p>
                <a href="prd.php?id=<?php echo $row_prd['p_id']; ?>" style="text-decoration: none;">
                  <h6 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span style="color: black;" class="name_pd"><?php echo $row_prd["p_name"]; ?></span>
                  </h6>
                </a>
                <br>
                <span style="color: black;" class="name_pd">ราคา <?php echo number_format($row_prd["p_price"]); ?> บาท</span>
              </p>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  <?php } else { ?>
    <!-- ถ้าไม่มีสินค้าทั้งหมด -->
    <hr>
    <div class="col-sm-12" align="center">
      <h4 class="text-danger">ไม่พบรายการที่คุณค้นหา</h4>
    </div>
  <?php } ?>

</body>

</html>