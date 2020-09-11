<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon_penggajian; ?>"></i> <?php echo $title_penggajian; ?></li>
        </ol>
    </div>




    <?php if ($this->session->level != 'manager' && $this->session->level != 'administrator') {  ?>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-cash"></i> Penggajian</span>
                    <div class="info-box-content">
                        <table class="table table-responsive">
                            <tr>
                                <th><?= ucfirst($this->session->name) ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-user"></i>Jabatan</span>
                    <div class="info-box-content">
                        <table class="table table-responsive">
                            <tr>
                                <th><?= ucfirst($this->session->level) ?></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    <?php } else {  ?>
        <div class="alert alert-info"><i class="fa fa-money"></i>Cara penggajian 
        <ol>
            <li>Set Terlebih dahulu besaran gaji di modul master karyawan dan jumlah tunjangan</li>
            <li>Set Status gaji di terima</li>
            <li>Kemudan masuk ke modul penggajian</li>
            <li>Pilih bulan berapa karyawan yang status penggajian nya aktif tersebut mendapatakan gaji
                , kemudian di tab tunjangan tambahan silahkan di tambah tunjangan lainya misal , lembur per x 1 jam (jik ada)</li>
            <li>Kemudian Simpan klik detail gaji </li>
            <li>kemudian pada kolom status set terima jika gaji telah di terima oleh karyawan .</li>
            <li>Cetak struk dan selesai .</li>

        </ol>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="ion ion-cash"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">ENTRI PENGGAJIAN</span>
                        <span class="info-box-number"><?php foreach ($grafik_penggajian as $total_penggajian) {
                                                            echo $total_penggajian->total_penggajian;
                                                        } ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-id-badge"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">KARYAWAN</span>
                        <span class="info-box-number"><?php foreach ($grafik_karyawan as $total_karyawan) {
                                                            echo $total_karyawan->total_karyawan;
                                                        } ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-checkmark-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">KARYAWAN AKTIF</span>
                        <span class="info-box-number"><?php foreach ($grafik_karyawan as $total_aktif) {
                                                            echo $total_aktif->total_aktif;
                                                        } ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="ion ion-ios-close-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">KARYAWAN NON-AKTIF</span>
                        <span class="info-box-number"><?php foreach ($grafik_karyawan as $total_nonaktif) {
                                                            echo $total_nonaktif->total_nonaktif;
                                                        } ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    <?php } ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab_penggajian" data-toggle="tab"><i class="fa <?php echo $faicon_penggajian; ?>"></i> <?php echo $title_penggajian; ?></a></li>
            <li><a href="#tab_insentif" data-toggle="tab"><i class="fa <?php echo $faicon_insentif; ?>"></i> <?php echo $title_insentif; ?></a></li>
        </ul>
        <!-- Tab content -->
        <div class="tab-content">
            <div class="tab-pane active" id="tab_penggajian">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_penggajian; ?>"></i> <?php echo $title_penggajian; ?></h3>
                    <div class="box-tools pull-right">
                        <?php if ($this->session->level == 'manager' or $this->session->level == 'administrator') {  ?>
                            <a href="#tambah_penggajian" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                        <?php } ?>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tabledatapenggajian" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">log</th>
                                <th class="text-center bg-primary text-white">BULAN</th>
                                <th class="text-center bg-primary text-white">TGL.PENGGAJIAN</th>
                                <th class="text-center bg-primary text-white">CATATAN</th>
                                <th class="text-center bg-primary text-white">STATUS</th>
                                <th class="text-center bg-primary text-white">ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
            <div class="tab-pane" id="tab_insentif">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_insentif; ?>"></i> <?php echo $title_insentif; ?></h3>
                    <?php if ($this->session->level == 'manager' or  $this->session->level == 'administrator') {  ?>
                        <div class="box-tools pull-right">
                            <a href="#tambah_insentif" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                        </div>

                    <?php } else {  ?>
                    <?php } ?>
                </div>

                <div class="box-body">
                    <table id="tabledatainsentif" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">NAMA</th>
                                <th class="text-center bg-primary text-white">INSENTIF</th>
                                <th class="text-center bg-primary text-white">TGL.TERIMA</th>
                                <th class="text-center bg-primary text-white">BULAN</th>
                                <th class="text-center bg-primary text-white">TOTAL</th>
                                <th class="text-center bg-primary text-white">STATUS</th>
                                <th class="text-center bg-primary text-white">ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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

</section>
<!-- /.content -->

<!-- ###################################################### -->
<!-- Modal Tambah Penggajian -->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_penggajian" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatapenggajian" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH PENGGAJIAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'penggajian/addpenggajian'; ?>" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="input_bulan">BULAN</label>
                                    <select class="form-control col-sm-9" name="input_bulan" id="input_bulan" required>
                                        <option value="" disabled selected>- Pilih - </option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="input_tahun">TAHUN</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control text-center" id="input_tahun" name="input_tahun" value="<?php echo date('Y'); ?>" readonly>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_catatan">CATATAN</label>
                            <textarea class="form-control" id="input_catatan" name="input_catatan" rows="5" placeholder="Catatan ..." required></textarea>
                        </div>

                        <div class="form-group" id="date_1">
                            <label for="input_tgl_penggajian">TGL.PENGGAJIAN</label>
                            <div class="input-group date" data-date-format="dd/mm/yyyy">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" autocomplete="off" class="form-control float-right" id="input_tgl_penggajian" name="input_tgl_penggajian" type="text" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                            </div>
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
<!-- Modal Tambah insentif -->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_insentif" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatainsentif" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH INSENTIF</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'penggajian/addinsentif'; ?>" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="input_bulan_insentif">BULAN :</label>
                                    <select class="form-control col-sm-9" name="input_bulan_insentif" id="input_bulan_insentif" required>
                                        <option value="" disabled selected>- Pilih - </option>
                                        <option value="Januari">Januari</option>
                                        <option value="Februari">Februari</option>
                                        <option value="Maret">Maret</option>
                                        <option value="April">April</option>
                                        <option value="Mei">Mei</option>
                                        <option value="Juni">Juni</option>
                                        <option value="Juli">Juli</option>
                                        <option value="Agustus">Agustus</option>
                                        <option value="September">September</option>
                                        <option value="Oktober">Oktober</option>
                                        <option value="November">November</option>
                                        <option value="Desember">Desember</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="input_tahun_insentif">TAHUN :</label>
                                    <div class="input-group">
                                        <input type="text" autocomplete="off" class="form-control text-center" id="input_tahun_insentif" name="input_tahun_insentif" value="<?php echo date('Y'); ?>" readonly>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label for="pop_id_karyawan">ID KARYAWAN :</label>
                                    <input type="text" autocomplete="off" class="form-control" id="pop_id_karyawan" name="pop_id_karyawan" placeholder="ID Karyawan" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pop_nm_karyawan">NAMA KARYAWAN :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="pop_nm_karyawan" name="pop_nm_karyawan" placeholder="Nama Karyawan" readonly>
                                        <span class="input-group-btn">
                                            <a href="#modalkaryawan" class="btn btn-primary btn-sm btn-cari-karyawan" data-toggle="modal" title="Cari Karyawan"><i class="fa fa-search"></i> CARI</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="input_nm_insentif">NAMA INSENTIF :</label>
                            <input type="text" autocomplete="off" class="form-control" id="input_nm_insentif" name="input_nm_insentif" placeholder="Nama Insentif ..." required>
                        </div>

                        <div class="form-group" id="date_1">
                            <label for="input_tgl_terima">TGL.TERIMA :</label>
                            <div class="input-group date" data-date-format="dd/mm/yyyy">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" autocomplete="off" class="form-control float-right" id="input_tgl_terima" name="input_tgl_terima" type="text" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_nm_insentif">TOTAL INSENTIF :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Rp.
                                </div>
                                <input type="text" autocomplete="off" class="form-control" id="input_total_insentif" name="input_total_insentif" placeholder="Total Insentif ..." required>
                            </div>
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
<!-- End Modal Tambah Insentif-->
<!-- ###################################################### -->
<!-- ###################################################### -->
<!-- Modal Ubah -->
<!-- ###################################################### -->
<?php foreach ($data_penggajian as $edit) { ?>
    <div class="modal fade" id="edit_penggajian_<?php echo $edit->id_penggajian; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahpenggajian" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH PENGGAJIAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'penggajian/editpenggajian'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="edit_id_penggajian" name="edit_id_penggajian" class="form-control" value="<?php echo $edit->id_penggajian; ?>">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="edit_bulan">BULAN</label>
                                        <select class="form-control col-sm-9" name="edit_bulan" id="edit_bulan" required>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <option value="Januari" <?php if ($edit->bulan == "Januari") {
                                                                        echo "selected";
                                                                    } ?>>Januari</option>
                                            <option value="Februari" <?php if ($edit->bulan == "Februari") {
                                                                            echo "selected";
                                                                        } ?>>Februari</option>
                                            <option value="Maret" <?php if ($edit->bulan == "Maret") {
                                                                        echo "selected";
                                                                    } ?>>Maret</option>
                                            <option value="April" <?php if ($edit->bulan == "April") {
                                                                        echo "selected";
                                                                    } ?>>April</option>
                                            <option value="Mei" <?php if ($edit->bulan == "Mei") {
                                                                    echo "selected";
                                                                } ?>>Mei</option>
                                            <option value="Juni" <?php if ($edit->bulan == "Juni") {
                                                                        echo "selected";
                                                                    } ?>>Juni</option>
                                            <option value="Juli" <?php if ($edit->bulan == "Juli") {
                                                                        echo "selected";
                                                                    } ?>>Juli</option>
                                            <option value="Agustus" <?php if ($edit->bulan == "Agustus") {
                                                                        echo "selected";
                                                                    } ?>>Agustus</option>
                                            <option value="September" <?php if ($edit->bulan == "September") {
                                                                            echo "selected";
                                                                        } ?>>September</option>
                                            <option value="Oktober" <?php if ($edit->bulan == "Oktober") {
                                                                        echo "selected";
                                                                    } ?>>Oktober</option>
                                            <option value="November" <?php if ($edit->bulan == "November") {
                                                                            echo "selected";
                                                                        } ?>>November</option>
                                            <option value="Desember" <?php if ($edit->bulan == "Desember") {
                                                                            echo "selected";
                                                                        } ?>>Desember</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="edit_tahun">TAHUN</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control text-center" id="edit_tahun" name="edit_tahun" value="<?php echo $edit->tahun; ?>" readonly>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_catatan">CATATAN</label>
                                <textarea class="form-control" id="edit_catatan" name="edit_catatan" rows="5" placeholder="Catatan ..." required><?php echo $edit->catatan; ?></textarea>
                            </div>

                            <div class="form-group" id="date_1">
                                <label for="edit_tgl_penggajian">TGL.PENGGAJIAN</label>
                                <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control float-right" id="edit_tgl_penggajian_<?php echo $edit->id_penggajian; ?>" name="edit_tgl_penggajian" type="text" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo date('d/m/Y', strtotime($edit->tgl_penggajian)); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
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
<?php } ?>
<!-- ###################################################### -->
<!-- Modal Ubah Insentif-->
<!-- ###################################################### -->
<?php foreach ($data_insentif as $edit) { ?>
    <div class="modal fade" id="edit_insentif_<?php echo $edit->id_insentif; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahinsentif" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH INSENTIF</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'penggajian/editinsentif'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="edit_id_insentif" name="edit_id_insentif" class="form-control" value="<?php echo $edit->id_insentif; ?>">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="edit_bulan_insentif">BULAN</label>
                                        <select class="form-control col-sm-9" name="edit_bulan_insentif" id="edit_bulan_insentif" required>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <option value="Januari" <?php if ($edit->bulan == "Januari") {
                                                                        echo "selected";
                                                                    } ?>>Januari</option>
                                            <option value="Februari" <?php if ($edit->bulan == "Februari") {
                                                                            echo "selected";
                                                                        } ?>>Februari</option>
                                            <option value="Maret" <?php if ($edit->bulan == "Maret") {
                                                                        echo "selected";
                                                                    } ?>>Maret</option>
                                            <option value="April" <?php if ($edit->bulan == "April") {
                                                                        echo "selected";
                                                                    } ?>>April</option>
                                            <option value="Mei" <?php if ($edit->bulan == "Mei") {
                                                                    echo "selected";
                                                                } ?>>Mei</option>
                                            <option value="Juni" <?php if ($edit->bulan == "Juni") {
                                                                        echo "selected";
                                                                    } ?>>Juni</option>
                                            <option value="Juli" <?php if ($edit->bulan == "Juli") {
                                                                        echo "selected";
                                                                    } ?>>Juli</option>
                                            <option value="Agustus" <?php if ($edit->bulan == "Agustus") {
                                                                        echo "selected";
                                                                    } ?>>Agustus</option>
                                            <option value="September" <?php if ($edit->bulan == "September") {
                                                                            echo "selected";
                                                                        } ?>>September</option>
                                            <option value="Oktober" <?php if ($edit->bulan == "Oktober") {
                                                                        echo "selected";
                                                                    } ?>>Oktober</option>
                                            <option value="November" <?php if ($edit->bulan == "November") {
                                                                            echo "selected";
                                                                        } ?>>November</option>
                                            <option value="Desember" <?php if ($edit->bulan == "Desember") {
                                                                            echo "selected";
                                                                        } ?>>Desember</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="edit_tahun_insentif">TAHUN</label>
                                        <div class="input-group">
                                            <input type="text" autocomplete="off" class="form-control text-center" id="edit_tahun_insentif" name="edit_tahun_insentif" value="<?php echo $edit->tahun; ?>" readonly>
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm">
                                        <label for="pop_edit_id_karyawan">ID KARYAWAN :</label>
                                        <input type="text" autocomplete="off" class="form-control" id="pop_edit_id_karyawan_<?php echo $edit->id_insentif; ?>" name="pop_edit_id_karyawan" placeholder="ID Karyawan" value="<?php echo $edit->id_karyawan; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pop_edit_nm_karyawan">NAMA KARYAWAN :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="pop_edit_nm_karyawan_<?php echo $edit->id_insentif; ?>" name="pop_edit_nm_karyawan" placeholder="Nama Karyawan" value="<?php echo $edit->nm_karyawan; ?>" readonly>
                                            <span class="input-group-btn">
                                                <a href="#modalkaryawan" class="btn btn-primary btn-sm btn-cari-karyawan" data-toggle="modal" title="Cari Karyawan"><i class="fa fa-search"></i> CARI</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_nm_insentif">NAMA INSENTIF :</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_nm_insentif" name="edit_nm_insentif" placeholder="Nama Insentif ..." value="<?php echo $edit->nm_insentif; ?>" required>
                            </div>

                            <div class="form-group" id="date_1">
                                <label for="edit_tgl_terima">TGL.TERIMA :</label>
                                <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control float-right" id="edit_tgl_terima_<?php echo $edit->id_insentif; ?>" name="edit_tgl_terima" type="text" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo date('d/m/Y', strtotime($edit->tgl_terima)); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_total_insentif">TOTAL INSENTIF :</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control" id="edit_total_insentif_<?php echo $edit->id_insentif; ?>" name="edit_total_insentif" value="<?php echo $edit->total_insentif; ?>" placeholder="Total Insentif ..." required>
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
<?php } ?>



<!-- Cari karyawan -->
<div class="modal fade" id="modalkaryawan" tabindex="-1" role="dialog" aria-labelledby="poplabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:800px">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-users"></i> DATA KARYAWAN</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <table id="popkaryawan" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">ID</th>
                                <th class="text-center bg-primary text-white">NAMA</th>
                                <th class="text-center bg-primary text-white">ACTION</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ###################################################### -->
<!-- End Modal Ubah -->
<!-- ###################################################### -->

<script>
    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables Cari karyawan 
    ///////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('.btn-cari-karyawan').on("click", function() {
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };
            var popkaryawan = $('#popkaryawan').DataTable({
                "language": {
                    //"url": "template/js/Indonesian.json",
                    "sEmptyTable": "Data Kosong.",
                    "zeroRecords": "Data Tidak Di Temukan.",
                    "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
                },
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?php echo base_url(); ?>master/carikaryawanjson",
                    "type": "POST"
                },
                "deferRender": true,
                "aLengthMenu": [
                    [10, 25, 50],
                    [10, 25, 50]
                ], // Combobox Limit
                "columns": [{
                        "data": null,
                        "class": "text-center"
                    },
                    {
                        "data": "id_karyawan",
                        "class": "text-center"
                    },
                    {
                        "data": "nm_karyawan",
                        "class": "text-center"
                    },

                    {
                        "data": null,
                        "class": "text-center",
                        "render": function(data) {
                            var id = data["id_karyawan"]
                            var nama = data["nm_karyawan"]
                            var html = '<button  class="btn btn-success btn-sm pilih_data_karyawan" data-id="' + id + '" data-nama="' + nama + '" ><i class="fa fa-plus"></i> Pilih</button>'
                            return html
                        }
                    }

                ],
                "order": [
                    [1, 'ASC']
                ],
                "rowCallback": function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);
                }
            });
            // $(document).ready(function() {
            //     $('#popkaryawan').on('init.dt', function() {
            //         $("#popkaryawan").removeClass('table-loader').show();
            //     });
            //     setTimeout(function() {
            //         $('#popkaryawan').DataTable();
            //     }, 3000);

            // });
            $(document).on('click', '.pilih_data_karyawan', function(e) {
                document.getElementById("pop_id_karyawan").value = $(this).attr("data-id");
                document.getElementById("pop_nm_karyawan").value = $(this).attr("data-nama");
                <?php foreach ($data_insentif as $pop) { ?>
                    document.getElementById("pop_edit_id_karyawan_<?php echo $pop->id_insentif; ?>").value = $(this).attr("data-id");
                    document.getElementById("pop_edit_nm_karyawan_<?php echo $pop->id_insentif; ?>").value = $(this).attr("data-nama");
                <?php } ?>
                $('#modalkaryawan').modal('hide');
            });
        });
    });

    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables penggajian
    ///////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var tabledatapenggajian = $('#tabledatapenggajian').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>penggajian/penggajianjson",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [
                [10, 25, 50],
                [10, 25, 50]
            ], // Combobox Limit
            "columns": [{
                    "data": null,
                    "class": "text-center"
                },
                {
                    "data": "log",
                    "class": "text-center",
                    "visible": false
                },
                {
                    "data": "bulan",
                    "class": "text-center"
                },
                {
                    "data": "tgl_penggajian_format",
                    "class": "text-center"
                },
                {
                    "data": "catatan",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        if (status == '0') {
                            var html = '<small class="label bg-yellow"><i class="fa fa-clock-o"></i> Menunggu</small> '
                        } else if (status == '1') {
                            var html = '<small class="label bg-green"><i class="fa fa-check"></i> Selesai</small> '
                        } else {
                            var html = '<small class="label bg-red"><i class="fa fa-times"></i> Error</small> '
                        }
                        return html
                    }
                }, {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        var id = data["id_penggajian"]
                        if (status == '0') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>penggajian/rincian_penggajian/' + id + '" title="Lihat Rincian" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>'

                            <?php if ($this->session->level == 'manager' or $this->session->level == 'administrator') {  ?>
                                html += '<a href="#edit_penggajian_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                                html += '<a href="<?php echo base_url(); ?>penggajian/delpenggajian/' + id + '" title="Hapus Jadwal" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'

                            <?php } ?>
                        } else if (status == '1') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>penggajian/rincian_penggajian/' + id + '" title="Lihat Rincian" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Rincian</a></div>'
                        } else {

                        }
                        return html
                    }
                }

            ],
            "order": [
                [1, 'DESC']
            ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });


    });

    $(document).ready(function() {
        $("#input_total_insentif").mask("#.##0", {
            reverse: true
        });

        $('#input_tgl_penggajian').mask('99/99/9999', {
            placeholder: 'dd/mm/yyyy'
        });

        <?php foreach ($data_penggajian as $mask) { ?>
            $('#edit_tgl_penggajian_<?php echo $mask->id_penggajian; ?>').mask('99/99/9999', {
                placeholder: 'dd/mm/yyyy'
            });
        <?php } ?>

        <?php foreach ($data_insentif as $mask) { ?>
            $('#edit_tgl_terima_<?php echo $mask->id_insentif; ?>').mask('99/99/9999', {
                placeholder: 'dd/mm/yyyy'
            });
        <?php } ?>

        <?php foreach ($data_insentif as $mask) { ?>
            $("#edit_total_insentif_<?php echo $mask->id_insentif; ?>").mask("#.##0", {
                reverse: true
            });
        <?php } ?>

    });



    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables insentif
    ///////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        var tabledatainsentif = $('#tabledatainsentif').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>penggajian/insentifjson",
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [
                [10, 25, 50],
                [10, 25, 50]
            ], // Combobox Limit
            "columns": [{
                    "data": null,
                    "class": "text-center"
                },

                {
                    "data": "nm_karyawan",
                    "class": "text-center"
                },
                {
                    "data": "nm_insentif",
                    "class": "text-center"
                },
                {
                    "data": "tgl_terima_format",
                    "class": "text-center"
                },
                {
                    "data": "bulan",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var total_insentif = data["total_insentif"]
                        var reverse = total_insentif.toString().split('').reverse().join(''),
                            rupiah = reverse.match(/\d{1,3}/g);
                        rupiah = rupiah.join('.').split('').reverse().join('');
                        var html = 'Rp.' + rupiah + ''
                        return html
                    }
                },

                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        if (status == '0') {
                            var html = '<small class="label bg-yellow"><i class="fa fa-clock-o"></i> Menunggu</small> '
                        } else if (status == '1') {
                            var html = '<small class="label bg-green"><i class="fa fa-check"></i> Selesai</small> '
                        } else {
                            var html = '<small class="label bg-red"><i class="fa fa-times"></i> Error</small> '
                        }
                        return html
                    }
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        var id = data["id_insentif"]
                        if (status == '0') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>penggajian/insentif_selesai/' + id + '" title="Selesai" class="btn btn-sm btn-success" onclick="return confirm(\'Selesaikan Insentif ?\')"><i class="fa fa-check"></i> </a>'
                            html += '<a href="#edit_insentif_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                            html += '<a href="<?php echo base_url(); ?>penggajian/delinsentif/' + id + '" title="Hapus Jadwal" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'
                        } else if (status == '1') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>penggajian/cetak_rincian_gaji/' + id + '" title="Cetak Insentif" class="btn btn-sm btn-success" ><i class="fa fa-print"></i> Cetak</a></div>'
                        } else {

                        }
                        return html
                    }
                }

            ],
            "order": [
                [1, 'DESC']
            ],
            "rowCallback": function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
        // $(document).ready(function() {
        //     $('#tabledatainsentif').on('init.dt', function() {
        //         $("#tabledatainsentif").removeClass('table-loader').show();
        //     });
        //     setTimeout(function() {
        //         $('#tabledatainsentif').DataTable();
        //     }, 3000);

        // });
    });
</script>