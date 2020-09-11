<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MENU UTAMA</li>
    <li class="<?php if ($this->uri->segment(1) == "home") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('home') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>

        </a>
    </li>
    <li class="<?php if ($this->uri->segment(2) == "penggajian") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('penggajian') ?>">
            <i class="fa fa-money"></i> <span>Histori Gaji</span>

        </a>
    </li>
    <li class="header">DATA MASTER</li>

    <li class="<?php if ($this->uri->segment(2) == "member") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('member') ?>">
            <i class="fa fa-user"></i> <span>member</span>
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
    <li class="header">DATA AKUN</li>
    <li class="<?php if ($this->uri->segment(1) == "profile") {
                    echo "active";
                } ?>">
        <a href="<?php echo base_url('profile') ?>">
            <i class="fa fa-user"></i> <span>Akun</span>

        </a>
    </li>

</ul>