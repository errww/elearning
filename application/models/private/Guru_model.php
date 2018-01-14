<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class guru_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function loginMe($nik, $password)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('nik', $nik);
        $query = $this->db->get();

        $user = $query->result();

        if (!empty($user)) {
            if (verifyHashedPassword($password, $user[0]->password)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function get_all_guru()
    {
        $this->db->from('guru');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_daftar_guru()
    {
        $this->db->select('id, nama, nik');
        $this->db->from('guru');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_nilai()
    {
        $this->db->select('*');
        $this->db->from('nilai');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('guru');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }

    public function get_select($id, $select)
    {
        $this->db->select($select);
        $this->db->where('id', $id);
        $query = $this->db->get('guru');
        return $query->row()->$select;
    }

    public function guru_add($data)
    {
        $this->db->insert('guru', $data);
        return $this->db->insert_id();
    }

    public function guru_mapel_add($data)
    {
        $this->db->insert('guru_mapel', $data);
        return $this->db->insert_id();
    }

    public function guru_update($where, $data)
    {
        $this->db->update('guru', $data, $where);
        return $this->db->affected_rows();
    }

    public function guru_mapel_replace($where, $data)
    {
        $this->db->insert('guru_mapel', $data);
        return $this->db->affected_rows();
    }

    public function delete_guru($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('guru');
    }

        public function delete_guru_mapel($id)
    {
        $this->db->where('id_guru', $id);
        $this->db->delete('guru_mapel');
    }

}
