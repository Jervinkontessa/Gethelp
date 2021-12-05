<?php

use Google\Service\Directory\UserName;

defined('BASEPATH') or exit('No direct script access allowed');

class Campaign extends CI_Controller
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
        $this->load->library('form_validation');
        $this->load->model('campaign_model');
        $this->load->model('users_model');
        $this->load->model('donasi_model');
        $this->load->helper('string');
    }

    public function index()
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $data['title'] = 'Mulai Galang Dana - GetHelp';
        $data['category'] = $this->donasi_model->getcategory();


        $data['css'] = '';
        $data['js'] = '';


        //pagination
        $this->load->library('pagination');

        $fundraiser = $this->input->get('u');

        if ($fundraiser) {
            $data['cariuser'] = $fundraiser;
            $this->session->unset_userdata('kategori');
            $this->session->unset_userdata('keyword');
            $this->session->set_userdata('cariuser', $data['cariuser']);
        } else {
            $data['cariuser'] = $this->session->userdata('cariuser');
        }

        $cari = $this->input->get('cari');
        if ($cari) {
            $data['keyword'] = $cari;
            $this->session->unset_userdata('kategori');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }


        //ambil data kategori
        $kategori = $this->input->get('c');

        if ($kategori) {
            $data['kategori'] = $kategori;
            $this->session->unset_userdata('keyword');
            $this->session->set_userdata('kategori', $data['kategori']);
        } else {
            $data['kategori'] = $this->session->userdata('kategori');
        }
        //config
        if ($cari != '') {
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->like('campaign.nama_campaign', $cari);
            $this->db->or_like('category.nama',  $cari);
            $this->db->or_like('users.nama',  $cari);

            $this->db->from('campaign');
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 3;
            $data['total_baris'] =  $config['total_rows'];
        } elseif ($fundraiser != '' && $kategori != '') {
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->where('users.nama',  $fundraiser);
            $this->db->where('category.nama', $kategori);
            $this->db->from('campaign');
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 3;
            $data['total_baris'] =  $config['total_rows'];
        } elseif ($fundraiser != '') {
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->where('users.nama',  $fundraiser);

            $this->db->from('campaign');
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 3;
            $data['total_baris'] =  $config['total_rows'];
        } else {
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->like('category.nama', $data['kategori']);
            $this->db->from('campaign');
            $config['total_rows'] = $this->db->count_all_results();
            $config['per_page'] = 3;
            $data['total_baris'] =  $config['total_rows'];
        }


        // var_dump($config['total_rows']);
        // die;

        $this->pagination->initialize($config);



        $data['start'] = $this->uri->segment(2);;
        $data['campaign'] = $this->campaign_model->getcampaign($config['per_page'], $data['start'],  $data['kategori'], $data['keyword'], $data['cariuser']);

        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/list-campaign', $data);
        $this->load->view('templates/home_footer', $data);
    }

    public function detail($slug)
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));

        $data['detail'] = $this->campaign_model->detailcampaign($slug);
        $data['title'] =  $data['detail']['nama_campaign'];
        $data['update'] = $this->campaign_model->getcampaignupdatebyid($data['detail']['campaign_id']);
        $data['donatur'] = $this->campaign_model->getdonatur($data['detail']['campaign_id'], 5);
        $data['donaturmodal'] = $this->campaign_model->getdonatur($data['detail']['campaign_id'], 10);
        $data['jumlahdonatur'] = $this->campaign_model->getjumlahdonatur($data['detail']['campaign_id']);
        $data['jumlahupdate'] = $this->campaign_model->getjumlahupdate($data['detail']['campaign_id']);
        $data['doa'] = $this->campaign_model->getdonatur($data['detail']['campaign_id'], 4);
        $data['biodata'] = $this->users_model->getuserbiodata($data['detail']['id']);
        $data['css'] = '';
        $data['js'] = '';

        // var_dump($data['update']);
        // die;
        $this->load->view('templates/home_header', $data);
        $this->load->view('templates/home_topbar', $data);
        $this->load->view('home/detail-campaign', $data);
        $this->load->view('templates/home_footer', $data);
    }


    public function report($slug)
    {
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        if ($data['user']) {
            $data['biodata'] = $this->users_model->getuserbiodata($data['user']['id']);
        }
        $data['detail'] = $this->campaign_model->detailcampaign($slug);
        $data['title'] = 'Laporkan Campaign ' . $data['detail']['nama_campaign'];
        $data['css'] = 'css2';
        $data['js'] = 'reportjs';

        $id = $data['detail']['campaign_id'];
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => '*Nama wajib harus ada'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
            'required' => '*Email wajib harus ada',
            'valid_email' => '*Format email salah'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'trim|min_length[10]|max_length[13]|numeric|required', [
            'min_length' => '*Nomor telepon anda terlalu pendek mungkin ada kesalahan dalam penulisan nomor anda',
            'max_length' => '*Nomor telepon anda terlalu panjang mungkin ada kesalahan dalam penulisan nomor anda',
            'numeric' => '*Nomor telepon harus diisi dengan angka',
            'required' => '*Nomor telepon wajib di isi'
        ]);

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => '*Wajib pilih satu'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'min_length[15]|required', [
            'min_length' => '*Detail terlalu pendek',
            'required' => '*Detail wajib di isi'
        ]);
        if (empty($_FILES['fotolaporan']['name'])) {
            $this->form_validation->set_rules('fotolaporan', 'Fotolaporan', 'required', [
                'required' => '*Foto laporan wajib dikirim!'
            ]);
        }


        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nohp = $this->input->post('nohp');
            $kategori = $this->input->post('kategori');
            $keterangan = $this->input->post('keterangan');
            $namafile = random_string('alnum', 15);


            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1048';
            $config['file_name']  = $namafile;
            $config['upload_path'] = './assets/img/buktilaporan';
            $config['overwrite']   = true;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('fotolaporan')) {
                // jika tidak berhasil
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                $this->load->view('templates/home_header', $data);
                $this->load->view('templates/home_topbar', $data);
                $this->load->view('home/report', $data);
                $this->load->view('templates/home_footer', $data);
            } else {
                $bukti = $this->upload->data('file_name');

                $this->campaign_model->insertlaporan($id, $nama, $email, $nohp, $kategori, $keterangan, $bukti);
                $this->_sendemail($nama, $email, $data['detail']['nama_campaign'],  $data['detail']['slug']);
                redirect(base_url('campaign/') . $data['detail']['slug']);
            }
        } else {
            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/report', $data);
            $this->load->view('templates/home_footer', $data);
        }
    }

    public function hapus_session()
    {
        $this->session->unset_userdata('cariuser');
        $this->session->unset_userdata('kategori');
        $this->session->unset_userdata('keyword');
        redirect(base_url('campaign'));
    }

    private function _sendemail($username, $to, $campaign, $slug)
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


        $this->email->subject('Pelaporan pelanggaran');

        $this->email->message('
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hi, ' . $username . '</h3>
      <p>Terima kasih telah melaporkan pelanggaran pada campaign <a href="' . base_url('campaign/') . $slug . '" target="_blank">' . $campaign . '</a></p>
      <p>Team kami akan melakukan evaluasi laporan anda, kami akan menghapus campaign ini
      jika ditemukan pelanggaran yang dilakukan pada campaign ini.</p>
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
