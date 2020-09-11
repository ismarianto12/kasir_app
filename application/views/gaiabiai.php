<!DOCTYPE html>
<html>
<?php $this->load->view("_partials/head.php") ?>
<?php $this->load->view("_partials/script.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php $this->load->view("_partials/header.php") ?>
        <?php $this->load->view("_partials/slidebar.php") ?>
        <!-- Content -->
        <div class="content-wrapper">
            <?php $this->load->view($content); ?>
        </div>
        <?php $this->load->view("_partials/footer.php") ?>
        
        <!-- End Content-->
    </div>
    <?php $this->load->view("_partials/notifikasi.php") ?>
</body>
</html>