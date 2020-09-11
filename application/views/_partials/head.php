<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GaiaBiai - <?= isset($page_title) ? $page_title : ''; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?= base_url() ?>/tpl/adminlte2/dist/img/favicon.ico" type="image/gif" sizes="16x16">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
     <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/dist/css/skins/_all-skins.min.css">
     <!-- DataTables -->
     <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
   <!-- Google Font -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/dist/css/custom.css">


   <!-- jvectormap -->
   <link rel="stylesheet" href="<?= base_url() ?>/tpl/adminlte2/bower_components/jvectormap/jquery-jvectormap.css">
 </head><!-- jQuery 3 -->
 <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/jquery/dist/jquery.min.js"></script>
 <!-- Bootstrap 3.3.7 -->
 <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- SlimScroll -->
 <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
 <!-- FastClick -->
 <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/fastclick/lib/fastclick.js"></script>
 <!-- AdminLTE App -->
 <script src="<?= base_url() ?>/tpl/adminlte2/dist/js/adminlte.min.js"></script>
 <!-- AdminLTE for demo purposes -->
 <script src="<?= base_url() ?>/tpl/adminlte2/dist/js/demo.js"></script>
 <!-- DataTables -->
<!-- <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script> -->
  <!-- DataTables -->
  <script src="<?= base_url() ?>/tpl/adminlte2/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>/tpl/adminlte2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>/tpl/adminlte2/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>/tpl/adminlte2/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <!-- InputMask -->
<!--<script src="<?= base_url() ?>/tpl/adminlte2/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url() ?>/tpl/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url() ?>/tpl/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="<?= base_url() ?>/tpl/adminlte2/dist/js/custom.js"></script>



<script src="<?= base_url() ?>/tpl/adminlte2/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>/tpl/adminlte2/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>/tpl/adminlte2/bower_components/chart.js/Chart.js"></script>
<script src="<?= base_url() ?>/tpl/adminlte2/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<link href="<?= base_url('assets/css/sweet-alert.css') ?>" rel="stylesheet" /> 