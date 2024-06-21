<?php
error_reporting(0);
include('h.php');
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php
    include('menutop.php');
    include('menu_l.php');
    include('../thai_date.php');
    ?>

    <?php
    $start = Date('Y-m-d');
    $end = Date('Y-m-d');
    $priceSum = 0;
    $qtySum = 0;
    $netSum = 0;
    $totalSum = 0;

    if (isset($_POST['submit'])) {
      $start = $_POST['start'];
      $end = $_POST['end'];
      $status = $_POST['status'];

      $whereClause = "";
      if ($status != "ทั้งหมด") {
        $whereClause = "AND o.status = '$status'";
      }

      $sql = "SELECT m.member_id, m.m_name, p.p_name, p.p_price, MAX(o.qty) AS oqty, SUM(o.total) AS sum, o.date
      FROM tbl_product AS p 
      INNER JOIN tbl_order AS o ON p.p_id = o.p_id
      INNER JOIN tbl_member AS m ON o.m_id = m.member_id
      WHERE DATE(o.date) BETWEEN '$start' AND '$end'
      $whereClause
      GROUP BY m.member_id, m.m_name, o.date, p.p_name, p.p_price, o.qty";
      $q = mysqli_query($con, $sql);
    }

    ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="glyphicon glyphicon-calendar hidden-xs"></i> <span class="hidden-xs">ข้อมูลการซื้อขาย</span></h1>
      </section>
      <section class="content">
        <form method="post">
          <div class="row justify-content-end">
            <div class="col-2">
              <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่เริ่มต้น</label>
              <input type="date" name="start" value="<?= $start ?>">

              <label for="">วันที่สิ้นสุด</label>
              <input type="date" name="end" value="<?= $end ?>">

              <label for="">สถานะ</label>
              <select name="status">
                <option value="ทั้งหมด">ทั้งหมด</option>
                <option value="ส่งสินค้าแล้ว">ส่งสินค้าแล้ว</option>
                <option value="รอเลขพัสดุ">รอเลขพัสดุ</option>
                <option value="กำลังเตรียมสินค้า">กำลังเตรียมสินค้า</option>
                <option value="รอตรวจสอบ">รอตรวจสอบ</option>
                <option value="ยกเลิกออเดอร์">ยกเลิกออเดอร์</option>
              </select>

              <input type="submit" name="submit" value="ค้นหา" class="btn btn-success">
            </div>
          </div>
        </form>

        <!-- ต่อไปเป็นส่วนของรายการสั่งซื้อ -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row">
                <div class="col-sm-12">
                  <div class="box-body">
                    <div id="printout">
                      <div align="center">
                        <h1>รายการสินค้าที่สั่งซื้อ</h1>
                        <div>ระหว่างวันที่ : จาก :
                          <?php if ($start !== "" && $end !== "") { ?>
                            <?= thai_date(strtotime($start)) ?> ถึง : <?= thai_date(strtotime($end)) ?>
                          <?php } ?>
                        </div>
                        <div>สถานะ : <?= $status ?></div>
                      </div>

                      <style>
                        table,
                        th,
                        td {
                          border: 1px solid black;
                          border-collapse: collapse;
                          padding: 5px;
                        }
                      </style>

                      <?php if (mysqli_num_rows($q) > 0) { ?>
                        <table width="100%">
                          <thead>
                            <tr>
                              <td align="center"><b>วันที่สั่งซื้อ</td>
                              <td align="center"><b>ชื่อลูกค้า</td>
                              <td align="center"><b>สินค้า</td>
                              <td align="center"><b>ราคาขาย</td>
                              <td align="center"><b>จำนวน</td>
                              <td align="center"><b>ยอดขาย</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php while ($row = mysqli_fetch_assoc($q)) { ?>
                              <tr>
                                <td align="center"><?= thai_date(strtotime($row['date'])) ?></td>
                                <td align="center"><?= $row['m_name'] ?></td>
                                <td align="center"><?= $row['p_name'] ?></td>
                                <td align="center"><?= number_format($row['p_price']) ?> ฿</td>
                                <td align="center"><?= number_format($row['oqty']) ?> คู่ </td>
                                <td align="center"><?= number_format($row['sum']) ?> ฿</td>
                              </tr>
                            <?php
                              $priceSum += $row['p_price'];
                              $qtySum += $row['oqty'];
                              $totalSum += $row['sum'];
                            } ?>
                          </tbody>
                          <tfoot>
                            <tr class="text-danger">
                              <td colspan="3" align="center"><b>รวมทั้งหมด</b></td>
                              <td align="center"><b><?= number_format($priceSum) ?> ฿</b></td>
                              <td align="center"><b><?= number_format($qtySum) ?> คู่ </b></td>
                              <td align="center"><b><?= number_format($totalSum) ?> ฿</b></td>
                            </tr>
                          </tfoot>
                        </table>
                      <?php } else { ?>
                        <hr>
                        <h4 class="text-danger text-center">ไม่พบรายการสั่งซื้อที่คุณค้นหา</h4>
                      <?php } ?>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-2"><br>
                          <button onclick="tablePrint();" class="btn btn-primary mt-3"><i class="fa fa-print"></i> พิมพ์รายงาน</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</body>

</html>
<!-- Script -->
<script>
  function tablePrint() {
    var display_setting = "toolbar=no,location=no,directories=no,menubar=no,";
    display_setting += "scrollbars=no,width=1024, height=768, left=100, top=100";
    var content_innerhtml = $("#printout").html();
    var document_print = window.open("", "", display_setting);
    document_print.document.open();
    document_print.document.close();
    document_print.document.write('<body style="font-family:Calibri(body);  font-size:14px;" onLoad="self.print();self.close();" >');
    document_print.document.write(content_innerhtml);
    document_print.document.write('</body></html>');
    document_print.document.title = 'ออกรายงาน';
    document_print.print();
    document_print.close();
    return false;
  }
</script>
<!-- .Script -->

<?php
include('footerjs.php');
?>