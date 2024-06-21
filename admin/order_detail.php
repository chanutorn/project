<?php
include('h.php');
include("../condb.php");

$o_code = $_GET["o_code"];
$sql = "SELECT * FROM tbl_order as o
INNER JOIN tbl_product as p ON o.p_id=p.p_id
WHERE o.o_code=$o_code";
$result = mysqli_query($con, $sql) or die("Error in query: $sql " . mysqli_error($con));
$total = 0;
$slip = "";
$num = 1;
?>

<body class="hold-transition skin-blue sidebar-mini">
  <style>
    #myImg {
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }

    #myImg:hover {
      opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      /* Stay in place */
      z-index: 1;
      /* Sit on top */
      padding-top: 100px;
      /* Location of the box */
      left: 0;
      top: 0;
      width: 100%;
      /* Full width */
      height: 100%;
      /* Full height */
      overflow: auto;
      /* Enable scroll if needed */
      background-color: rgb(0, 0, 0);
      /* Fallback color */
      background-color: rgba(0, 0, 0, 0.9);
      /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
      margin: auto;
      display: block;
      width: 100%;
      max-width: 450px;
    }

    /* Caption of Modal Image */
    #caption {
      margin: auto;
      display: block;
      width: 80%;
      max-width: 700px;
      text-align: center;
      color: #ccc;
      padding: 10px 0;
      height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
      animation-name: zoom;
      animation-duration: 0.6s;
    }

    @keyframes zoom {
      from {
        transform: scale(0.1)
      }

      to {
        transform: scale(1)
      }
    }

    /* The Close Button */
    .close {
      position: absolute;
      top: 50px;
      right: 35px;
      color: #f1f1f1;
      font-size: 40px;
      font-weight: bold;
      transition: 0.3s;
    }

    .close:hover,
    .close:focus {
      color: #bbb;
      text-decoration: none;
      cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
      .modal-content {
        width: 100%;
      }
    }
  </style>
  <div class="wrapper">
    <?php include('menutop.php'); ?>
    <?php include('menu_l.php'); ?>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <i class="glyphicon glyphicon-shopping-cart"></i><span class="hidden-xs">ข้อมูลรายการสินค้า <span class='label' style='background-color:#F39C12' ;>
              <b><?php echo $o_code ?></b></span></span>
        </h1>
      </section>
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-body">
                <table id="example2" class="table table-bordered">
                  <thead>
                    <th>ลำดับ</th>
                    <th>รหัสสินค้า</th>
                    <th>ชื่อสินค้า</th>
                    <th>รูปสินค้า</th>
                    <th>ราคาสินค้า</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                  </thead>
                  <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                      <tr>
                        <td align='center'><?php echo $num++ ?></td>
                        <td align='center'><?php echo $row["type_id"] . "" . $row["brand_id"] . $row["p_id"] ?></td>
                        <td><?php echo $row["p_name"] ?></td>
                        <td><?php echo "<img src='../p_img/" . $row['p_img'] . "'width='140' height='170'>"; ?></td>
                        <td><?php echo number_format($row["p_price"]) ?> บาท</td>
                        <td><?php echo $row["qty"] ?> คู่</td>
                        <td><?php echo number_format($row["total"]) ?> บาท</td>
                      </tr>
                    <?php $total += $row["total"];
                      $slip = $row["slip"];
                      $tracking = $row["tracking"];
                    } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                    <tr>
                      <td><b>ราคารวมทั้งหมด</b></td>
                      <td>
                        <font color='red'><b><?php echo number_format($total); ?></b></font> บาท
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><b>รูปสลิปโอนเงิน</b></td>
                      <td><?php echo "<img id='myImg' src='../image/slip/" . $slip . "' width='140' height='170'>"; ?>
                        <div id="myModal" class="modal">
                          <span class="close">&times;</span>
                          <img class="modal-content" id="img01">
                          <div id="caption"></div>
                        </div>
                      </td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><b>เลขพัสดุ</b></td>
                      <td><?php echo $tracking ?></td>
                      <td></td>
                    </tr>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
      <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function() {
          modal.style.display = "block";
          modalImg.src = this.src;
          captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
      </script>
</body>
<?php include('footerjs.php'); ?>