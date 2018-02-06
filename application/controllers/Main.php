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

public function informasi(){

  $this->cek_session();

  $id_session = $this->session->userdata('id');
  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->where('id_siswa',$id_session)->get('siswa')->row();
  //get detail informasi
  $data['informasi'] = $this->main_model->get_inf();

  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/informasi',$data);
  $this->load->view('layout/footer/main/footer');
}


public function show_informasi ($id){

  $this->cek_session();

  $data['informasi'] = $this->db->where('id',$id)->get('guru_pesan_informasi')->row();

  if(is_null($id) || empty($data['informasi'])){

    redirect(base_url());
  }

  $id_session = $this->session->userdata('id');

  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->where('id_siswa',$id_session)->get('siswa')->row();
  //get detail informasi
  $data['informasi'] = $this->main_model->get_informasi_by_id($id);



  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/list_informasi',$data);
  $this->load->view('layout/footer/main/footer');
}

public function materi(){

 $this->cek_session();

 $id_session = $this->session->userdata('id');
 //get data foto
 $data['foto_avatar'] = $this->db->select('foto')->where('id_siswa',$id_session)->get('siswa')->row();
  //get detail materi
 $data['materi'] = $this->main_model->get_all_mtri();

 $this->load->view('layout/header/main/header');
 $this->load->view('content/main/materi',$data);
 $this->load->view('layout/footer/main/footer');

}


public function show_materi ($id){

  $this->cek_session();

  $data['materi'] = $this->db->where('id_materi',$id)->get('materi')->row();

  if(is_null($id) || empty($data['materi'])){

    redirect(base_url());
  }

  $id_session = $this->session->userdata('id');
  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->where('id_siswa',$id_session)->get('siswa')->row();
  //get detail materi
  $data['materi'] = $this->main_model->get_materi_by_id($id);

  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/detail_materi',$data);
  $this->load->view('layout/footer/main/footer');

}

public function nilai(){

  $this->cek_session();
  $id_session = $this->session->userdata('id');
  //get data foto
  $data['foto_avatar'] = $this->db->select('foto')->where('id_siswa',$id_session)->get('siswa')->row();

  $data['nilai'] = $this->main_model->get_all_nilai(); 

  $this->load->view('layout/header/main/header');
  $this->load->view('content/main/nilai',$data);
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