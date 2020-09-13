<script src="<?= base_url('tpl/adminlte2/js/jquery-code-scanner.js') ?>"></script>
<script>
    function load_struck() {
        $.ajax({
            url: '<?= base_url('trtransaksi/getStruckno/' . $this->properti->rian_encp(RIAN_ENCP)) ?>',
            method: 'POST',
            dataType: 'json',
            success: function(data) {
                $('#simpan_transaksi').attr('struck_id', data.nomor);
            },
            error: function(data, JqXHR, status, error) {
                alert('transaksi tidak bisa di lajut ' + error);
            }
        });
    }
    load_struck();
</script>

<div class="box">
    <div class="box-header with-border">
        <h4><i class="fa fa-cubes"></i> Transaksi </h4>
    </div>
    <div class="box-tools pull-right" style="margin-right: 15px;">
        <button class="btn btn-primary" id="refresh_form"><i class="fa fa-refresh"></i>Refresh Page</button>
    </div>
    <div class="box-tools pull-left" style="margin-left: 15px;">
        <h3>Kasir <b><?= $this->session->name ?></b></h3>
    </div>
    <div class="box-tools pull-left" style="margin-left: 15px;">
        <h3>
            <marquee>hari ini <?= date('Y-M-d H:i:s') ?>Botique , Selamat datang di halaman penjualan Silahkan Perhatikan jumlah dan harga
                untuk barang yang di beli apa bila tidak di simpan tidak bisa di recount di penjualan harap selalu menyimpan penjualan terima kasih. </marquee>
        </h3>
    </div>
    <div class="box-body">
        <div class='row'>
            <div class='col-sm-12'>
                <div class='white-box'>
                    <div id="show_app"></div>
                </div>
                <div class='white-box'>
                    <div class="alert alert-danger">Laba rugi hanya dapat di report apabila transaksi dis simpan dan struk di cetak. </div>
                    <table class="table" id="barang_tb">
                        <thead>
                            <tr>
                                <th width="80px">No</th>
                                <th>Kode</th>
                                <th>Barang</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Diskon</th>
                                <th>Sub Total</th>
                                <th width="200px">Action</th>
                            </tr>
                        </thead>
                        <tbody style="
    font-size: 12pt;
    font-style: italic;
    font-family: cursive;
"></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:center;font-size: 23pt;">Total Yang Harus Di Bayar</th>
                                <th colspan="2" style="text-align:left;font-size: 30pt;">
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-offset-3 col-md-9'>
                                <button id="simpan_transaksi" type="submit" class="btn btn-info"><i class='fa fa-save'></i> Simpan Transaksi</button>
                                <button id="batalkan_transaksi" type="submit" class="btn btn-warning"><i class='fa fa-save'></i> Batalkan Transaksi</button>

                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
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

                            var lis_tr = $("#barang_tb").DataTable({
                                initComplete: function() {
                                    var api = this.api();
                                    $('#barang_tb input')
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
                                    "url": "<?= base_url('trtransaksi/json') ?>",
                                    "type": "POST"
                                },
                                columns: [{
                                        "data": "id_penjualan",
                                        "orderable": false
                                    }, {
                                        "data": "kode_barang"
                                    }, {
                                        "data": "nm_barang"
                                    }, {
                                        "data": "harga_jual_baru",
                                        render: function(data, type, row) {
                                            var format_jual = $.fn.dataTable.render.number(",", ".", 0, "Rp.").display;
                                            return format_jual(row.harga_jual_baru);
                                        }
                                    }, {
                                        "data": "jumlah"
                                    },
                                    {
                                        "data": "diskon",
                                        render: function(data, type, row) {
                                            var format_diskon = $.fn.dataTable.render.number(",", "%", "%", 0).display;
                                            return format_diskon(row.diskon);
                                        }
                                    }, {
                                        "data": "subtotal",
                                        "orderable": false,
                                        render: function(data, type, row) {
                                            var numFormat = $.fn.dataTable.render.number(",", ".", 0, "Rp.").display;
                                            var total = parseInt(row.subtotal);
                                            return numFormat(total);
                                        }
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
                                },
                                "footerCallback": function(row, data, start, end, display) {
                                    var api = this.api(),
                                        data;
                                    var intVal = function(i) {
                                        return typeof i === 'string' ?
                                            i.replace(/[\$,]/g, '') * 1 :
                                            typeof i === 'number' ?
                                            i : 0;
                                    };
                                    var subtotalall = api
                                        .column(6)
                                        .data()
                                        .reduce(function(a, b) {
                                            return intVal(a) + intVal(b);
                                        }, 0);
                                    var format_jual = $.fn.dataTable.render.number(",", ".", 0, "Rp.").display;
                                    $(api.column(5).footer()).html(format_jual(subtotalall));
                                }
                            });

                        });
                        $(function() {
                            $('#simpan_transaksi').on('click', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Simpan Transaksi',
                                    text: "dan cetak struk?",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Simpan '
                                }).then((result) => {
                                    if (result.value) {
                                        var n = $('#no_penjualan').val();
                                        $.ajax({
                                            url: '<?= base_url('trtransaksi/simpan_penjualan') ?>',
                                            data: 'ktransaksi=' + n,
                                            method: 'POST',
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.stat == 1) {
                                                    load_struck();
                                                    Swal.fire(
                                                        'Transaksi',
                                                        'Data Telah Berhasil disimpan',
                                                        'success'
                                                    );
                                                    tampil_struck(n);
                                                } else if (data.stat == 2) {
                                                    Swal.fire(
                                                        'Gagal',
                                                        data.msg,
                                                        'success'
                                                    );
                                                }
                                                $("#barang_tb").DataTable().ajax.reload();
                                            },
                                            error: function(data) {
                                                Swal.fire(
                                                    'Error 500',
                                                    'Server tidak respon.',
                                                    'danger'
                                                );
                                            }
                                        });
                                    }
                                })
                            });

                            //if cancel
                            $('#batalkan_transaksi').on('click', function(event) {
                                event.preventDefault();
                                Swal.fire({
                                    title: 'Hapus Transaksi ?',
                                    text: "Transaksi akan di batalkan",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Hapus'
                                }).then((result) => {
                                    if (result.value) {
                                        var n = $('#no_penjualan').val();
                                        $.ajax({
                                            url: '<?= base_url('trtransaksi/hapus_transaksi') ?>',
                                            data: 'ktransaksi=' + n,
                                            method: 'POST',
                                            dataType: 'json',
                                            success: function(data) {
                                                if (data.stat == 1) {
                                                    load_struck();
                                                    Swal.fire(
                                                        'Transaksi',
                                                        'Data Telah Berhasil di hapus',
                                                        'success'
                                                    );
                                                } else if (data.stat == 2) {
                                                    Swal.fire(
                                                        'Gagal',
                                                        data.msg,
                                                        'success'
                                                    );
                                                }
                                                $("#barang_tb").DataTable().ajax.reload();
                                            },
                                            error: function(data) {
                                                Swal.fire(
                                                    'Error 500',
                                                    'Server tidak respon.',
                                                    'danger'
                                                );
                                            }
                                        });
                                    }
                                })
                            });
                        });

                        //tampil struck after confirm()


                        function tampil_struck(n) {
                            window.open('<?= base_url('trtransaksi/print_struk/') ?>' + n, '1429893142534', 'width=' + (parseInt(window.innerWidth) * 0.3) + ',height=' + (parseInt(window.innerHeight) * .3) + ',toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=0,left=0,top=0');
                            return false;
                        }

                        function kosong() {
                            $('#dbarang').val('');
                            $('input[name="price"]').val('');
                            $('input[name="item"]').val('');
                            $('input[name="barang_id"]').val('');
                            $('input[name="jumlah"]').val('');
                            $('input[name="member_id"]').val('');
                            $('input[name="diskon"]').val('');

                        }


                        function hapus(n, j) {
                            Swal.fire({
                                title: 'Item ' + j + ' Di Batalkan ?',
                                text: "Data akan di hapus ",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.value) {
                                    $.ajax({
                                        url: '<?= base_url('trtransaksi/hapus') ?>',
                                        data: 'id=' + n,
                                        method: 'POST',
                                        dataType: 'json',
                                        success: function(data) {
                                            // Swal.fire(
                                            //     'Deleted!',
                                            //     'Your file has been deleted.',
                                            //     'success'
                                            // );
                                            kosong();
                                            $("#barang_tb").DataTable().ajax.reload();
                                            $('#show_app').load("<?= base_url('trtransaksi/tambah/' . $this->properti->rian_encp(RIAN_ENCP)) ?>");

                                        },
                                        error: function(data) {
                                            Swal.fire(
                                                'Tidak bisa di hapus!',
                                                'Server tidak respon.',
                                                'danger'
                                            );
                                        }
                                    });
                                }
                            })
                        }
                    </script>

                    <script>
                        //sc show that from 
                        $(function() {
                            $('#refresh_form').on('click', function(e) {
                                e.preventDefault();
                                $("#barang_tb").DataTable().ajax.reload();
                                $('#show_app').load("<?= base_url('trtransaksi/tambah/' . $this->properti->rian_encp(RIAN_ENCP)) ?>");
                            });
                            $('#show_app').load("<?= base_url('trtransaksi/tambah/' . $this->properti->rian_encp(RIAN_ENCP)) ?>");

                            //
                            $('#barang_tb').on('click', '.edit', function(e) {
                                url = $(this).attr('to');
                                $('#show_app').load(url);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</div>