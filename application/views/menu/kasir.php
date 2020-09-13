<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MENU UTAMA</li>
  <li class="<?php if ($this->uri->segment(1) == "home") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('home') ?>">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>

    </a>
  </li>

  <li class="header">Sych Data </li>
  <li class="<?php if ($this->uri->segment(1) == "synch") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('synch') ?>">
      <i class="fa fa-cubes"></i> <span>Sinkron master barang</span>
    </a>
  </li>


  <li class="header">DATA TRANSAKSI</li>
  <li class="<?php if ($this->uri->segment(1) == "trtransaksi") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('trtransaksi') ?>">
      <i class="fa fa-cart-arrow-down"></i> <span>Penjualan</span>

    </a>
  </li>

  <li class="header">Histori Penjualan </li>
  <li class="<?php if ($this->uri->segment(1) == "report_transaksi") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('report_transaksi') ?>">
      <i class="fa fa-cubes"></i> <span>Report Transaksi.</span> 
    </a>
  </li>
   

  <li class="header">Hostori GAJI</li>
  <li class="<?php if ($this->uri->segment(1) == "penggajian") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('penggajian') ?>">
      <i class="fa fa-money"></i> <span>Hisori Penggajian</span>

    </a>
  </li>
  <li class="header">DATA AKUN</li>
  <li class="<?php if ($this->uri->segment(1) == "profil") {
                echo "active";
              } ?>">
    <a href="<?php echo base_url('profile') ?>">
      <i class="fa fa-user"></i> <span>Akun</span>

    </a>
  </li>

</ul>