<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Siswa extends CI_Controller
{


      public function __construct()
     {
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('html');
        $this->load->model('private/siswa_model');
          
     }



        public function siswa_add()
        {
            $data = array(
                    'nis_siswa' => $this->input->post('nis_siswa'),
                    'nama_siswa' => $this->input->post('nama_siswa'),
                );
            $insert = $this->siswa_model->siswa_add($data);
            echo json_encode(array("status" => TRUE));
        }


        public function ajax_edit($id)
        {  
            $data = $this->siswa_model->get_by_id($id);
 
            echo json_encode($data);
        }

        public function siswa_update()
        {
        $data = array(
                'nama_siswa' => $this->input->post('nama_siswa'),
            );
        $this->siswa_model->siswa_update(array('nis_siswa' => $this->input->post('nis_siswa_edit')), $data);
        echo json_encode(array("status" => TRUE));
        }


        public function siswa_delete($id)
        {
       
        $this->siswa_model->delete_by_nis($id);
        echo json_encode(array("status" => TRUE));
        }






     function cek_session() {

		if (!isset($this->session->userdata['nik'])) {
			return  redirect("admin/login");
			}

     }

     
 }