<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Thajaran_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_all_thajaran()
    {
        $this->db->from('thajaran');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('thajaran');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }

    public function thajaran_add($data)
    {
        $this->db->insert('thajaran', $data);
        return $this->db->insert_id();
    }

    public function thajaran_update($where, $data)
    {
        $this->db->update('thajaran', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('thajaran');
    }

}
