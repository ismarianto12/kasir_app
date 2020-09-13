<div class="nav-tabs-custom">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#tab_terima" data-toggle="tab"><i class="fa fa-database"></i> Sych Kirim data ke server .</a></li>
        <li><a href="#tab_kirim" data-toggle="tab" style="
    background: green;
    color: #fff;"><i class="fa fa-list"></i> Sych Kirim data dari server .</a></li>
        <li><a href="#transaksi_terima" data-toggle="tab"><i class="fa fa-list"></i> Sych Data Penjualan (Terima) .</a></li>
        <li><a href="#transaksi_kirim" data-toggle="tab" style="
    background: #bb1b6d;
    color: #fff;
"><i class="fa fa-list"></i> Sych Data Penjualan (Kirim) .</a></li>
    </ul>
    <div class="tab-content">
        <div class="callout callout-info">
            Table untuk synch data yang di terima adalah data barang .
            <hr />
            Pastikan untuk synch data harap terkonksi dengan internet yang memadai
        </div> 
        <!-- Tab karyawan-->
        <!-- ###################################################### -->
        <div class="tab-pane active" id="tab_kirim">
            <div class="box-body">
                <div id="tampil_notifikasi"></div>
                <a href="#" id="receive_data" class="btn btn-primary"><i class="fa fa-database"></i>Terima data </a>
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
        <div class="tab-pane" id="tab_terima">
            <div class="box-body">

                <div id="tampil_kirimnot"></div>
                <a href="#" id="send_data" class="btn btn-success"><i class="fa fa-database"></i>Kirim data </a>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="callout callout-info">
                    untuk sinkronisasi data adalah table data barang .
                </div>
                <?php
                echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                ?>
            </div>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="transaksi_terima">
            <div class="box-body">
                <div id="trterima"></div>
                <a href="#" id="receivetrf" class="btn btn-success"><i class="fa fa-database"></i>Terima Data Transaksi Dari Server </a>
            </div>
            <div class="box-footer">
                <div class="callout callout-warning">
                    untuk sinkronisasi data adalah table trtransaksi barang .
                </div>
                <?php
                echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                ?>
            </div>
        </div>
        <div class="tab-pane" id="transaksi_kirim">
            <div class="box-body">
                <div id="trkirim"></div>
                <a href="#" id="send_transaksi" class="btn btn-success"><i class="fa fa-database"></i>Synch data transaksi ker server </a>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <div class="callout callout-danger">
                    Table Sycnh table transaksi
                </div>
                <?php
                echo "<i>Timestamp " . date("d/m/Y h:i:sa") . "</i>";
                ?>
            </div>
        </div>
        <!-- tab transaksi  -->
    </div>
    <!-- /.tab-content -->
</div>
<script>
    $(function() {
        $('#receive_data').click(function(e) {
            e.preventDefault();
            $('#receive_data').hide();
            $("#tampil_notifikasi").html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i></i>Sedang Synch data (Terima data barang dari server) ... </div>');

            $.ajax({
                url: '<?= base_url('Synch_api/terima') ?>',
                method: 'get',
                chace: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        $("#tampil_notifikasi").html('<div class="callout callout-success"><i class="fa fa-check"></i>Successful restore from db to local server .</div>');
                        swal.fire({
                            title: 'Data Success di restore dari server',
                            text: "berhasil di restore",
                            icon: 'warning'
                        });
                    } else if (data.status == 2) {
                        swal.fire({
                            title: 'masalah dalam restore database',
                            text: "system sedang mengulang harap tunggu ...",
                            icon: 'warning'
                        });
                    }
                    $('#receive_data').show();

                },
                error: function(data, xhr, error, Status) {
                    swal.fire({
                        title: 'gagal server tidak response',
                        text: "Status : " + error,
                        icon: 'warning'
                    });
                },
            });
        });

        $('#send_data').click(function(e) {
            e.preventDefault();
            $("#tampil_kirimnot").html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i>Sedang Synch data (Kirim data barang ke server) ...</div>');
            $('#sed_data').hide();
            $.ajax({
                url: '<?= base_url('Synch_api/barang_kirim') ?>',
                method: 'get',
                chace: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        $("#tampil_kirimnot").html('<div class="callout callout-success"><i class="fa fa-check"></i>Successful send data to server ..</div>');
                        swal.fire({
                            title: 'Data Success di restore dari server',
                            text: "berhasil di restore",
                            icon: 'warning'
                        });
                    } else if (data.status == 2) {
                        swal.fire({
                            title: 'masalah dalam restore database',
                            text: "system sedang mengulang harap tunggu ...",
                            icon: 'warning'
                        });
                    }
                    $('#send_data').show();

                },
                error: function(data, xhr, error, Status) {
                    swal.fire({
                        title: 'gagal server tidak response',
                        text: "Status : " + error,
                        icon: 'warning'
                    });
                },
            });
        });
    });
</script>

<!-- synch transaction to serv -->
<script>
    $(function() {
        $('#send_transaksi').click(function(e) {
            e.preventDefault();
            $("#trkirim").html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i>Sedang Synch data (Kirim data barang ke server) ...</div>');
            $('#send_transaksi').hide();
            $.ajax({
                url: '<?= base_url('Synch_api/transaksi_kirim') ?>',
                method: 'get',
                chace: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        $("#trkirim").html('<div class="callout callout-success"><i class="fa fa-check"></i>Successful send data to server ..</div>');
                        swal.fire({
                            title: 'Data Success di restore dari server',
                            text: "berhasil di restore",
                            icon: 'warning'
                        });
                    } else if (data.status == 2) {
                        swal.fire({
                            title: 'masalah dalam restore database',
                            text: "system sedang mengulang harap tunggu ...",
                            icon: 'warning'
                        });
                    }
                    $('#send_transaksi').show();
                },
                error: function(data, xhr, error, Status) {
                    swal.fire({
                        title: 'gagal server tidak response',
                        text: "Status : " + error,
                        icon: 'warning'
                    });
                },
            });
        });
        //kirim data transaksi
        $('#receivetrf').click(function(e) {
            e.preventDefault();
            $('#receivetrf').hide();
            $("#trterima").html('<div class="callout callout-warning"><i class="fa fa-share fa-spin"></i></i>Sedang Synch data (Terima data barang dari server) ... </div>');

            $.ajax({
                url: '<?= base_url('synch_api/terima_transaksi') ?>',
                method: 'get',
                chace: false,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 1) {
                        $("#trterima").html('<div class="callout callout-success"><i class="fa fa-check"></i>Successful restore from db to local server .</div>');
                        swal.fire({
                            title: 'Data Success report penjualan berhasil di restore dari server',
                            text: "berhasil di restore",
                            icon: 'warning'
                        });
                    } else if (data.status == 2) {
                        swal.fire({
                            title: 'masalah dalam restore database',
                            text: "system sedang mengulang harap tunggu ...",
                            icon: 'warning'
                        });
                    }
                    $('#receivetrf').show();
                },
                error: function(data, xhr, error, Status) {
                    swal.fire({
                        title: 'gagal server tidak response',
                        text: "Status : " + status,
                        icon: 'warning'
                    });
                },
            });
        });
    });  
    // end synch 
</script>