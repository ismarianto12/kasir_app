<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if ($this->session->flashdata('berhasil')) { ?>
	<script type="text/javascript">
		swal.fire({
			icon: 'success',
			title: 'Berhasil',
			text: '<?= $this->session->flashdata('berhasil') ?>',
			type: 'success',
			//timer: 3000,
			closeOnClickOutside: false,
		});	
	</script>	
	<?php }elseif($this->session->flashdata('informasi')){ ?>
		<script type="text/javascript">
		swal.fire({
			icon: 'info',
			title: 'Informasi',
			text: '<?= $this->session->flashdata('informasi') ?>',
			type: 'info',
			//timer: 3000,
			closeOnClickOutside: false,
		});	
	</script>	
	<?php }elseif($this->session->flashdata('gagal')){ ?>
		<script type="text/javascript">
		swal.fire({
			icon: 'error',
			title: 'Gagal',
			text: '<?= $this->session->flashdata('gagal') ?>',
			type: 'error',
			//timer: 3000,
			closeOnClickOutside: false,
		});	
	</script>	
	<?php } ?>
