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
                <a href="#tambah_pelanggan" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>

        <div class="box-body">
            <table id="tabledatapelanggan" class="table table-bordered table-hover dt-responsive table-loader" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white">NO.</th>
                        <th class="text-center bg-primary text-white">LOG</th>
                        <th class="text-center bg-primary text-white">NAMA PELANGGAN</th>
                        <th class="text-center bg-primary text-white">ALAMAT</th>
                        <th class="text-center bg-primary text-white">NO.TLPN</th>
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
<!-- Modal Tambah pelanggan-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_pelanggan" tabindex="-1" role="dialog" aria-labelledby="ModalAddDatapelanggan" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> TAMBAH PELANGGAN</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'master/addpelanggan'; ?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="input_nm_pelanggan">Nama Pelanggan</label>
                            <input type="text" autocomplete="off" class="form-control" id="input_nm_pelanggan" name="input_nm_pelanggan" placeholder="Nama Pelanggan" required>
                        </div>
                        <div class="form-group">
                            <label for="input_no_tlpn">No.Telepon</label>
                            <input type="number" autocomplete="off" class="form-control" id="input_no_tlpn" name="input_no_tlpn" placeholder="No. Telepon" required>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" id="input_alamat" name="input_alamat" rows="5" placeholder="Alamat ..." required></textarea>
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
<?php foreach ($data_pelanggan as $edit) { ?>
    <div class="modal fade" id="edit_pelanggan_<?php echo $edit->id_pelanggan; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahpelanggan" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> UBAH PELANGGAN</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php echo base_url() . 'master/editpelanggan'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="edit_id_pelanggan" name="edit_id_pelanggan" class="form-control" value="<?php echo $edit->id_pelanggan; ?>">
                            <div class="form-group">
                                <label for="input_nm_pelanggan">Nama pelanggan</label>
                                <input type="text" autocomplete="off" class="form-control" id="edit_nm_pelanggan" name="edit_nm_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $edit->nm_pelanggan; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="input_no_tlpn">No.Telepon</label>
                                <input type="number" autocomplete="off" class="form-control" id="edit_no_tlpn" name="edit_no_tlpn" placeholder="No. Telepon" value="<?php echo $edit->no_tlpn; ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" id="edit_alamat" name="edit_alamat" rows="5" placeholder="Alamat ..." required><?php echo $edit->alamat; ?></textarea>
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

<script>
    ///////////////////////////////////////////////////////////////////////////////////
    // Datatables pelanggan
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
        var datajadwal = $('#tabledatapelanggan').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>master/pelangganjson",
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
                    "visible" : false
                },                
                {
                    "data": "nm_pelanggan",
                    "class": "text-center"
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
                        //var stat = data["status"]
                        var id = data["id_pelanggan"]
                        var html = '<div class="btn-group">'
                        html += '<a href="#edit_pelanggan_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a>'
                        html += '<a href="<?php echo base_url(); ?>master/delpelanggan/' + id + '" title="Hapus Jadwal" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'
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
            $('#tabledatapelanggan').on('init.dt', function() {
                $("#tabledatapelanggan").removeClass('table-loader').show();
            });
            setTimeout(function() {
                $('#tabledatapelanggan').DataTable();
            }, 3000);

        });       
    });
</script>