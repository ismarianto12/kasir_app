<?php 
$string = "<section class=\"content\">
<div class=\"row clearfix\">
    <div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
        <div class=\"card\">
            <div class=\"header\"> 
             <h2><?= ucfirst(\$page_title) ?></h2> 
             </div>
            <div class=\"body\" style=\"overflow: auto;\"> 
                <div class='row'>
                    <div class='col-sm-12'>  
                    <?= \$this->session->flashdata('message') ?>
                        <div class=\'white-box\'>
                            <h3 class=\'box-title m-b-0\'>".strtoupper($page_title)."</h3>
                        <form action=\"<?php echo \$action; ?>\" method=\"post\" class='form-horizontal form-bordered'>
    <div class='form-body'> 
     ** ) Harap Isikan data yang di butuhkan pada form.
     <br /><br /><br /><br /> ";
   foreach ($non_pk as $row) {
    if ($row["data_type"] == 'text')
    {
    $string .= "\n\t    <div class=\"form-group\">
            <label for=\"".$row["column_name"]."\" class='control-label col-md-3'><b>".label($row["column_name"])."<?php echo form_error('".$row["column_name"]."') ?></b></label>

             <div class='col-md-9'>
            <textarea class=\"form-control\" rows=\"3\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\"><?php echo $".$row["column_name"]."; ?></textarea>
        </div>
    </div>";
    } else
    {
    $string .= "\n\t <div class=\"form-group\">
            <label for=\"".$row["data_type"]."\" class='control-label col-md-3'><b>".label($row["column_name"])."<?php echo form_error('".$row["column_name"]."') ?></b></label>
            <div class='col-md-9'>
            <input type=\"text\" class=\"form-control\" name=\"".$row["column_name"]."\" id=\"".$row["column_name"]."\" placeholder=\"".label($row["column_name"])."\" value=\"<?php echo $".$row["column_name"]."; ?>\" />
        </div>
    </div>";
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$pk."\" value=\"<?php echo $".$pk."; ?>\" /> ";
$string .= "\n\t   

<div class='form-actions'>
    <div class='row'>
        <div class='col-md-12'>
            <div class='row'>
                <div class='col-md-offset-3 col-md-9'>
 <button type=\"submit\" class=\"btn btn-info\"><i class='fa fa-check'></i><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"<?php echo site_url('".$c_url."') ?>\" class=\"btn btn-default\"><i class='fa fa-share'></i>Cancel</a>";
$string .= "\n\t

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
";

$hasil_view_form = createFile($string, $target."views/" . $c_url . "/" . $v_form_file);

?>