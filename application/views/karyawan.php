<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon_karyawan; ?>"></i> <?php echo $title_karyawan; ?></li>
        </ol>
    </div>

    <!-- Info boxes -->
    <div class="row">
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
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="ion ion-ios-bookmarks-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">JABATAN</span>
                    <span class="info-box-number"><?php foreach ($grafik_jabatan as $total_jabatan) {
                                                        echo $total_jabatan->total_jabatan;
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


    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab_karyawan" data-toggle="tab"><i class="fa <?php echo $faicon_karyawan; ?>"></i> <?php echo $title_karyawan; ?></a></li>
            <li><a href="#tab_jabatan" data-toggle="tab"><i class="fa <?php echo $faicon_jabatan; ?>"></i> <?php echo $title_jabatan; ?></a></li>
            <li><a href="#tab_gaji" data-toggle="tab"><i class="fa <?php echo $faicon_gaji; ?>"></i> <?php echo $title_gaji; ?></a></li>

        </ul>
        <div class="tab-content">
            <!-- ###################################################### -->
            <!-- Tab karyawan-->
            <!-- ###################################################### -->
            <div class="tab-pane active" id="tab_karyawan">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_karyawan; ?>"></i> <?php echo $title_karyawan; ?></h3>
                    <div class="box-tools pull-right">
                        <a href="#tambah_karyawan" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tabledatakaryawan" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">ID</th>
                                <th class="text-center bg-primary text-white">PHOTO</th>
                                <th class="text-center bg-primary text-white">NAMA</th>
                                <th class="text-center bg-primary text-white">JABATAN</th>
                                <th class="text-center bg-primary text-white">TEMPAT/TGL.LAHIR</th>
                                <th class="text-center bg-primary text-white">ALAMAT</th>
                                <th class="text-center bg-primary text-white">NO.TLPN</th>
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
            </div>
            <!-- /.tab-pane -->
            <!-- ###################################################### -->
            <!-- Tab Jabatan-->
            <!-- ###################################################### -->
            <div class="tab-pane" id="tab_jabatan">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_jabatan; ?>"></i> <?php echo $title_jabatan; ?></h3>
                    <div class="box-tools pull-right">
                        <a href="#tambah_jabatan" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tabledatajabatan" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">NAMA JABATAN</th>
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
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_gaji">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_gaji; ?>"></i> <?php echo $title_gaji; ?></h3>
                    <div class="box-tools pull-right">
                        <a href="#tambah_gaji" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tabledatagaji" class="table table-bordered table-hover dt-responsive " style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">NAMA KARYAWAN</th>
                                <th class="text-center bg-primary text-white">GAJI POKOK</th>
                                <th class="text-center bg-primary text-white">TUNJANGAN</th>
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
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->

</section>
<!-- /.content -->

<!-- ###################################################### -->
<!-- Modal Tambah karyawan-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_karyawan" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatakaryawan" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH KARYAWAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/addkaryawan'; ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_id_karyawan">ID</label>
                            <input type="text" autocomplete="off" class="form-control" id="input_id_karyawan" name="input_id_karyawan" value="<?php echo $idk; ?>" placeholder="Nama Karyawan" readonly>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_nm_karyawan">NAMA</label>
                                    <input type="text" autocomplete="off" class="form-control" id="input_nm_karyawan" name="input_nm_karyawan" placeholder="Nama Karyawan" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_jabatan">JABATAN</label>
                                    <select class="form-control col-sm-9" name="input_jabatan" id="input_jabatan" required>
                                        <option value="" disabled selected>- Pilih - </option>
                                        <?php foreach ($data_jabatan as $jabatan) { ?>
                                            <option value="<?php echo $jabatan->id_jabatan; ?>"><?php echo $jabatan->nm_jabatan; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_tmpt_lahir">TEMPAT LAHIR :</label>
                                    <input type="text" autocomplete="off" class="form-control" id="input_tmpt_lahir" name="input_tmpt_lahir" placeholder="Tempat Lahir" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group" id="date_1">
                                    <label for="input_tgl_lahir">TGL.LAHIR</label>
                                    <div class="input-group date" data-date-format="dd/mm/yyyy">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" autocomplete="off" class="form-control float-right" id="input_tgl_lahir" name="input_tgl_lahir" type="text" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>ALAMAT :</label>
                            <textarea class="form-control" id="input_alamat" name="input_alamat" rows="5" placeholder="Alamat ..." required></textarea>
                        </div>

                         <div class="form-group">
                            <label for="input_no_tlpn">NO.TELEPON</label>
                            <input type="number" autocomplete="off" class="form-control" id="input_no_tlpn" name="input_no_tlpn" placeholder="No. Telepon" required>
                        </div>

                        <div class="form-group">
                            <label for="input_photo">PHOTO</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-photo"></i>
                                </div>
                                <input type="file" class="form-control" id="input_photo" name="input_photo" required>
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
<!-- End Modal Tambah karyawan-->
<!-- ###################################################### -->

<!-- ###################################################### -->
<!-- Modal Tambah jabatan-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_jabatan" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatajabatan" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH JABATAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/addjabatan'; ?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_nm_jabatan">NAMA JABATAN:</label>
                            <input type="text" autocomplete="off" class="form-control" id="input_nm_jabatan" name="input_nm_jabatan" placeholder="Nama Jabatan" required>
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
<!-- End Modal Tambah jabatan-->
<!-- ###################################################### -->


<!-- ###################################################### -->
<!-- Modal Ubah Karyawan-->
<!-- ###################################################### -->
<?php foreach ($data_karyawan as $edit) { ?>
    <div class="modal fade" id="edit_karyawan_<?php echo $edit->id_karyawan; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahkaryawan" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH KARYAWAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/editkaryawan'; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="edit_id_karyawan">ID :</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_id_karyawan" name="edit_id_karyawan" placeholder="ID Karyawan" value="<?php echo $edit->id_karyawan; ?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_nm_karyawan">NAMA</label>
                                        <input type="text" autocomplete="off" class="form-control" id="edit_nm_karyawan" name="edit_nm_karyawan" placeholder="Nama Karyawan" value="<?php echo $edit->nm_karyawan; ?>" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_jabatan">JABATAN</label>
                                        <select class="form-control col-sm-9" name="input_jabatan" id="input_jabatan" required>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <?php foreach ($data_jabatan as $jabatan) { ?>
                                                <?php if ($jabatan->id_jabatan == $edit->id_jabatan) { ?>
                                                    <option value="<?php echo $jabatan->id_jabatan; ?>" selected><?php echo $jabatan->nm_jabatan; ?></option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $jabatan->id_jabatan; ?>"><?php echo $jabatan->nm_jabatan; ?></option>
                                                <?php } ?>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label for="edit_tmpt_lahir">TEMPAT LAHIR :</label>
                                        <input type="text" autocomplete="off" class="form-control" id="edit_tmpt_lahir" name="edit_tmpt_lahir" placeholder="Tempat Lahir" value="<?php echo $edit->tmpt_lahir; ?>" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group" id="date_1">
                                        <label for="input_tgl_lahir">TGL.LAHIR</label>
                                        <div class="input-group date" data-date-format="dd/mm/yyyy">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control float-right" id="edit_tgl_lahir_<?php echo $edit->id_karyawan; ?>" name="edit_tgl_lahir" type="text" placeholder="<?php echo date('d/m/Y'); ?>" value="<?php echo date('d/m/Y', strtotime($edit->tgl_lahir)); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>ALAMAT :</label>
                                <textarea class="form-control" id="edit_alamat" name="edit_alamat" rows="5" placeholder="Alamat ..." required><?php echo $edit->alamat; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="input_no_tlpn">NO.TELEPON :</label>
                                <input type="number" autocomplete="off" class="form-control" id="edit_no_tlpn" name="edit_no_tlpn" placeholder="No. Telepon" value="<?php echo $edit->no_tlpn; ?>" required>
                            </div>



                            <div class="form-group">
                                <label for="edit_photo">PHOTO</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-photo"></i>
                                    </div>
                                    <input type="file" class="form-control" id="edit_photo" name="edit_photo">
                                    <input type="hidden" name="edit_photo_before" value="<?php echo $edit->photo; ?>">
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
<!-- End Modal Ubah Karyawan -->
<!-- ###################################################### -->

<!-- ###################################################### -->
<!-- Modal Ubah Jabatan -->
<!-- ###################################################### -->
<?php foreach ($data_jabatan as $edit) { ?>
    <div class="modal fade" id="edit_jabatan_<?php echo $edit->id_jabatan; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahjabatan" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH JABATAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/editjabatan'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" autocomplete="off" class="form-control" id="edit_id_jabatan" name="edit_id_jabatan" placeholder="ID Karyawan" value="<?php echo $edit->id_jabatan; ?>" readonly>

                            <div class="form-group">
                                <label for="edit_nm_jabatan">NAMA JABATAN:</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_nm_jabatan" name="edit_nm_jabatan" placeholder="Nama Jabatan" value="<?php echo $edit->nm_jabatan; ?>" required>
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
<!-- End Modal Lihat Photo -->
<!-- ###################################################### -->
<?php foreach ($data_karyawan as $photo) { ?>
    <div class="modal fade" id="photo_<?php echo $photo->id_karyawan; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-photo"></i> PHOTO</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body text-center">
                        <div class="form-group row">
                            <img src="<?php echo base_url(); ?>photo/<?php $tampil_photo = $photo->photo;
                                                                        if ($tampil_photo == '' or $tampil_photo == null) {
                                                                            echo "photo.jpg";
                                                                        } else {
                                                                            echo $tampil_photo;
                                                                        } ?>" class="rounded mx-auto d-block" width="50%" alt="<?php echo $photo->nm_karyawan; ?>">
                        </div>
                        <div class="form-group row justify-content-center">
                            <h6><i class="fa fa-photo"></i> <?php echo $photo->nm_karyawan; ?> </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- ###################################################### -->
<!-- Modal Tambah Gaji-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_gaji" tabindex="-1" role="dialog" aria-labelledby="ModalAddDataGaji" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> DATA GAJI</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/addgaji'; ?>" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group input-group-sm">
                                    <label for="pop_id_karyawan">ID :</label>
                                    <input type="text" autocomplete="off" class="form-control" id="pop_id_karyawan" name="pop_id_karyawan" placeholder="ID Karyawan" readonly>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pop_nm_karyawan">NAMA KARYAWAN :</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="pop_nm_karyawan" name="pop_nm_karyawan" readonly>
                                        <span class="input-group-btn">
                                            <a href="#modalkaryawan" class="btn btn-primary btn-sm btn-cari-karyawan" data-toggle="modal" title="Cari Karyawan"><i class="fa fa-search"></i> CARI</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_gaji_pokok">GAJI POKOK :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Rp.
                                </div>
                                <input type="text" autocomplete="off" class="form-control" id="input_gaji_pokok" name="input_gaji_pokok" placeholder="Gaji Pokok..." required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_tunjangan">TUNJANGAN :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Rp.
                                </div>
                                <input type="text" autocomplete="off" class="form-control" id="input_tunjangan" name="input_tunjangan" placeholder="Tunjangan..." required>
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
<!-- Modal Ubah Gaji -->
<!-- ###################################################### -->
<?php foreach ($data_gaji as $edit) { ?>
    <div class="modal fade" id="edit_gaji_<?php echo $edit->id_gaji; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahgaji" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH GAJI</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/editgaji'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" autocomplete="off" class="form-control" id="edit_id_gaji" name="edit_id_gaji" placeholder="ID Karyawan" value="<?php echo $edit->id_gaji; ?>" readonly>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group input-group-sm">
                                        <label for="pop_edit_id_karyawan">ID :</label>
                                        <input type="text" autocomplete="off" class="form-control" id="pop_edit_id_karyawan_<?php echo $edit->id_gaji; ?>" name="pop_edit_id_karyawan" value="<?php echo $edit->id_karyawan; ?>" placeholder="ID Karyawan" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pop_edit_nm_karyawan">NAMA KARYAWAN :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control" id="pop_edit_nm_karyawan_<?php echo $edit->id_gaji; ?>" name="pop_edit_nm_karyawan" value="<?php echo $edit->nm_karyawan; ?>" readonly>
                                            <span class="input-group-btn">
                                                <a href="#modalkaryawan" class="btn btn-primary btn-sm" data-toggle="modal" title="Cari Karyawan"><i class="fa fa-search"></i> CARI</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input_gaji_pokok">GAJI POKOK :</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_gaji_pokok_<?php echo $edit->id_gaji; ?>" name="edit_gaji_pokok" value="<?php echo $edit->gaji_pokok; ?>" placeholder="Gaji Pokok" required>
                            </div>

                            <div class="form-group">
                                <label for="input_tunjangan">TUNJANGAN :</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_tunjangan_<?php echo $edit->id_gaji; ?>" name="edit_tunjangan" value="<?php echo $edit->tunjangan; ?>" placeholder="Tunjangan" required>
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

<script>
    $(document).ready(function() {
        $('#input_tgl_lahir').mask('99/99/9999', {
            placeholder: 'dd/mm/yyyy'
        });
    });

    $(function() {
        $("#input_gaji_pokok").mask("#.##0", {
            reverse: true
        });
        $("#input_tunjangan").mask("#.##0", {
            reverse: true
        });
        <?php foreach ($data_gaji as $mask) { ?>
            $("#edit_gaji_pokok_<?php echo $mask->id_gaji; ?>").mask("#.##0", {
                reverse: true
            });

            $("#edit_tunjangan_<?php echo $mask->id_gaji; ?>").mask("#.##0", {
                reverse: true
            });
        <?php } ?>
    });

    $(document).ready(function() {
        <?php foreach ($data_karyawan as $mask) { ?>
            $('#edit_tgl_lahir_<?php echo $mask->id_karyawan; ?>').mask('99/99/9999', {
                placeholder: 'dd/mm/yyyy'
            });
        <?php } ?>
    });
</script>

<script>
    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables Cari karyawan 
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
                [5, 10, 15],
                [5, 10, 15]
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
                        //var html = '<div class="btn-group">'
                        //html += '<a href="#edit_karyawan_' + id + '" id="' + id + '" class="btn btn-primary btn-sm pilih_data_karyawan" data-toggle="modal" title="Ubah"><i class="fa fa-plus"></i> Tambah</a></div>'
                        var html = '<button  class="btn btn-success btn-sm pilih_data_karyawan" data-id="' + id + '" data-nama="' + nama + '" ><i class="fa fa-plus"></i> Pilih</button>'
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
        $(document).ready(function() {
            $('#popkaryawan').on('init.dt', function() {
                $("#popkaryawan").removeClass('').show();
            });
            setTimeout(function() {
                $('#popkaryawan').DataTable();
            }, 3000);

        });
        $(document).on('click', '.pilih_data_karyawan', function(e) {
            document.getElementById("pop_id_karyawan").value = $(this).attr("data-id");
            document.getElementById("pop_nm_karyawan").value = $(this).attr("data-nama");
            <?php foreach ($data_gaji as $pop) { ?>
                document.getElementById("pop_edit_id_karyawan_<?php echo $pop->id_gaji; ?>").value = $(this).attr("data-id");
                document.getElementById("pop_edit_nm_karyawan_<?php echo $pop->id_gaji; ?>").value = $(this).attr("data-nama");
            <?php } ?>
            $('#modalkaryawan').modal('hide');
        });
    });

    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables karyawan
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
        var tabledatakaryawan = $('#tabledatakaryawan').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/karyawanjson",
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
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        var id = data["id_karyawan"]
                        var photo = data["photo"]
                        var nama = data["nm_karyawan"]
                        if (photo == '' || photo == null) {
                            var html = '<a href="#photo_' + id + '" data-toggle="modal" title="' + nama + '"><img src="<?php echo base_url(); ?>photo/photo.jpg" class="img-circle" alt="' + nama + '" width="60" height="60"></a>'
                        } else {
                            var html = '<a href="#photo_' + id + '" data-toggle="modal" title="' + nama + '"><img src="<?php echo base_url(); ?>photo/' + photo + '" class="img-circle" alt="' + nama + '" width="60" height="60"></a>'
                        }

                        return html
                    }
                },
                {
                    "data": "nm_karyawan",
                    "class": "text-center"
                },
                {
                    "data": "nm_jabatan",
                    "class": "text-center"
                },

                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return full["tmpt_lahir"] + ", " + full["tgl_lahir"];
                    }
                },

                {
                    "data": "alamat",
                    "class": "text-center"
                },
                {
                    "data": "no_tlpn",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        if (status == '0') {
                            var html = '<small class="label bg-red"> Non-Aktif</small> '
                        } else if (status == '1') {
                            var html = '<small class="label bg-green"> Aktif</small> '
                        } else {
                            //var html = '<i class="fa fa-circle text-primary fa-blink"></i>'
                        }
                        return html
                    }
                },

                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        var id = data["id_karyawan"]
                        var html = '<div class="btn-group">'
                        if (status == "0") {
                            html += '<a href="<?php base_url(); ?>status_karyawan/' + id + '" title="Aktifkan Status Karyawan" class="btn btn-success btn-sm" onclick="return confirm(\'Aktifkan Status Karyawan ?\')"><i class="fa fa-check"></i> </a>'
                            var statuskunci = ''
                        } else if (status == "1") {
                            html += '<a href="<?php base_url(); ?>status_karyawan/' + id + '" title="Non-aktifkan Status Karyawan" class="btn btn-danger btn-sm" onclick="return confirm(\'Non-aktifkan Status Karyawan ?\')"><i class="fa fa-times"></i> </a>'
                            var statuskunci = 'disabled'
                        } else {
                            html += ''
                        }
                        html += '<a class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> AKSI '
                        html += '<span class="caret"></span>'
                        html += '<span class="sr-only">Toggle Dropdown</span>'
                        html += '</a>'
                        html += '<ul class="dropdown-menu" role="menu">'
                        html += '<li><a href="#edit_karyawan_' + id + '" class="btn btn-default btn-sm ' + statuskunci + '" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></li>'
                        html += '<li><a href="<?php echo base_url(); ?>master/delkaryawan/' + id + '" title="Hapus Karyawan" class="btn btn-sm btn-default ' + statuskunci + '" onclick="return confirm(\'Anda Yakin Menghapus Karyawan ?\')"><i class="fa fa-trash"></i> Hapus</a></li>'
                        html += '<li><a href="<?php echo base_url(); ?>master/arsipkaryawan/' + id + '" title="Arsip Karyawan" class="btn btn-sm btn-default ' + statuskunci + '" onclick="return confirm(\'Anda Yakin Arsip Karyawan ?\')"><i class="fa fa-archive"></i> Arsip</a></li>'
                        html += '</ul></div>'

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
        //     $('#tabledatakaryawan').on('init.dt', function() {
        //         $("#tabledatakaryawan").removeClass('').show();
        //     });
        //     setTimeout(function() {
        //         $('#tabledatakaryawan').DataTable();
        //     }, 3000);

        // });

    });

    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables Jabatan
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
        var tabledatajabatan = $('#tabledatajabatan').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/jabatanjson",
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
                    "data": "nm_jabatan",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var id = data["id_jabatan"]
                        var html = '<div class="btn-group">'
                        html += '<a href="#edit_jabatan_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                        html += '<a href="<?php echo base_url(); ?>master/deljabatan/' + id + '" title="Hapus Jadwal" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'
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
        $(document).ready(function() {
            $('#tabledatajabatan').on('init.dt', function() {
                $("#tabledatajabatan").removeClass('').show();
            });
            setTimeout(function() {
                $('#tabledatajabatan').DataTable();
            }, 3000);

        });


    });


    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables Gaji
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
        var tabledatagaji = $('#tabledatagaji').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/gajijson",
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
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var gaji_pokok = data["gaji_pokok"]
                        var reverse = gaji_pokok.toString().split('').reverse().join(''),
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
                        var tunjangan = data["tunjangan"]
                        var reverse = tunjangan.toString().split('').reverse().join(''),
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
                            var html = '<small class="label bg-green"><i class="fa fa-check"></i> Diterima</small> '
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
                        var id = data["id_gaji"]
                        var html = '<div class="btn-group">'
                        if (status == "0") {
                            html += '<a href="<?php base_url(); ?>kuncigaji/' + id + '" title="Komfrimasi Gaji" class="btn btn-success btn-sm" onclick="return confirm(\'Komfrimasi Gaji Kaeyawan ?\')"><i class="fa fa-lock"></i> </a>'
                            var statuskunci = ''
                        } else if (status == "1") {
                            html += '<a href="<?php base_url(); ?>kuncigaji/' + id + '" title="Batal Komfrimasi Gaji" class="btn btn-warning btn-sm" onclick="return confirm(\'Anda Yakin Membatalkan Komfrimasi Gaji ?\')"><i class="fa fa-unlock"></i> </a>'
                            var statuskunci = 'disabled'
                        } else {
                            html += ''
                        }
                        html += '<a href="#edit_gaji_' + id + '" class="btn btn-warning btn-sm ' + statuskunci + '" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                        html += '<a href="<?php echo base_url(); ?>master/delgaji/' + id + '" title="Hapus Gaji" class="btn btn-sm btn-danger ' + statuskunci + '" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'
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
        //     $('#tabledatagaji').on('init.dt', function() {
        //         $("#tabledatagaji").removeClass('').show();
        //     });
        //     setTimeout(function() {
        //         $('#tabledatagaji').DataTable();
        //     }, 3000);

        // });

    });
    //initialize select2()
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>