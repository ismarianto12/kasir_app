<?php

/*developed by ismarianto putra
  you can visit my site in ismarianto.com
  for more complain anda more information.  
*/

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Instansi extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Instansi_model');
    $this->load->library('form_validation');
    $this->load->library('datatables');
  }

  public function index()
  {
    $sql = $this->Instansi_model->tampil_data();
    if ($sql->num_rows() > 0) {
      $row = $sql->row();
      $nama_instansi = $row->nama_instansi;
      $ip_addres = $row->ip_addres;
      $alamat_lengkap = $row->alamat_lengkap;
      $telp = $row->telp;
      $informasi = $row->informasi;
      $keterangan_situs = $row->keterangan_situs;
      $fax = $row->fax;
      $npwp = $row->npwp;
      $logo = $row->logo;
      $nip  = $row->nip;
      $favicon = $row->favicon;
      $nama_pejabat  = $row->nama_pejabat;
      $jabatan = $row->jabatan;
    } else {

      $nama_instansi = '';
      $alamat_lengkap = '';
      $telp = '';
      $informasi = '';
      $keterangan_situs = '';
      $fax = '';
      $npwp = '';
      $nip = '';
      $logo = '';
      $favicon = '';
      $nama_pejabat = '';
      $jabatan = '';
    }
    $data = array(
      'page_title' => 'Identitas Aplikasi',
      'button' => 'Update',
      'action' => site_url('instansi/edit_data'),
      'keterangan_situs' => set_value('keterangan_situs', $keterangan_situs),
      'nama_instansi' => set_value('nama_instansi', $nama_instansi),
      'alamat_lengkap' => set_value('alamat_lengkap', $alamat_lengkap),
      'telp' => set_value('telp', $telp),
      'fax' => set_value('fax', $fax),
      'informasi' => set_value('informasi', $informasi),
      'npwp' => set_value('npwp', $npwp),
      'logo' => set_value('logo', $logo),
      'favicon' => set_value('favicon', $favicon),
      'nama_pejabat' => set_value('nama_pejabat', $nama_pejabat),
      'jabatan' => set_value('jabatan', $jabatan),
      'nip' => set_value('nip', $nip),

    );
    $this->template->load('Template', 'instansi/instansi_form', $data);
  }

  public function json()
  {
    header('Content-Type: application/json');
    echo $this->Instansi_model->json();
  }

  public function detail($id)
  {
    $row = $this->Instansi_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_instansi' => $row->id_instansi,
        'nama_instansi' => $row->nama_instansi,
        'alamat_lengkap' => $row->alamat_lengkap,
        'keterangan_situs' => $row->keterangan_situs,
        'informasi' => $row->informasi,
        'telp' => $row->telp,
        'nip' => $row->nip,
        'fax' => $row->fax,
        'npwp' => $row->npwp,
        'logo' => $row->logo,
        'page_title' => 'Detail :  Instansi',
      );
      $this->template->load('Template', 'instansi/instansi_read', $data);
    } else {
      $this->session->set_flashdata('message', '<div class="callout callout-warniing fade-in">Data Tidak Di Temukan.</div>');
      redirect(site_url('instansi'));
    }
  }


  public function edit_data()
  {

    $cek = $this->db->select('*')->from('instansi')->get();
    if ($cek->num_rows() != 0) {
      $this->_rules();
      if ($this->form_validation->run() == FALSE) {
           $this->index($this->input->post('', TRUE));
      } else {

        if ($_FILES['logo']['name'] == '' and $_FILES['favicon']['name'] == '') {

          $data = array(
            'nama_instansi' => $this->input->post('nama_instansi', TRUE),
            'keterangan_situs' => $this->input->post('keterangan_situs', TRUE),
            'alamat_lengkap' => $this->input->post('alamat_lengkap', TRUE),
            'telp' => $this->input->post('telp', TRUE),
            'fax' => $this->input->post('fax', TRUE),
            'informasi' => $this->input->post('informasi', TRUE),
            'npwp' => $this->input->post('npwp', TRUE),
            'nip' => $this->input->post('nip', TRUE),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),
          );
          $this->db->update('instansi', $data);
          $this->session->set_flashdata('message', '<div class="callout callout-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
          redirect(site_url('instansi'));
        } else {

          $conf['allowed_types'] = 'jpg|png|ico|bmp';
          $conf['upload_path'] = 'assets/img/';
          $conf['file_name']   = time() . 'logo';

          $this->upload->initialize($conf);

          $error = array();
          $gambar = array();
          foreach ($_FILES as $field_name => $file) {
            if (!$this->upload->do_upload($field_name)) {
              $error[] = $this->upload->display_errors();
            } else {
              $gambar0 = $this->upload->data();
              $gambar[] = $gambar0['file_name'];
            }
          }

          $nilai1 = $gambar[0] ? $gambar[0] : '';
          $nilai2 = $gambar[1] ? $gambar[1] : '';
          $row = $this->db->get('instansi');
          if ($nilai1 != '') {

            unlink('assets/img/' . $row->logo);
          } elseif ($nilai2 != '') {
            # code...
            unlink('assets/img/' . $row->favicon);
          } elseif ($nilai1 != '' and $nilai2 != '') {
            unlink('assets/img/' . $row->logo);
            unlink('assets/img/' . $row->favicon);
          } else {
          }

          if ($nilai1 != '') {
            $hasil_gambar1 = array('logo' => $nilai1);
          } else {
            $hasil_gambar1 = array();
          }
          if ($nilai1 != '') {
            $hasil_gambar2 = array('favicon' => $nilai2);
          } else {
            $hasil_gambar2 = array();
          }

          $data = array(
            'nama_instansi' => $this->input->post('nama_instansi', TRUE),
            'alamat_lengkap' => strip_tags($this->input->post('alamat_lengkap', TRUE)),
            'telp' => strip_tags($this->input->post('telp', TRUE)),
            'keterangan_situs' => strip_tags($this->input->post('keterangan_situs', TRUE)),
            'fax' => $this->input->post('fax', TRUE),
            'npwp' => $this->input->post('npwp', TRUE),
            'nip' => $this->input->post('nip', TRUE),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),

          );

          $update_data  = array_merge($data, $hasil_gambar1, $hasil_gambar2);
          $this->db->update('instansi', $update_data);
          $this->session->set_flashdata('message', '<div class="callout callout-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
          redirect(site_url('instansi'));
          /*favicon*/
        }
      }
    } else {
      $this->_rules();
      if ($this->form_validation->run() == FALSE) {
        $this->index($this->input->post('', TRUE));
      } else {

        if ($_FILES['logo']['name'] == '' and $_FILES['favicon']['name'] == '') {

          $data = array(
            'nama_instansi' => $this->input->post('nama_instansi', TRUE),
            'keterangan_situs' => $this->input->post('keterangan_situs', TRUE),
            'alamat_lengkap' => $this->input->post('alamat_lengkap', TRUE),
            'telp' => $this->input->post('telp', TRUE),
            'fax' => $this->input->post('fax', TRUE),
            'nip' => $this->input->post('nip', TRUE),
            'npwp' => $this->input->post('npwp', TRUE),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),

          );
          $this->db->insert('instansi', $data);
          $this->session->set_flashdata('message', '<div class="callout callout-success fade-in"><i class="fa fa-check"></i>Edit Data Berhasil.</div>');
          redirect(site_url('instansi'));
        } else {

          $conf['allowed_types'] = 'jpg|png|ico|bmp';
          $conf['upload_path'] = 'assets/img/';
          $conf['file_name']   = time() . 'logo';

          $this->upload->initialize($conf);

          $error = array();
          $gambar = array();
          foreach ($_FILES as $field_name => $file) {
            if (!$this->upload->do_upload($field_name)) {
              $error[] = $this->upload->display_errors();
            } else {
              $gambar0 = $this->upload->data();
              $gambar[] = $gambar0['file_name'];
            }
          }

          $nilai1 = $gambar[0] ? $gambar[0] : '';
          $nilai2 = $gambar[1] ? $gambar[1] : '';

          if ($nilai1 != '') {
            $hasil_gambar1 = array('logo' => $nilai1);
          } else {
            $hasil_gambar1 = array();
          }
          if ($nilai1 != '') {
            $hasil_gambar2 = array('favicon' => $nilai2);
          } else {
            $hasil_gambar2 = array();
          }

          $data = array(
            'nama_instansi' => $this->input->post('nama_instansi', TRUE),
            'alamat_lengkap' => strip_tags($this->input->post('alamat_lengkap', TRUE)),
            'telp' => strip_tags($this->input->post('telp', TRUE)),
            'keterangan_situs' => strip_tags($this->input->post('keterangan_situs', TRUE)),
            'fax' => $this->input->post('fax', TRUE),
            'npwp' => $this->input->post('npwp', TRUE),
            'nama_pejabat' => $this->input->post('nama_pejabat'),
            'jabatan' => $this->input->post('jabatan'),

          );
          $insert  = array_merge($data, $hasil_gambar1, $hasil_gambar2);
          $this->db->insert('instansi', $insert);
          $this->session->set_flashdata('message', '<div class="callout callout-success fade-in"><i class="fa fa-check"></i>Data instansi berhasil di update.</div>');
          redirect(site_url('instansi'));
        }
      }
    }
  }



  public function hapus($id)
  {
    $row = $this->Instansi_model->get_by_id($id);

    if ($row) {
      $this->Instansi_model->delete($id);
      $this->session->set_flashdata('message', '<div class="callout callout-danger fade-in"><i class="fa fa-check"></i>Data Berhasil Di Hapus</div>');
      redirect(site_url('instansi'));
    } else {
      $this->session->set_flashdata('message', '<div class="callout callout-warniing fade-in">Ops Something Went Wrong Please Contact Administrator.</div>');
      redirect(site_url('instansi'));
    }
  }

  public function _rules()
  {

    $this->form_validation->set_rules('nama_instansi', 'nama instansi', 'trim|required');
    $this->form_validation->set_rules('alamat_lengkap', 'alamat lengkap', 'trim|required');
    $this->form_validation->set_rules('telp', 'telp', 'trim|required');
    $this->form_validation->set_rules('fax', 'fax', 'trim|required');
    $this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
    $this->form_validation->set_rules('nama_pejabat', 'nama_pejabat', 'trim|required');
    $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');

    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
