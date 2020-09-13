<?php

$string = "<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . $c . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        \$this->load->model('$m');
        \$this->load->library('form_validation');";

if ($jenis_tabel <> 'reguler_table') {
    $string .= "   \n\t\$this->load->library('datatables');";
}
        
$string .= "
    }";

if ($jenis_tabel == 'reguler_table') {
    
$string .= "\n\n    public function index()
    {
        \$q = urldecode(\$this->input->get('q', TRUE));
        \$start = intval(\$this->input->get('start'));
        
        if (\$q <> '') {
            \$config['base_url'] = base_url() . '$c_url/?q=' . urlencode(\$q);
            \$config['first_url'] = base_url() . '$c_url/?q=' . urlencode(\$q);
        } else {
            \$config['base_url'] = base_url() . '$c_url';
            \$config['first_url'] = base_url() . '$c_url';
        }

        \$config['per_page'] = 10;
        \$config['page_query_string'] = TRUE;
        \$config['total_rows'] = \$this->" . $m . "->total_rows(\$q);
        \$$c_url = \$this->" . $m . "->get_limit_data(\$config['per_page'], \$start, \$q);

        \$this->load->library('pagination');
        \$this->pagination->initialize(\$config);

        \$data = array(
            '" . $c_url . "_data' => \$$c_url,
            'q' => \$q,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
            'page_title'=>'Data ".strtoupper($c)."'
        );
        \$this->template->load('template','$c_url/$v_list', \$data);
    }";

} else {
    
$string .="\n\n    public function index()
    {
         \$x['page_title'] = 'Data : ".str_replace('_', ' ',ucfirst($c))."';
         \$this->template->load('template','$c_url/$v_list',\$x);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo \$this->" . $m . "->json();
    }";

}
    
$string .= "\n\n    public function detail(\$id) 
    {
        \$row = \$this->" . $m . "->get_by_id(\$id);
        if (\$row) {
            \$data = array(";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$row->" . $row['column_name'] . ",";
}
$string .= "\n\t    
'page_title'=>'Detail :  ".strtoupper($c)."',
);
            \$this->template->load('template','$c_url/$v_read', \$data);
        } else {
            \$this->session->set_flashdata('message', '<div class=\"alert alert-warniing fade-in\">Data Tidak Di Temukan.</div>');
            redirect(site_url('$c_url'));
        }
    }

    public function tambah() 
    {
        \$data = array(
            'page_title'=>'Tambah ".str_replace('_', ' ',ucfirst($c))."',
            'button' => 'Create',
            'action' => site_url('$c_url/tambah_data'),";
foreach ($all as $row) {
    $string .= "\n\t    '" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "'),";
}
$string .= "\n\t);
        \$this->template->load('template','$c_url/$v_form', \$data);
    }
    
    public function tambah_data() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->tambah();
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}
$string .= "\n\t    );

            \$this->".$m."->insert(\$data);
            \$this->session->set_flashdata('message', '<div class=\"alert alert-success fade-in\"><i class=\"fa fa-check\"></i>Data Berhasil Di Tambahkan.</div>');
            redirect(site_url('$c_url'));
        }
    }
    
    public function edit(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$data = array(
                'page_title'=>'Data ".strtoupper($c)."',
                'button' => 'Update',
                'action' => site_url('$c_url/edit_data'),";
foreach ($all as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => set_value('" . $row['column_name'] . "', \$row->". $row['column_name']."),";
}
$string .= "\n\t    );
             \$this->template->load('template','$c_url/$v_form', \$data);
        } else {
            \$this->session->set_flashdata('message', '<div class=\"alert alert-info fade-in\">Data Tidak Di Temukan.</div>');
            redirect(site_url('$c_url'));
        }
    }
    
    public function edit_data() 
    {
        \$this->_rules();

        if (\$this->form_validation->run() == FALSE) {
            \$this->edit(\$this->input->post('$pk', TRUE));
        } else {
            \$data = array(";
foreach ($non_pk as $row) {
    $string .= "\n\t\t'" . $row['column_name'] . "' => \$this->input->post('" . $row['column_name'] . "',TRUE),";
}    
$string .= "\n\t    );

            \$this->".$m."->update(\$this->input->post('$pk', TRUE), \$data);
            \$this->session->set_flashdata('message', '<div class=\"alert alert-success fade-in\"><i class=\"fa fa-check\"></i>Edit Data Berhasil.</div>');
            redirect(site_url('$c_url'));
        }
    }
    
    public function hapus(\$id) 
    {
        \$row = \$this->".$m."->get_by_id(\$id);

        if (\$row) {
            \$this->".$m."->delete(\$id);
            \$this->session->set_flashdata('message', '<div class=\"alert alert-danger fade-in\"><i class=\"fa fa-check\"></i>Data Berhasil Di Hapus</div>');
            redirect(site_url('$c_url'));
        } else {
            \$this->session->set_flashdata('message', '<div class=\"alert alert-warniing fade-in\">Ops Something Went Wrong Please Contact Administrator.</div>');
            redirect(site_url('$c_url'));
        }
    }

    public function _rules() 
    {";
foreach ($non_pk as $row) {
    $int = $row3['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? '|numeric' : '';
    $string .= "\n\t\$this->form_validation->set_rules('".$row['column_name']."', '".  strtolower(label($row['column_name']))."', 'trim|required$int');";
}    
$string .= "\n\n\t\$this->form_validation->set_rules('$pk', '$pk', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($export_excel == '1') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table_name.xls\";
        \$page_title = \"$table_name\";
        \$tablehead = 0;
        \$tablebody = 1;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"No\");";
foreach ($non_pk as $row) {
        $column_name = label($row['column_name']);
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$column_name\");";
}
$string .= "\n\n\tforeach (\$this->" . $m . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
foreach ($non_pk as $row) {
        $column_name = $row['column_name'];
        $xlsWrite = $row['data_type'] == 'int' || $row['data_type'] == 'double' || $row['data_type'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$column_name);";
}
$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($export_word == '1') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table_name.doc\");

        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
         \$this->load->view('template','" . $c_url ."/". $v_doc . "',\$data);
    }";
}

if ($export_pdf == '1') {
    $string .= "\n\n    function pdf()
    {
        \$data = array(
            '" . $table_name . "_data' => \$this->" . $m . "->get_all(),
            'start' => 0
        );
        
        ini_set('memory_limit', '32M');
        \$html = \$this->load->view('" . $c_url ."/". $v_pdf . "', \$data, true);
        \$this->load->library('pdf');
        \$pdf = \$this->pdf->load();
        \$pdf->WriteHTML(\$html);
        \$pdf->Output('" . $table_name . ".pdf', 'D'); 
    }";
}

$string .= "\n\n}\n\n";
$hasil_controller = createFile($string, $target . "controllers/" . $c_file);

?>