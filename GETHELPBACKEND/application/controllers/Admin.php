<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');

        $this->load->model('users_model');
        $this->load->model('donasi_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['totaluser'] = $this->users_model->totaluser();
        $data['pending'] = $this->donasi_model->countpendingcampaign();
        $data['donasiselesai'] = $this->donasi_model->countcampaignselesai();
        $data['report'] = $this->donasi_model->countreport();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function profile()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));

        $this->form_validation->set_rules('name', 'fullname', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $image = $this->input->post('old_image');

            $uploadimage = $_FILES['image']['name'];

            //cek jika ada gambar yang akan diupload

            // var_dump($uploadimage);
            // die;

            if (!empty($uploadimage)) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                //kb
                $config['upload_path'] = './assets/img/profile/';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // jika berhasil
                    $oldimage = $data['user']['image'];
                    if ($oldimage != 'default.jpeg') {
                        unlink(FCPATH . 'assets/img/profile/' . $oldimage);
                    }

                    $newimage = $this->upload->data('file_name');

                    // $this->db->set('image', $newimage);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $newimage = $image;
            }
            $this->users_model->editprofile($newimage, $name, $email);

            // $this->db->set('nama', $name);
            // $this->db->where('email', $email);
            // $this->db->update('admin');
            if ($name == $data['user']['nama'] && $image == $data['user']['image']) {
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Your Profile has been updated</div>');
                redirect('admin');
            }
        }
    }


    public function changepassword()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));


        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[repeat_password]');
        $this->form_validation->set_rules('repeat_password', 'Repeat Password', 'required|trim|min_length[3]|matches[new_password1]');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $currentpass = $this->input->post('current_password');
            $newpass = $this->input->post('new_password1');
            $repeatpass = $this->input->post('repeat_password');

            if (!password_verify($currentpass, $data['user']['password'])) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong old password</div>');
                redirect('admin/changepassword');
            } else {
                if ($currentpass == $newpass) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New password cannot same with your current password</div>');
                    redirect('admin/changepassword');
                } else {
                    // password baru sdh ok
                    $password_hash = password_hash($newpass, PASSWORD_DEFAULT);

                    // $this->db->set('password', $password_hash);
                    // $this->db->where('email', $this->session->userdata('email'));
                    // $this->db->update('user');
                    $this->users_model->changepassword($password_hash);


                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your Password Changed</div>');
                    redirect('admin/changepassword');
                }
            }
        }
    }
}
