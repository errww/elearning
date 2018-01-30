<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller
{

  public function __construct()
  {
   parent::__construct();
   $this->load->database();
   $this->load->library(array('session','form_validation'));
   $this->load->helper(array('html','form','login','file'));
   
   $this->load->model('main/main_model');
   $this->load->model('private/guru_model');


 }


 public function index()
 { 

  $data['informasi'] = $this->main_model->get_all_informasi();        
  $data['nilai'] = $this->guru_model->get_nilai();        
  $data['materi'] = $this->guru_model->get_materi();     	
  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/content', $data);
  $this->load->view('layout/footer/main/footer');
}


public function show_informasi ($id){

  $this->cek_session();

  $data['informasi'] = $this->db->where('id',$id)->get('guru_pesan_informasi')->row();

  if(is_null($id) || empty($data['informasi'])){

    redirect(base_url());
  }

  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->get('siswa')->row();
  //get detail informasi
  $data['informasi'] = $this->main_model->get_informasi_by_id($id);



  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/list_informasi',$data);
  $this->load->view('layout/footer/main/footer');
}


public function show_materi ($id){

  $this->cek_session();

  $data['materi'] = $this->db->where('id_materi',$id)->get('materi')->row();

  if(is_null($id) || empty($data['materi'])){

    redirect(base_url());
  }

  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->get('siswa')->row();
  //get detail materi
  $data['materi'] = $this->main_model->get_materi_by_id($id);

  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/detail_materi',$data);
  $this->load->view('layout/footer/main/footer');

}

public function download_materi($file,$id){

  $this->cek_session();

  if(is_null($file)){

    redirect(base_url());
  }

  $this->load->helper('download');

  $filename = './assets/file_materi/'.$file;

  //echo $filename; die();

  if(file_exists($filename)){

    force_download('assets/file_materi/'.$file, NULL);


  }else{

    //alert 
    $this->session->set_flashdata('error','File tidak ditemukan di server !');

    redirect('main/show_materi/'.$id);

  }

}

public function download_nilai($file){

  $this->cek_session();

  if(is_null($file)){

    redirect(base_url());
  }

  $this->load->helper('download');

  $filename = './assets/file_nilai/'.$file;

  //echo $filename; die();

  if(file_exists($filename)){

    force_download('assets/file_nilai/'.$file, NULL);


  }else{

    //alert file not found
    ?>
    <script type=text/javascript>
      alert("File Tidak ditemukan !");
    </script>
    <?php


  }

}


/**
 * [cek_session description]
 * @return [type] [description]
 */
private function cek_session(){

  if ($this->session->userdata('level') !== 'siswa') {
    return redirect(base_url());
  }

}



}