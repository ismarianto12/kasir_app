<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></li>
        </ol>
    </div>
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></h3>
            <div class="box-tools pull-right">
                <a href="#tambah_pembelian" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        <div class="box-body">
            <table id="tabledatapembelian" class="table table-bordered table-hover dt-responsive table-loader" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white">NO.</th>
                        <th class="text-center bg-primary text-white">LOG</th>
                        <th class="text-center bg-primary text-white">PEMASOK</th>
                        <th class="text-center bg-primary text-white">NO.FAKTUR</th>
                        <th class="text-center bg-primary text-white">TGL.PEMBELIAN</th>
                        <th class="text-center bg-primary text-white">TOTAL HARGA</th>
                        <th class="text-center bg-primary text-white">BIAYA LAINNYA</th>
                        <th class="text-center bg-primary text-white">TOTAL BAYAR</th>
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
    <!-- /.box -->
</section>
<!-- /.content -->

<!-- ###################################################### -->
<!-- Modal Tambah pembelian-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_pembelian" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatapembelian" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH PEMBELIAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'pembelian/addpembelian'; ?>" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input_no_faktur">NO.FAKTUR</label>
                                    <input type="text" autocomplete="off" class="form-control" id="input_no_faktur" name="input_no_faktur" placeholder="No.Faktur" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group" id="date_1">
                                    <label for="input_tgl_fakturbeli">TGL.FAKTUR</label>
                                    <div class="input-group date" data-date-format="dd/mm/yyyy">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" autocomplete="off" class="form-control float-right" id="input_tgl_fakturbeli" name="input_tgl_fakturbeli" type="text" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pop_nm_pemasok">PEMASOK :</label>
                            <div class="input-group input-group">
                                <input type="text" class="form-control" autocomplete="off" id="pop_nm_pemasok" name="pop_nm_pemasok" placeholder="Pemasok" readonly>
                                <input type="hidden" autocomplete="off" class="form-control" id="pop_id_pemasok" name="pop_id_pemasok" placeholder="No.Faktur" required>

                                <span class="input-group-btn">
                                    <a href="#modalpemasok" class="btn btn-primary btn-cari-pemasok" data-toggle="modal" title="Cari Pemasok"><i class="fa fa-search"></i> CARI</a>
                                </span>
                            </div>
                        </div>

                        <div class="form-group" id="date_1">
                            <label for="input_tgl_pembelian">TGL.PEMBELIAN</label>
                            <div class="input-group date" data-date-format="dd/mm/yyyy">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" autocomplete="off" class="form-control float-right" id="input_tgl_pembelian" name="input_tgl_pembelian" type="text" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
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
<!-- Modal Ubah -->
<!-- ###################################################### -->
<?php foreach ($data_pembelian as $edit) { ?>
    <div class="modal fade" id="edit_pembelian_<?php echo $edit->id_pembelian; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahpembelian" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH PEMBELIAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'pembelian/editpembelian'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="edit_id_pembelian" name="edit_id_pembelian" class="form-control" value="<?php echo $edit->id_pembelian; ?>">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="edit_no_faktur">NO.FAKTUR</label>
                                        <input type="text" autocomplete="off" class="form-control" id="edit_no_faktur" name="edit_no_faktur" value="<?php echo $edit->no_fakturbeli; ?>" placeholder="No.Faktur" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" id="date_1">
                                        <label for="edit_tgl_fakturbeli">TGL.FAKTUR</label>
                                        <div class="input-group date" data-date-format="dd/mm/yyyy">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" autocomplete="off" class="form-control float-right" id="edit_tgl_fakturbeli_<?php echo $edit->id_pembelian; ?>" name="edit_tgl_fakturbeli" type="text" value="<?php echo date('d/m/Y', strtotime($edit->tgl_fakturbeli)); ?>" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pop_edit_nm_pemasok">PEMASOK :</label>
                                <div class="input-group input-group">
                                    <input type="text" class="form-control" autocomplete="off" id="pop_edit_nm_pemasok_<?php echo $edit->id_pembelian; ?>" name="pop_edit_nm_pemasok" value="<?php echo $edit->nm_pemasok; ?>" placeholder="Pemasok" readonly>
                                    <input type="hidden" autocomplete="off" class="form-control" id="pop_edit_id_pemasok_<?php echo $edit->id_pembelian; ?>" name="pop_edit_id_pemasok" value="<?php echo $edit->id_pemasok; ?>" placeholder="ID Pemasok" required>

                                    <span class="input-group-btn">
                                        <a href="#modalpemasok" class="btn btn-warning btn-cari-pemasok" data-toggle="modal" title="Cari Pemasok"><i class="fa fa-search"></i> CARI</a>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" id="date_1">
                                <label for="edit_tgl_pembelian">TGL.PEMBELIAN</label>
                                <div class="input-group date" data-date-format="dd/mm/yyyy">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control float-right" id="edit_tgl_pembelian_<?php echo $edit->id_pembelian; ?>" name="edit_tgl_pembelian" type="text" value="<?php echo date('d/m/Y', strtotime($edit->tgl_pembelian)); ?>" placeholder="<?php echo date('d/m/Y'); ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask required>
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
<!-- Cari Pemasok -->
<div class="modal fade" id="modalpemasok" tabindex="-1" role="dialog" aria-labelledby="poplabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:800px">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-bell"></i> DATA PEMASOK</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                    <table id="poppemasok" class="table table-bordered table-hover dt-responsive table-loader" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center bg-primary text-white">NO.</th>
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
<!-- END Cari Pemasok -->
<script>
    $(document).ready(function() {
        $('#input_tgl_fakturbeli').mask('99/99/9999', {
            placeholder: 'dd/mm/yyyy'
        });
        $('#input_tgl_pembelian').mask('99/99/9999', {
            placeholder: 'dd/mm/yyyy'
        });
        <?php foreach ($data_pembelian as $mask) { ?>
            $('#edit_tgl_fakturbeli_<?php echo $mask->id_pembelian; ?>').mask('99/99/9999', {
                placeholder: 'dd/mm/yyyy'
            });
            $('#edit_tgl_pembelian_<?php echo $mask->id_pembelian; ?>').mask('99/99/9999', {
                placeholder: 'dd/mm/yyyy'
            });

        <?php } ?>
    });

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
        var poppemasok = $('#poppemasok').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/pemasokjson",
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
                    "data": "nm_pemasok",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var id = data["id_pemasok"]
                        var nama = data["nm_pemasok"]
                        //var html = '<div class="btn-group">'
                        //html += '<a href="#edit_karyawan_' + id + '" id="' + id + '" class="btn btn-primary btn-sm pilih_data_karyawan" data-toggle="modal" title="Ubah"><i class="fa fa-plus"></i> Tambah</a></div>'
                        var html = '<button  class="btn btn-success btn-sm pilih_data_pemasok" data-id="' + id + '" data-nama="' + nama + '" ><i class="fa fa-plus"></i> Pilih</button>'
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

        $(document).on('click', '.pilih_data_pemasok', function(e) {
            document.getElementById("pop_id_pemasok").value = $(this).attr("data-id");
            document.getElementById("pop_nm_pemasok").value = $(this).attr("data-nama");
            <?php foreach ($data_pembelian as $pop) { ?>
                document.getElementById("pop_edit_id_pemasok_<?php echo $pop->id_pembelian; ?>").value = $(this).attr("data-id");
                document.getElementById("pop_edit_nm_pemasok_<?php echo $pop->id_pembelian; ?>").value = $(this).attr("data-nama");
            <?php } ?>
            $('#modalpemasok').modal('hide');
        });

        $(document).ready(function() {
            $('#poppemasok').on('init.dt', function() {
                $("#poppemasok").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#poppemasok').DataTable();
            }, 3000);

        });


    });


    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables pembelian
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
        var datajadwal = $('#tabledatapembelian').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>pembelian/pembelianjson",
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
                    "data": "nm_pemasok",
                    "class": "text-center"
                },
                {
                    "data": "no_fakturbeli",
                    "class": "text-center"
                },
                {
                    "data": "tgl_fakturbeli_format",
                    "class": "text-center"
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var total_harga = data["total_harga"]
                        var reverse = total_harga.toString().split('').reverse().join(''),
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
                        if (biaya_lainnya = null || status == "0") {
                            var kosong = "0";
                            var reverse = kosong.toString().split('').reverse().join(''),
                                rupiah = reverse.match(/\d{1,3}/g);
                            rupiah = rupiah.join('.').split('').reverse().join('');
                            var html = 'Rp.' + rupiah + ''
                            return html
                        } else {
                            var biaya_lainnya = data["biaya_lainnya"]
                            var reverse = biaya_lainnya.toString().split('').reverse().join(''),
                                rupiah = reverse.match(/\d{1,3}/g);
                            rupiah = rupiah.join('.').split('').reverse().join('');
                            var html = 'Rp.' + rupiah + ''
                            return html
                        }
                    }
                },
                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var total_bayar = data["total_bayar"]
                        var reverse = total_bayar.toString().split('').reverse().join(''),
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
                        var id = data["id_pembelian"]
                        if (status == '0') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>pembelian/rincian/' + id + '" title="Lihat Rincian" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> </a>'
                            html += '<a href="#edit_pembelian_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                            html += '<a href="<?php echo base_url(); ?>delpembelian/' + id + '" title="Hapus Pembelian" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data Pembelian ?\')"><i class="fa fa-trash"></i> </a></div>'
                        } else if (status == '1') {
                            var html = '<div class="btn-group">'
                            html += '<a href="<?php echo base_url(); ?>pembelian/rincian/' + id + '" title="Lihat Rincian" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> Rincian</a></div>'
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
        $(document).ready(function() {
            $('#tabledatapembelian').on('init.dt', function() {
                $("#tabledatapembelian").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#tabledatapembelian').DataTable();
            }, 3000);

        });

    });
</script>