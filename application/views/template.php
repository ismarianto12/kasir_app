<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GaiaBiai - <?= $page_title ?></title>
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
<script src="<?= base_url() ?>/tpl/adminlte2/plugins/sweetalert/sweetalert2@9.js"></script>
 
<link href="<?= base_url('assets/css/sweet-alert.css') ?>" rel="stylesheet" />
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

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>G</b>B</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Gaia</b>Biai</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" onclick="logout()" data-toggle="control-sidebar"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header> <!-- =============================================== -->

        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?= base_url() ?>/tpl/adminlte2/dist/img/icon-gaia-biai-512px.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p class="text-capitalize"><?= ucfirst($this->session->name) ?> - <?= ucfirst($this->session->level) ?></p>
                        <a href="#"><i class="fa fa-circle text-success fa-blink"></i> Online</a>
                    </div>
                </div>
                <?php
                if ($this->session->level == 'administrator' or  $this->session->level == 'manager') {
                    $params = 'superuser';
                } elseif ($this->session->level == 'admin') {
                    $params = 'admin';
                } elseif ($this->session->level == 'kasir') {
                    $params = 'kasir';
                }
                require_once APPPATH . 'views/menu/' . $params . '.php'; ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- =============================================== -->
        <!-- Content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <ol class="breadcrumb bg-white">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active"><i class="fa fa-id-badge"></i><?= $page_title ?></li>
                    </ol>
                </div>
                <?= $contents ?>
            </section>

        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 0.1
            </div>
            <strong>Copyright &copy; 2020 Gaia Biai</strong> All rights
            reserved.
        </footer>
        <!-- End Content-->
    </div>

</body>

</html>