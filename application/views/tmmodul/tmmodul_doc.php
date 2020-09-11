 
    <body>
        <h2>Tmmodul List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Modulnm</th>
		<th>Url</th>
		<th>Params</th>
		<th>Active</th>
		<th>User Id</th>
		<th>Date Created</th>
		<th>Date Updated</th>
		
            </tr><?php
            foreach ($tmmodul_data as $tmmodul)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tmmodul->modulnm ?></td>
		      <td><?php echo $tmmodul->url ?></td>
		      <td><?php echo $tmmodul->params ?></td>
		      <td><?php echo $tmmodul->active ?></td>
		      <td><?php echo $tmmodul->user_id ?></td>
		      <td><?php echo $tmmodul->date_created ?></td>
		      <td><?php echo $tmmodul->date_updated ?></td>	
                </tr>
                <?php
            }
            ?>
        