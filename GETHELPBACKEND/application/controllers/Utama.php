<?php

use Google\Service\Directory\UserName;

defined('BASEPATH') or exit('No direct script access allowed');

class Utama extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('users_model');
        $this->load->model('donasi_model');
        $this->load->model('campaign_model');
    }

    public function index()
    {
        //hapus session filter data user
        $this->session->unset_userdata('kategori');
        $this->session->unset_userdata('keyword');
        $this->session->unset_userdata('cariuser');
        //hapus session jenis akun
        $this->session->unset_userdata('jenis-akun');

        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'GetHelp ~ Hidup Untuk Berbagi';
        $data['category'] = $this->donasi_model->getcategory();
        $data['cfavorit'] = $this->donasi_model->getcategory('favorit');
        $data['campaign'] = $this->donasi_model->getdonasiygaktif('', '', '', 3);
        $data['doa'] = $this->campaign_model->getdoahome(3);
        $data['doamodal'] = $this->campaign_model->getdoahome(10);
        $data['css'] = '';
        $data['js'] = '';

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/halut', $data);
        $this->load->view('templates/home_footer');
    }

    public function about()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Tentang GetHelp - GetHelp';
        $data['css'] = '';
        $data['js'] = '';
        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/about', $data);
        $this->load->view('templates/home_footer');
    }

    public function terms()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Syarat & Ketentuan GetHelp - GetHelp';
        $data['css'] = '';
        $data['js'] = '';
        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/terms', $data);
        $this->load->view('templates/home_footer');
    }

    public function privasi()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Syarat & Ketentuan GetHelp - GetHelp';
        $data['css'] = '';
        $data['js'] = '';
        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/privasi', $data);
        $this->load->view('templates/home_footer');
    }

    public function kontak()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Kontak Kami GetHelp - GetHelp';
        $data['css'] = '';
        $data['js'] = '';

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => ' Email wajib di isi!'
        ]);
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric|min_length[12]', [
            'required' => ' nomor telepon wajib di isi!',
            'numeric' => 'Isi nomor telepon yang benar',
            'min_length' => 'Panjang nomor terlalu pendek'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email', [
            'required' => 'Email wajib di isi!',
            'valid_email' => 'Masukkan alamat email yang benar'
        ]);
        $this->form_validation->set_rules('category', 'Category', 'required', [
            'required' => 'Wajib pilih satu'
        ]);
        $this->form_validation->set_rules('pertanyaan', 'Pertanyaan', 'required', [
            'required' => 'Wajib diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/kontak', $data);
            $this->load->view('templates/home_footer');
        } else {
            $username = $this->input->post('nama');
            $from = $this->input->post('email');
            $phone = $this->input->post('phone');
            $topik = $this->input->post('category');
            $pesan = $this->input->post('pertanyaan');


            $this->_sendemail($username, $pesan, $from, $topik, $phone);
            $this->session->set_flashdata('message', 'Pesan anda berhasil terkirim!, Terima kasih telah mengirim pesan ke kami');
            redirect('kontak');
        }
    }

    private function _sendemail($username, $pesan, $from, $topik, $phone)
    {
        // $config = [
        //     'protocol'  => 'smtp',
        //     'smtp_host' => 'ssl://smtp.googlemail.com',
        //     'smtp_user' => 'gethelp.startup@gmail.com',
        //     'smtp_pass' => 'k&1DZNpl',
        //     'smtp_port' =>  465,
        //     'mailtype'  => 'html',
        //     'charset'   => 'utf-8',
        //     'newline'   => "\r\n"
        // ];
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.gethelpid.com',
            'smtp_user' => 'support@gethelpid.com',
            'smtp_crypto' => 'ssl',
            'smtp_pass' => '4bZ1Tz-8s!iAU1',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"

        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('support@gethelpid.com', 'support@gethelpid.com');
        $this->email->to('gethelp.startup@gmail.com');

        $this->email->subject($topik);

        $this->email->message('
        <h3>Dari :' . $username . '</h3>
        <h4>Email : ' . $from . '</h4>
        <h4>Nomor Telepon : ' . $phone . '</h4>
         <p>' . $pesan . '</p>
  
  </td>
  </tr>
  </tbody>
  </table>
  </td>
  </tbody>
      </table>
  
  
        ');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
