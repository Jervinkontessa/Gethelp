<?php

use Google\Service\CloudHealthcare\Type;

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //kalo belum login
        is_logged_in();
        $this->load->helper(array('url', 'download'));
        $this->load->model('users_model');
    }

    public function index()
    {
        $data['title'] = "Daftar Users";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
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
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['users'] = $this->users_model->getuserdetail($id);

        $data['yayasan'] = $this->users_model->getorganisasi($id);
        // var_dump($data['yayasan']);
        // die;

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
                Gagal mengubah Status
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
            redirect('users');
        } else {
            $nama = $this->input->post('namauser');
            $email = $this->input->post('emailuser');
            $id = $this->input->post('user_id');
            $status = $this->input->post('status');
            $verifikasi = $this->input->post('verifikasi');

            $data['users'] = $this->users_model->getuser($id);
            $oldverifikasi = $data['users']['verifikasi'];
            $oldstatus = $data['users']['status'];


            $this->users_model->ubahstatus($status, $verifikasi, $id);
            if ($verifikasi == '1') {
                $this->_sendemail($nama, $email, 'diverifikasi');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status users berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('users');
            } elseif ($verifikasi == '2' || $verifikasi == $oldverifikasi) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status users berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('users');
            } elseif ($verifikasi == '0' && $status != $oldstatus) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status users berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('users');
            } elseif ($verifikasi == '0') {

                $this->_sendemail($nama, $email, 'ditolak');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status users berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
                redirect('users');
            }
        }
    }

    private function _sendemail($username, $to, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'gethelp.startup@gmail.com',
            'smtp_pass' => 'k&1DZNpl',
            'smtp_port' =>  465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];


        $image = base_url('assets/img/logo.png');
        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('gethelp.startup@gmail.com', 'GetHelp');
        $this->email->to($to);


        $this->email->subject('Status request verifikasi akun');

        if ($type == 'diverifikasi') {
            $this->email->message('
            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
        <tbody>
          <td align="center">
            <table>
              <tbody>
                <tr>
                  <td valign="top">
        <h3>Hi, ' . $username . '</h3>
  <p>kami ingin mengabari anda tentang status</p>
  <p>Verifikasi akun anda, Kami telah memverifikasi akun anda 
  sekarang anda bisa melakukan galang dana.</p>
  <>anda bisa bergalang dana di <a href="' . base_url() . '" target="_blank">website gethelpstartup</a></p>
  <p>Hormat kami,</p>
  <p style="margin-bottom:10px">
  <img src="' . $image . '" style="width: 30%;">
  </p>
  </td>
  </tr>
  </tbody>
  </table>
  </td>
  </tbody>
      </table>
            ');
        } else {
            $this->email->message('
            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
        <tbody>
          <td align="center">
            <table>
              <tbody>
                <tr>
                  <td valign="top">
        <h3>Hi, ' . $username . '</h3>
        <p>kami ingin mengabari anda tentang status</p>
        <p>Verifikasi akun anda, verifikasi akun anda belum berhasil
        Karena data verifikasi akun anda kurang lengkap atau data yang anda berikan tidak valid.</p>
        <p>Anda bisa melakukan verifikasi akun anda lagi di <a href="' . base_url() . '" target="_blank">website gethelpstartup</a></p>
  <p>Hormat kami,</p>
  <p style="margin-bottom:10px">
  <img src="' . $image . '" style="width: 30%;">
  </p>
  </td>
  </tr>
  </tbody>
  </table>
  </td>
  </tbody>
      </table>
            ');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
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
