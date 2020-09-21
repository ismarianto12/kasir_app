<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-info'>
            <div class='panel-heading'><i class="icon-user"></i> Edit Profil</div>
            <div class='panel-wrapper collapse in' aria-expanded='true'>
                <div class='panel-body'>
                    <form id="cupdate" enctype="multipart/form-data" class='form-horizontal' method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $this->session->id_user; ?>" />
                        <div class='form-body'>
                            <h3 class='box-title'>Edit Profil</h3>
                            <hr class='m-t-0 m-b-40'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='control-label col-md-3'>Username </label>
                                        <div class='col-md-9'>
                                            <input type='text' name="username" id="username" class='form-control' placeholder='Username' value="<?= $username ?>"></div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='control-label col-md-3'>Password </label>
                                        <div class='col-md-9'>
                                            <input type='password' name="password" id="password" class='form-control' placeholder='Password..'></div>
                                    </div>
                                </div>

                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='control-label col-md-3'>Ulangi Password</label>
                                        <div class='col-md-9'>
                                            <input type='password' name="password_ul" id="password_ul" class='form-control' placeholder='Password..'></div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='form-group'>
                                        <label class='control-label col-md-3'>Nama </label>
                                        <div class='col-md-9'>
                                            <input type='text' name="nama" id="nama" class='form-control' placeholder='Password..' value="<?= $nama ?>"></div>
                                    </div>
                                </div>

                            </div>
                            <!--/row-->
                            
                            </div>
                            <hr class='m-t-0 m-b-40'>
                        </div>
                        <div class='form-actions'>
                            <div class='row'>
                                <div class='col-md-6'>
                                    <div class='row'>
                                        <div class='col-md-offset-3 col-md-9'>
                                            <button type='submit' class="simpan" class='btn btn-success'>Simpan Data</button>
                                            <button type='button' class='btn btn-default'>Cancel</button>
                                            <br />
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-6'> </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
  
        $('#cupdate').submit(function(e) {
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();
            var password_ul = $('#password_ul').val();
            var nama = $('#nama').val();
            var email = $('#email').val();
            //   var foto = $('#foto').val();
            if (username == '') {
                swal.fire('Keterangan', 'Username tidak boleh kosong', 'error');
            } else if (password == '') {
                swal.fire('Keterangan', 'Password tidak boleh kosong', 'error');
            } else if (password_ul == '') {
                swal.fire('Keterangan', 'Ulangi Password tidak boleh kosong', 'error');
            } else if (password != password_ul) {
                swal.fire('Keterangan', 'password tidak sama silahkan ulangi', 'error');
            } else if (nama == '') {
                swal.fire('Keterangan', 'Nama tidak boleh kosong', 'error');
            } else if (email == '') {
                swal.fire('Keterangan', 'email tidak boleh kosong', 'error');
            } else {

                var datastring = $(this).serialize();
                $.ajax({
                    url: '<?= base_url('profile/action_insert') ?>',
                    type: 'post',
                    data: datastring,
                    cache: false,
                    beforeSend: function() {
                        $('#cupdate').attr("disabled", "disabled");
                        $('#cupdate').css("opacity", ".5");
                    },
                    success: function(data) {
                        swal.fire('Keterangan', 'Data username dan password berhasil di update', 'success');
                        $('#cupdate').css("opacity", "");
                        $("#cupdate").removeAttr("disabled");
                    },
                    error: function(data) {
                        swal.fire('Keterangan', 'Data username dan password gagal di update', 'warning');
                    }
                });
            }
        });
    });
</script>