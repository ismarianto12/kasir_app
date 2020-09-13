<section class="content">
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header"> 
             <h2><?= ucfirst($page_title) ?></h2> 
             </div>
            <div class="body" style="overflow: auto;"> 
                <div class='row'>
                    <div class='col-sm-12'>  
                    <?= $this->session->flashdata('message') ?>
                        <div class=\'white-box\'>
                            <h3 class=\'box-title m-b-0\'></h3>
                        <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
    <div class='form-body'> 
     ** ) Harap Isikan data yang di butuhkan pada form.
     <br /><br /><br /><br /> 
	 <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>No Penjualan<?php echo form_error('no_penjualan') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="no_penjualan" id="no_penjualan" placeholder="No Penjualan" value="<?php echo $no_penjualan; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Kasir Id<?php echo form_error('kasir_id') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="kasir_id" id="kasir_id" placeholder="Kasir Id" value="<?php echo $kasir_id; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="char" class='control-label col-md-3'><b>Barang Id<?php echo form_error('barang_id') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="barang_id" id="barang_id" placeholder="Barang Id" value="<?php echo $barang_id; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Member Id<?php echo form_error('member_id') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="member_id" id="member_id" placeholder="Member Id" value="<?php echo $member_id; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="bigint" class='control-label col-md-3'><b>Price<?php echo form_error('price') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Item Name<?php echo form_error('item_name') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item Name" value="<?php echo $item_name; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="bigint" class='control-label col-md-3'><b>Jumlah<?php echo form_error('jumlah') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="int" class='control-label col-md-3'><b>Diskon<?php echo form_error('diskon') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Diskon" value="<?php echo $diskon; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="enum" class='control-label col-md-3'><b>Finish<?php echo form_error('finish') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="finish" id="finish" placeholder="Finish" value="<?php echo $finish; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="datetime" class='control-label col-md-3'><b>Date Updated<?php echo form_error('date_updated') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="date_updated" id="date_updated" placeholder="Date Updated" value="<?php echo $date_updated; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="datetime" class='control-label col-md-3'><b>Date Created<?php echo form_error('date_created') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="date_created" id="date_created" placeholder="Date Created" value="<?php echo $date_created; ?>" />
        </div>
    </div>
	 <div class="form-group">
            <label for="varchar" class='control-label col-md-3'><b>Subtotal<?php echo form_error('subtotal') ?></b></label>
            <div class='col-md-9'>
            <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo $subtotal; ?>" />
        </div>
    </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	   

<div class='form-actions'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='row'>
                <div class='col-md-offset-3 col-md-9'>
 <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button> 
	    <a href="<?php echo site_url('report_transaksi') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>
	

       </div>
    </div>
   </div>
 </div>
 </div>
</form>
</div>
</div>
</div>
</div>
</div>
