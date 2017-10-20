<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }


    public function get_all_siswa()
    {   
        $this->db->from('siswa');
        $query=$this->db->get();
        return $query->result();
    }
 
 
    public function get_by_id($id)
    {   $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('nis_siswa',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
 
    public function siswa_add($data)
    {
        $this->db->insert('siswa' ,$data);
        return $this->db->insert_id();
    }
 
    public function siswa_update($where, $data)
    {
        $this->db->update('siswa', $data, $where);

        return $this->db->affected_rows();

    }
 
    public function delete_by_nis($id)
    {
        $this->db->where('nis_siswa', $id);
        $this->db->delete('siswa');
    }
 




	 
}?>