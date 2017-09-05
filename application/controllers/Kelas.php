<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Kelas extends CI_Controller
{


      public function __construct()
     {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('html');
        $this->load->model('private/kelas_model');
          
     }


     public function kelas()
     {          
               $this->cek_session();
               $data['books']=$this->kelas_model->get_all_kelas();
               $this->load->view('layout/header/private/header');
               $this->load->view('content/private/main',$data);
               $this->load->view('layout/footer/private/footer');        

     }



        public function kelas_add()
        {
            $data = array(
                    'nama_kelas' => $this->input->post('nama_kelas'),
                );
            $insert = $this->kelas_model->kelas_add($data);
            echo json_encode(array("status" => TRUE));
        }


        public function ajax_edit($id)
        {  
            $data = $this->kelas_model->get_by_id($id);
 
            echo json_encode($data);
        }

        public function kelas_update()
        {
        $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
            );
        $this->kelas_model->kelas_update(array('id_kelas' => $this->input->post('id_kelas')), $data);
        echo json_encode(array("status" => TRUE));
        }


        public function kelas_delete($id)
        {
       
        $this->kelas_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
        }






     function cek_session() {

		if (!isset($this->session->userdata['nik'])) {
			return  redirect("admin/login");
			}

     }

     
 }