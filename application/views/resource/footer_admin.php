<!-- jQuery 3 -->
<script src="<?php echo base_url().'bower_components/jquery/dist/jquery.min.js'?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url().'bower_components/jquery-ui/jquery-ui.min.js'?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url().'bower_components/bootstrap/dist/js/bootstrap.min.js'?>"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url().'bower_components/raphael/raphael.min.js'?>"></script>
<script src="<?php echo base_url().'bower_components/morris.js/morris.min.js'?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url().'bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url().'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'?>"></script>
<script src="<?php echo base_url().'plugins/jvectormap/jquery-jvectormap-world-mill-en.js'?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url().'bower_components/jquery-knob/dist/jquery.knob.min.js'?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url().'bower_components/moment/min/moment.min.js'?>"></script>
<script src="<?php echo base_url().'bower_components/bootstrap-daterangepicker/daterangepicker.js'?>"></script>
<!-- datepicker -->
<script src="<?php echo base_url().'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url().'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'?>"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url().'bower_components/jquery-slimscroll/jquery.slimscroll.min.js'?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url().'bower_components/fastclick/lib/fastclick.js'?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url().'dist/js/adminlte.min.js'?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url().'dist/js/demo.js'?>"></script>

<script src="<?php echo base_url().'bower_components/chart.js/Chart.js'?>"></script>
<script>
  $(function () {
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )
    //Date picker
    $('#datepicker').datepicker({
	  dateFormat: 'dd-mm-yyyy',
      autoclose: true
    })
	$('#datepicker2').datepicker({
	  dateFormat: 'dd-mm-yyyy',
      autoclose: true
    }).on("dp.change", function (e) {
        $('#datepicker3').data("datepicker").minDate(e.date);
    });
	$('#datepicker3').datepicker({
	  dateFormat: 'dd-mm-yyyy',
	  useCurrent: false,
      autoclose: true
    }).on("dp.change", function (e) {
        $('#datepicker2').data("datepicker").maxDate(e.date);
    });
	
 
  })
</script>
</body>
</html>
