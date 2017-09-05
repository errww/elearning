<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }


    public function get_all_kelas()
    {   
        $this->db->from('kelas');
        $query=$this->db->get();
        return $query->result();
    }
 
 
    public function get_by_id($id)
    {   $this->db->select('*');
        $this->db->from('kelas');
        $this->db->where('id_kelas',$id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
 
    public function kelas_add($data)
    {
        $this->db->insert('kelas' ,$data);
        return $this->db->insert_id();
    }
 
    public function kelas_update($where, $data)
    {
        $this->db->update('kelas', $data, $where);

        return $this->db->affected_rows();

    }
 
    public function delete_by_id($id)
    {
        $this->db->where('id_kelas', $id);
        $this->db->delete('kelas');
    }
 




	 
}?>