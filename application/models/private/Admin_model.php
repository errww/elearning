<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }

     public function add_admin($data)
     {
        $this->db->insert('admin' ,$data);
     }

     //get the username & password from tbl_usrs
     function get_user($usr, $pwd)
     {       
		  $this->db->select('*');
			$this->db->from('admin');
      $this->db->where('id',$usr);
		  $this->db->where('password',($pwd));      
      $query = $this->db->get(); 
			echo $this->db->last_query();
            if($query->num_rows() != 0)
            {
                return $query->row_array();
            }
            else
            {
                return false;
            }
     }

    function loginMe($username, $password)
    {
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $username);
        $query = $this->db->get();
            
        $user = $query->result();
            
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
	 
   
}?>