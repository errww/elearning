<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admin extends CI_Controller
{


      public function __construct()
     {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('html');

          
     }

     public function index()
     {      
               $this->load->model('private/admin_model');
               $this->cek_session();
               $data['books']=$this->admin_model->get_all_books();
               $this->load->view('layout/header/private/header');
               $this->load->view('content/private/main',$data);
               $this->load->view('layout/footer/private/footer');
     }


     public function kelas()
     {          
               $this->load->model('private/kelas_model');
               $this->cek_session();
               $data['content']='content/private/kelas';
               $data['kelas']=$this->kelas_model->get_all_kelas();
               $this->load->view('layout/header/private/header');
               $this->load->view('content/private/main',$data);
               $this->load->view('layout/footer/private/footer');
     }

     public function siswa()
     {          
               $this->load->model('private/siswa_model');
               $this->cek_session();
               $data['content']='content/private/siswa';
               $data['siswa']=$this->siswa_model->get_all_siswa();
               $this->load->view('layout/header/private/header');
               $this->load->view('content/private/main',$data);
               $this->load->view('layout/footer/private/footer');
     }




     public function login()
     {              $this->load->model('private/admin_model');
           $data=array(
                    'isi'       =>'content/private/login',
                    );
               $this->load->view('layout/header/private/header');
               $this->load->view('layout/content',$data);
               $this->load->view('layout/footer/private/footer');


     }

    public function cek() {
                    $this->load->model('private/admin_model');

                     $username = $this->input->post("username");
                     $password = $this->input->post("password");
                     $role     = $this->input->post("role");

                    //check if username and password is correct
                    $usr_result = $this->admin_model->get_user($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
                         $sessiondata = array(
                              'nis_siswa'         => $usr_result['nis_siswa'],
                              'password'          => $usr_result['password'],
                         );
                         $this->session->set_userdata($sessiondata);
                        
            
                         redirect("admin");
                   } else { redirect("admin/login"); }

    }


        public function book_add()
        {   $this->load->model('private/admin_model');
            $data = array(
                    'book_isbn' => $this->input->post('book_isbn'),
                    'book_title' => $this->input->post('book_title'),
                    'book_author' => $this->input->post('book_author'),
                    'book_category' => $this->input->post('book_category'),
                );
            $insert = $this->admin_model->book_add($data);
            echo json_encode(array("status" => TRUE));
        }


        public function ajax_edit($id)
        {   $this->load->model('private/admin_model');
            $data = $this->admin_model->get_by_id($id);
 
 
 
            echo json_encode($data);
        }

        public function book_update()
        {
            $this->load->model('private/admin_model');
        $data = array(
                'book_isbn' => $this->input->post('book_isbn'),
                'book_title' => $this->input->post('book_title'),
                'book_author' => $this->input->post('book_author'),
                'book_category' => $this->input->post('book_category'),
            );
        $this->admin_model->book_update(array('book_id' => $this->input->post('book_id')), $data);
        echo json_encode(array("status" => TRUE));
        }


        public function book_delete($id)
        {
        $this->load->model('private/admin_model');
        $this->admin_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
        }



     function cek_session() {

        if (!isset($this->session->userdata['nis_siswa'])) {
            return  redirect("admin/login");
            }

     }

     function logout() {

      $this->session->sess_destroy();
        redirect('admin/login');

     }

     
 }