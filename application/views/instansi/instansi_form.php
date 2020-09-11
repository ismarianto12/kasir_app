<div class="row">
  <div class="col-xs-12">
    <div class="info-box">

      <div class="box-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data""> 
       
        <div class=" form-group">
          <label for="varchar">IP addres Printer</label>
          <input type="text" class="form-control" name="ip_addres" id="ip_addres" placeholder="Masukan Nama Printer" value="<?php echo $ip_addres; ?>" />
        </div> 
       
       <div class=" form-group">
          <label for="varchar">Nama Aplikasi <?php echo form_error('nama_instansi') ?></label>
          <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" value="<?php echo $nama_instansi; ?>" />
      </div>
      <div class="form-group">
        <label for="alamat_lengkap">Alamat Lengkap <?php echo form_error('alamat_lengkap') ?></label>
        <textarea class="form-control" rows="3" name="alamat_lengkap" id="alamat_lengkap" placeholder="Alamat Lengkap"><?php echo $alamat_lengkap; ?></textarea>
      </div>
      <div class="form-group">
        <label for="alamat_lengkap">Keterangan Situs ** ) <?php echo form_error('keterangan_situs') ?></label>
        <textarea class="form-control" rows="3" name="keterangan_situs" id="keterangan_situs" placeholder="Keterangan Situs .."><?php echo $keterangan_situs; ?></textarea>
      </div>

      <div class="form-group">
        <label for="alamat_lengkap">Informasi Situs <smaall>Bagian ini akan tanpil di halaman daaboard </small> ** ) <?php echo form_error('informasi') ?></label>
        <textarea class="form-control" rows="3" name="informasi" id="informasi" placeholder="Keterangan Situs .."><?php echo $informasi; ?></textarea>
      </div>


      <div class="form-group">
        <label for="varchar">Telp <?php echo form_error('telp') ?></label>
        <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
      </div>
      <div class="form-group">
        <label for="varchar">Fax <?php echo form_error('fax') ?></label>
        <input type="text" class="form-control" name="fax" id="fax" placeholder="Fax" value="<?php echo $fax; ?>" />
      </div>
      <div class="form-group">
        <label for="varchar">Npwp <?php echo form_error('npwp') ?></label>
        <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" />
      </div>

      <div class="form-group">
        <label for="varchar">Nama Jabatan <?php echo form_error('nama_jabatan') ?></label>
        <input type="text" class="form-control" name="nama_pejabat" id="nama_pejabat" placeholder="Nama Atasan / Pimpinan .." value="<?php echo $nama_pejabat; ?>" />
      </div>

      <div class="form-group">
        <label for="varchar">Nip * ) jika ada <?php echo form_error('nip') ?></label>
        <input type="text" class="form-control" name="nip" id="nip" placeholder="Nip pegawai" value="<?php echo $nip; ?>" />
      </div>

      <div class="form-group">
        <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
        <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" />
      </div>


      <div class="form-group">
        <div class="tampil_gambar"><img src="<?= base_url('assets/img/' . $logo) ?>" class="img-responsive" id="image_upload_preview" style="width: 100px"></div>
        <br />
        <label for="varchar">Logo <?php echo form_error('logo') ?></label>
        <input type="file" class="form-control" name="logo" id="inputFile">
      </div>

      <div class="form-group">
        <div class="tampil_gambar"><img src="<?= base_url('assets/img/' . $favicon) ?>" class="img-responsive" id="image_upload_preview2" style="width: 100px"></div>
        <br />
        <label for="varchar">Favicon</label>
        <input type="file" class="form-control" name="favicon" id="inputFile2">
      </div>
      <button type="submit" class="btn btn-primary shiny"><i class='fa fa-save'></i><?php echo $button ?></button>
      <a href="<?php echo site_url('instansi') ?>" class="btn btn-warning shiny"><i class='fa fa-share'></i>Cancel</a>
      </form>

      </div>
    </div>
  </div>

      <script type="text/javascript">
        function readURL(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#image_upload_preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }

        function readURL2(input) {
          if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
              $('#image_upload_preview2').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
          }
        }

        $("#inputFile").change(function() {
          readURL(this);
        });

        $("#inputFile2").change(function() {
          readURL2(this);
        });
      </script>

