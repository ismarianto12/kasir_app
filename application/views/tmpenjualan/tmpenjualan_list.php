<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">

                </div>
                <div class="box-tools pull-right">
                    <button class="btn btn-primary" id="refresh_form"><i class="fa fa-refresh"></i>Refresh Page</button>
                </div>
                <div class="box-body">
                    <div class='row'>

                        <div class='col-sm-12'>
                            <div class='white-box'>
                                <div id="show_app"></div>
                            </div>
                            <div class='white-box'>
                                <table class="table" id="barang_tb">
                                    <thead>
                                        <tr>
                                            <th width="80px">No</th>
                                            <th>Kode</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th width="200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

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

                                        $("#barang_tb").DataTable({
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
                                                "url": "<?= base_url('penjualan/json/transaksi') ?>",
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
                                                    "data": "jumlah"
                                                },
                                                {
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

                                    function hapus(n) {
                                        swal.fire({
                                                title: 'Konfirmasi Hapus',
                                                text: 'Apakah Anda Yakin Untuk Menghapus Data Ini?',
                                                type: 'warning',
                                                showCancelButton: true,
                                                confirmButtonClass: 'btn-danger',
                                                confirmButtonText: 'Ya',
                                                closeOnConfirm: false
                                            },
                                            function() {
                                                swal.fire('Hapus Data', 'Data Berhasil Di Hapus', 'success');
                                                window.location.href = '<?= base_url('tmpenjualan/hapus/') ?>' + n;
                                            });
                                    }
                                </script>



                                <script>
                                    //sc show that from 
                                    $(function() {
                                        $('#refresh_form').on('click', function(e) {
                                            e.preventDefault();
                                            $("#barang_tb").DataTable().ajax.reload();
                                            $('#show_app').load("<?= base_url('penjualan/tambah/' . $this->properti->rian_encp(RIAN_ENCP)) ?>");
                                        });
                                        $('#show_app').load("<?= base_url('penjualan/tambah/' . $this->properti->rian_encp(RIAN_ENCP)) ?>");
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>