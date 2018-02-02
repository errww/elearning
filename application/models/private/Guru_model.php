<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Guru_model extends CI_Model
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
        $this->db->order_by('id','desc');
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

    /**
     * [get_nilai_by_guru description]
     * @author [acil]
     * @return [type] [description]
     */
    public function get_nilai_by_guru($id_guru)
    {

        $this->db->select('nilai.id_nilai,
                           nilai.title , 
                           nilai.file,
                           guru.nama, 
                           tahunajaran.tahun , 
                           mapel.nama_mapel , 
                           kelas.nama_kelas,
                           semester.semester');
        $this->db->from('nilai');
        $this->db->where('nilai.id_guru',$id_guru);
        $this->db->join('guru', 'guru.id = nilai.id_guru');
        $this->db->join('tahunajaran','tahunajaran.id_tahunajaran = nilai.id_tahunajaran');
        $this->db->join('mapel', 'mapel.id_mapel = nilai.id_mapel');
        $this->db->join('kelas', 'kelas.id_kelas = nilai.id_kelas');
        $this->db->join('semester', 'semester.id_semester = nilai.semester');

        $this->db->order_by('nilai.id_nilai','desc');

        $query = $this->db->get();
        return $query->result();
    }



    public function get_nilai(){

        $this->db->select('n.id_nilai as idnilai, title,nama_kelas,m.nama_mapel,nama,file');
        $this->db->from('nilai n');
        $this->db->join('mapel m', 'n.id_mapel=m.id_mapel');
        $this->db->join('kelas k', 'n.id_kelas=k.id_kelas');
        $this->db->join('guru g', 'n.id_guru=g.id');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_materi_by_guru($id_guru){

        $this->db->select('materi.id_materi,
                           materi.nama_materi,
                           materi.tgl_upload,
                           materi.file_materi,
                           materi.tipe_materi,
                           guru.nama, 
                           mapel.nama_mapel ,
                           tahunajaran.tahun , 
                           kelas.nama_kelas, 
                           semester.semester');
        $this->db->from('materi');
        $this->db->join('guru', 'guru.id = materi.id_guru');
        $this->db->join('mapel', 'mapel.id_mapel = materi.id_mapel');
        $this->db->join('tahunajaran','tahunajaran.id_tahunajaran = materi.id_tahunajaran');
        $this->db->join('kelas', 'kelas.id_kelas = materi.id_kelas');
        $this->db->join('semester', 'semester.id_semester = materi.semester');
        $this->db->where('materi.id_guru',$id_guru);

        $this->db->order_by('materi.id_materi','desc');

        $query = $this->db->get();
        return $query->result();
    }


    public function get_materi()
    {
        $this->db->select('n.id_materi as idmateri, 
                          g.nama as nama_guru , 
                          k.nama_kelas ,
                          m.nama_mapel, 
                          n.nama_materi, 
                          n.file_materi'
                          );
        $this->db->from('materi n');
        $this->db->join('mapel m', 'n.id_mapel=m.id_mapel');
        $this->db->join('kelas k', 'n.id_kelas=k.id_kelas');
        $this->db->join('guru g', 'n.id_guru=g.id');
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
        $query = $this->db->get('guru')->row();

        return $query;
    }


    /**
     * [get_where_return_row by acil]
     * @param  [string] $table  [description]
     * @param  [string] $select [description]
     * @param  [string] $where  [description]
     * @param  [string] $id     [description]
     * @return [object]         [description]
     */
    public function get_where_return_row($table,$select,$where,$id){

        $this->db->select($select);
        $this->db->where($where,$id);
        return $this->db->get($table)->row();
    }

    /**
     * [get_where insert by acil]
     * @param  [string] $table  [description]
     * @param  [string] $select [description]
     * @param  [where]  $where  [description]
     * @param  [string] $id     [description]
     * @return [array]         [description]
     */
    public function get_where($table,$select,$where,$id){
        $this->db->select($select);
        $this->db->where($where,$id);
        $this->db->order_by('id','desc');
        return $this->db->get($table)->result_array();
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

    /**
     * [delete_by_id inserted by acil]
     * @param  [string] $table [description]
     * @param  [string] $where [description]
     * @param  [string] $id    [description]
     * @return [type]          [description]
     */
    public function delete_by_id($table,$where,$id){

        $this->db->where($where, $id);
        $this->db->delete($table);
    }

    public function delete_guru_mapel($id)
    {
        $this->db->where('id_guru', $id);
        $this->db->delete('guru_mapel');
    }

}
