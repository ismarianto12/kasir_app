<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></li>
        </ol>
    </div>


    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="ion ion-ios-person-outline"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">TOTAL AKUN</span>
                    <span class="info-box-number"><?php foreach ($grafik as $total_akun) {
                                                        echo $total_akun->total_akun;
                                                    } ?> User</span>
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
                    <span class="info-box-text">AKUN NON-AKTIF</span>
                    <span class="info-box-number"><?php foreach ($grafik as $total_akun) {
                                                        echo $total_akun->total_nonaktif;
                                                    } ?> User</span>
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
                    <span class="info-box-text">AKUN AKTIF</span>
                    <span class="info-box-number"><?php foreach ($grafik as $total_akun) {
                                                        echo $total_akun->total_aktif;
                                                    } ?> User</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-archive"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">AKUN ARSIP</span>
                    <span class="info-box-number"><?php foreach ($grafik as $total_akun) {
                                                        echo $total_akun->total_arsip;
                                                    } ?> User</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></h3>
            <div class="box-tools pull-right">
                <a href="#tambah_akun" class="btn btn-primary btn-circle btn-sm" data-toggle="modal" title="Tambah"><i class="fa fa-plus"></i> Tambah</a>
            </div>
        </div>
        <div class="box-body">
            <small>Sebelum Menambahkan hak akses silahkan tambahkan data karyawan terlebih dahulu .</small>
            <table id="tabledataakun" class="table table-bordered table-hover dt-responsive " style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white">NO.</th>
                        <th class="text-center bg-primary text-white">ID KARYAWAN</th>
                        <th class="text-center bg-primary text-white">USERNAME</th>
                        <th class="text-center bg-primary text-white">NAMA</th>
                        <th class="text-center bg-primary text-white">LEVEL</th>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">

                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- ###################################################### -->
<!-- Modal Tambah Akun-->
<!-- ###################################################### -->
<div class="modal fade" id="tambah_akun" tabindex="-1" role="dialog" aria-labelledby="ModalAddDataakun" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-fw fa-plus"></i> Tambah Akun</h4>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" id="act_simpan" action="<?php echo base_url() . 'akun/addakun'; ?>" method="post">
                    <div class="box-body">
                        <b>* ) penting </b> : Untuk menambahkan user pastikan data user ada di table karyawan .</b>
                        <div class="form-group">
                            <label for="input_username">Karyawan </label>
                            <input type="text" name="nama_karyawan" class="form-control" id="cari_karyawan" placeholder="pilih karyawan ....">
                            <br />
                            <span class="input-group-btn">
                                <a href="#modalkaryawan" class="btn btn-primary btn-sm btn-cari-karyawan" data-toggle="modal" title="Cari Karyawan"><i class="fa fa-search"></i> CARI KARYAWAN </a>
                            </span>

                            <input type="hidden" name="karyawan_id" id="karyawan_id" value="">
                        </div>
                        <div class="form-group">
                            <label for="input_username">Username :</label>
                            <input type="text" onkeypress="return event.charCode != 32" oninput="this.value = this.value.toLowerCase()" autocomplete="off" class="form-control" id="input_username" name="input_username" placeholder="Username" required>
                        </div>


                        <div class="form-group">
                            <label for="input_password">Password : </label>
                            <input type="text" autocomplete="off" class="form-control" id="input_password" name="input_password" placeholder="Password" required>
                        </div>

                        <div class="form-group">
                            <label for="input_level">Level : </label>
                            <select id="input_level" name="input_level" class="form-control" required>
                                <option value="" selected disabled>- Pilih -</option>
                                <option velue="administrator">Administrator</option>
                                <option velue="manager">Manajer</option>
                                <option velue="admin">Admin</option>
                                <option velue="kasir">Kasir</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_level">Modul Akses : </label>
                            <select class="form-control js-example-basic-multiple" name="hak_akses[]" style="width:500px" multiple="multiple">
                                <?php foreach ($this->properti->getModul() as $mod) : ?>
                                    <optgroup label="<?= $mod->modulnm ?>">
                                        <option value="<?= $mod->modulnm ?>"><?= $mod->url ?></option>
                                    </optgroup>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" id="act_simpan" class="btn btn-primary">Simpan</button>
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
<?php foreach ($data_akun as $edit) {
    $data = $this->db->get_where('tbl_karyawan', ['id_karyawan' => $edit->karyawan_id]);
    if ($data->num_rows() > 0) {
        $nama = $data->row()->nm_karyawan;
    } else {
        $nama = NULL;
    }

?>
    <div class="modal fade" id="edit_akun_<?php echo $edit->id_login; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalUbahakun" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-yellow text-white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-pencil"></i> Ubah Akun</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="act_simpan" action="<?php echo base_url() . 'akun/editakun'; ?>" method="post">
                        <div class="box-body">
                            <input type="hidden" id="id_login" name="id_login" class="form-control" value="<?php echo $edit->id_login; ?>">

                            <div class="form-group">
                                <b>Berikut data karyawan yang di pilih untuk login sebelumnya .</b>
                                <label for="edit_username">Nama :</label>
                                <b><?= $nama ?></b>
                            </div>
                            <div class="form-group">
                                <label for="edit_username">Nama Karyawan yang di pilih :</label>
                                <?= $nama ?>
                                <br />
                                <span class="input-group-btn">
                                    <small>Action edit data karyawan tidak bisa di ubah .</small>
                                </span>
                                <input type="hidden" name="karyawan_id" id="karyawan_id_edit" value="">
                            </div>

                            <div class="form-group">
                                <label for="edit_username">Username :</label>
                                <input type="text" onkeypress="return event.charCode != 32" oninput="this.value = this.value.toLowerCase()" autocomplete="off" class="form-control" id="edit_username" name="edit_username" placeholder="Username" value="<?php echo $edit->username; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_password">Password : </label>
                                <input type="password" autocomplete="off" class="form-control" id="edit_password" name="edit_password" placeholder="Password" value="<?php echo $edit->password; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="edit_level">Level : </label>
                                <select id="edit_level" name="edit_level" class="form-control" required>
                                    <option value="" selected disabled>- Pilih -</option>
                                    <option value="administrator" <?php $slevel = $edit->level;
                                                                    if ($slevel == "administrator") {
                                                                        echo "selected";
                                                                    } ?>>Super User</option>
                                    <option value="admin" <?php $slevel = $edit->level;
                                                            if ($slevel == "admin") {
                                                                echo "selected";
                                                            } ?>>Manajer </option>
                                    <option value="kasir" <?php $slevel = $edit->level;
                                                            if ($slevel == "kasir") {
                                                                echo "selected";
                                                            } ?>>Kasir</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="input_level">Modul Akses : </label>
                                <select class="form-control js-example-basic-multiple" name="hak_akses[]" style="width:500px" multiple="multiple">
                                    <?php

                                    foreach ($this->properti->getModul() as $mod) :
                                        $get = $this->db->get_where('tmprivelage', ['user_id' => trim($edit->id_login)]);
                                        if ($get->num_rows() > 0) {
                                            $lsm = explode('.', $get->row()->priv_name);
                                            foreach ($lsm as  $val) {
                                                $selected =  ($val == $mod->modulnm) ? 'selected' : '';
                                            }
                                        } else {
                                            $selected = '';
                                        }

                                    ?>
                                        <optgroup label="<?= $mod->modulnm ?>">
                                            <option value="<?= $mod->modulnm ?>" <?= $selected ?>><?= $mod->url ?></option>
                                        </optgroup>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" id="act_simpan" class="btn btn-warning">Simpan</button>
                            </div>
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
    // Datatables akun
    ///////////////////////////////////////////////////////////////////////////////////
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
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
        var tabledataakun = $('#tabledataakun').DataTable({
            "language": {
                //"url": "template/js/Indonesian.json",
                "sEmptyTable": "Data Kosong.",
                "zeroRecords": "Data Tidak Di Temukan.",
                "sProcessing": '<div class="font-loading">Sedang Memuat...</div>'
            },
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo base_url(); ?>akun/akunjson",
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
                    "data": "username",
                    "class": "text-center"
                },
                {
                    "data": "karyawan_id",
                    "class": "text-center"
                },
                {
                    "data": "nm_karyawan",
                    "class": "text-center"
                },
                {
                    "data": "level",
                    "class": "text-center",
                    "render": function(data) {
                        var level = data;
                        if (level == "administrator") {
                            return '<small class="label bg-green">Administrator</small>'

                        } else if (level == "manager") {
                            return '<small class="label bg-yellow">Manajer </small>'

                        } else if (level == "admin") {
                            return '<small class="label bg-blue">Admin</small>'
                        } else if (level == "kasir") {
                            return '<small class="label bg-yellow">Kasir</small>'
                        }
                    }
                },
                {
                    "data": "status",
                    "class": "text-center",
                    "render": function(data) {
                        var status = data;
                        if (status == "1") {
                            return '<small class="label bg-green">Aktif</small>'
                        } else if (status == "0") {
                            return '<small class="label bg-red">Non-Aktif</small>'
                        }
                    }
                },

                {
                    "data": null,
                    "class": "text-center",
                    "render": function(data) {
                        var status = data["status"]
                        var id = data["id_login"]
                        var html = '<div class="btn-group">'
                        if (status == "0") {
                            html += '<a href="<?php base_url(); ?>akun/editstatus/' + id + '" title="Aktifkan" class="btn btn-success btn-sm" onclick="return confirm(\'Anda Yakin Aktifkan ?\')"><i class="fa fa-check"></i> </a>'
                        } else if (status == "1") {
                            html += '<a href="<?php base_url(); ?>akun/editstatus/' + id + '" title="Non-Aktifkan" class="btn btn-danger btn-sm" onclick="return confirm(\'Anda Yakin Non-Aktifkan ?\')"><i class="fa fa-times"></i> </a>'
                        } else {
                            html += ''
                        }
                        html += '<a href="#edit_akun_' + id + '" class="btn btn-warning btn-sm" data-toggle="modal" title="Ubah"><i class="fa fa-edit"></i> </a><a href="<?php base_url(); ?>akun/arsipakun/' + id + '" title="Arsip Akun" class="btn btn-sm btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ?\')"><i class="fa fa-trash"></i> </a></div>'
                        return html
                    }
                }

            ],
            "order": [
                [1, 'asc']
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
        //     $('#tabledataakun').on('init.dt', function() {
        //         $("#tabledataakun").removeClass('').show();
        //     });
        //     setTimeout(function() {
        //         $('#tabledataakun').DataTable();
        //     }, 3000);

        // });
    });
</script>



<!-- untuk tambah -->

<script>
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
                    "url": "<?php echo base_url(); ?>master/carikaryawanjson/akun",
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
        });
        // $(document).ready(function() {
        //     $('#popkaryawan').on('init.dt', function() {
        //         $("#popkaryawan").removeClass('').show();
        //     });
        //     setTimeout(function() {
        //         $('#popkaryawan').DataTable();
        //     }, 3000);

        // });
        $(document).on('click', '.pilih_data_karyawan', function(e) {
            document.getElementById("karyawan_id").value = $(this).attr("data-id");
            document.getElementById("cari_karyawan").value = $(this).attr("data-nama");
            $('#modalkaryawan_edit').modal('hide');
            $('#modalkaryawan').modal('hide');

        });

    });

    //if click data

    $(function() {
        $('#act_simpan').submit(function(e) {
            e.preventDefault();
            var action = $(this).attr('action');
            var dataparams = $(this).serialize();
            var karyawan_id = $('#karyawan_id').val();
            if (karyawan_id == '') {
                swal.fire('info', 'silahkan pilih id karyawan terlebih dahulu', 'error');
            } else {
                $.ajax({
                    url: action,
                    data: dataparams,
                    method: 'post',
                    dataType: 'json',
                    chace: false,
                    success: function(data) {
                        if (data.status == 1) {
                            swal.fire('success', data.msg, 'success');
                        } else if (data.status == 2) {
                            swal.fire('warning', data.msg, 'warning');
                        } else {
                            swal.fire('success', 'data  gagal di simpans', 'success');
                        }
                        $('#tabledataakun').DataTable().ajax.reload();
                        $('#tambah_akun').modal('hide');
                        $('#edit_akun').modal('hide');
 
                    },
                    error: function(data, error) {
                        swal.fire('info', 'server tida dappat merespon permintaan' + error, 'error');
                    },
                });
            }
        });
    });
</script>



<!-- modal karyawan -->
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
                    <table id="popkaryawan" class="table table-bordered table-hover dt-responsive " style="width:100%">
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