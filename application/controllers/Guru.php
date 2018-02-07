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
        $this->load->helper(array('html','form','login','file'));
        $this->load->model('private/guru_model');
        $this->load->model('private/kelas_model');
        $this->load->model('private/mapel_model');
        $this->load->model('private/nilai_model');
    }

    public function index()
    {
        $this->cek_session();
        $id                 = $this->session->userdata('id');
        $data['nik']        = $this->session->userdata('nik');
        $data['nama']       = $this->session->userdata('nama');
        $data['content']    = 'content/private/dashboard';
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
        $data['navigation'] = $this->uri->segment(1);
        $data['pesan']      = $this->guru_model->get_where('guru_pesan_informasi', '*' ,'guru_id',$id);
        $data['content']    = 'content/private/gurupesan';

        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }


    /**
     * [pesan_save description]
     * @author [acil]
     * @return [type] [description]
     */
    public function pesan_save(){

        $this->cek_session();
        $id  = $this->session->userdata('id');

        //form validation
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            $data = array(
                'title' => $this->input->post('title'),
                'guru_id' => $id,
                'isi'   => $this->input->post('isi')
                );

            $this->db->insert('guru_pesan_informasi', $data);
            
            echo json_encode(array("status" => true));

        }
    }

    /**
     * [pesan_get_edit acil]
     * @author [acil] 
     * @return [type] [description]
     */
    public function pesan_get_edit($id){

        $this->cek_session();
        $data = $this->guru_model->get_where_return_row('guru_pesan_informasi','*','id',$id);
        echo json_encode($data);
    }

    public function pesan_update()
    {
        $this->cek_session();


        //form validation
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{


            $id = $this->input->post('id');
            $data = array(
                'title' => $this->input->post('title'),
                'isi'   => $this->input->post('isi')
                );
            $this->db->where('id', $id);
            $this->db->update('guru_pesan_informasi', $data);
            
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => 'Berhasil update data !')));

        }
    }


    /**
     * [pesan_hapus]
     * @author [acil] 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function pesan_hapus($id){

        $this->cek_session();

        $this->guru_model->delete_by_id('guru_pesan_informasi','id',$id);
        echo json_encode(array("status" => true));
    }

    /**
     * [nilai show data]
     * @author [acil] 
     * @return [type] [description]
     */
    public function nilai()
    {
        $this->cek_session();

        $id_guru          = $this->session->userdata('id');
        $data['navigation'] = $this->uri->segment(1);

        $data['content']    = 'content/private/gurunilai';
        $data['nilai']      = $this->guru_model->get_nilai_by_guru($id_guru);

        $data['mapel']      = $this->db->get('mapel')->result_array();
        $data['thajaran']   = $this->db->order_by('id_tahunajaran','desc')->get('tahunajaran')->result_array();
        $data['semester']   = $this->db->get('semester')->result_array();
        $data['kelas']      = $this->db->get('kelas')->result_array();


        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }


    /**
     * [nilai_add save nilai]
     * @author [acil] 
     * @return [type] [description]
     */
    public function nilai_add()
    {
        $this->cek_session();

        $this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');
        $this->form_validation->set_rules('mapel', 'Mapel', 'required');
        $this->form_validation->set_rules('thajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{


            $data = array(
                'title' => $this->input->post('title'),
                'id_guru' => $this->session->userdata('id'),
                'id_mapel' => $this->input->post('mapel'),
                'id_tahunajaran' => $this->input->post('thajaran'),
                'semester' => $this->input->post('semester'), 
                'id_kelas' => $this->input->post('kelas'), 
                );

                //save into database
            $this->db->insert('nilai',$data);

            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => 'Berhasil insert data !')));

        }
    }


    /**
     * [nilai_file_add]
     * @author [acil]
     * @return [type] [description]
     */
    public function nilai_file_add($id){

        $this->cek_session();

        $this->form_validation->set_rules('file', '', 'callback_file_check');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            //upload configuration
            $config['upload_path']   = './assets/file_nilai/';
            //$config['allowed_types'] = 'xls|xlsx|pdf';
            $config['allowed_types'] = '*';
            $config['max_size']      = '2048';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            //upload file to directory
            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];

                //insert file information into the database
                
                $data = array('file' => $uploadedFile);

                $this->db->where('id_nilai', $id);
                $this->db->update('nilai', $data);

                $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => 'Berhasil upload !')));
            }else{
                $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => $this->upload->display_errors())));

            }

        }

    }


    /**
     * [file_check callback validation]
     * @author [acil] 
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    public function file_check($str){

        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){

            $allowed_mime_type_arr = array('application/pdf','
                                            application/zip',
                                            'application/x-zip',
                                            'application/x-zip-compressed',
                                            'application/vnd.ms-excel', //xls
                                            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', //xlsx
                                            'application/vnd.ms-powerpoint', //ppt
                                            'application/vnd.openxmlformats-officedocument.presentationml.presentation', //pptx
                                            'application/msword', //doc
                                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' //docx
                                            );
            $mime = get_mime_by_extension($_FILES['file']['name']);

            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/xls/xlsx/zip/ppt/pptx/docx file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }


    /**
     * [ajax_nilai_edit description]
     * @author [acil]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    
    public function ajax_nilai_edit($id)
    {

        $data = $this->db->where('id_nilai',$id)->get('nilai')->row();
        echo json_encode($data);
    }

    public function nilai_update(){

        $id = $this->input->post('id_nilai');
        $data = array(
            'title' => $this->input->post('title'),
            'id_mapel' => $this->input->post('mapel'),
            'id_tahunajaran' => $this->input->post('thajaran'),
            'semester' => $this->input->post('semester'),
            'id_kelas' => $this->input->post('kelas'),
            );

         $this->db->where('id_nilai', $id);
         $this->db->update('nilai', $data);

        echo json_encode(array("status" => true));


    }

    /**
     * [nilai_delete]
     * @author [acil] 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function nilai_delete($id){

        $this->cek_session();

        $this->db->where('id_nilai', $id);
        $this->db->delete('nilai');

        echo json_encode(array("status" => true));

    }

   

    /**
     * [download_file_nilai description]
     * @author [acil] 
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function download_file_nilai($file){

        $this->load->helper('download');
        force_download('assets/file_nilai/'.$file, NULL);
    }

    /**
     * [profile_update description]
     * @author [acil]
     * @return [type] [description]
     */
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


            if(!empty($_FILES['foto']['name'])){

              $config['upload_path'] = './assets/avatar/';
              $config['allowed_types'] = 'jpg|png|gif';
              $config['max_size'] = '2048';
              $config['max_filename'] = '255';
              $config['encrypt_name'] = TRUE;
              $image_data = array();


                //load the preferences
              $this->load->library('upload', $config);
                //check file successfully uploaded. 'image_name' is the name of the input
              if (!$this->upload->do_upload('foto')) {
                //if file upload failed then catch the errors


                $this->session->set_flashdata('error', $this->upload->display_errors() );

                    //redirect
                redirect('/guru/profile', 'refresh');

            } else {

                // find the old file remove it (pending)

                    //store the file info
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

             $old_image_name    = $this->guru_model->get_select($this->session->userdata('id'), 'foto');

             $file = $config['upload_path'].$old_image_name->foto;
             if (file_exists($file)) {
                unlink($file);
            }

        }

        $tgl   = $this->input->post('tgl');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $tanggal_lahir = $tgl.'-'.$bulan.'-'.$tahun;

            //update data to db
        $data = array(
            'nama' => $this->input->post('nama'),
            'nik' => $this->input->post('nik'),
            'telp' => $this->input->post('telp'),
            'email' => $this->input->post('email'),
            'alamat' => $this->input->post('alamat'),
            'tgl_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $this->input->post('jenis_kelamin')
            );


        if($_FILES['foto']['name']){
            $data['foto'] = $image_data['file_name'];
        }

        $this->guru_model->guru_update(array('id' => $this->session->userdata('id')), $data);

        $this->session->set_flashdata('success', 'Berhasil update data' );

        redirect('/guru/profile', 'refresh');

    }


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



    /**
     * [materi show data]
     * @author [acil] 
     * @return [type] [description]
     */
    public function materi()
    {
        $this->cek_session();

        $id_guru          = $this->session->userdata('id');
        $data['navigation'] = $this->uri->segment(1);

        $data['content']    = 'content/private/gurumateri';
        $data['materi']     = $this->guru_model->get_materi_by_guru($id_guru);

        $data['mapel']      = $this->db->get('mapel')->result_array();
        $data['thajaran']   = $this->db->order_by('id_tahunajaran','desc')->get('tahunajaran')->result_array();
        $data['kelas']      = $this->db->get('kelas')->result_array();
        $data['semester']   = $this->db->get('semester')->result_array();


        $this->load->view('layout/header/private/header');
        $this->load->view('content/private/main', $data);
        $this->load->view('layout/footer/private/footer');
    }


    /**
     * [materi_add save materi]
     * @author [acil] 
     * @return [type] [description]
     */
    public function materi_add()
    {
        $this->cek_session();

        $this->form_validation->set_rules('title', 'Title', 'required|max_length[255]');
        $this->form_validation->set_rules('mapel', 'Mapel', 'required');
        $this->form_validation->set_rules('thajaran', 'Tahun Ajaran', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{


            $data = array(
                'nama_materi' => $this->input->post('title'),
                'id_guru' => $this->session->userdata('id'),
                'id_mapel' => $this->input->post('mapel'),
                'id_tahunajaran' => $this->input->post('thajaran'),
                'semester' => $this->input->post('semester'), 
                'id_kelas' => $this->input->post('kelas'), 
                );

                //save into database
            $this->db->insert('materi',$data);

            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('success' => 'Berhasil insert data !')));

        }
    }


    /**
     * [materi_file_add]
     * @author [acil]
     * @return [type] [description]
     */
    public function materi_file_add($id){

        $this->cek_session();

        $this->form_validation->set_rules('file', '', 'callback_file_check');

        if($this->form_validation->run() === false){

            $this->output
            ->set_status_header(500)
            ->set_content_type('application/json')
            ->set_output(json_encode(array('error' => validation_errors())));

        }else{

            //upload configuration
            $config['upload_path']   = './assets/file_materi/';
            //$config['allowed_types'] = 'xls|xlsx|pdf|zip|rar|ppt|pptx|doc|docx';
            $config['allowed_types'] = '*';
            $config['max_size']      = '2048';
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            //upload file to directory
            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];

                //insert file information into the database
                
                $data = array('file_materi' => $uploadedFile);

                $this->db->where('id_materi', $id);
                $this->db->update('materi', $data);

                $this->output
                ->set_status_header(200)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('success' => 'Berhasil upload !')));
            }else{
                $this->output
                ->set_status_header(500)
                ->set_content_type('application/json')
                ->set_output(json_encode(array('error' => $this->upload->display_errors())));

            }

        }

    }


    /**
     * [ajax_materi_edit description]
     * @author [acil]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    
    public function ajax_materi_edit($id)
    {

        $data = $this->db->where('id_materi',$id)->get('materi')->row();
        echo json_encode($data);
    }

    public function materi_update(){

        $id = $this->input->post('id_materi');
        $data = array(
            'nama_materi' => $this->input->post('title'),
            'id_mapel' => $this->input->post('mapel'),
            'id_tahunajaran' => $this->input->post('thajaran'),
            'semester' => $this->input->post('semester'),
            'id_kelas' => $this->input->post('kelas'),
            );

         $this->db->where('id_materi', $id);
         $this->db->update('materi', $data);

        echo json_encode(array("status" => true));


    }

    /**
     * [materi_delete]
     * @author [acil] 
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function materi_delete($id){

        $this->cek_session();

        $this->db->where('id_materi', $id);
        $this->db->delete('materi');

        echo json_encode(array("status" => true));

    }

   

    /**
     * [download_file_materi description]
     * @author [acil] 
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    public function download_file_materi($file){

        $this->load->helper('download');
        force_download('assets/file_materi/'.$file, NULL);
    }


    //  public function materi()
    // {
    //     $this->cek_session();
    //     $data['id']         = $this->session->userdata('id');
    //     $data['nik']        = $this->session->userdata('nik');
    //     $data['nama']       = $this->session->userdata('nama');
    //     $data['navigation'] = $this->uri->segment(1);
    //     $data['kelas']    = $this->kelas_model->get_all_kelas();
    //     $data['content'] = 'content/private/gurumateri';
    //     $data['materi']   = $this->guru_model->get_materi();
    //     $data['mapel']    = $this->mapel_model->get_all_mapel();

    //     $this->load->view('layout/header/private/header');
    //     $this->load->view('content/private/main', $data);
    //     $this->load->view('layout/footer/private/footer');
    // }





    //  public function materi_add()
    // {
        
    //     $file_element_name = 'userfile';


    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'gif|jpg|png|doc|txt|xls|';
    //     $config['max_size'] = 1024 * 8;
    //     $config['encrypt_name'] = TRUE;

    //      $this->load->library('upload', $config);
 
    //     if (!$this->upload->do_upload($file_element_name))
    //     {
    //         $status = 'error';
    //         $msg = $this->upload->display_errors('', '');
    //     }
    //     else
    //     {
    //         $data = $this->upload->data();
    //                 $data_nilai = array(
    //                 'file' =>  $data['file_name'],
    //                 'id_guru' => $this->input->post('id_guru'),
    //                 'mapel_id' => $this->input->post('mapel_id'),
    //                 'kelas_id' => $this->input->post('kelas_id'),
    //                 'judul' => $this->input->post('judul'),
    //                 );
        
    //         $file_id  = $this->nilai_model->materi_add($data_nilai);

    //         if($file_id)
    //         {
    //             $status = "success";
    //             $msg = "File successfully uploaded";
    //         }
    //         else
    //         {
    //             unlink($data['full_path']);
    //             $status = "error";
    //             $msg = "Something went wrong when saving the file, please try again.";
    //         }
    //     }
    //     @unlink($_FILES[$file_element_name]);



  
    //     echo json_encode(array("status" => $data, "msg" =>$msg));

    // }


    // public function materi_delete($id){

        
    //     $this->nilai_model->delete_materi($id);
    //     echo json_encode(array("status" => true));

    // }

}
