<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></li>
        </ol>
    </div>

    <?php
    foreach ($info_pembelian as $row) {
    ?>
        <div class="box border">
            <div class="box-header with-border">
                <h5 class="box-title"><i class="fa fa-info"></i> Info Pembelian</h5>
            </div>
            <div class="box-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="tanggal"><b>ID : </b></label>
                        <div class="input-group">
                            <div class="input-group-addon">ID</div>
                            <input type="text" class="form-control" id="tanggal" value="<?php echo $row->id_pembelian; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="keterangan"><b>NO.FAKTUR/TGL.PEMBELIAN :</b></label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="keterangan" value="<?php echo $row->no_fakturbeli;
                                                                                            echo " - ";
                                                                                            echo date('d/m/Y', strtotime($row->tgl_fakturbeli)); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="jumlah"><b>STATUS :</b></label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-circle <?php $status = $row->status;
                                                                                    if ($status == "0") {
                                                                                        echo "text-yellow";
                                                                                    } elseif ($status == "1") {
                                                                                        echo "text-green";
                                                                                    } ?> fa-blink"></i></div>
                            <input type="text" class="form-control" id="jumlah" value="<?php $status = $row->status;
                                                                                        if ($status == "0") {
                                                                                            echo "Belum Selesai";
                                                                                        } elseif ($status == "1") {
                                                                                            echo "Selesai";
                                                                                        } ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></h3>
            <div class="box-tools pull-right">

                <?php foreach ($cek_status_pembelian as $cek) {
                    if ($cek->cek == null) { ?>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-warning disabled" href="#" data-target="" data-toggle="modal">
                                <i class="fa fa-fw fa-clock-o"></i> Menunggu
                            </a>
                            <a class="btn btn-sm btn-primary" href="#" data-target="#tpembelian" data-toggle="modal">
                                <i class="fa fa-fw fa-plus"></i> Tambah
                            </a>
                        </div>
                    <?php } elseif ($cek->total_status != $cek->status_selesai && $cek->status == '0') { ?>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-warning disabled" href="#" data-target="" data-toggle="modal">
                                <i class="fa fa-fw fa-clock-o"></i> Menunggu
                            </a>
                            <a class="btn btn-sm btn-primary" href="#" data-target="#tpembelian" data-toggle="modal">
                                <i class="fa fa-fw fa-plus"></i> Tambah
                            </a>
                        </div>
                    <?php } elseif ($cek->total_status == $cek->status_selesai && $cek->status == '1' && $cek->cek != null) { ?>
                        <div class="btn-group">
                            <a class="btn btn-sm btn-success pull-right" href="#" data-target="" data-toggle="modal">
                                <i class="fa fa-fw fa-print"></i> Cetak
                            </a>
                        </div>
                    <?php } else { ?>
                        <div class="btn-group">
                            <a href="<?php echo base_url(); ?>pembelian/rincian_selesai/<?php echo $cek->id_pembelian; ?>" title="Selesai Semua" class="btn btn-success btn-sm" onclick="return confirm('Anda Yakin Selesai Semua ?')"><i class="fa fa-fw fa-check"></i> Selesai</a>
                            <a class="btn btn-sm btn-primary" href="#" data-target="#tpembelian" data-toggle="modal">
                                <i class="fa fa-fw fa-plus"></i> Tambah
                            </a>
                        </div>
                <?php }
                } ?>

            </div>
        </div>

        <div class="box-body">
            <table class="table table-bordered table-hover dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white">NO.</th>
                        <th class="text-center bg-primary text-white">NAMA BARANG</th>
                        <th class="text-center bg-primary text-white">JUMLAH</th>
                        <th class="text-center bg-primary text-white">HARGA SATUAN</th>
                        <th class="text-center bg-primary text-white">SUBTOTAL</th>
                        <th class="text-center bg-primary text-white">STATUS</th>
                        <th class="text-center bg-primary text-white">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_rincian_pembelian as $row) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $row->nm_barang; ?></td>
                            <td class="text-center"><?php echo $row->jumlah; ?></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->harga); ?></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->subtotal); ?></td>
                            <td class="text-center">
                                <?php if ($row->status == '0') { ?>
                                    <small class="label bg-yellow"><i class="fa fa-clock-o"></i> Menunggu</small>
                                <?php } elseif ($row->status == '1') { ?>
                                    <small class="label bg-green"><i class="fa fa-check"></i> Selesai</small>
                                <?php } else { ?>
                                    <small class="label bg-red"><i class="fa fa-times"></i> Error</small>
                                <?php } ?>
                            </td>

                            <td class="text-center">
                                <?php if ($row->status == '0') {
                                    $endis = "";
                                } elseif ($row->status == '1') {
                                    $endis = "disabled";
                                } else {
                                    $endis = "disabled";
                                } ?>
                                <div class="btn-group">
                                    <a href="<?php echo base_url(); ?>pembelian/kunci/<?php echo $row->id_rincian_pembelian; ?>/<?php echo $row->id_pembelian; ?>/<?php echo $row->kode_barang; ?>" title="Selesai" class="btn btn-success btn-sm <?php echo $endis; ?>" onclick="return confirm('Anda Yakin Penambahan Selesai ?')"><i class="fa fa-check"></i> </a>
                                    <a href="#edit_rincian_pembelian_<?php echo $row->id_rincian_pembelian; ?>" class="btn btn-warning btn-sm <?php echo $endis; ?>" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>
                                    <a href="<?php echo base_url(); ?>pembelian/delrpembelian/<?php echo $row->id_rincian_pembelian; ?>/<?php echo $row->id_pembelian; ?>" title="Hapus" class="btn btn-danger btn-sm <?php echo $endis; ?>" onclick="return confirm('Anda Yakin Menghapus Data ?')"><i class="fa fa-trash"></i> </a>
                                </div>


                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
                <?php
                if ($data_rincian_pembelian != null) { ?>
                    <tfoot>
                        <tr>
                            <td class="text-right" colspan="4"><b>TOTAL :</b></td>
                            <td class="text-center"><b><?php $sum = 0;
                                                        foreach ($data_rincian_pembelian as $row) {
                                                            $data = $row->subtotal;
                                                            $sum += $data;
                                                        }
                                                        echo "Rp." . number_format($sum); ?></b></td>
                            <td class="text-center" colspan="3"></td>
                        </tr>
                    </tfoot>
                <?php } else { ?>
                    <tfoot>
                        <tr>
                            <td class="text-center fa-blink text-yellow" colspan="7"><b> ...:: Data Pembelian Masih Kosong ::...</b></td>
                        </tr>
                    </tfoot>
                <?php } ?>
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


    <!--////////////// -->
    <div class="box">
        <div class="box-body">
            <table class="table table-bordered dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white" colspan="3">BIAYA LAINNYA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($biaya_lain as $row) {
                    ?>
                        <tr>
                            <td class="text-right"><b>TOTAL BIAYA :</b></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->biaya_lainnya); ?></td>
                            <td class="text-left">
                                <?php if ($row->status == '0') {
                                    $endis = "";
                                    $msg_buttom = "Tambah";
                                    $icon_buttom = "fa-plus";
                                    $col_buttom = "btn-primary";
                                } elseif ($row->status == '1') {
                                    $endis = "disabled";
                                    $msg_buttom = "Selesai";
                                    $icon_buttom = "fa-check";
                                    $col_buttom = "btn-success";
                                } else {
                                    $endis = "disabled";
                                } ?>
                                <div class="btn-group">
                                    <a href="#biaya_<?php echo $row->id_pembelian; ?>" class="btn <?php echo $col_buttom; ?> btn-sm <?php echo $endis; ?>" data-toggle="modal" title="<?php echo $msg_buttom; ?>"><i class="fa <?php echo $icon_buttom; ?>"></i> <?php echo $msg_buttom; ?></a>
                                </div>


                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- ////////////// -->

    <!-- /.box -->
</section>
<!-- /.content -->
<!-- ###################################################### -->
<!-- Modal Tambah Rincian Pembelian-->
<!-- ###################################################### -->
<div class="modal fade" id="tpembelian" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatapembelian" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH PEMBELIAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'pembelian/addrpembelian'; ?>" method="post">
                    <input type="hidden" id="input_id_pembelian" name="input_id_pembelian" class="form-control" value="<?php foreach ($data_pembelian_id as $row) echo $row->id_pembelian; ?>">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_no_faktur">KODE BARANG</label>
                                    <input type="text" autocomplete="off" class="form-control" id="pop_kode_barang" name="pop_kode_barang" placeholder="Kode Barang" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="pop_nm_barang">BARANG :</label>
                                    <div class="input-group input-group">
                                        <input type="text" class="form-control" autocomplete="off" id="pop_nm_barang" name="pop_nm_barang" placeholder="Nama Barang" readonly>
                                        <span class="input-group-btn">
                                            <a href="#modalbarang" class="btn btn-primary btn-cari-barang" data-toggle="modal" title="Cari Barang"><i class="fa fa-search"></i> CARI</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="input_jumlah">JUMLAH :</label>
                            <input type="number" autocomplete="off" class="form-control" id="input_jumlah" name="input_jumlah" placeholder="Jumlah ..." required>
                        </div>


                        <div class="form-group">
                            <label for="input_harga">HARGA SATUAN :</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    Rp.
                                </div>
                                <input type="text" autocomplete="off" class="form-control" id="input_harga" name="input_harga" placeholder="Harga Satuan ..." required>
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
<!-- End Modal Tambah Rincian-->
<!-- ###################################################### -->
<!-- ###################################################### -->
<!-- Edit Rincian-->
<!-- ###################################################### -->
<?php foreach ($data_rincian_pembelian as $edit) { ?>
    <div class="modal fade" id="edit_rincian_pembelian_<?php echo $edit->id_rincian_pembelian; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahpembelian" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH RINCIAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'pembelian/editrpembelian'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="edit_id_rincian_pembelian" name="edit_id_rincian_pembelian" class="form-control" value="<?php echo $edit->id_rincian_pembelian; ?>">
                            <input type="hidden" id="edit_id_pembelian" name="edit_id_pembelian" class="form-control" value="<?php echo $edit->id_pembelian; ?>">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_no_faktur">KODE BARANG</label>
                                        <input type="text" autocomplete="off" class="form-control" id="pop_edit_kode_barang_<?php echo $edit->id_rincian_pembelian; ?>" name="pop_edit_kode_barang" value="<?php echo $edit->kode_barang; ?>" placeholder="Kode Barang" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pop_nm_barang">BARANG :</label>
                                        <div class="input-group input-group">
                                            <input type="text" class="form-control" autocomplete="off" id="pop_edit_nm_barang_<?php echo $edit->id_rincian_pembelian; ?>" name="pop_edit_nm_barang" value="<?php echo $edit->nm_barang; ?>" placeholder="Nama Barang" readonly>
                                            <span class="input-group-btn">
                                                <a href="#modalbarang" class="btn btn-warning btn-cari-barang" data-toggle="modal" title="Cari Barang"><i class="fa fa-search"></i> CARI</a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="input_jumlah">JUMLAH :</label>
                                <input type="number" autocomplete="off" class="form-control" id="edit_jumlah" name="edit_jumlah" value="<?php echo $edit->jumlah; ?>" placeholder="Jumlah ..." required>
                            </div>


                            <div class="form-group">
                                <label for="input_harga">HARGA SATUAN :</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control" id="edit_harga_<?php echo $edit->id_rincian_pembelian; ?>" name="edit_harga" value="<?php echo $edit->harga; ?>" placeholder="Harga Satuan ..." required>
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

<?php foreach ($biaya_lain as $biaya) { ?>
    <div class="modal fade" id="biaya_<?php echo $biaya->id_pembelian; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahpembelian" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-money"></i> BIAYA LAINNYA</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'pembelian/biayalainnya'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="biaya_id_pembelian" name="biaya_id_pembelian" class="form-control" value="<?php echo $biaya->id_pembelian; ?>">
                            <div class="form-group">
                                <label for="input_harga">BIAYA LAINNYA :</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        Rp.
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control" id="biaya_lainnya_<?php echo $biaya->id_pembelian; ?>" name="biaya_lainnya" value="<?php echo $biaya->biaya_lainnya; ?>" placeholder="Biaya Lainnya" required>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-info">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<!-- Cari barang -->
<div class="modal fade" id="modalbarang" tabindex="-1" role="dialog" aria-labelledby="poplabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:800px">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-bell"></i> DATA barang</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <table id="popbarang" class="table table-bordered table-hover dt-responsive table-loader" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
                                <th class="text-center bg-primary text-white">KODE</th>
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
<!-- END Cari barang -->
<script>
    $(function() {
        $("#input_harga").mask("#.##0", {
            reverse: true
        });

        <?php foreach ($data_rincian_pembelian as $mask) { ?>
            $('#edit_harga_<?php echo $mask->id_rincian_pembelian; ?>').mask('#.##0', {
                reverse: true
            });
        <?php } ?>

        <?php foreach ($biaya_lain as $mask) { ?>
            $('#biaya_lainnya_<?php echo $mask->id_pembelian; ?>').mask('#.##0', {
                reverse: true
            });
        <?php } ?>


    });
    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables Cari Barang 
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
        var popbarang = $('#popbarang').DataTable({
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
                [5, 10, 15],
                [5, 10, 15]
            ], // Combobox Limit
            "columns": [{
                    "data": null,
                    "class": "text-center"
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
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var id = data["kode_barang"]
                        var nama = data["nm_barang"]
                        //var html = '<div class="btn-group">'
                        //html += '<a href="#edit_barang_' + id + '" id="' + id + '" class="btn btn-primary btn-sm pilih_data_barang" data-toggle="modal" title="Ubah"><i class="fa fa-plus"></i> Tambah</a></div>'
                        var html = '<button  class="btn btn-success btn-sm pilih_data_barang" data-id="' + id + '" data-nama="' + nama + '" ><i class="fa fa-plus"></i> Pilih</button>'
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

        $(document).on('click', '.pilih_data_barang', function(e) {
            document.getElementById("pop_kode_barang").value = $(this).attr("data-id");
            document.getElementById("pop_nm_barang").value = $(this).attr("data-nama");
            <?php foreach ($data_rincian_pembelian as $pop) { ?>
                document.getElementById("pop_edit_kode_barang_<?php echo $pop->id_rincian_pembelian; ?>").value = $(this).attr("data-id");
                document.getElementById("pop_edit_nm_barang_<?php echo $pop->id_rincian_pembelian; ?>").value = $(this).attr("data-nama");
            <?php } ?>
            $('#modalbarang').modal('hide');
        });

        $(document).ready(function() {
            $('#popbarang').on('init.dt', function() {
                $("#popbarang").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#popbarang').DataTable();
            }, 3000);
        });
    });
</script>