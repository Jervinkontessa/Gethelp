<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galangdana extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        user_sudah_login();
        $this->load->library('form_validation');
        $this->load->model('galangdana_model');
        $this->load->model('users_model');
        $this->load->model('donasi_model');
    }

    public function index()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Mulai Galang Dana - GetHelp';
        $data['verifikasi'] = $data['user']['verifikasi'];
        $data['js'] = '';
        $data['css'] = 'css2';

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/panduan-galang-dana', $data);
    }

    public function mulai()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));

        if ($data['user']['verifikasi'] != 1) {
            redirect('panduan-galang-dana');
        }
        $data['title'] = 'Galang Dana - GetHelp';
        $data['css'] = 'summernote';
        $data['category'] = $this->donasi_model->getcategory();
        $data['js'] = '';
        $userid = $data['user']['id'];
        $email = $data['user']['email'];

        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '*Nama wajib di isi!'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => '*Wajib pilih salah satu'
        ]);
        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[8]|is_unique[campaign.nama_campaign]', [
            'required' => '*Wajib di isi',
            'min_length' => '*Judul terlalu pendek',
            'is_unique' => '*Judul Telah digunakan di galang dana lainnya'
        ]);
        $this->form_validation->set_rules('targetdonasi', 'Targetdonasi', 'required|trim|min_length[8]', [
            'required' => '*Wajib di isi',
            'min_length' => '*Target donasi minimal Rp. 1.000.000',

        ]);
        $this->form_validation->set_rules('date', 'Date', 'required', [
            'required' => '*Wajib di isi',
        ]);
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required|min_length[8]', [
            'required' => '*Wajib di isi',
            'min_length' => '*Tujuan terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerima', 'Penerima', 'required', [
            'required' => '*Wajib di isi'
        ]);
        $this->form_validation->set_rules('rincian', 'Rincian', 'required', [
            'required' => '*Wajib di isi'
        ]);
        if (empty($_FILES['thumbnail']['name'])) {
            $this->form_validation->set_rules('thumbnail', 'Thumbnail', 'required', [
                'required' => '*Foto wajib dikirim!'
            ]);
        }
        $this->form_validation->set_rules('cerita', 'Cerita', 'required', [
            'required' => '*Wajib di isi'
        ]);
        $this->form_validation->set_rules('persetujuan', 'Persetujuan', 'required', [
            'required' => '*Wajib di centang'
        ]);

        if ($this->form_validation->run() == true) {

            $namauser = $this->input->post('nama');
            $kategori =  $this->input->post('kategori');
            $judul =  $this->input->post('judul');
            $targetdonasi = preg_replace("/[^0-9]/", "", $this->input->post('targetdonasi'));
            $tglberakhir =  $this->input->post('date');
            $tujuan =  $this->input->post('tujuan');
            $penerima =  $this->input->post('penerima');
            $rincian =  $this->input->post('rincian');
            $cerita =  $this->input->post('cerita');
            $slug = url_title($judul, 'dash', true);
            $tgldibuat = date("Y-m-d");
            $namaimage = 'thumb' . $userid . $judul;

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['overwrite']   = true;
            $config['file_name']  = $namaimage;
            $config['upload_path'] = './assets/img/donasithumb/';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('thumbnail')) {
                // jika tidak berhasil
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                $this->load->view('templates/home_header', $data);
                $this->load->view('templates/home_topbar', $data);
                $this->load->view('home/form-galang-dana', $data);
            } else {

                $thumbnail = $this->upload->data('file_name');
                $this->galangdana_model->insertnewcampaign($userid, $judul, $slug, $tujuan, $penerima, $rincian, $kategori, $thumbnail, $tgldibuat, $tglberakhir, 2, $cerita, $targetdonasi);
                $this->session->set_flashdata('message', 'Terima kasih telah mengalang dana di gethelp, 
                    status galang dana anda dalam tahap evaluasi. kami akan menginformasikan
                     anda di email tentang status terbaru galang dana anda.');
                $this->_sendemail($namauser, $email);
                redirect('user');
            }
        } else {

            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/form-galang-dana', $data);
        }
    }



    private function _sendemail($username, $to)
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



        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('gethelp.startup@gmail.com', 'GetHelp');
        $this->email->to($to);


        $this->email->subject('Galang Dana');

        $this->email->message('
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hi, ' . $username . '</h3>
      <p>Terima kasih telah mengalang dana di ' . base_url() . ',</p>
      <p>Team kami akan melakukan evaluasi data campaign anda</p>
      <p>untuk sekarang status dari campaign anda dalam masa pending/sedang di evaluasi</p>
      <p>Kami akan mengabari status terbaru campaign anda di email anda.</p>
      <p>Hormat kami,</p>
      <p style="margin-bottom:10px">
      <img src="https://lh3.googleusercontent.com/8c0W8_Zk38CPBivX5kGKBnlTGTBoLqXyT-eJ9G58v-l0dt4ko1x7P_5XlvTb8MN7EImf9FZWfwH4_A3G4JiwOwJ2QY0MC_3b98u6HkvVMNv2krWxqgMQrHbL0-gNTR7b02S09W0M3LsrHJRESxNFCvL6RUv5W941OKSMHZxr8nUUqY_d5AoL6lmCt7CNsLifR6hVNKjy_2WjCaJ1FxRq8HJ26DZ4fc2yVhVz9vM46GgSR-YWTyOSXnyApBQDdaQ3UhWvBhUdarUsiJHj7NkaH5mnV52_8NLVlfV4rtAr095wpsVtxCir9Bq_sSLEYjqkXTue7u3LBXUouN-c93jyYwOGB7qofpGQtOa0TTSx3NC6i42HeiLGnhVrNSxH32s3SgW7ujfMIkIqfuKs9sxmyE48GtUz_LjkNyQb5AO084SzTnta8lauza7IOy4DaOorinU6yo8rSjRShC1f3YdPthR7Eq_KA8j5UeNccOul1rqz7UyVubjnpb4AMv3aI4K7YpHMKkCZh_MbtZVtLZyD_kghS8Pbsh9tr9TiJ7my6v886n1K_1IQo63bhU1zZNJWkxi8eN5hF3Q9SA4uQ6hiZe48PeC87wHvzW8xl9IBPRv_HyRHzlYctuKRSE2s-xAKljKcd5HFv25pxuJoy7gSk38-GaoNV88UiDV9nmlsv4f-Q1SeKayQVURDUL-LDmMsEdE9PAQN3CwuyeiM4wTuBzU=w118-h67-no" style="width: 30%;">
      </p>
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
