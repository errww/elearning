<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Siswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->model('private/siswa_model');

    }

    public function index()
    {
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);
        $this->cek_session();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function login()
    {
        $this->load->model('private/siswa_model');
        $data = array(
            'isi' => 'content/private/loginsiswa',
        );
        $this->load->view('layout/header/private/header');
        $this->load->view('layout/content', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function cek()
    {
        $this->load->library('form_validation');
        $this->load->helper('login');

        $this->form_validation->set_rules('nis', 'NIS', 'required|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == false) {
            redirect("siswa/login/c");
        } else {
            $nis      = $this->input->post('nis');
            $password = $this->input->post('password');

            $result = $this->siswa_model->loginMe($nis, $password);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = array(
                        'id'    => $res->id_siswa,
                        'nama'  => $res->nama_siswa,
                        'nik'   => $res->nis_siswa,
                        'level' => 'siswa',
                    );

                    $nik = $res->nik;
                    $this->session->set_userdata($sessionArray);
                    redirect('siswa/');
                }
            } else {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                redirect('siswa/login/d');
            }
        }
    }

    public function cek_session()
    {
        if ($this->session->userdata('level') !== 'siswa') {
            return redirect("siswa/login");
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('siswa/login');
    }

}
