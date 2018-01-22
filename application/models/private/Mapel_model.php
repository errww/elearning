<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mapel_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_all_mapel()
    {
        $this->db->from('mapel');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_all_hari()
    {
        $this->db->from('hari');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('mapel');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function mapel_add($data)
    {
        $this->db->insert('mapel', $data);
        return $this->db->insert_id();
    }

    public function mapel_update($where, $data)
    {
        $this->db->update('mapel', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mapel');
    }

}
