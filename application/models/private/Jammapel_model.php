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

        $this->db->select('jm.id as idmp,
                            jam_mulai,
                            jam_selesai,
                            nama_hari,
                            nama_kelas,
                            mp.nama_mapel,
                            nama');
        $this->db->from('jammapel jm ');
        $this->db->join('mapel mp', 'jm.mapel_id = mp.id_mapel');
        $this->db->join('kelas kl', 'jm.kelas_id = kl.id_kelas');
        $this->db->join('hari hr', 'hr.id_hari = jm.hari_id');
        $this->db->join('guru gr', 'gr.id = jm.guru_id');
        
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        
        $this->db->select('jm.id,
                            mp.id_mapel as idmp,
                            gr.id as grid,
                            id_hari,
                            id_kelas,
                            jam_mulai,
                            jam_selesai,
                            nama_hari,
                            nama_kelas,
                            mp.nama_mapel,
                            nama');
        $this->db->from('jammapel jm');
        $this->db->join('mapel mp', 'jm.mapel_id = mp.id_mapel');
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

    public function get_mapel_by_siswa($id_hari,$id_kelas){

        $this->db->select('jammapel.id,
                            jammapel.jam_mulai,
                            jammapel.jam_selesai,
                            hari.nama_hari,
                            kelas.nama_kelas,
                            mapel.nama_mapel,
                            guru.nama
                        ');
        $this->db->from('jammapel');
        $this->db->join('hari','hari.id_hari = jammapel.hari_id');
        $this->db->join('kelas','kelas.id_kelas = jammapel.kelas_id');
        $this->db->join('mapel','mapel.id_mapel = jammapel.mapel_id');
        $this->db->join('guru','guru.id = jammapel.guru_id');
        $this->db->where('jammapel.hari_id',$id_hari);
        $this->db->where('jammapel.kelas_id',$id_kelas);
        $this->db->order_by('HOUR(jammapel.jam_mulai)','asc');

        return $this->db->get()->result();

    }

}
