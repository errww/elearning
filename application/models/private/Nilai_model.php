<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Nilai_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }



    public function nilai_add($data)
    {
        $this->db->insert('nilai', $data);
        return $this->db->insert_id();
    }



    public function delete_nilai($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('nilai');
    }

}
