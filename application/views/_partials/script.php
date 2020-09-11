<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/dist/js/demo.js"></script>
<!-- DataTables -->
<!-- <script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
<!-- DataTables -->

<link href="<?= base_url('tpl/adminlte2/plugins/select2') ?>/select2.min.css" rel="stylesheet" />
<script src="<?= base_url('tpl/adminlte2/plugins/select2') ?>/select2.min.js"></script>

<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- InputMask -->
<!--<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/dist/js/custom.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/chart.js/Chart.js"></script>
<script src="<?php echo base_url(); ?>tpl/adminlte2/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script>
    function logout() {
        //const imageURL = "tpl/adminlte2/dist/img/tanya.png";

        event.preventDefault();
        Swal.fire({
            title: 'Anda akan keluar dari halamn administrator ?',
            text: "klik jika iya",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.value) {
                window.location.href = "<?= base_url('login/logout') ?>";
            }
        })
    }
</script>