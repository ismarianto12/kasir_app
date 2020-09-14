<link href="<?= base_url('assets/css/sweet-alert.css') ?>" rel="stylesheet" />
<script type="text/javascript" src="<?= base_url('assets/js/sweet-alert.js') ?>"></script>
<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Master Report Penjualan.</h2>
                </div>
                <div class="body" style="background:#fff; padding:10px 10px 10px">
                    <div class='row'>
                        <div class='col-sm-12'>
                            <?= $this->session->flashdata('message') ?>
                            <div class='white-box'>
                                <h3 class='box-title m-b-0'></h3>
                                <br /><br />
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
                                            <th>Tgl .Transaksi</th>
                                            <?php if ($this->session->level == 'kasir' || $this->session->level == 'admin') {  ?>
                                            <?php } else {  ?>
                                                <th width="200px">Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody style="
    font-size: 12pt;
    font-style: italic;
    font-family: cursive;
"></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style="text-align:center;font-size: 23pt;">Total Pendapatan</th>
                                            <th colspan="2" style="text-align:left;font-size: 30pt;">
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="alert alert-info">
                                    <p>
                                        Data penjualan muncul apa bila di di list transaksi<br />
                                        struk penjualan berhasil di cetak terlebih dahulu.
                                    </p>
                                </div>
                                <script type="text/javascript" src="<?= base_url('tpl/button/dataTables.buttons.min.js') ?>"></script>
                                <script type="text/javascript" src="<?= base_url('tpl/button/jszip.min.js')  ?>"></script>
                                <script type="text/javascript" src="<?= base_url('tpl/button/pdfmake.min.js')  ?>"></script>
                                <script type="text/javascript" src="<?= base_url('tpl/button/vfs_fonts.js')  ?>"></script>
                                <script type="text/javascript" src="<?= base_url('tpl/button/buttons.html5.min.js')  ?>"></script>


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
                                            dom: 'Bfrtip',
                                            buttons: [
                                                'copyHtml5',
                                                'excelHtml5',
                                                'csvHtml5',
                                                'pdfHtml5'
                                            ],
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
                                                "url": "<?= base_url('report_transaksi/json') ?>",
                                                "type": "POST"
                                            },
                                            columns: [{
                                                    "data": "id_penjualan",
                                                    "orderable": false
                                                }, {
                                                    "data": "barang_id"
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
                                                },
                                                {
                                                    "data": "date_created",
                                                    "orderable": false,
                                                },
                                                <?php if ($this->session->level == 'kasir' || $this->session->level == 'admin') {  ?>
                                                <?php } else {  ?> {
                                                        "data": "action",
                                                        "orderable": false,
                                                        "className": "text-center"
                                                    }
                                                <?php } ?>
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
                                                    url: '<?= base_url('report_transaksi/hapus') ?>/' + n,
                                                    data: 'id=' + n,
                                                    method: 'GET',
                                                    dataType: 'json',
                                                    success: function(data) {
                                                        $("#barang_tb").DataTable().ajax.reload();

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
                            </div>
                        </div>
                    </div>
                </div>