<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Siswa_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_all_siswa()
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $this->db->join('tahunajaran', 'tahunajaran.id_tahunajaran = siswa.id_thajaran');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_daftar_siswa($seg)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->join('kelas', 'kelas.id_kelas = siswa.id_kelas');
        $this->db->join('tahunajaran', 'tahunajaran.id_tahunajaran = siswa.id_thajaran');
        $this->db->where('siswa.id_thajaran', $seg);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('siswa.*,kelas.nama_kelas,tahunajaran.tahun');
        $this->db->from('siswa');
        $this->db->join('kelas','kelas.id_kelas = siswa.id_kelas');
        $this->db->join('tahunajaran','tahunajaran.id_tahunajaran = siswa.id_thajaran');
        $this->db->where('id_siswa', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function siswa_add($data)
    {
        $this->db->insert('siswa', $data);
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

    public function delete_siswa($id)
    {
        $this->db->where('id_siswa', $id);
        $this->db->delete('siswa');
    }

    public function loginMe($nis, $password)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('nis_siswa', $nis);
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

}
