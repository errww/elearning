<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('html','form','login','file'));
        $this->load->model('private/siswa_model');
        $this->load->model('private/jammapel_model');

    }

    public function index()
    {
        $this->cek_session();
        
        $id                 = $this->session->userdata('id');
        $data['navigation'] = $this->uri->segment(1);
        $data['content']    = 'content/private/dashboard';

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function profile(){

        $this->cek_session();

        $data['navigation'] = $this->uri->segment(1);
        $data['profile']    = $this->siswa_model->get_by_id($this->session->userdata('id'));
        $data['content']    = 'content/private/siswaprofile';

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    
    public function profile_update()
    {
        $this->cek_session();

        $this->form_validation->set_rules('nis_siswa', 'Nis', 'required|numeric');
        $this->form_validation->set_rules('nama_siswa', 'Nama', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('telp', 'Telp', 'required|numeric|max_length[20]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[255]');
        $this->form_validation->set_rules('tgl', 'Tgl', 'required|numeric|min_length[2]|max_length[2]');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric|min_length[2]|max_length[2]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|min_length[4]|max_length[4]');



        if($this->form_validation->run() === false){

            $data['navigation'] = $this->uri->segment(1);
            $data['profile']    = $this->siswa_model->get_by_id($this->session->userdata('id'));

            $data['content']    = 'content/private/siswaprofile';

            $this->load->view('layout/header/private/header');
            $this->load->view('content/private/main', $data);
            $this->load->view('layout/footer/private/footer');

        }else{


            if(!empty($_FILES['foto']['name'])){

              $config['upload_path'] = './assets/avatar/';
              $config['allowed_types'] = 'jpg|png|gif';
              $config['max_size'] = '2048';
              $config['max_filename'] = '255';
              $config['encrypt_name'] = TRUE;
              $image_data = array();


              
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('foto')) {


                $this->session->set_flashdata('error', $this->upload->display_errors() );

                redirect('/siswa/profile', 'refresh');

            } else {


                $image_data = $this->upload->data();
                $config['image_library'] = 'gd2';
                    $config['source_image'] = $image_data['full_path']; //get original image
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = 200;
                    $this->load->library('image_lib', $config);
                    
                    if (!$this->image_lib->resize()) {
                       echo $this->image_lib->display_errors();
                   }
               }

               $old_image_name = $this->db->select('foto')
               ->from('siswa')
               ->where('id_siswa',$this->session->userdata('id'))
               ->get()
               ->row();

               $file = $config['upload_path'].$old_image_name->foto;
               if (file_exists($file)) {
                unlink($file);
            }

        }

        $tgl   = $this->input->post('tgl');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $tanggal_lahir = $tgl.'-'.$bulan.'-'.$tahun;


        $data = array(
            'nama_siswa' => $this->input->post('nama_siswa'),
            'nis_siswa' => $this->input->post('nis_siswa'),
            'telp' => $this->input->post('telp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'tgl_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $this->input->post('jenis_kelamin')
            );


        if($_FILES['foto']['name']){
            $data['foto'] = $image_data['file_name'];
        }

        $this->db->where('id_siswa',$this->session->userdata('id'));
        $this->db->update('siswa',$data);

        $this->session->set_flashdata('success', 'Berhasil update data' );

        redirect('/siswa/profile', 'refresh');

    }


}



public function profile_update_password(){

    $this->cek_session();


    $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
    $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]|max_length[50]');


    if($this->form_validation->run() === false){


        $data['navigation'] = $this->uri->segment(1);
        $data['profile']    = $this->siswa_model->get_by_id($this->session->userdata('id'));

        $data['content']    = 'content/private/siswaprofile';

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');

    }else{

        $oldpassword  = $this->input->post('old_password');
        $newpassword  = $this->input->post('new_password');


        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('id_siswa', $this->session->userdata('id'));
        $query = $this->db->get()->result();

        if (!empty($query)) {

            if (verifyHashedPassword($oldpassword, $query[0]->password)) {


                $dataPass = array ('password' => $this->hash_password($newpassword));

                $this->db->where('id_siswa',$this->session->userdata('id'));
                $this->db->update('siswa',$dataPass);


                $this->session->set_flashdata('success_update_password', 'Berhasil update password, login selanjutnya menggunakan password baru anda ! ');


                redirect('/siswa/profile', 'refresh');

                
            } else {


                $this->session->set_flashdata('error_update_password', 'Gagal update password, password lama salah ! ');

                redirect('/siswa/profile', 'refresh');
            }

        } else {


            $this->session->set_flashdata('error_update_password', 'Gagal update password, tidak ada data !');

            redirect('/siswa/profile', 'refresh');
        }

    }

}

public function jadwal(){

    $this->cek_session();

    $data['navigation'] = $this->uri->segment(1);
    $data['hari']       = $this->db->get('hari')->result();
    $data['content']    = 'content/private/siswajadwal';

    $this->load->view('layout/header/private/header');
    $this->load->view('content/private/main', $data);
    $this->load->view('layout/footer/private/footer');

}

public function jadwal_detail(){

    $this->cek_session();


    if(empty($this->input->get('hari'))){

        redirect('siswa/jadwal');
    }

    $session_id = $this->session->userdata('id');

    $get_kelas_id = $this->db->select('id_kelas')->from('siswa')->where('id_siswa',$session_id)->get()->row();

    $siswa_kelas = $get_kelas_id->id_kelas;
    $id_hari = $this->input->get('hari');

    $data['jadwal'] = $this->jammapel_model->get_mapel_by_siswa($id_hari,$siswa_kelas);
    $data['navigation'] = $this->uri->segment(1);
    $data['content']    = 'content/private/siswajadwal_detail';

    $this->load->view('layout/header/private/header');
    $this->load->view('content/private/main', $data);
    $this->load->view('layout/footer/private/footer');
        
}

private function hash_password($password)
{
    return password_hash($password, PASSWORD_BCRYPT);
}


public function cek_session()
{
    if ($this->session->userdata('level') !== 'siswa') {
        return redirect("admin/login");
    }
}

public function logout()
{

    $this->session->sess_destroy();
    redirect(site_url());
}



}
