<!-- jQuery 3  devbanban.com -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(document).ready(function() {
    $('#example1').DataTable({
      "aaSorting": [
        [0, 'asc']
      ],
      "lengthMenu": [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
      ]
    });
    $('#example2').DataTable({
      "aaSorting": [
        [0, 'asc']
      ],
      "lengthMenu": [
        [3, 5, 10, -1],
        [3, 5, 10,  "All"]
      ]
    });
  });
</script>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
    $('#example3').DataTable({
      'paging': false,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': false,
      'autoWidth': false
    })
  })
</script>