<?php
function helper_log($tipe = "", $str = ""){
    $CI =& get_instance();
 
    if (strtolower($tipe) == "login"){
        $log_tipe   = 0;
    }
    elseif(strtolower($tipe) == "logout")
    {
        $log_tipe   = 1;
    }
    elseif(strtolower($tipe) == "tambah"){
        $log_tipe   = 2;
    }
    elseif(strtolower($tipe) == "ubah"){
        $log_tipe  = 3;
    }
    elseif(strtolower($tipe) == "hapus"){
        $log_tipe  = 4;
    }    
    else{
        $log_tipe  = 5;
    }
 
    // paramter
    $param['id_login']     = $CI->session->userdata('id_login');
    $param['tipe_log']     = $log_tipe;
    $param['ket_log']      = $str;
 
    //load model log
    $CI->load->model('m_log');
 
    //save to database
    $CI->m_log->save_log($param);
 
}
?>