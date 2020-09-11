<div class="box">
    <div class="box-header with-border">
        <h3><i class="fa fa-list"></i> Data Master Modul Aplikasi</h3>
    </div>
    <div class="box-body">
        <div class='row'>
            <div class='col-sm-12'>
                <?= $this->session->flashdata('message') ?>
                <div class='white-box'>
                    <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
                        <div class='form-body'>
                            <div class="form-group">
                                <label for="varchar" class='control-label col-md-3'><b>Nama Menu<?php echo form_error('modulnm') ?></b></label>
                                <div class='col-md-9'>
                                    <input type="text" class="form-control" name="modulnm" id="modulnm" placeholder="Modulnm" value="<?php echo $modulnm; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="varchar" class='control-label col-md-3'><b>Url<?php echo form_error('url') ?></b></label>
                                <div class='col-md-9'>
                                    <select class="form-control" name="url">
                                        <?= $this->properti->get_access(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="varchar" class='control-label col-md-3'><b>Params<?php echo form_error('params') ?></b></label>
                                <div class='col-md-9'>
                                    <input type="text" class="form-control" name="params" id="params" placeholder="Params" value="<?php echo $params; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="enum" class='control-label col-md-3'><b>Active<?php echo form_error('active') ?></b></label>
                                <div class='col-md-9'>
                                    <select name="active" id="active" class="form-control">
                                        <?php
                                        $ls = ['Y' => 'Active', 'N' => 'Non Active'];
                                        foreach ($ls as $dt => $vals) {
                                            $checked = ($dt == $active) ? 'selected' : '';
                                        ?>
                                            <option value="<?= $dt ?>" <?= $checked ?>><?= $vals ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <div class='form-actions'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='row'>
                                            <div class='col-md-offset-3 col-md-9'>
                                                <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button>
                                                <a href="<?php echo site_url('tmmodul') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


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