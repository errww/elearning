<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('session','form_validation'));
        $this->load->helper(array('html','form','login','file'));
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
        $this->cek_session();

        $this->load->model('private/mapel_model');
        $this->load->model('private/jammapel_model');
        $this->load->model('private/thajaran_model');
        $this->load->model('private/kelas_model');

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
            $th = $this->db->select('tahun')->from('tahunajaran')->where('id_tahunajaran',$seg)->get()->row();
            $data['th'] = $th->tahun;
        } else {
            $data['siswa'] = $this->siswa_model->get_all_siswa();
            $data['th'] = "Semua";
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
        
        $this->form_validation->set_rules('nik', 'nik', 'required|max_length[100]');
        $this->form_validation->set_rules('nama', 'nama', 'required|max_length[100]');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('telp', 'No telp', 'required|numeric');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        $this->form_validation->set_rules('tgl', 'Tanggal', 'required|numeric|min_length[2]|max_length[2]');
        $this->form_validation->set_rules('bln', 'Bulan', 'required|numeric|min_length[2]|max_length[2]');
        $this->form_validation->set_rules('thn', 'Tahun', 'required|numeric|min_length[4]|max_length[4]');

        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if($this->form_validation->run() == false){

         $this->output
         ->set_status_header(500)
         ->set_content_type('application/json')
         ->set_output(json_encode(array('error' => validation_errors())));

     }else{


        $data   = array(
            'nik'      => $this->input->post('nik'),
            'nama'     => $this->input->post('nama'),
            'level'    => $this->input->post('level'),
            'telp'     => $this->input->post('telp'),
            'email'     => $this->input->post('email'),
            'alamat'    => $this->input->post('alamat'),
            'tgl_lahir' => $this->input->post('tgl').'-'.$this->input->post('bln').'-'.$this->input->post('thn'),
            );

        //jika form password tidak kosong
        if(!empty($this->input->post('pass'))){
            //gunakan data dari post
            $data['password']  = $this->hash_password($this->input->post('pass'));
        }else{
            //default password adalah nik
            $data['password']  = $this->hash_password($this->input->post('nik'));  
        }

        $insert = $this->guru_model->guru_add($data);

        echo json_encode(array("status" => true));


    }
}

public function guru_file_add($id_guru){

   $this->cek_session();

   $this->form_validation->set_rules('file','','callback_image_file_check');

   if($this->form_validation->run() == false){

       $this->output
       ->set_status_header(500)
       ->set_content_type('application/json')
       ->set_output(json_encode(array('error' => validation_errors())));

   }else{

        //configuration
    $config['upload_path'] = './assets/avatar/';
    $config['allowed_types'] = 'jpeg|jpg|png|gif';
    $config['max_size'] = '2048';
    $config['max_filename'] = '255';
    $config['encrypt_name'] = TRUE;
    $image_data = array();

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('file')) {

        //if file upload failed then catch the errors

        $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode(array('error' => $this->upload->display_errors() )));

    } else {

        //store the file info
        $image_data = $this->upload->data();
        $config['image_library'] = 'gd2';
        $config['source_image'] = $image_data['full_path']; //get original image
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 200;
        $config['height'] = 200;
        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize()) {

           $this->output
           ->set_status_header(500)
           ->set_content_type('application/json')
           ->set_output(json_encode(array('error' => $this->image_lib->display_errors() )));

       }


    //get old file
       $old_image_name    = $this->db->get_where('guru', array('id' => $id_guru))->row();
    //remove
       $file = $config['upload_path'].$old_image_name->foto;
       if (file_exists($file)) {
        unlink($file);
    }

    //update into db
    $data = array('foto' => $image_data['file_name']);
    $this->db->where('id', $id_guru);
    $this->db->update('guru', $data);

}

echo json_encode(array("status" => true));

}   

}

    /**
     * [image_file_check callback validation]
     * @author [acil] 
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    public function image_file_check($str){

        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){

            $allowed_mime_type_arr = array('image/jpg','image/jpeg','image/png');
            $mime = get_mime_by_extension($_FILES['file']['name']);

            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('image_file_check', 'Please select only jpg/jpeg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('image_file_check', 'Please choose a file to upload.');
            return false;
        }
    }

    /**
     * [ajax_guru_edit description]
     * @author [acil] 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function ajax_guru_edit($id)
    {
        $this->cek_session();
        $data = $this->guru_model->get_by_id($id);
        echo json_encode($data);
    }

    /**
     * [ajax_guru_mapel description]
     * @param  [type] $id_guru [description]
     * @return [type]          [description]
     */
    public function ajax_guru_mapel($id_guru){

        $this->db->select('guru_mapel.id_mapel, mapel.nama_mapel ');
        $this->db->from('guru_mapel');
        $this->db->join('mapel','guru_mapel.id_mapel=mapel.id_mapel');
        $this->db->where('guru_mapel.id_guru',$id_guru);
        $data = $this->db->get()->result();

        echo json_encode($data);

    }

    /**
     * [guru_mapel_update description]
     * @return [type] [description]
     */
    public function guru_mapel_update(){

        //print_r($this->input->post()); die();

        $id_guru = $this->input->post('id_guru');
        $id_mapel = $this->input->post('mapel');

        if(isset($id_mapel)){
            //delete the old data
            $this->db->where('id_guru',$id_guru);
            $this->db->delete('guru_mapel');


            for($i=0;$i<sizeof($id_mapel);$i++)
            {
             $dataSet[$i] = array ('id_guru' => $id_guru, 'id_mapel' => $id_mapel[$i]);
         }

         $this->db->insert_batch('guru_mapel', $dataSet);

         echo json_encode(array("status" => true));

     }else{

        //delete old data
        $this->db->where('id_guru',$id_guru);
        $this->db->delete('guru_mapel');

        echo json_encode(array("status" => true));

    }

}


public function guru_update()
{
    $this->cek_session();

    $this->form_validation->set_rules('nik', 'nik', 'required|max_length[100]');
    $this->form_validation->set_rules('nama', 'nama', 'required|max_length[100]');
    $this->form_validation->set_rules('level', 'Level', 'required');
    $this->form_validation->set_rules('telp', 'No telp', 'required|numeric');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');

    $this->form_validation->set_rules('tgl', 'Tanggal', 'required|numeric|min_length[2]|max_length[2]');
    $this->form_validation->set_rules('bln', 'Bulan', 'required|numeric|min_length[2]|max_length[2]');
    $this->form_validation->set_rules('thn', 'Tahun', 'required|numeric|min_length[4]|max_length[4]');

    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

    if($this->form_validation->run() == false){

        $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode(array('error' => validation_errors())));

    }else{

        $pass   = $this->input->post('pass');

        if (!empty($pass)) {
            $data = array(
                'nama'      => $this->input->post('nama'),
                'nik'       => $this->input->post('nik'),
                'level'     => $this->input->post('level'),
                'telp'      => $this->input->post('telp'),
                'email'     => $this->input->post('email'),
                'alamat'    => $this->input->post('alamat'),
                'tgl_lahir' => $this->input->post('tgl').'-'.$this->input->post('bln').'-'.$this->input->post('thn'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'password'  => $this->hash_password($this->input->post('pass')),
                );
        } else {
            $data = array(
                'nama'      => $this->input->post('nama'),
                'nik'       => $this->input->post('nik'),
                'level'     => $this->input->post('level'),
                'telp'      => $this->input->post('telp'),
                'email'     => $this->input->post('email'),
                'alamat'    => $this->input->post('alamat'),
                'tgl_lahir' => $this->input->post('tgl').'-'.$this->input->post('bln').'-'.$this->input->post('thn'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                );
        }

        $this->guru_model->guru_update(array('id' => $this->input->post('id_guru')), $data);

        echo json_encode(array("status" => true));
    }
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

        $this->form_validation->set_rules('nis_siswa', 'Nis', 'required|numeric');
        $this->form_validation->set_rules('nama_siswa', 'Nama', 'required|max_length[100]');
        $this->form_validation->set_rules('kelas_siswa', 'Kelas', 'required');
        $this->form_validation->set_rules('th_siswa', 'Tahun Ajar', 'required');

        if($this->form_validation->run() == false){


            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

         $data = array(
            'nis_siswa'   => $this->input->post('nis_siswa'),
            'nama_siswa'  => $this->input->post('nama_siswa'),
            'id_kelas'    => $this->input->post('kelas_siswa'),
            'id_thajaran' => $this->input->post('th_siswa'),
            );

         if(!empty($this->input->post('pass_siswa'))){

            $data['password']  = $this->hash_password($this->input->post('pass_siswa'));

        }else{

            $data['password']  = $this->hash_password($this->input->post('nis_siswa'));  
            
        }

        $insert = $this->siswa_model->siswa_add($data);

        echo json_encode(array("status" => true));
    }
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

    $this->form_validation->set_rules('nis_siswa', 'Nis', 'required|numeric');
    $this->form_validation->set_rules('nama_siswa', 'Nama', 'required|max_length[100]');
    $this->form_validation->set_rules('kelas_siswa', 'Kelas', 'required');
    $this->form_validation->set_rules('th_siswa', 'Tahun Ajar', 'required');

    if($this->form_validation->run() == false){

        $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode(array('error' => validation_errors())));

    }else{

        $pass = $this->input->post('pass_siswa');
        if (!empty($pass)) {
            $data = array(
                'nis_siswa'   => $this->input->post('nis_siswa'),
                'nama_siswa'  => $this->input->post('nama_siswa'),
                'id_kelas'    => $this->input->post('kelas_siswa'),
                'password'    => $this->hash_password($this->input->post('pass_siswa')),
                'id_thajaran' => $this->input->post('th_siswa'),
                );
            $this->siswa_model->siswa_update(array('id_siswa' => $this->input->post('id_siswa')), $data);
            echo json_encode(array("status" => true));
        } else {
            $data = array(
                'nis_siswa'   => $this->input->post('nis_siswa'),
                'nama_siswa'  => $this->input->post('nama_siswa'),
                'id_kelas'    => $this->input->post('kelas_siswa'),
                'id_thajaran' => $this->input->post('th_siswa'),
                );
            $this->siswa_model->siswa_update(array('id_siswa' => $this->input->post('id_siswa')), $data);
            echo json_encode(array("status" => true));
        }
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
        $this->cek_session();
        $this->form_validation->set_rules('nama_mapel','Nama Mapel','required');

        if($this->form_validation->run() == false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $this->load->model('private/mapel_model');
            $data = array(
                'nama_mapel' => $this->input->post('nama_mapel'),
                );
            $this->mapel_model->mapel_add($data);

            echo json_encode(array("status" => true));
        }
    }

    public function ajax_mapel_edit($id)
    {
        $this->cek_session();
        $this->load->model('private/mapel_model');
        $data = $this->mapel_model->get_by_id($id);
        echo json_encode($data);
    }

    /**
     * [mapel_update description]
     * @author [acil]
     * @return [type] [description]
     */
    public function mapel_update()
    {
        $this->cek_session();
        $this->form_validation->set_rules('nama_mapel','Nama Mapel','required');

        if($this->form_validation->run() == false){

           $this->output
           ->set_status_header(500)
           ->set_content_type('application/json')
           ->set_output(json_encode(array('error' => validation_errors())));

       }else{

          $this->load->model('private/mapel_model');
          $data = array(
            'nama_mapel' => $this->input->post('nama_mapel'),
            );
          $this->mapel_model->mapel_update(array('id_mapel' => $this->input->post('id_mapel')), $data);
          echo json_encode(array("status" => true));
      }

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
    $this->cek_session();

    $this->form_validation->set_rules('start','Jam Mulai', 'required');
    $this->form_validation->set_rules('end','Jam Selesai', 'required');
    $this->form_validation->set_rules('hari_id','Hari', 'required');
    $this->form_validation->set_rules('kelas_id','Kelas', 'required');
    $this->form_validation->set_rules('mapel_id','Mapel', 'required');
    $this->form_validation->set_rules('guru_id','Guru', 'required');

    if($this->form_validation->run() == false){

        $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode(array('error' => validation_errors())));

    }else{

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
}


public function ajax_jammapel_edit($id)
{
    $this->cek_session();
    $this->load->model('private/jammapel_model');
    $data = $this->jammapel_model->get_by_id($id);
    echo json_encode($data);
}

/**
 * [jammapel_update description]
 * @author [acil] <[<email address>]>
 * @return [type] [description]
 */
public function jammapel_update(){

    $this->cek_session();

    $this->form_validation->set_rules('start','Jam Mulai', 'required');
    $this->form_validation->set_rules('end','Jam Selesai', 'required');
    $this->form_validation->set_rules('hari_id','Hari', 'required');
    $this->form_validation->set_rules('kelas_id','Kelas', 'required');
    $this->form_validation->set_rules('mapel_id','Mapel', 'required');
    $this->form_validation->set_rules('guru_id','Guru', 'required');

    if($this->form_validation->run() == false){

        $this->output
        ->set_status_header(500)
        ->set_content_type('application/json')
        ->set_output(json_encode(array('error' => validation_errors())));

    }else{

        $this->load->model('private/jammapel_model');
        $data = array(
            'jam_mulai'     => $this->input->post('start'),
            'jam_selesai'   => $this->input->post('end'),
            'hari_id'       => $this->input->post('hari_id'),
            'kelas_id'      => $this->input->post('kelas_id'),
            'mapel_id'      => $this->input->post('mapel_id'),
            'guru_id'       => $this->input->post('guru_id')
            );
        
        $this->db->where('id', $this->input->post('id_jammapel'));
        $this->db->update('jammapel', $data);

        echo json_encode(array("status" => true));
    }

}


/**
 * [jammapel_delete description]
 * @author [acil] <[<email address>]>
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function jammapel_delete($id)
{
    $this->cek_session();
    $this->load->model('private/mapel_model');
    $this->db->delete('jammapel', array('id' => $id));
    echo json_encode(array("status" => true));
}





}


