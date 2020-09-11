<!-- Main content -->
<section class="content">
    <div class="box">
        <ol class="breadcrumb bg-white">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><i class="fa <?php echo $faicon; ?>"></i> <?php echo $title; ?></li>
        </ol>
    </div>
    <?php if ($this->session->level == 'manager' or $this->session->level == 'administrator') {  ?>
        <span class="callout callout-info">Silahkan cek terlebih dahulu karyawan yang belum di gaji .</span>

    <?php } else {  ?>
        <span class="callout callout-info">Jika detail data kosong silahkan hubungi manager penggajain</span>
    <?php
    }
    foreach ($info_penggajian as $row) {
    ?>
        <div class="box border">
            <div class="box-header with-border">
                <h5 class="box-title"><i class="fa fa-info"></i> Info Penggajian</h5>
            </div>
            <div class="box-body">
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="tanggal"><b>ID : </b></label>
                        <div class="input-group">
                            <div class="input-group-addon">ID</div>
                            <input type="text" class="form-control" id="tanggal" value="<?php echo $row->id_penggajian; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="keterangan"><b>BULAN/TGL.PENGGAJIAN :</b></label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control" id="keterangan" value="<?php echo $row->bulan;
                                                                                            echo " - ";
                                                                                            echo date('d/m/Y', strtotime($row->tgl_penggajian)); ?>" readonly>
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

                <?php foreach ($cek_status_button as $cek) {
                    if ($cek->cek == null) { ?>
                        <a class="btn btn-sm btn-warning pull-right disabled" href="#" data-target="" data-toggle="modal">
                            <i class="fa fa-fw fa-clock-o"></i> Menunggu
                        </a>
                    <?php } elseif ($cek->total_status != $cek->status_selesai && $cek->status == '0') { ?>
                        <a class="btn btn-sm btn-warning pull-right disabled" href="#" data-target="" data-toggle="modal">
                            <i class="fa fa-fw fa-clock-o"></i> Menunggu
                        </a>
                    <?php } elseif ($cek->total_status == $cek->status_selesai && $cek->status == '1' && $cek->cek != null) { ?>
                        <a class="btn btn-sm btn-success pull-right" href="#" data-target="" data-toggle="modal">
                            <i class="fa fa-fw fa-print"></i> Cetak
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo base_url(); ?>penggajian/lock_srp/<?php echo $cek->id_penggajian; ?>" title="Selesai" class="btn btn-sm btn-success pull-right" onclick="return confirm('Anda Yakin Selesaikan Semua ?')"><i class="fa fa-fw fa-check"></i> Selesai</a>
                <?php }
                } ?>


            </div>
        </div>

        <div class="box-body">
            <table id="tabledatapemasok" class="table table-bordered table-hover dt-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center bg-primary text-white">NO.</th>
                        <th class="text-center bg-primary text-white">ID</th>
                        <th class="text-center bg-primary text-white">NAMA KARYAWAN</th>
                        <th class="text-center bg-primary text-white">GAJI POKOK</th>
                        <th class="text-center bg-primary text-white">TUNJANGAN</th>
                        <th class="text-center bg-primary text-white">TOTAL</th>

                        <?php if ($this->session->level == 'manager' or $this->session->level  == 'administrator') {  ?>

                            <th class="text-center bg-primary text-white">STATUS</th>
                            <th class="text-center bg-primary text-white">ACTION</th>
                        <?php } else {  ?>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_rincian_penggajian as $row) {
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $row->id_karyawan; ?></td>
                            <td class="text-center"><?php echo $row->nm_karyawan; ?></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->gaji_pokok); ?></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->tunjangan); ?></td>
                            <td class="text-center"><?php echo "Rp." . number_format($row->total_terima); ?></td>

                            <?php if ($this->session->level == 'manager' or $this->session->level == 'administrator') {  ?>

                                <td class="text-center">
                                    <?php if ($row->status == '0') { ?>
                                        <small class="label bg-yellow"><i class="fa fa-clock-o"></i> Menunggu</small>
                                    <?php } elseif ($row->status == '1') { ?>
                                        <small class="label bg-green"><i class="fa fa-check"></i> Diterima</small>
                                    <?php } else { ?>
                                        <small class="label bg-red"><i class="fa fa-times"></i> Error</small>
                                    <?php } ?>
                                </td>

                                <td class="text-center">
                                    <?php if ($row->status == '0') { ?>
                                        <div class="btn-group">
                                            <a href="<?php echo base_url(); ?>penggajian/kunci_rincian_penggajian/<?php echo $row->id_rincian; ?>/<?php echo $row->id_penggajian; ?>" title="Selesai" class="btn btn-success btn-sm" onclick="return confirm('Anda Yakin Penambahan Selesai ?')"><i class="fa fa-check"></i> </a>
                                        </div>
                                    <?php } elseif ($row->status == '1') { ?>
                                        <a href="<?php echo base_url(); ?>penggajian/cetak_rincian_gaji/<?php echo $row->id_penggajian; ?>" title="Cetak Rincian" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak</a>
                                    <?php } else { ?>
                                        <span class="badge badge-danger"><i class="fa fa-warning"></i> Error</span>
                                    <?php } ?>
                                </td>

                            <?php } else {  ?>

                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-right" colspan="5"><b>TOTAL :</b></td>
                        <td class="text-center"><b><?php $sum = 0;
                                                    foreach ($data_rincian_penggajian as $row) {
                                                        $data = $row->total_terima;
                                                        $sum += $data;
                                                    }
                                                    echo "Rp." . number_format($sum); ?></b></td>
                        <td class="text-center"></td>
                    </tr>
                </tfoot>
            </table>

            <a href="<?= base_url('penggajian') ?>" class="btn btn-primary btn-xs"><i class="fa fa-share"></i>Kembali</a>
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