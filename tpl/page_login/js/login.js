$(function () {
	$('#form_login').submit(function (event) {
		event.preventDefault();
		$('#notifikasi').html('<div class="alert alert-info"><i class="fa fa-close"></i>Mohon bersabar Sedang memproses login ..</div>');

		username = $('input[name="username"]').val();
		password = $('input[name="password"]').val();
		if (username == '') {
			$('#notifikasi').html('<div class="alert alert-danger"><i class="fa fa-close"></i>Username Tidak Boleh Kosong</div>');
		} else if (password == '') {
			$('#notifikasi').html('<div class="alert alert-warning"><i class="fa fa-close"></i>Password Tidak Boleh Kosong</div>');
		} else {
			$.ajax({
				url: base_url() + '/login/login',
				type: 'POST',
				dataType: 'json',
				data: {
					username: username,
					password: password
				},
				success: function (data) {
					if (data.response == 'ok') {
						window.location.href = base_url() + 'home?page=success';
					} else {
						swal.fire('info', 'Username dan pasword salah', 'error');
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					alert('GAgal');
				}
			});
		}

	});

});
