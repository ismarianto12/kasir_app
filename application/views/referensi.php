<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon_referensi; ?>"></i> <?php echo $title_referensi; ?></li>
        </ol>
    </div>

    <div class="row">

        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL JENIS</span>
                    <span class="info-box-number"><?php foreach ($grafik_referensi as $total_jenis) {
                                                        echo $total_jenis->total_jenis;
                                                    } ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL MODEL</span>
                    <span class="info-box-number"><?php foreach ($grafik_referensi as $total_model) {
                                                        echo $total_model->total_model;
                                                    } ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL WARNA</span>
                    <span class="info-box-number"><?php foreach ($grafik_referensi as $total_warna) {
                                                        echo $total_warna->total_warna;
                                                    } ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL UKURAN</span>
                    <span class="info-box-number"><?php foreach ($grafik_referensi as $total_ukuran) {
                                                        echo $total_ukuran->total_ukuran;
                                                    } ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-2 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bullseye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL OPTIONAL</span>
                    <span class="info-box-number"><?php foreach ($grafik_referensi as $total_optional) {
                                                        echo $total_optional->total_optional;
                                                    } ?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab_jenis" data-toggle="tab"><i class="fa fa-circle-o"></i> Jenis</a></li>
            <li><a href="#tab_model" data-toggle="tab"><i class="fa fa-circle-o"></i> Model</a></li>
            <li><a href="#tab_warna" data-toggle="tab"><i class="fa fa-circle-o"></i> Warna</a></li>
            <li><a href="#tab_ukuran" data-toggle="tab"><i class="fa fa-circle-o"></i> Ukuran</a></li>
            <li><a href="#tab_optional" data-toggle="tab"><i class="fa fa-circle-o"></i> Optional</a></li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_jenis">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cube"></i> Jenis</h3>
                    <div class="box-tools pull-right">
                        <?php foreach (array_slice($ref_jenis, 0, 1) as $row) { ?>
                            <a href="#tambah_ref" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-refref="<?php echo $row->ref; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="box-body">
                    <table id="datatable_jenis" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">KODE</th>
                                <th class="text-center bg-primary text-white">KETERANGAN</th>
                                <th class="text-center bg-primary text-white">ACT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($ref_jenis as $row) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><?php echo $row->kode_ref ?></td>
                                    <td class="text-center"><?php echo $row->keterangan_ref ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="#edit_ref_<?php echo $row->kode_ref; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                            <a href="<?php echo base_url(); ?>master/del_ref/<?php echo $row->kode_ref; ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php
                    echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                    ?>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_model">
                <div class="tab-pane" id="tab_model">
                    <div class="box-body box box-solid box-gray">
                        <form method="get" action="<?php echo base_url("master/referensi/") ?>">
                            <div class="row col-sm-2">
                                <label for="model_jenis"><b>PILIH JENIS : </b></label>
                                <div class="input-group">
                                    <div class="input-group-addon">JNS</div>
                                    <select name="model_jenis" id="model_jenis" class="form-control">
                                        <option value="" selected disabled>- Pilih Jenis -</option>
                                        <?php
                                        foreach ($ref_jenis_list as $list) { ?>
                                            <option value="<?php echo $list->link ?>" <?php foreach (array_slice($ref_model_input, 0, 1) as $row) {
                                                                                            if ($list->link == $row->link) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>><?php echo $list->keterangan_ref ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Cari</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cube"></i> Model</h3>
                        <div class="box-tools pull-right">
                            <?php if (count($ref_model) > 0) {
                                foreach (array_slice($ref_model, 0, 1) as $row) { ?>
                                    <a href="#tambah_ref_mdl" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-reflinkmdl="<?php echo $row->link; ?>" data-refref="<?php echo $row->ref; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                                <?php }
                            } else {
                                foreach (array_slice($ref_model_input, 0, 1) as $row) { ?>
                                    <a href="#tambah_ref_mdl" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-reflinkmdl="<?php echo $row->link; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                            <?php }
                            } ?>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="datatable_model" class="table table-bordered table-hover dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-primary text-white">NO.</th>
                                    <th class="text-center bg-primary text-white">KODE</th>
                                    <th class="text-center bg-primary text-white">KETERANGAN</th>
                                    <th class="text-center bg-primary text-white">ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($ref_model) > 0) {
                                    $no = 1;
                                    foreach ($ref_model as $row) {
                                ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td class="text-center"><?php echo $row->kode_ref ?></td>
                                            <td class="text-center"><?php echo $row->keterangan_ref ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#edit_ref_<?php echo $row->kode_ref; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                                    <a href="<?php echo base_url(); ?>master/del_ref/<?php echo $row->kode_ref; ?>/<?php echo $row->ref; ?>/<?php echo $row->link; ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php
                        echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                        ?>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_warna">
                <div class="tab-pane active" id="tab_warna">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cube"></i> warna</h3>
                        <div class="box-tools pull-right">
                            <?php foreach (array_slice($ref_warna, 0, 1) as $row) { ?>
                                <a href="#tambah_ref" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-refref="<?php echo $row->ref; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="datatable_warna" class="table table-bordered table-hover dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-primary text-white">NO.</th>
                                    <th class="text-center bg-primary text-white">KODE</th>
                                    <th class="text-center bg-primary text-white">KETERANGAN</th>
                                    <th class="text-center bg-primary text-white">ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ref_warna as $row) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++ ?></td>
                                        <td class="text-center"><?php echo $row->kode_ref ?></td>
                                        <td class="text-center"><?php echo $row->keterangan_ref ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#edit_ref_<?php echo $row->kode_ref; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                                <a href="<?php echo base_url(); ?>master/del_ref/<?php echo $row->kode_ref; ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php
                        echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                        ?>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_ukuran">
                <div class="tab-pane active" id="tab_ukuran">
                    <div class="box-body box box-solid box-gray">
                        <form method="get" action="<?php echo base_url("master/referensi/") ?>">
                            <div class="row col-sm-2">
                                <label for="pilih_jenis"><b>PILIH JENIS : </b></label>
                                <div class="input-group">
                                    <div class="input-group-addon">JNS</div>
                                    <select name="pilih_jenis" id="pilih_jenis" class="form-control">
                                        <option value="" selected disabled>- Pilih Jenis -</option>
                                        <?php
                                        foreach ($ref_jenis_list as $list) { ?>
                                            <option value="<?php echo $list->link ?>" <?php foreach (array_slice($ref_ukuran_input, 0, 1) as $row) {
                                                                                            if ($list->link == $row->link) {
                                                                                                echo "selected";
                                                                                            }
                                                                                        } ?>><?php echo $list->keterangan_ref ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i> Cari</button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cube"></i> Ukuran</h3>
                        <div class="box-tools pull-right">
                            <?php if (count($ref_ukuran) > 0) {
                                foreach (array_slice($ref_ukuran, 0, 1) as $row) { ?>
                                    <a href="#tambah_ref_ukr" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-reflink="<?php echo $row->link; ?>" data-refref="<?php echo $row->ref; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                                <?php }
                            } else {
                                foreach (array_slice($ref_ukuran_input, 0, 1) as $row) { ?>
                                    <a href="#tambah_ref_ukr" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-reflink="<?php echo $row->link; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                            <?php }
                            } ?>
                        </div>
                    </div>

                    <div class="box-body ">
                        <table id="datatable_ukuran" class="table table-bordered table-hover dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-primary text-white">NO.</th>
                                    <th class="text-center bg-primary text-white">KODE</th>
                                    <th class="text-center bg-primary text-white">KETERANGAN</th>
                                    <th class="text-center bg-primary text-white">ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (count($ref_ukuran) > 0) {
                                    $no = 1;
                                    foreach ($ref_ukuran as $row) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td class="text-center"><?php echo $row->kode_ref ?></td>
                                            <td class="text-center"><?php echo $row->keterangan_ref ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#edit_ref_<?php echo $row->kode_ref; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                                    <a href="<?php echo base_url(); ?>master/del_ref/<?php echo $row->kode_ref; ?>/<?php echo $row->ref; ?>/<?php echo $row->link; ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php
                        echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                        ?>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_optional">
                <div class="tab-pane active" id="tab_optional">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-cube"></i> Optional</h3>
                        <div class="box-tools pull-right">
                            <?php foreach (array_slice($ref_optional, 0, 1) as $row) { ?>
                                <a href="#tambah_ref" class="btn btn-primary btn-circle btn-sm add_ref" data-toggle="modal" data-refref="<?php echo $row->ref; ?>" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="box-body">
                        <table id="datatable_optional" class="table table-bordered table-hover dt-responsive " style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center bg-primary text-white">NO.</th>
                                    <th class="text-center bg-primary text-white">KODE</th>
                                    <th class="text-center bg-primary text-white">KETERANGAN</th>
                                    <th class="text-center bg-primary text-white">ACT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ref_optional as $row) {
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $no++ ?></td>
                                        <td class="text-center"><?php echo $row->kode_ref ?></td>
                                        <td class="text-center"><?php echo $row->keterangan_ref ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="#edit_ref_<?php echo $row->kode_ref; ?>" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                                <a href="<?php echo base_url(); ?>master/del_ref/<?php echo $row->kode_ref; ?>" title="Hapus" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <?php
                        echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                        ?>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
        </div>
    </div>


</section>
<!-- /.content -->

<!-- ###################################################### -->
<!-- Modal Tambah referensi-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_ref" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatareferensi" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/add_ref'; ?>" method="post">
                    <div class="box-body">
                        <input type="text" id="ref_ref" name="ref_ref" class="form-control">
                        <div class="form-group">
                            <label for="input_kode_jenis">KODE :</label>
                            <input type="text" onkeypress="return event.charCode != 32" oninput="this.value" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_kode_jenis" name="input_kode_jenis" title="Kode Jenis" placeholder="Kode Jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="input_nm_jenis">KETERANGAN :</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_nm_jenis" name="input_nm_jenis" title="Keterangan" placeholder="Keterangan..." required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- ###################################################### -->
<!-- End Modal Tambah Unit-->
<!-- ###################################################### -->

<!-- ###################################################### -->
<!-- Modal Tambah referensi-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_ref_ukr" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatareferensi" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/add_ref'; ?>" method="post">
                    <div class="box-body">
                        <input type="text" id="ref_ref" name="ref_ref" value="UKR" class="form-control">
                        <input type="text" id="ref_link" name="ref_link" class="form-control">
                        <div class="form-group">
                            <label for="input_kode_jenis">KODE :</label>
                            <input type="text" onkeypress="return event.charCode != 32" oninput="this.value" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_kode_jenis" name="input_kode_jenis" title="Kode Jenis" placeholder="Kode Jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="input_nm_jenis">KETERANGAN :</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_nm_jenis" name="input_nm_jenis" title="Keterangan" placeholder="Keterangan..." required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- ###################################################### -->
<!-- End Modal Tambah Unit-->
<!-- ###################################################### -->


<!-- ###################################################### -->
<!-- Modal Tambah referensi-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_ref_mdl" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatareferensi" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/add_ref'; ?>" method="post">
                    <div class="box-body">
                        <input type="text" id="ref_ref" name="ref_ref" value="MDL" class="form-control">
                        <input type="text" id="ref_link_mdl" name="ref_link" class="form-control">
                        <div class="form-group">
                            <label for="input_kode_jenis">KODE :</label>
                            <input type="text" onkeypress="return event.charCode != 32" oninput="this.value" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_kode_jenis" name="input_kode_jenis" title="Kode Jenis" placeholder="Kode Jenis" required>
                        </div>
                        <div class="form-group">
                            <label for="input_nm_jenis">KETERANGAN :</label>
                            <input type="text" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" id="input_nm_jenis" name="input_nm_jenis" title="Keterangan" placeholder="Keterangan..." required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- ###################################################### -->
<!-- End Modal Tambah Unit-->
<!-- ###################################################### -->


<!-- ###################################################### -->
<!-- Modal Ubah -->
<!-- ###################################################### -->
<?php foreach ($data_referensi as $edit) { ?>
    <div class="modal fade" id="edit_ref_<?php echo $edit->kode_ref; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahreferensi" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/edit_ref'; ?>" method="post">
                        <div class="box-body">
                        <input type="text" id="edit_ref" name="edit_ref" value="<?php echo $edit->ref; ?>" class="form-control">
                        <input type="text" id="edit_link" name="edit_link" value="<?php echo $edit->link; ?>" class="form-control">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="edit_kode_jenis">KODE :</label>
                                    <input type="text" onkeypress="return event.charCode != 32" oninput="this.value" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" value="<?php echo $edit->kode_ref; ?>" id="edit_kode_ref" name="edit_kode_ref" title="Kode Jenis" placeholder="Kode Jenis" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="edit_keterangan_ref">KETERANGAN :</label>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" class="form-control" value="<?php echo $edit->keterangan_ref; ?>" id="edit_keterangan_ref" name="edit_keterangan_ref" title="Keterangan" placeholder="Keterangan..." required>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-warning">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php }
?>
<!-- ###################################################### -->
<!-- End Modal Ubah -->
<!-- ###################################################### -->
<script>
    $(document).ready(function() {
        $('.add_ref').on('click', function() {
            document.getElementById("ref_ref").value = $(this).attr("data-refref");
            document.getElementById("ref_link").value = $(this).attr("data-reflink");
            document.getElementById("ref_link_mdl").value = $(this).attr("data-reflinkmdl");
        });
    });

    $(function() {
        $("#datatable_default,#datatable_optional,#datatable_ukuran").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#datatable_jenis").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#datatable_model").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
        $("#datatable_warna").DataTable({
            "responsive": true,
            "autoWidth": false,
        });

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>