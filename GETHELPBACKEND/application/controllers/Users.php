<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //kalo belum login
        // is_logged_in();
        $this->load->helper(array('url', 'download'));
        $this->load->model('users_model');
        $this->load->model('admin_model');
    }

    public function index()
    {
        $data['title'] = "Daftar Users";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['users'] = $this->users_model->getuser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/users', $data);
        $this->load->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = "Detail Users";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['users'] = $this->users_model->getuser($id);



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->users_model->hapus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus</div>');
        redirect('users');
    }

    public function ubahstatus()
    {
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
        $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Gagal mengubah Status</div>');
            redirect('users');
        } else {
            $id = $this->input->post('user_id');
            $status = $this->input->post('status');
            $verifikasi = $this->input->post('verifikasi');


            $this->users_model->ubahstatus($status, $verifikasi, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Status users berhasil diubah</div>');
            redirect('users');
        }
    }


    public function download($filename)
    {
        $folder = 'assets/img/users/ktp/';


        force_download($folder . $filename, NULL);
    }

    public function downloadselfie($filename)
    {
        $folder = 'assets/img/users/selfie/';


        force_download($folder . $filename, NULL);
    }

    public function downloadnpwp($filename)
    {
        $folder = 'assets/img/users/npwp/';


        force_download($folder . $filename, NULL);
    }
}
