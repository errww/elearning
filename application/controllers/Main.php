<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Main extends CI_Controller
{

	 public function __construct()
     {
       parent::__construct();
          
     }

     public function index()
     { 
     	$data = '';     	
     	$this->load->view('layout/header/main/header');
        $this->load->view('content/main/content', $data);
        $this->load->view('layout/footer/main/footer');
     }

 }