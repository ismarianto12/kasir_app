<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                </div>
                <div class="body">
                    <div class='row'>
                        <div class='col-sm-12'>
                            <?= $this->session->flashdata('message') ?>
                            <div class=white-box>
                                <form id="simpan" action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
                                    <div class='form-body'>
                                        <div class="form-group">
                                            <label for="varchar" class='control-label col-md-3'><b>No Penjualan<?php echo form_error('no_penjualan') ?></b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="no_penjualan" id="no_penjualan" placeholder="No Penjualan" value="" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="varchar" class='control-label col-md-3'><b>Harga Satuan</b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="price" id="price" placeholder="Harga satuan" value="<?= $price ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="varchar" class='control-label col-md-3'><b>Barang <?php echo form_error('barang_id') ?></b></label>
                                            <div class='col-md-3'>
                                                <input type="text" class="form-control" name="item" id="item" placeholder="Cari Item ..." value="<?php echo $nm_barang; ?>" readonly />
                                            </div>
                                            <div class='col-md-3'>
                                                <input type="text" class="form-control" id="dbarang" placeholder="Cari Barang" onload="caribarang(dbarang.value)" onclick="caribarang(dbarang.value)" onkeyup="caribarang(dbarang.value)" value="<?= $barang_id ?>" />
                                                <input type="hidden" id="barang_id" name="barang_id" value="<?= $barang_id ?>" />
                                            </div>
                                            <div class='col-md-3'>
                                                <a href="#" class="btn btn-info" id="cari_barang"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="diskon" class='control-label col-md-3'><b>Diskon</b></label>
                                            <div class='col-md-3'>
                                                <input type="number" class="form-control" name="diskon" id="diskon" placeholder="Junmlah Diskon" value="<?php echo $diskon; ?>" />
                                                <i> Jika ada ada diskon silahkan diisi.</i>
                                            </div>
                                            <div class='col-md-3'>
                                                <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah Item" value="<?php echo $jumlah; ?>" required onInput="getJumlah()" />
                                                <small>Silahkan arahkan kursor dan tekan enter untuk pilih item </small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="int" class='control-label col-md-3'><b>Member <br /> <small>jika ada </small><?php echo form_error('member_id') ?></b></label>
                                            <div class='col-md-3'>
                                                <input type="text" class="form-control" id="membernm" placeholder="Jika ada member .." value="" readonly />
                                                <input type="hidden" name="member_id" id="member_id" value="">
                                            </div>

                                            <div class='col-md-3'>
                                                <a href="#" id="cari_member" class="btn btn-info"><i class="fa fa-search"></i></a>
                                                <button id="simpan" class="btn btn-primary"><i class="fa fa-plus"></i></button>

                                            </div>

                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function load_struck() {
                    $.ajax({
                        url: '<?= base_url('trtransaksi/getStruckno/' . $this->properti->rian_encp(RIAN_ENCP)) ?>',
                        method: 'POST',
                        dataType: 'json',
                        success: function(data) {
                            $('#no_penjualan').val(data.nomor);
                        }
                    });
                }
                load_struck();
                // cari barang
                $('#cari_barang').on('click', function(e) {
                    e.preventDefault();
                    $('#modal_cari_barang').modal('show');
                });
                //cari member
                $(document).on('click', '#cari_member', function(e) {
                    e.preventDefault();
                    $('#Idmember').modal('show');
                });

                //if member clicked
                $(document).on('click', '#add_list', function(e) {
                    e.preventDefault();
                    $("member_id").value = $(this).attr("data-member_id");
                    $("membernm").value = $(this).attr("data-membernm");
                    $('#Idmember').modal('hide');

                });
            </script>

            <!-- Cari barang -->
            <div class="modal fade" id="modal_cari_barang" tabindex="-1" role="dialog" aria-labelledby="poplabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:800px">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-fw fa-bell"></i> Item Data .</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <button class="btn btn-primary" id="sycndata"><i class="fa fa-refresh"></i>Synch data</button>
                                <table id="popbarang" class="table table-bordered table-hover dt-responsive " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary text-white">NO.</th>
                                            <th class="text-center bg-primary text-white">KODE</th>
                                            <th class="text-center bg-primary text-white">BARCODE</th>
                                            <th class="text-center bg-primary text-white">NAMA</th>
                                            <th class="text-center bg-primary text-white">STOK</th>
                                            <th class="text-center bg-primary text-white">HARGA</th>
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
                            "url": "<?= base_url('master') ?>/barangjson",
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
                                "data": null,
                                "class": "text-center",
                                "render": function(data, type, full, meta) {
                                    var kode = data["kode_barang"]
                                    var html = '<img src="<?php echo base_url('assets'); ?>/barcode/' + kode + '.jpg" alt="' + kode + '" width="200" height="60"></a>';
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
                                "data": "harga_jual_baru",
                                render: function(data, type, row) {
                                    var format_jual = $.fn.dataTable.render.number(",", ".", 0, "Rp.").display;
                                    return format_jual(row.harga_jual_baru);
                                }
                            },
                            {
                                "data": null,
                                "class": "text-center",
                                "render": function(data) {
                                    var id = data["kode_barang"]
                                    var nama = data["nm_barang"]
                                    var harga = data["harga_jual_baru"]
                                    //var html = '<div class="btn-group">'
                                    //html += '<a href="#edit_barang_' + id + '" id="' + id + '" class="btn btn-primary btn-sm pilih_data_barang" data-toggle="modal" title="Ubah"><i class="fa fa-plus"></i> Tambah</a></div>'
                                    var html = '<button  class="btn btn-success btn-sm pilih_data_barang" data-id="' + id + '" data-nama="' + nama + '" data-harga="' + harga + '"><i class="fa fa-plus"></i> Pilih</button>'
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
                        document.getElementById("dbarang").value = $(this).attr("data-id");
                        document.getElementById("barang_id").value = $(this).attr("data-id");
                        document.getElementById("item").value = $(this).attr("data-nama");
                        document.getElementById("price").value = $(this).attr("data-harga");
                        $('#modal_cari_barang').modal('hide');
                    });

                    // $(document).ready(function() {
                    //     $('#popbarang').on('init.dt', function() {
                    //         $("#popbarang").removeClass('').show();
                    //     });
                    //     setTimeout(function() {
                    //         $('#popbarang').DataTable();
                    //     }, 3000);
                    // });
                });

                $(function() {
                    $('#sycndata').click(function(e) {
                        e.preventDefault();
                        $('#popbarang').DataTable.ajax.reload();
                    });
                });
            </script>


            <div class="modal fade" id="Idmember" tabindex="-1" role="dialog" aria-labelledby="poplabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="width:800px">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title"><i class="fa fa-fw fa-bell"></i> Data Member .</h4>
                        </div>
                        <div class="modal-body">
                            <div class="box-body">
                                <table id="list_member" class="table table-responsive " style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center bg-primary text-white">NO.</th>
                                            <th class="text-center bg-primary text-white">KODE</th>
                                            <th class="text-center bg-primary text-white">NAMA</th>
                                            <th class="text-center bg-primary text-white">Active</th>
                                            <th class="text-center bg-primary text-white">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- json  datatable member -->
            <script type="text/javascript">
                $(document).ready(function() {
                    // $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                    //     return {
                    //         "iStart": oSettings._iDisplayStart,
                    //         "iEnd": oSettings.fnDisplayEnd(),
                    //         "iLength": oSettings._iDisplayLength,
                    //         "iTotal": oSettings.fnRecordsTotal(),
                    //         "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    //         "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    //         "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    //     };
                    // };

                    $("#list_member").DataTable({
                        initComplete: function() {
                            var api = this.api();
                            $('#datatables input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                                    }
                                });
                        },
                        oLanguage: {
                            sProcessing: "loading..."
                        },
                        processing: true,
                        serverSide: true,
                        ajax: {
                            "url": "<?= base_url('member/json/select_data') ?>",
                            "type": "POST"
                        },
                        columns: [
                            {
                                "data": "id",
                                "orderable": false
                            }, {
                                "data": "kode", 
                                "orderable": false
                            }, {
                                "data": "nama"
                            },
                            {
                                "data": "active"
                            }, {
                                "data": "action",
                                "orderable": false,
                                "className": "text-center"
                            }
                        ],
                        order: [
                            [0, 'desc']
                        ],
                        rowCallback: function(row, data, iDisplayIndex) {
                            var info = this.fnPagingInfo();
                            var page = info.iPage;
                            var length = info.iLength;
                            var index = page * length + (iDisplayIndex + 1);
                            $('td:eq(0)', row).html(index);
                        }
                    });
                });
            </script>
            <!-- end -->
            <!-- simpan -->
            <script>
                function kosong() {
                    $('#dbarang').val('');
                    $('input[name="price"]').val('');
                    $('input[name="item"]').val('');
                    $('input[name="barang_id"]').val('');
                    $('input[name="jumlah"]').val('');
                    $('input[name="member_id"]').val('');
                    $('input[name="diskon"]').val('');
                }

                function getJumlah() {
                    var jumlah = $('#jumlah').val();
                    var barang_id = $('#barang_id').val();

                    event.preventDefault();
                    if (jumlah == '') {

                    } else if (barang_id == '') {
                        // Swal.fire({
                        //     title: 'Kesalaha',
                        //     text: "Jumlah barang tidak boleh kosong",
                        //     icon: 'warning',
                        // });

                    } else {
                        dataInsert = $(this).serialize();
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: dataInsert,
                            dataType: 'json',
                            chace: false,
                            success: function(data) {
                                if (data.msg == 'ok') {
                                    $("#barang_tb").DataTable().ajax.reload();
                                    kosong();
                                } else {
                                    swal.fire({
                                        title: "Terjadi Kesalahan Berikut",
                                        html: data.msg + '<br /> <b>Saran Silahkan Stok Opname terlebih dahulu.</b>',
                                        confirmButtonText: "Ok",
                                    });

                                }
                            },
                            error: function(error, jqXHR, status) {
                                //  swal.fire('info', 'server dalam masalah', 'error');
                            }
                        });
                    }
                }


                //if clik
                $(function() {
                    $('#simpan').on('submit', function(e) {
                        e.preventDefault();
                        dataInsert = $(this).serialize();
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'post',
                            data: dataInsert,
                            dataType: 'json',
                            chace: false,
                            beforeSend: function(data) {
                                let timerInterval
                                Swal.fire({
                                    title: 'Sedang Menyimpan',
                                    html: 'Memproses data',
                                    timer: 200,
                                    timerProgressBar: true,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            const content = Swal.getContent()
                                            if (content) {
                                                const b = content.querySelector('b')
                                                if (b) {
                                                    b.textContent = Swal.getTimerLeft()
                                                }
                                            }
                                        }, 100)
                                    },
                                    onClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {

                                })
                            },
                            success: function(data) {
                                if (data.msg == 'ok') {
                                    load_struck();
                                    kosong();
                                } else {
                                    swal.fire({
                                        title: "Terjadi Kesalahan Berikut",
                                        html: data.msg + '<br />',
                                        confirmButtonText: "Ok",
                                    });

                                }
                                $("#barang_tb").DataTable().ajax.reload();
                            },
                            error: function(error, jqXHR, status) {
                                swal.fire('info', 'server dalam masalah', 'error');
                            }
                        });
                        return false;

                    });
                });
            </script>

            <!-- tembak barcode -->
            <script>
                $(function() {
                    $('#dbarang').codeScanner();
                });

                //cari data barang 
                function caribarang(code) {
                    if (code == '') {

                    } else {
                        $.ajax({
                            url: '<?= base_url('trtransaksi/get_scan') ?>',
                            method: 'post',
                            data: 'no_barang=' + code,
                            dataType: 'json',
                            chace: false,
                            success: function(data) {
                                $("#dbarang").val(data.kode_barang);
                                $("#barang_id").val(data.kode_barang);
                                $("#item").val(data.item);
                                $("#price").val(data.price);

                            },
                            error: function(data) {
                                swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something Error 500 bosque',
                                    footer: '<a href>Why do I have this issue?</a>'

                                });
                            }
                        });
                    }
                }
            </script>