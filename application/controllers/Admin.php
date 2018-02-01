<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('html','form','login'));
        $this->load->model('private/guru_model');
        $this->load->model('private/siswa_model');
    }

    /*
    // ----------------------------------- Admin Local Page -----------------------------------------
     */

    public function index()
    {
        $this->cek_session();
        $this->load->model('private/admin_model');
        $this->load->model('private/thajaran_model');
        
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $data['content']  = 'content/private/dashboard';
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function thajaran()
    {
        $this->load->model('private/thajaran_model');
        $this->cek_session();
        $data['content']  = 'content/private/thajaran';
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function mapel()
    {
        $this->load->model('private/mapel_model');
        $this->load->model('private/thajaran_model');
        $this->cek_session();
        $data['content'] = 'content/private/mapel';
        $data['mapel']   = $this->mapel_model->get_all_mapel();
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function jammapel()
    {

        $this->load->model('private/mapel_model');
        $this->load->model('private/jammapel_model');
        $this->load->model('private/thajaran_model');
        $this->load->model('private/kelas_model');
        $this->cek_session();
        $data['content'] = 'content/private/jammapel';

        $data['kelas']   = $this->kelas_model->get_all_kelas();
        $data['mapel']   = $this->mapel_model->get_all_mapel();
        $data['hari']   = $this->mapel_model->get_all_hari();
        $data['jammapel']   = $this->jammapel_model->get_all_jammapel();
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $data['guru']    = $this->guru_model->get_all_guru();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }


    public function kelas()
    {
        $this->cek_session();
        $this->load->model('private/kelas_model');
        $this->load->model('private/thajaran_model');
        $data['content'] = 'content/private/kelas';
        $data['kelas']   = $this->kelas_model->get_all_kelas();
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function siswa()
    {
        $this->cek_session();
        $seg = $this->uri->segment(3);
        $this->load->model('private/kelas_model');
        $this->load->model('private/thajaran_model');
        $data['content'] = 'content/private/siswa';
        if (isset($seg)) {
            $data['siswa'] = $this->siswa_model->get_daftar_siswa($seg);
        } else {
            $data['siswa'] = $this->siswa_model->get_all_siswa();
        }
        $data['kelas']    = $this->kelas_model->get_all_kelas();
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function guru()
    {
        $this->cek_session();
        $this->load->model('private/mapel_model');
        $this->load->model('private/kelas_model');
        $this->load->model('private/thajaran_model');
        $data['thajaran'] = $this->thajaran_model->get_all_thajaran();
        $data['content'] = 'content/private/guru';
        $data['guru']    = $this->guru_model->get_all_guru();
        $data['mapel']   = $this->mapel_model->get_all_mapel();
        //$data['jadwal']    = $this->kelas_model->get_select($id, 'jadwal');
        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }

    public function login()
    {
        $this->load->model('private/admin_model');
        $data = array(
            'isi' => 'content/private/login',
            );
        $this->load->view('layout/header/private/header');
        $this->load->view('layout/content', $data);
        $this->load->view('layout/footer/private/footer');
    }


    /**
     * [auth_role_siswa description]
     * @author [acil]
     * @return [type] [description]
     */
    public function auth_role_siswa(){

        $this->form_validation->set_rules('nis', 'NIS', 'required|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');


        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{


            $nis = $this->input->post('nis');
            $password = $this->input->post('password');

            $result = $this->siswa_model->loginMe($nis, $password);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = array(
                        'id'       => $res->id_siswa, 
                        'nis'      => $res->nis_siswa,
                        'name'     => $res->nama_siswa,
                        'level'    => 'siswa',
                        'is_login' => TRUE
                        );

                    $this->session->set_userdata($sessionArray);

                    $url = base_url();

                    $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json')
                    ->set_output(json_encode(array('redirect' => $url)));
                }
            } else {

                $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => 'Credential salah')));
            }
        }


    }

    /**
     * [auth_role_admin for guru]
     * @return [type] [description]
     */
    public function auth_role_guru(){

        $this->form_validation->set_rules('nik', 'NIP', 'required|max_length[100]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[100]');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{


            $nik = $this->input->post('nik');
            $password = $this->input->post('password');

            $result = $this->guru_model->loginMe($nik, $password);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = array(
                        'id'       => $res->id,
                        'nik'      => $res->nik,
                        'name'     => $res->nama,
                        'level'    => $res->level,
                        'is_login' => TRUE
                        );

                    $this->session->set_userdata($sessionArray);

                    //role for level
                    if($res->level == 'guru'){
                       $url = site_url().'guru';
                   }

                   if($res->level == 'admin'){
                    $url = site_url().'admin';
                }


                $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('redirect' => $url)));
            }
        } else {

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => 'Credential salah')));
        }
    }

} 

public function ajax_edit($id)
{
    $this->load->model('private/admin_model');
    $data = $this->admin_model->get_by_id($id);

    echo json_encode($data);
}

public function cek_session()
{
    if ($this->session->userdata('level') !== 'admin') {
        return redirect("admin/login");
    }
}

public function logout()
{
    $this->session->sess_destroy();
    redirect('admin/login');

}

public function admin_add()
{
    $this->load->model('private/admin_model');
    $data = array(
        'id'       => '2',
        'username' => '2',
        'password' => $this->hash_password('2'),
        );
    $this->admin_model->add_admin($data);
    return 'success';
}

    /*
    // ------------------ Private Shared Function -----------------------------------------------------
     */

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /*
    // ----------------------- Guru Management Page -----------------------------------------------------
     */

    public function guru_add()
    {
        $this->cek_session();
        $pass   = $this->input->post('pass');
        $mapels = $this->input->post('mapel');

        $data   = array(
            'nik'      => $this->input->post('nik'),
            'nama'     => $this->input->post('nama'),
            'password' => $this->hash_password($this->input->post('pass')),
            );
        $insert = $this->guru_model->guru_add($data);

        if ($mapels > 0) {
            foreach ($mapels as $row) {
                $data2 = array(
                    'id_guru'  => $insert,
                    'id_mapel' => $row,
                    );
                $this->guru_model->guru_mapel_add($data2);
            }
        }

        echo json_encode(array("status" => true));
    }

    /*
    public function guru_add()
    {
    $pass   = $this->input->post('pass');
    $mapels = $this->input->post('mapel');
    $data   = array(
    'nik'      => $this->input->post('nik'),
    'nama'     => $this->input->post('nama'),
    'password' => $this->hash_password($this->input->post('pass')),
    );
    // var_dump($mapels);
    // die();
    $insert = $this->guru_model->guru_add($data);

    if($mapels > 0) {
    foreach ($mapels as $row) {
    $data2 = array(
    'id_guru'  => $insert,
    'id_mapel' => $row,
    );
    $this->guru_model->guru_mapel_add($data2);
    }
    }

    //echo json_encode(array("status" => true));
    }
     */

    public function ajax_guru_edit($id)
    {
        $this->cek_session();
        $data = $this->guru_model->get_by_id($id);
        echo json_encode($data);
    }

    public function guru_update()
    {
        $this->cek_session();
        $pass   = $this->input->post('pass');
        $mapels = $this->input->post('mapel');
        $id = $this->input->post('id_guru');
        if (!empty($pass)) {
            $data = array(
                'nama'     => $this->input->post('nama'),
                'nik'      => $this->input->post('nik'),
                'password' => $this->hash_password($this->input->post('pass')),
                );
        } else {
            $data = array(
                'nama' => $this->input->post('nama'),
                'nik'  => $this->input->post('nik'),
                );
        }

        $this->guru_model->guru_update(array('id' => $this->input->post('id_guru')), $data);
        $this->guru_model->delete_guru_mapel($id);
        if ($mapels > 0) {
            foreach ($mapels as $row) {
                $data2 = array(
                    'id_guru'  => $this->input->post('id_guru'),
                    'id_mapel' => $row,
                    );
                $this->guru_model->guru_mapel_add($data2);
            }
        }

        echo json_encode(array("status" => true));
    }

    public function guru_delete($id)
    {
        $this->cek_session();
        $this->guru_model->delete_guru($id);
        $this->guru_model->delete_guru_mapel($id);
        echo json_encode(array("status" => true));
    }

    /*
    // ---------------------------- Siswa Management Page -------------------------------------------
     */

    public function siswa_add()
    {
        $this->cek_session();
        $data = array(
            'nis_siswa'   => $this->input->post('nis_siswa'),
            'nama_siswa'  => $this->input->post('nama_siswa'),
            'id_kelas'    => $this->input->post('kelas_siswa'),
            'password'    => $this->hash_password($this->input->post('pass_siswa')),
            'id_thajaran' => $this->input->post('th_siswa'),
            );
        $insert = $this->siswa_model->siswa_add($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_siswa_edit($id)
    {
        $this->cek_session();
        $data = $this->siswa_model->get_by_id($id);
        echo json_encode($data);
    }

    public function siswa_update()
    {
        $this->cek_session();
        $pass = $this->input->post('pass');
        if (!empty($pass)) {
            $data = array(
                'nis_siswa'   => $this->input->post('nis_siswa'),
                'nama_siswa'  => $this->input->post('nama_siswa'),
                'id_kelas'    => $this->input->post('kelas_siswa'),
                'password'    => $this->hash_password($this->input->post('pass_siswa')),
                'id_thajaran' => $this->input->post('th_siswa'),
                );
            $this->siswa_model->siswa_update(array('id_siswa' => $this->input->post('id_siswa_edit')), $data);
            echo json_encode(array("status" => true));
        } else {
            $data = array(
                'nis_siswa'   => $this->input->post('nis_siswa'),
                'nama_siswa'  => $this->input->post('nama_siswa'),
                'id_kelas'    => $this->input->post('kelas_siswa'),
                'id_thajaran' => $this->input->post('th_siswa'),
                );
            $this->siswa_model->siswa_update(array('id_siswa' => $this->input->post('id_siswa_edit')), $data);
            echo json_encode(array("status" => true));
        }
    }

    public function siswa_delete($id)
    {
        $this->cek_session();
        $this->siswa_model->delete_siswa($id);
        echo json_encode(array("status" => true));
    }

    /*
    // ---------------------------- Kelas Management Page -------------------------------------------
     */

    public function kelas_add()
    {
        $this->cek_session();
        $this->form_validation->set_rules('nama_kelas','Nama Kelas','required');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $this->load->model('private/kelas_model');
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas'),
                );
            $insert = $this->kelas_model->kelas_add($data);
            echo json_encode(array("status" => true));
        }
    }

    public function ajax_kelas_edit($id)
    {
        $this->cek_session();
        $this->load->model('private/kelas_model');
        $data = $this->kelas_model->get_by_id($id);
        echo json_encode($data);
    }

    public function kelas_update()
    {
        $this->cek_session();
        
        $this->form_validation->set_rules('nama_kelas','Nama Kelas','required');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $this->load->model('private/kelas_model');
            $data = array(
                'nama_kelas' => $this->input->post('nama_kelas')
                );
            $this->kelas_model->kelas_update(array('id_kelas' => $this->input->post('id_kelas')), $data);
            echo json_encode(array("status" => true));
        }
    }

    public function kelas_delete($id)
    {
        $this->cek_session();
        $this->load->model('private/kelas_model');
        $this->kelas_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }

    /*
    // ---------------------------- Thajaran Management Page -------------------------------------------
     */

    /**
     * [thajaran_add description]
     * @author [acil]
     * @return [type] [description]
     */
    public function thajaran_add()
    {
        $this->cek_session();

        $this->form_validation->set_rules('nama_thajaran','Tahun Ajaran', 'required');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $this->load->model('private/thajaran_model');
            $data = array(
                'tahun' => $this->input->post('nama_thajaran'),
                );
            $insert = $this->thajaran_model->thajaran_add($data);
            echo json_encode(array("status" => true));
        }
    }

    public function ajax_thajaran_edit($id)
    {
        $this->cek_session();
        $this->load->model('private/thajaran_model');
        $data = $this->thajaran_model->get_by_id($id);
        echo json_encode($data);
    }

    public function thajaran_update()
    {
        $this->cek_session();

        $this->form_validation->set_rules('nama_thajaran','Tahun Ajaran', 'required');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $this->load->model('private/thajaran_model');
            $data = array(
                'tahun' => $this->input->post('nama_thajaran'),
                );
            $this->thajaran_model->thajaran_update(array('id_tahunajaran' => $this->input->post('id_thajaran')), $data);
            echo json_encode(array("status" => true));
        }
    }

    public function thajaran_delete($id)
    {
        $this->cek_session();
        $this->load->model('private/thajaran_model');
        $this->thajaran_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }


    /*
    // ---------------------------- Mapel Management Page -------------------------------------------
     */

    public function mapel_add()
    {
        //$this->cek_session();
        $this->load->model('private/mapel_model');
        $data = array(
            'mapel' => $this->input->post('nama_mapel'),
            );
        $insert = $this->mapel_model->mapel_add($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_mapel_edit($id)
    {
        $this->cek_session();
        $this->load->model('private/mapel_model');
        $data = $this->mapel_model->get_by_id($id);
        echo json_encode($data);
    }

    public function mapel_update()
    {
        $this->cek_session();
        $this->load->model('private/mapel_model');
        $data = array(
            'mapel' => $this->input->post('nama_mapel'),
            );
        $this->mapel_model->mapel_update(array('id' => $this->input->post('id_mapel')), $data);
        echo json_encode(array("status" => true));
    }

    public function mapel_delete($id)
    {
        $this->cek_session();
        $this->load->model('private/mapel_model');
        $this->mapel_model->delete_by_id($id);
        echo json_encode(array("status" => true));
    }


//////////////////////////jam mapel///////////////////////////////////

    public function jammapel_add()
    {
        //$this->cek_session();
        $this->load->model('private/jammapel_model');
        $data = array(
            'jam_mulai'     => $this->input->post('start'),
            'jam_selesai'   => $this->input->post('end'),
            'hari_id'       => $this->input->post('hari_id'),
            'kelas_id'      => $this->input->post('kelas_id'),
            'mapel_id'      => $this->input->post('mapel_id'),
            'guru_id'       => $this->input->post('guru_id')
            );
        $insert = $this->jammapel_model->jammapel_add($data);
        echo json_encode(array("status" => true));
    }


    public function ajax_jammapel_edit($id)
    {
        $this->cek_session();
        $this->load->model('private/jammapel_model');
        $data = $this->jammapel_model->get_by_id($id);
        echo json_encode($data);
    }




}


