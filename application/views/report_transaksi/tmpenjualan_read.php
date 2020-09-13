 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>No Penjualan</td><td><?php echo $no_penjualan; ?></td></tr>
	    <tr><td>Kasir Id</td><td><?php echo $kasir_id; ?></td></tr>
	    <tr><td>Barang Id</td><td><?php echo $barang_id; ?></td></tr>
	    <tr><td>Member Id</td><td><?php echo $member_id; ?></td></tr>
	    <tr><td>Jumlah</td><td><?php echo $jumlah; ?></td></tr>
	    <tr><td>Diskon</td><td><?php echo $diskon; ?></td></tr>
	    <tr><td>Price</td><td><?php echo $price; ?></td></tr>
	    <tr><td>Item Name</td><td><?php echo $item_name; ?></td></tr>
	    <tr><td>Date Created</td><td><?php echo $date_created; ?></td></tr>
	    <tr><td>Date Updated</td><td><?php echo $date_updated; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('report_transaksi') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>