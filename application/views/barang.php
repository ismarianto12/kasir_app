<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon_barang; ?>"></i> <?php echo $title_barang; ?></li>
        </ol>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php foreach ($grafik_barang as $barang) {
                            echo $barang->total_barang;
                        } ?></h3>
                    <p>Total Item Barang</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pricetag"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php foreach ($grafik_barang as $stok) {
                            echo $stok->total_stok;
                        } ?></h3>
                    <p>Total Stok</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php foreach ($grafik_barang as $stok) {
                            echo $stok->total_aktif;
                        } ?></h3>
                    <p>Barang Aktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php foreach ($grafik_barang as $stok) {
                            echo $stok->total_nonaktif;
                        } ?></h3>
                    <p>Barang Non-Aktif</p>
                </div>
                <div class="icon">
                    <i class="fa fa-times"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->


    </div>
    <!-- /.row -->

    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" id="myTab">
            <li class="active"><a href="#tab_barang" data-toggle="tab"><i class="fa <?php echo $faicon_barang; ?>"></i> <?php echo $title_barang; ?></a></li>
            <li><a href="#tab_harga" data-toggle="tab"><i class="fa <?php echo $faicon_harga; ?>"></i> <?php echo $title_harga; ?></a></li>
        </ul>
        <div class="tab-content">
            <!-- ###################################################### -->
            <!-- TAB Barang-->
            <!-- ###################################################### -->
            <div class="tab-pane active" id="tab_barang">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_barang; ?>"></i> <?php echo $title_barang; ?></h3>
                    <div class="box-tools pull-right">
                        <a href="#tambah_barang" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>

                <div class="box-body">
                    <table id="tabledatabarang" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">LOG</th>
                                <th class="text-center bg-primary text-white">KODE BARANG</th>
                                <th class="text-center bg-primary text-white">Barcode</th>
                                <th class="text-center bg-primary text-white">GAMBAR</th>
                                <th class="text-center bg-primary text-white">NAMA BARANG</th>
                                <th class="text-center bg-primary text-white">STOK</th>
                                <th class="text-center bg-primary text-white">HARGA BELI</th>
                                <th class="text-center bg-primary text-white">HARGA JUAL</th>
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
            <!-- ###################################################### -->
            <!-- TAB Referensi-->
            <!-- ###################################################### -->
            <div class="tab-pane" id="tab_harga">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa <?php echo $faicon_harga; ?>"></i> <?php echo $title_harga; ?></h3>
                </div> 
                <div class="box-body">
                    <table id="tabledatahargabarang" class="table table-bordered table-hover dt-responsive" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">LOG</th>
                                <th class="text-center bg-primary text-white">KODE BARANG</th>
                                <th class="text-center bg-primary text-white">NAMA BARANG</th>
                                <th class="text-center bg-primary text-white">STOK</th>
                                <th class="text-center bg-primary text-white">HARGA BELI LAMA</th>
                                <th class="text-center bg-primary text-white">HARGA BELI BARU</th>
                                <th class="text-center bg-primary text-white">HARGA JUAL LAMA</th>
                                <th class="text-center bg-primary text-white">HARGA JUAL BARU</th>
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
    </div>

    <!-- /.box -->
</section>
<!-- /.content -->

<!-- ###################################################### -->
<!-- Modal Tambah barang-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_barang" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatabarang" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH BARANG</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/addbarang'; ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_nm_barang">Nama Barang</label>
                            <input type="text" autocomplete="off" class="form-control" id="input_nm_barang" name="input_nm_barang" placeholder="Nama barang" required>
                        </div>

                        <div class="form-group">
                            <label for="pilih_jenis">Jenis</label>
                            <select class="form-control col-sm-9" name="pilih_jenis" id="pilih_jenis" required>
                                <option value="" disabled selected>- Pilih - </option>
                                <?php foreach ($ref_jenis as $ref_jenis) { ?>
                                    <option value="<?php echo $ref_jenis->kode_ref; ?>"><?php echo $ref_jenis->keterangan_ref; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-3">
                                    <label for="pilih_model">Model</label>
                                    <select class="form-control col-sm-9" name="pilih_model" id="pilih_model" required>
                                        <option value="" disabled selected>- Pilih Jenis- </option>

                                    </select>
                                </div>

                                <div class="col-xs-3">
                                    <label for="pilih_warna">Warna</label>
                                    <select class="form-control col-sm-9" name="pilih_warna" id="pilih_warna" required>
                                        <option value="" disabled selected>- Pilih - </option>
                                        <?php foreach ($ref_warna as $ref_warna) { ?>
                                            <option value="<?php echo $ref_warna->kode_ref; ?>"><?php echo $ref_warna->keterangan_ref; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="col-xs-3">
                                    <label for="pilih_ukuran">Ukuruan</label>
                                    <select class="form-control col-sm-9" name="pilih_ukuran" id="pilih_ukuran" required>
                                        <option value="" disabled selected>- Pilih Jenis- </option>

                                    </select>
                                </div>

                                <div class="col-xs-3">
                                    <label for="pilih_optional">Optional</label>
                                    <select class="form-control col-sm-9" name="pilih_optional" id="pilih_optional" required>
                                        <option value="" disabled selected>- Pilih - </option>
                                        <?php foreach ($ref_optional as $ref_optional) { ?>
                                            <option value="<?php echo $ref_optional->kode_ref; ?>"><?php echo $ref_optional->keterangan_ref; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="input_gambar">GAMBAR</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-photo"></i>
                                </div>
                                <input type="file" class="form-control" id="input_gambar" name="input_gambar" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input_catatan">Catatan</label>
                            <textarea class="form-control" name="catatan" cols="15" rows="15"></textarea>
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
<?php foreach ($data_barang as $edit) { ?>
    <div class="modal fade" id="edit_barang_<?php echo $edit->kode_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahbarang" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH BARANG</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/editbarang'; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="edit_kode_barang">Kode Barang</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_kode_barang" name="edit_kode_barang" value="<?php echo $edit->kode_barang; ?>" placeholder="Nama barang" readonly>
                            </div>

                            <div class="form-group">
                                <label for="edit_nm_barang">Nama Barang</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_nm_barang" name="edit_nm_barang" value="<?php echo $edit->nm_barang; ?>" placeholder="Nama barang" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_pilih_jenis">Jenis</label>
                                <select class="form-control col-sm-9" name="pilih_jenis" id="pilih_jenis" disabled>
                                    <option value="" disabled selected>- Pilih - </option>
                                    <?php foreach ($edit_ref_jenis as $edit_jenis) { ?>
                                        <option value="<?php echo $edit_jenis->kode_ref; ?>" <?php if ($edit->jenis == $edit_jenis->kode_ref) {
                                                                                                    echo "selected disabled";
                                                                                                } ?>><?php echo $edit_jenis->keterangan_ref; ?></option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-3">
                                        <label for="pilih_model">Model</label>
                                        <select class="form-control col-sm-9 disabled" name="pilih_model" id="pilih_model" disabled>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <?php foreach ($edit_ref_model as $edit_model) { ?>
                                                <option value="<?php echo $edit_model->kode_ref; ?>" <?php if ($edit->model == $edit_model->kode_ref) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $edit_model->keterangan_ref; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-3">
                                        <label for="pilih_warna">Warna</label>
                                        <select class="form-control col-sm-9" name="pilih_warna" id="pilih_warna" disabled>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <?php foreach ($edit_ref_warna as $edit_warna) { ?>
                                                <option value="<?php echo $edit_warna->kode_ref; ?>" <?php if ($edit->warna == $edit_warna->kode_ref) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $edit_warna->keterangan_ref; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-3">
                                        <label for="pilih_ukuran">Ukuruan</label>
                                        <select class="form-control col-sm-9" name="pilih_warna" id="pilih_warna" disabled>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <?php foreach ($edit_ref_ukuran as $edit_ukuran) { ?>
                                                <option value="<?php echo $edit_ukuran->kode_ref; ?>" <?php if ($edit->ukuran == $edit_ukuran->kode_ref) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $edit_ukuran->keterangan_ref; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="col-xs-3">
                                        <label for="pilih_optional">Optional</label>
                                        <select class="form-control col-sm-9" name="pilih_optional" id="pilih_optional" disabled>
                                            <option value="" disabled selected>- Pilih - </option>
                                            <?php foreach ($edit_ref_optional as $edit_optional) { ?>
                                                <option value="<?php echo $edit_optional->kode_ref; ?>" <?php if ($edit->tambahan == $edit_optional->kode_ref) {
                                                                                                            echo "selected";
                                                                                                        } ?>><?php echo $edit_optional->keterangan_ref; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_gambar">GAMBAR</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-photo"></i>
                                    </div>
                                    <input type="file" class="form-control" id="edit_gambar" name="edit_gambar">
                                    <input type="hidden" name="edit_gambar_before" value="<?php echo $edit->gambar; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="input_catatan">Catatan</label>
                                <textarea class="form-control" name="catatan" cols="8" rows="15"><?php echo $edit->catatan; ?></textarea>
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
<!-- End Modal Ubah -->
<!-- ###################################################### -->
<!-- ###################################################### -->
<!-- Modal Ubah -->
<!-- ###################################################### -->
<?php foreach ($data_barang as $edit) { ?>
    <div class="modal fade" id="edit_harga_barang_<?php echo $edit->kode_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahbarang" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH DETAIL BARANG</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/edithargabarang'; ?>" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="edit_kode_barang_harga">Kode Barang</label>
                                        <input type="text" autocomplete="off" class="form-control" id="edit_kode_barang_harga" name="edit_kode_barang_harga" value="<?php echo $edit->kode_barang; ?>" placeholder="Kode barang" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="edit_nm_barang">Nama Barang</label>
                                        <input type="text" autocomplete="off" class="form-control" id="edit_nm_barang" name="edit_nm_barang" value="<?php echo $edit->nm_barang; ?>" placeholder="Nama barang" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="edit_harga_beli_lama">Harga Beli Lama:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Rp.
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control" id="edit_harga_beli_lama_<?php echo $edit->kode_barang; ?>" name="edit_harga_beli_lama" value="<?php echo $edit->harga_beli_lama; ?>" placeholder="Harga Beli Lama..." required>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <label for="edit_harga_beli_baru">Harga Beli Baru:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Rp.
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control" id="edit_harga_beli_baru_<?php echo $edit->kode_barang; ?>" name="edit_harga_beli_baru" value="<?php echo $edit->harga_beli_baru; ?>" placeholder="Harga Beli Baru..." required>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label for="edit_harga_jual_lama">Harga Jual Lama:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Rp.
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control" id="edit_harga_jual_lama_<?php echo $edit->kode_barang; ?>" name="edit_harga_jual_lama" value="<?php echo $edit->harga_jual_lama; ?>" placeholder="Harga Jual Lama..." required>
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                        <label for="edit_harga_jual_baru">Harga Jual Baru:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                Rp.
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control" id="edit_harga_jual_baru_<?php echo $edit->kode_barang; ?>" name="edit_harga_jual_baru" value="<?php echo $edit->harga_jual_baru; ?>" placeholder="Harga Jual Baru..." required>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="edit_stok">Stok Barang</label>
                                        <input type="number" autocomplete="off" class="form-control" id="edit_stok" name="edit_stok" value="<?php echo $edit->stock; ?>" placeholder="Stok barang" required>
                                    </div>
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
<!-- End Modal Ubah -->
<!-- ###################################################### -->

<!-- ###################################################### -->
<!-- End Modal Lihat Photo -->
<!-- ###################################################### -->
<?php foreach ($data_barang as $gambar) { ?>
    <div class="modal fade" id="gambar_<?php echo $gambar->kode_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-photo"></i> GAMBAR</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body text-center">
                        <div class="form-group row">
                            <img src="<?php echo base_url(); ?>gambar/<?php $tampil_gambar = $gambar->gambar;
                                                                        if ($tampil_gambar == '' or $tampil_gambar == null) {
                                                                            echo "photo.jpg";
                                                                        } else {
                                                                            echo $tampil_gambar;
                                                                        } ?>" class="rounded mx-auto d-block" width="50%" alt="<?php echo $gambar->nm_barang; ?>">
                        </div>
                        <div class="form-group row justify-content-center">
                            <h6><i class="fa fa-photo"></i> <?php echo $gambar->nm_barang; ?> </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(function() {
        <?php foreach ($data_barang as $mask) { ?>
            $("#edit_harga_beli_lama_<?php echo $mask->kode_barang; ?>").mask("#.##0", {
                reverse: true
            });
            $("#edit_harga_beli_baru_<?php echo $mask->kode_barang; ?>").mask("#.##0", {
                reverse: true
            });
            $("#edit_harga_jual_lama_<?php echo $mask->kode_barang; ?>").mask("#.##0", {
                reverse: true
            });
            $("#edit_harga_jual_baru_<?php echo $mask->kode_barang; ?>").mask("#.##0", {
                reverse: true
            });
        <?php } ?>
    });


    $("#pilih_jenis").change(function() {
        // variabel dari nilai combo box kendaraan
        var kode_ref = $("#pilih_jenis").val();

        // Menggunakan ajax untuk mengirim dan dan menerima data dari server
        $.ajax({
            url: "<?php echo base_url(); ?>/master/get_koderef_jenis",
            method: "POST",
            data: {
                kode_ref: kode_ref
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;

                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].kode_ref + '>' + data[i].keterangan_ref + '</option>';
                }
                $('#pilih_ukuran').html(html);
                //alert(html);

            }
        });

        $.ajax({
            url: "<?php echo base_url(); ?>/master/get_koderef_model",
            method: "POST",
            data: {
                kode_ref: kode_ref
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '';
                var i;

                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].kode_ref + '>' + data[i].keterangan_ref + '</option>';
                }
                $('#pilih_model').html(html);
                //alert(html);

            }
        });

    });


    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables barang
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

        var tabledatabarang = $('#tabledatabarang').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/barangjson",
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
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        var kode = data["kode_barang"]
                        var html = '<img src="<?php echo base_url('assets'); ?>/barcode/' + kode + '.jpg" alt="' + kode + '" width="200" height="60"></a>';
                        return html
                    }
                },
                {
                    "data": "kode_barang",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        var kode = data["kode_barang"]
                        var gambar = data["gambar"]
                        var nama = data["nm_barang"]
                        if (gambar == '' || gambar == null) {
                            var html = '<a href="#gambar_' + kode + '" data-toggle="modal" title="' + nama + '"><img src="<?php echo base_url(); ?>gambar/photo.jpg" class="img-circle" alt="' + nama + '" width="60" height="60" onerror="this.src=<?php echo base_url(); ?>gambar/photo.jpg"></a>';
                        } else {
                            var html = '<a href="#gambar_' + kode + '" data-toggle="modal" title="' + nama + '"><img src="http://gaiabiai.my.id/gambar/' + gambar + '" class="img-circle" alt="' + nama + '" width="60" height="60" onerror="this.src=<?php echo base_url(); ?>gambar/photo.jpg"></a>';
                        }
                        return html
                    }
                },
                {
                    "data": "nm_barang",
                    "class": "text-center"
                },
                {
                    "data": "stock",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var harga = data["harga_beli_baru"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var harga = data["harga_jual_baru"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var html = '';
                        var status = data["status"]
                        var kode = data["kode_barang"]
                        if (status == "0") {
                            html += '<a href="<?php base_url(); ?>status_barang/' + kode + '" title="Aktifkan Status Barang" class="btn btn-success btn-sm" onclick="return confirm(\'Aktifkan Status Barang ?\')"><i class="fa fa-check"></i> </a>'
                            var statuskunci = ''
                        } else if (status == "1") {
                            html += '<a href="<?php base_url(); ?>status_barang/' + kode + '" title="Non-aktifkan Status Barang" class="btn btn-danger btn-sm" onclick="return confirm(\'Non-aktifkan Status Barang ?\')"><i class="fa fa-times"></i> </a>'
                            var statuskunci = 'disabled'
                        } else {
                            html += ''
                        }
                        html += '<a href="#edit_barang_' + kode + '" class="btn bg-purple btn-flat margin btn-sm ' + statuskunci + '" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i></a></li>'
                        html += '<a href="<?php echo base_url(); ?>master/delbarang/' + kode + '" title="Hapus Barang" class="btn bg-blue btn-flat margin ' + statuskunci + '" onclick="return confirm(\'Anda Yakin Menghapus Barang ?\')"><i class="fa fa-trash"></i></a></li>'
                        html += '<a href="<?php echo base_url(); ?>master/arsipbarang/' + kode + '" title="Arsip Barang" class="btn bg-orange btn-flat margin ' + statuskunci + '" onclick="return confirm(\'Anda Yakin Arsip Barang ?\')"><i class="fa fa-archive"></i></a></li>'
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

        $(document).ready(function() {
            $('#tabledatabarang').on('init.dt', function() {
                $("#tabledatabarang").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#tabledatabarang').DataTable();
            }, 3000);

        });

    });

    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables barang
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

        var tabledatahargabarang = $('#tabledatahargabarang').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/hargabarangjson",
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
                    "data": "kode_barang",
                    "class": "text-center"
                },
                {
                    "data": "nm_barang",
                    "class": "text-center"
                },
                {
                    "data": "stock",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var harga = data["harga_beli_lama"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var harga = data["harga_beli_baru"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var harga = data["harga_jual_lama"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var harga = data["harga_jual_baru"]
                        var reverse = harga.toString().split('').reverse().join(''),
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
                        var kode = data["kode_barang"]
                        var html = '<div class="btn-group"><a href="#edit_harga_barang_' + kode + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> Ubah</a></div>'
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
            $('#tabledatahargabarang').on('init.dt', function() {
                $("#tabledatahargabarang").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#tabledatahargabarang').DataTable();
            }, 3000);

        });

    });
</script>