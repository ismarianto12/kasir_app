<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>
    Login Apss </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?= base_url('tpl/page_login') ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url('tpl/page_login') ?>/css/login.css">
  <script src="<?= base_url() ?>/tpl/adminlte2/bower_components/jquery/dist/jquery.min.js"></script>
  <link href="<?= base_url('assets/css/sweet-alert.css') ?>" rel="stylesheet" />
  <script src="<?= base_url() ?>/tpl/adminlte2/plugins/sweetalert/sweetalert2@9.js"></script>


  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
</head>
<script>
  function base_url() {
    return ' <?= base_url() ?>';
  }
</script>
<script src="<?= base_url('tpl/page_login/js/login.js') ?>"></script>

<body>
  <div class="main-content-wrapper">
    <div class="image-area">
    </div>
    <div class="login-area">
      <div class="login-header">
        <h4><?= ucfirst($this->properti->identitas('nama_instansi')) ?></h4>
        <h2 class="title">POST - PAYMENT </h2>
      </div>
      <div class="login-content">
        <form method="post" id="form_login">
          <div class="form-group">
            <input type="text" class="input-field" name="username" placeholder="Username" required autocomplete="off">
          </div>
          <div class="form-group">
            <input type="password" class="input-field" name="password" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-primary" name="login" id="form_login">Login<i class="fa fa-lock"></i></button>
        </form>
        <div class="login-bottom-links">
          <a href="/reset_pass" style="color:#fff">Lupa Password ? </a>
        </div>
      </div>
    </div>

  </div>
</body>

</html>