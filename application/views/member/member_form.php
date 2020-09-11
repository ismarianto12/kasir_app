<section class="content">
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2><?= ucfirst($page_title) ?></h2>
                </div>
                <div class="body">
                    <div class='row'>
                        <div class='col-sm-12'>
                            <div class='white-box'>
                                <h3 class='box-title m-b-0'></h3>
                                <form action="<?php echo $action; ?>" method="post" class='simpan form-horizontal form-bordered'>
                                    <div class='form-body'>
                                        <div class="form-group">
                                            <label for="varchar" class='control-label col-md-3'><b>Kode<?php echo form_error('kode') ?></b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="kode" id="kode" placeholder="Kode" value="<?php echo $kode; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="varchar" class='control-label col-md-3'><b>Nama<?php echo form_error('nama') ?></b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat" class='control-label col-md-3'><b>Alamat<?php echo form_error('alamat') ?></b></label>

                                            <div class='col-md-9'>
                                                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="ttl" class='control-label col-md-3'><b>Ttl<?php echo form_error('ttl') ?></b></label>

                                            <div class='col-md-9'>
                                                <textarea class="form-control" rows="3" name="ttl" id="ttl" placeholder="Ttl"><?php echo $ttl; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="enum" class='control-label col-md-3'><b>Jk<?php echo form_error('jk') ?></b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="jk" id="jk" placeholder="Jk" value="<?php echo $jk; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="enum" class='control-label col-md-3'><b>Active<?php echo form_error('active') ?></b></label>
                                            <div class='col-md-9'>
                                                <input type="text" class="form-control" name="active" id="active" placeholder="Active" value="<?php echo $active; ?>" />
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />


                                        <div class='form-actions'>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <div class='row'>
                                                        <div class='col-md-offset-3 col-md-9'>
                                                            <button type="submit" class="simpan btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button>
                                                            <a href="#" id="cancel" class="btn btn-danger"><i class='fa fa-check'></i>Batal</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    $(function() {
        $('.simpan').submit(function(e) {
            e.preventDefault();
            var action = $(this).attr('action');
            $.ajax({
                url: action,
                data: $(this).serialize(),
                method: "post",
                chace: false,
                dataType: 'json',
                success: function(data) {
                    if (data.type == 1) {
                        $('#datatables').DataTable().ajax.reload();
                        $('#show_form').hide();
                    } else {
                        swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: data.msg
                        });
                    }
                },
                error: function(data) {
                    swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        });

        $('#cancel').click(function(e) {
            e.preventDefault();
            $('#show_form').hide().slideUp();
        });
    });
</script>