 
    <body>
        <h2>Member List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kode</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>Ttl</th>
		<th>Jk</th>
		<th>Active</th>
		<th>User Id</th>
		<th>Date Created</th>
		<th>Date Updated</th>
		
            </tr><?php
            foreach ($member_data as $member)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $member->kode ?></td>
		      <td><?php echo $member->nama ?></td>
		      <td><?php echo $member->alamat ?></td>
		      <td><?php echo $member->ttl ?></td>
		      <td><?php echo $member->jk ?></td>
		      <td><?php echo $member->active ?></td>
		      <td><?php echo $member->user_id ?></td>
		      <td><?php echo $member->date_created ?></td>
		      <td><?php echo $member->date_updated ?></td>	
                </tr>
                <?php
            }
            ?>
        