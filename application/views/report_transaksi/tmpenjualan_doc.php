 
    <body>
        <h2>Tmpenjualan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>No Penjualan</th>
		<th>Kasir Id</th>
		<th>Barang Id</th>
		<th>Member Id</th>
		<th>Jumlah</th>
		<th>Diskon</th>
		<th>Price</th>
		<th>Item Name</th>
		<th>Date Created</th>
		<th>Date Updated</th>
		
            </tr><?php
            foreach ($report_transaksi_data as $report_transaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $report_transaksi->no_penjualan ?></td>
		      <td><?php echo $report_transaksi->kasir_id ?></td>
		      <td><?php echo $report_transaksi->barang_id ?></td>
		      <td><?php echo $report_transaksi->member_id ?></td>
		      <td><?php echo $report_transaksi->jumlah ?></td>
		      <td><?php echo $report_transaksi->diskon ?></td>
		      <td><?php echo $report_transaksi->price ?></td>
		      <td><?php echo $report_transaksi->item_name ?></td>
		      <td><?php echo $report_transaksi->date_created ?></td>
		      <td><?php echo $report_transaksi->date_updated ?></td>	
                </tr>
                <?php
            }
            ?>
        