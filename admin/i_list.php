<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="i_list.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .no-data {
      color: red;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  include('../thai_date.php');
  $sql1 = "SELECT COUNT(m_user) AS cm FROM `tbl_member` WHERE m_level != 'admin'";
  $query1 = mysqli_query($con, $sql1);
  $result1 = mysqli_fetch_assoc($query1); //จำนวนแอดมิน

  $sql2 = "SELECT COUNT(p_name) AS cp FROM `tbl_product`";
  $query2 = mysqli_query($con, $sql2);
  $result2 = mysqli_fetch_assoc($query2); //จำนวนสินค้า

  $mount = date('m');
  $year = date('Y');
  $sql3 = "SELECT SUM(total) as income1
            FROM tbl_order
            WHERE MONTH(Date) = $mount AND YEAR(Date) = $year";
  $query3 = mysqli_query($con, $sql3);
  $result3 = mysqli_fetch_assoc($query3); //รายได้ต่อเดือน

  $mount = date('m');
  $year = date('Y');
  $sql4 = "SELECT SUM(total) as income2
            FROM tbl_order
            WHERE YEAR(Date) = $year";
  $query4 = mysqli_query($con, $sql4);
  $result4 = mysqli_fetch_assoc($query4); //รายได้ต่อปี

  $sql6 = "SELECT tbl_product.p_name AS pp, SUM(tbl_order.qty) AS op 
         FROM `tbl_order`
         INNER JOIN tbl_product ON tbl_product.p_id = tbl_order.p_id 
         WHERE tbl_order.status = 'ส่งสินค้าแล้ว' 
         GROUP BY tbl_order.p_id
         ORDER BY op DESC";

  $query6 = mysqli_query($con, $sql6);
  $result6 = mysqli_fetch_assoc($query6); //สินค้าขายดี

  $sql7 = "SELECT p_name AS mp1 , MINUTE(datesave) AS mp2 , datesave AS mp3
           FROM tbl_product ORDER BY `mp2` ASC";
  $query7 = mysqli_query($con, $sql7);
  $result7 = mysqli_fetch_assoc($query7); //ขายได้น้อย

  $sql8 = "SELECT COUNT(m_user) AS cm1 FROM `tbl_member` WHERE m_level != 'member'";
  $query8 = mysqli_query($con, $sql8);
  $result8 = mysqli_fetch_assoc($query8); //จำนวนสมาชิก

  $sql9 = "SELECT COUNT(m_user) AS cm FROM `tbl_member`";
  $query9 = mysqli_query($con, $sql9);
  $result9 = mysqli_fetch_assoc($query9); //จำนวนสมาชิกทั้งหมด

  $sql10 = "SELECT * FROM tbl_product WHERE curdate()<date_add(datesave,interval 7 day) ORDER BY `tbl_product`.`p_id` DESC";
  $result10 = mysqli_query($con, $sql10); //สินค้ามาใหม่

  $sql11 = "SELECT IFNULL(SUM(total), 0) as income, MONTH(Date) as month, YEAR(Date) as year 
        FROM tbl_order 
        WHERE YEAR(Date) = YEAR(CURDATE()) 
        GROUP BY YEAR(Date), MONTH(Date) 
        ORDER BY YEAR(Date), MONTH(Date)";
  $result11 = mysqli_query($con, $sql11);

  $incomes = array();
  for ($month1 = 1; $month1 <= 12; $month1++) {
    $query = "SELECT SUM(total) as income FROM tbl_order WHERE MONTH(Date) = $month1 AND YEAR(Date) = YEAR(CURRENT_DATE())";
    $result = mysqli_query($con, $query);
    $income = mysqli_fetch_assoc($result);
    $incomes[$month1] = $income['income'];
  }

  $sql12 = "SELECT * FROM tbl_order INNER JOIN tbl_member ON tbl_order.m_id = tbl_member.member_id INNER JOIN tbl_product ON tbl_order.p_id = tbl_product.p_id WHERE DATE(tbl_order.date) = CURDATE() GROUP BY o_code ORDER BY tbl_order.date DESC";
  $result12 = mysqli_query($con, $sql12); //แสดงข้อมูลรายวัน

  // echo $sql3;
  // exit();
  mysqli_close($con);
  ?>
  <div class="col-md-12">
    <ul class="index-list">
      <li class="index-list-li" style="background-color: var(--light-primary);">
        <i class='bx bx-calendar-check'></i>
        <span class="info">
          <p class="list-p">จำนวนสินค้า</p>
          <h3>
            <?= number_format($result2['cp']) ?> รายการ
          </h3>
        </span>
      </li>
      <li class="index-list-li" style="background-color: var(--light-warning);">
        <i class='bx bx-show-alt'></i>
        <span class="info">
          <p class="list-p">สินค้าขายดี</p>
          <h5>
            <?= $result6['pp'] ?></b>
            <br>ขายได้ <?= number_format($result6['op']) ?> คู่
          </h5>
        </span>
      </li>
      <li class="index-list-li" style="background-color: var(--light-success);">
        <i class='bx bx-line-chart'></i>
        <span class="info">
          <p class="list-p">รายได้ต่อเดือน</p>
          <h4>
            <?php if (number_format($result3['income1']) == 0) { ?>
              เดือนนี้ยังไม่มีรายได้</td>
            <?php } else { ?>
              <?= number_format($result3['income1']) ?> บาท
            <?php } ?>
          </h4>
        </span>
      </li>
      <li class="index-list-li" style="background-color: var(--light-danger);">
        <i class='bx bx-dollar-circle'></i>
        <span class="info">
          <p class="list-p">รายได้ต่อปี</p>
          <h4>
            <?php if (number_format($result4['income2']) == 0) { ?>
              ปีนี้ยังไม่มีรายได้</td>
            <?php } else { ?>
              <?= number_format($result4['income2']) ?> บาท
            <?php } ?>
          </h4>
        </span>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <?php if (mysqli_num_rows($result12) > 0) { ?>
        <table table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th colspan="6" class="text-center">รายได้รายวัน</th>
            </tr>
            <tr>
              <th class="text-center">รหัสคำสั่งซื้อ</th>
              <th class="text-center">ชื่อสมาชิก</th>
              <th class="text-center">สินค้า</th>
              <th class="text-center">จำนวน</th>
              <th class="text-center">ราคา</th>
              <th class="text-center">วันที่</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row12 = mysqli_fetch_assoc($result12)) { ?>
              <tr>
                <td><?= $row12['o_code'] ?></td>
                <td><?= $row12['m_user'] ?></td>
                <td><?= $row12['p_name'] ?></td>
                <td><?= $row12['qty'] ?></td>
                <td><?= number_format($row12['total']) ?> บาท</td>
                <td><?= thai_date1(strtotime($row12['date'])) ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <p class="no-data">ยังไม่มีข้อมูลการสั่งซื้อรายวัน</p>
      <?php } ?>
    </div>
  </div>

  <!-- ตำแหน่งที่ต้องการแสดงกราฟ myChart1 -->
  <div class="row">
    <div class="col-md-6">
      <div class="card" style="height: 100%;">
        <div class="card-body">
          <canvas id="myChart1" width="200" height="130"></canvas>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card" style="height: 100%;">
        <div class="card-body">
          <canvas id="myChart2" width="300" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    // ข้อมูลที่ต้องการแสดงบนกราฟ
    var data = {
      labels: ["จำนวนสมาชิกทั้งหมด", "จำนวนแอดมิน", "จำนวนสมาชิก"],
      datasets: [{
        label: 'จำนวนสมาชิกทั้งหมด',
        data: [<?= $result9['cm'] ?>, <?= $result8['cm1'] ?>, <?= $result1['cm'] ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
      }]
    };

    // ตั้งค่าและแสดงกราฟ
    var ctx = document.getElementById('myChart1').getContext('2d');
    var myChart1 = new Chart(ctx, {
      type: 'bar',
      data: data,
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    var currentMonth = new Date().getMonth(); // เดือนปัจจุบัน (0-11)
    var dataColors = [];
    for (var i = 0; i < 12; i++) {
      if (i === currentMonth) {
        dataColors.push('rgb(255, 99, 132)'); // สีเข้มสำหรับเดือนปัจจุบัน
      } else {
        dataColors.push('rgb(75, 192, 192)'); // สีอื่น ๆ
      }
    }

    var ctx = document.getElementById('myChart2').getContext('2d');
    var myChart2 = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
          "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ],
        datasets: [{
          label: 'รายได้ต่อเดือน',
          data: [
            <?php echo implode(', ', $incomes); ?> // ใส่ข้อมูลรายได้ต่อเดือนจากตัวแปร $incomes
          ],
          backgroundColor: dataColors,
          borderColor: 'rgb(75, 192, 192)',
          tension: 0.1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <script src="chart_script.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.min.js"></script>
</body>

</html>