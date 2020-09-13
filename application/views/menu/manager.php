<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    <li class="<?php if ($this->uri->segment(1) == "home") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="<?php if ($this->uri->segment(2) == "karyawan") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('master/karyawan') ?>">
            <i class="fa fa-id-badge"></i> <span>Karyawan</span>

        </a>
    </li>
    <li class="header">DATA MASTER</li>
    <li class="<?php if ($this->uri->segment(2) == "pemasok") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('master/pemasok') ?>">
            <i class="fa fa-bell"></i> <span>Pemasok</span>

        </a>
    </li>
    <li class="<?php if ($this->uri->segment(2) == "member") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('member') ?>">
            <i class="fa fa-user"></i> <span>member</span>
        </a>
    </li>
    <li class="<?php if ($this->uri->segment(2) == "pelanggan") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('master/pelanggan') ?>">
            <i class="fa fa-handshake-o"></i> <span>Pelanggan</span>
        </a>
    </li>
    <li class="header">MASTER BARANG</li>
    <li class="<?php if ($this->uri->segment(2) == "referensi") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('master/referensi') ?>">
            <i class="fa fa-cubes"></i> <span>Referensi</span>

        </a>
    </li>
    <li class="<?php if ($this->uri->segment(2) == "barang") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('master/barang') ?>">
            <i class="fa fa-cube"></i> <span>Barang</span>

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
    <li class="<?php if ($this->uri->segment(1) == "pembelian") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('pembelian') ?>">
            <i class="fa fa-cart-arrow-down"></i> <span>Pembelian & Purchase</span>

        </a>
    </li>
    <li class="header">Report</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Iktishar Laba Rugi</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url('trtransaksi/report') ?>"><i class="fa fa-circle-o"></i> Report Penjualan</a></li>
            <li><a href="<?= base_url('trtransaksi/report') ?>"><i class="fa fa-circle-o"></i> Report Pembelian</a></li>
            <li><a href="<?= base_url('barang/report') ?>"><i class="fa fa-circle-o"></i> Report Barang </a></li>

        </ul>
    </li>

    <li class="treeview">
        <a href="#">
            <i class="fa fa-wrench"></i> <span>Setting</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?= base_url('tmmodul') ?>"><i class="fa fa-circle-o"></i> Menu Apss</a></li>
            <li><a href="<?= base_url('instansi') ?>"><i class="fa fa-circle-o"></i> Aplication Setting</a></li>

        </ul>
    </li>

    <li><a href="<?= base_url('report_transaksi') ?>"><i class="fa fa-list-o"></i> Report Penjualan</a></li>
      
    <li class="header">DATA GAJI</li>
    <li class="<?php if ($this->uri->segment(1) == "penggajian") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('penggajian') ?>">
            <i class="fa fa-money"></i> <span>Penggajian</span>

        </a>
    </li>
    <li class="header">DATA AKUN</li>
    <li class="<?php if ($this->uri->segment(1) == "akun") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('akun') ?>">
            <i class="fa fa-user"></i> <span>Akun</span>

        </a>
    </li>

</ul>