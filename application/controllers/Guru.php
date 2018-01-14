<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Guru extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->model('private/guru_model');
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

    public function profile()
    {

        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);
        $data['profile']    = $this->guru_model->get_select($id, 'profile');
        $data['content']    = 'content/private/guruprofile';
        $this->cek_session();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function pesan()
    {
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['navigation'] = $this->uri->segment(1);
        $data['pesan']      = $this->guru_model->get_select($id, 'pesan');
        $data['content']    = 'content/private/gurupesan';
        $this->cek_session();
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
        $this->cek_session();
        $data = $this->guru_model->get_by_id($id);
        echo json_encode($data);
    }

        public function nilai_add()
    {
        $this->load->library('upload');
        $this->cek_session();
        $data = array(
            'mapel' => $this->input->post('nama_mapel'),
        );
        $insert = $this->mapel_model->mapel_add($data);
        echo json_encode(array("status" => true));
    }

    public function profile_update()
    {
        $id              = $this->session->userdata('id');
        $this->cek_session();
        $data = array(
            'profile' => $this->input->post('txt1'),
        );
        $this->guru_model->guru_update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

        public function pesan_update()
    {
        $id              = $this->session->userdata('id');
        $this->cek_session();
        $data = array(
            'pesan' => $this->input->post('txt1'),
        );
        $this->guru_model->guru_update(array('id' => $id), $data);
        echo json_encode(array("status" => true));
    }

    public function cek()
    {
        $this->load->model('private/guru_model');
        $this->load->library('form_validation');
        $this->load->helper('login');

        $this->form_validation->set_rules('nik', 'NIK', 'required|max_length[128]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[32]');

        if ($this->form_validation->run() == false) {
            //$this->index();
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
}
