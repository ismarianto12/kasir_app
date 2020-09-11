    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url(); ?>tpl/adminlte2/dist/img/icon-gaia-biai-512px.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p class="text-capitalize"><?php echo $this->session->userdata("username") ?></p>
            <a href="#"><i class="fa fa-circle text-success fa-blink"></i> Online</a>
          </div>
        </div>
        <?php
        if ($this->session->level == 'administrator' or $this->session->level == 'manager') {
          $params = 'superuser';
        } elseif ($this->session->level == 'admin') {
          $params = 'admin';
        } elseif ($this->session->level == 'kasir') {
          $params = 'kasir';
        }
        require_once APPPATH . 'views/menu/' . $params.'.php'; ?>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->