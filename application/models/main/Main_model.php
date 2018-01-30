<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
     }

   function get_all_informasi() {


        $this->db->select('*');
        $this->db->from('guru gr');
        $this->db->join('guru_pesan_informasi gpi', 'gr.id = gpi.guru_id');
       
        $query = $this->db->get();
        return $query->result();
   }

   function get_informasi_by_id($id){

      $this->db->select('gpi.id as informasi_id , gpi.title , gpi.isi , gpi.created_at,  g.nama , g.nik , g.foto');
      $this->db->from('guru_pesan_informasi gpi');
      $this->db->join('guru g', 'gpi.guru_id = g.id');
      $this->db->where('gpi.id',$id);
      return $this->db->get()->row();
   }

   function get_materi_by_id($id){

      $this->db->select(' mt.id_materi ,
        mt.nama_materi,
        mt.tgl_upload,
        mt.tipe_materi,
        mt.file_materi,
        gr.id as guru_id,
        gr.nama as guru_nama ,
        mp.nama_mapel,
        th.tahun,
        kl.nama_kelas,
        sm.semester,
        ');
      
      $this->db->from('materi mt');
      
      $this->db->join('guru gr', 'mt.id_guru = gr.id');
      $this->db->join('mapel mp', 'mt.id_mapel = mp.id_mapel');
      $this->db->join('tahunajaran th', 'mt.id_tahunajaran = th.id_tahunajaran');
      $this->db->join('kelas kl', 'mt.id_kelas = kl.id_kelas');
      $this->db->join('semester sm', 'mt.semester = sm.id_semester');


      return $this->db->get()->row();


   }
	 
   
}?>