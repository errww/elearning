<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Jammapel_model extends CI_Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function get_all_jammapel()
    {

        $this->db->select('jm.id as idmp,jam_mulai,jam_selesai,nama_hari,nama_kelas,mapel,nama');
        $this->db->from('jammapel jm ');
        $this->db->join('mapel mp', 'jm.mapel_id = mp.id');
        $this->db->join('kelas kl', 'jm.kelas_id = kl.id_kelas');
        $this->db->join('hari hr', 'hr.id_hari = jm.hari_id');
        $this->db->join('guru gr', 'gr.id = jm.guru_id');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        
        $this->db->select('mp.id as idmp,gr.id as grid,id_hari,id_kelas,jam_mulai,jam_selesai,nama_hari,nama_kelas,mapel,nama');
        $this->db->from('jammapel jm ');
        $this->db->join('mapel mp', 'jm.mapel_id = mp.id');
        $this->db->join('kelas kl', 'jm.kelas_id = kl.id_kelas');
        $this->db->join('hari hr', 'hr.id_hari = jm.hari_id');
        $this->db->join('guru gr', 'gr.id = jm.guru_id');
        $this->db->where('jm.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function jammapel_add($data)
    {
        $this->db->insert('jammapel', $data);
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
