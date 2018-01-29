<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller
{

	 public function __construct()
     {
       parent::__construct();
       $this->load->model('main/main_model');
       $this->load->model('private/guru_model');
       
          
     }

     public function index()
     { 

        $data['informasi'] = $this->main_model->get_all_informasi();        
     	$data['nilai'] = $this->guru_model->get_nilai();     	
     	$this->load->view('layout/header/main/header');
        $this->load->view('content/main/content', $data);
        $this->load->view('layout/footer/main/footer');
     }

 }