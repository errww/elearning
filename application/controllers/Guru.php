<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('html','form','login'));
        $this->load->model('private/guru_model');
    }

    public function index()
    {
        $this->cek_session();
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function profile()
    {

        $this->cek_session();
        $data['navigation'] = $this->uri->segment(1);
        $data['profile']    = $this->guru_model->get_select($this->session->userdata('id'), '*');

        $data['content']    = 'content/private/guruprofile';
        
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function pesan()
    {
        $this->cek_session();
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);
        $data['pesan']      = $this->guru_model->get_select($id, 'pesan');
        $data['content']    = 'content/private/gurupesan';

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function nilai()
    {
        $this->cek_session();
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);

        $data['content'] = 'content/private/gurunilai';
        $data['nilai']    = $this->guru_model->get_nilai();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function ajax_nilai_edit($id)
    {

        $data = $this->guru_model->get_by_id($id);
        echo json_encode($data);
    }

    public function nilai_add()
    {
        $this->load->library('upload');

        $data = array(
            'mapel' => $this->input->post('nama_mapel'),
            );
        $insert = $this->mapel_model->mapel_add($data);
        echo json_encode(array("status" => true));
    }

    public function profile_update()
    {
        $this->cek_session();

        // form validation
        $this->form_validation->set_rules('nik', 'NIP', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('telp', 'Telp', 'required|numeric|max_length[20]');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[255]');
        $this->form_validation->set_rules('tgl', 'Tgl', 'required|numeric|max_length[2]');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric|max_length[2]');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric|max_length[4]');


        //if validation run false
        if($this->form_validation->run() === false){

            $data['navigation'] = $this->uri->segment(1);
            $data['profile']    = $this->guru_model->get_select($this->session->userdata('id'), '*');

            $data['content']    = 'content/private/guruprofile';

            $this->load->view('layout/header/private/header');
            $this->load->view('content/private/main', $data);
            $this->load->view('layout/footer/private/footer');
        
        }else{

            print_r($this->input->post());

        }
        
        // $data = array(
        //     'profile' => $this->input->post('txt1'),
        //     );

        // $this->guru_model->guru_update(array('id' => $id), $data);

        // echo json_encode(array("status" => true));
    }

    //update password function
    public function profile_update_password(){

        $this->cek_session();

        // form validation
        $this->form_validation->set_rules('old_password', 'Password Lama', 'required');
        $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]|max_length[50]');

        //if validation run false
        if($this->form_validation->run() === false){

            //load view of content profile
            $data['navigation'] = $this->uri->segment(1);
            $data['profile']    = $this->guru_model->get_select($this->session->userdata('id'), '*');

            $data['content']    = 'content/private/guruprofile';

            $this->load->view('layout/header/private/header');
            $this->load->view('content/private/main', $data);
            $this->load->view('layout/footer/private/footer');

        }else{

            $oldpassword  = $this->input->post('old_password');
            $newpassword  = $this->input->post('new_password');

            //cek password exist
            $this->db->select('*');
            $this->db->from('guru');
            $this->db->where('id', $this->session->userdata('id'));
            $query = $this->db->get()->result();

            //jika hasil tidak kosong
            if (!empty($query)) {
                //jika verifyed
                if (verifyHashedPassword($oldpassword, $query[0]->password)) {
                    
                    //update password guru
                    $dataPass = array ('password' => $this->hash_password($newpassword));

                    $this->db->where('id',$this->session->userdata('id'));
                    $this->db->update('guru',$dataPass);

                    //tampilkan pesan
                    $this->session->set_flashdata('success_update_password', 'Berhasil update password, login selanjutnya menggunakan password baru anda ! ');

                    //redirect
                    redirect('/guru/profile', 'refresh');
                    
                
                } else {
                    
    
                    //tampilkan pesan
                    $this->session->set_flashdata('error_update_password', 'Gagal update password, password lama salah ! ');
                    //redirect
                    redirect('/guru/profile', 'refresh');
                }

            } else {

                 //tampilkan pesan
                    $this->session->set_flashdata('error_update_password', 'Gagal update password, tidak ada data !');
                    //redirect
                    redirect('/guru/profile', 'refresh');
            }


        }

    }

    public function pesan_update()
    {
        $id              = $this->session->userdata('id');
        
        $data = array(
            'pesan' => $this->input->post('txt1'),
            );
        $this->guru_model->guru_update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

    public function cek()
    {
        $this->load->model('private/guru_model');

        $this->form_validation->set_rules('nik', 'NIK', 'required|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == false) {
            redirect("admin/login/c");
        } else {
            $nik      = $this->input->post('nik');
            $password = $this->input->post('password');

            $result = $this->guru_model->loginMe($nik, $password);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = array(
                        'id'    => $res->id,
                        'nama'  => $res->nama,
                        'nik'   => $res->nik,
                        'level' => 'guru',
                        );

                    $nik = $res->nik;
                    $this->session->set_userdata($sessionArray);
                    redirect('guru/');
                    //redirect('admin/login/f');
                }
            } else {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                redirect('admin/login/d');
            }
        }
    }

    public function cek_session()
    {
        if ($this->session->userdata('level') !== 'guru') {
            return redirect("admin/login");
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('admin/login');
    }


    ///////////////////////////////// hash the password ////////////////////////////////
    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
