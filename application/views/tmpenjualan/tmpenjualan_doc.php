 
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
		<th>Date Created</th>
		<th>Date Updated</th>
		
            </tr><?php
            foreach ($tmpenjualan_data as $tmpenjualan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tmpenjualan->no_penjualan ?></td>
		      <td><?php echo $tmpenjualan->kasir_id ?></td>
		      <td><?php echo $tmpenjualan->barang_id ?></td>
		      <td><?php echo $tmpenjualan->member_id ?></td>
		      <td><?php echo $tmpenjualan->jumlah ?></td>
		      <td><?php echo $tmpenjualan->date_created ?></td>
		      <td><?php echo $tmpenjualan->date_updated ?></td>	
                </tr>
                <?php
            }
            ?>
        