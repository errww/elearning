<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }



   function get_all_informasi() {


        $this->db->select('*');
        $this->db->from('guru gr');
        $this->db->join('guru_pesan_informasi gpi', 'gr.id = gpi.guru_id');
       
        
        $query = $this->db->get();
        return $query->result();


   }
	 
   
}?>