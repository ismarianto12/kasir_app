 
    <body>
        <h2>Trtransaksi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No Penjualan</th>
		<th>Kasir Id</th>
		<th>Barang Id</th>
		<th>Member Id</th>
		<th>Price</th>
		<th>Item Name</th>
		<th>Jumlah</th>
		<th>Diskon</th>
		<th>Date Updated</th>
		<th>Date Created</th>
		
            </tr><?php
            foreach ($trtransaksi_data as $trtransaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trtransaksi->no_penjualan ?></td>
		      <td><?php echo $trtransaksi->kasir_id ?></td>
		      <td><?php echo $trtransaksi->barang_id ?></td>
		      <td><?php echo $trtransaksi->member_id ?></td>
		      <td><?php echo $trtransaksi->price ?></td>
		      <td><?php echo $trtransaksi->item_name ?></td>
		      <td><?php echo $trtransaksi->jumlah ?></td>
		      <td><?php echo $trtransaksi->diskon ?></td>
		      <td><?php echo $trtransaksi->date_updated ?></td>
		      <td><?php echo $trtransaksi->date_created ?></td>	
                </tr>
                <?php
            }
            ?>
        