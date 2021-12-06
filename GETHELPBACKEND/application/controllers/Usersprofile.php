<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usersprofile extends CI_Controller
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
        user_sudah_login();
        $this->load->library('form_validation');
        $this->load->model('users_model');
        $this->load->model('donasi_model');
        $this->load->model('verifikasi_model');
    }

    public function index()
    {

        $data['title'] = 'Dashboard ~ GetHelp';
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        $nama = $data['user']['nama'];
        $id = $data['user']['id'];
        $data['biodata'] = $this->users_model->getbiodata($id);
        $data['donasiuser'] = $this->users_model->gettransaksi($nama);


        $data['campaignuser'] = $this->users_model->getcampaign($id, '');



        $this->form_validation->set_rules('username', 'username', 'required|trim', [
            'required' => 'Nama wajib harus ada'
        ]);

        $this->form_validation->set_rules('phone', 'Phone', 'trim|min_length[10]|max_length[13]|numeric', [
            'min_length' => 'Nomor telepon anda terlalu pendek mungkin ada kesalahan dalam penulisan nomor anda',
            'max_length' => 'Nomor telepon anda terlalu panjang mungkin ada kesalahan dalam penulisan nomor anda',
            'numeric' => 'nomor telepon harus diisi dengan angka'
        ]);
        $this->form_validation->set_rules('alamat', 'alamat', 'min_length[10]|max_length[200]', [
            'min_length' => 'alamat terlalu pendek',
            'max_length' => 'alamat terlalu panjang'
        ]);
        if ($this->form_validation->run() == true) {
            $name = $this->input->post('username');
            $email = $this->input->post('email');
            $image = $this->input->post('oldimage');
            $phone = $this->input->post('phone');
            $alamat = $this->input->post('alamat');



            $uploadimage = $_FILES['image']['name'];



            if (!empty($uploadimage)) {
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = '1048';
                //kb
                $config['upload_path'] = './assets/img/users/profile';
                $config['overwrite'] = true;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    // jika berhasil
                    $oldimage = $data['user']['image'];
                    if ($oldimage != 'default.png') {
                        unlink(FCPATH . 'assets/img/users/profile/' . $oldimage);
                    }

                    $newimage = $this->upload->data('file_name');
                    $this->session->set_flashdata('message2', 'foto profil berhasil diubah');

                    // $this->db->set('image', $newimage);
                } else {
                    $this->session->set_flashdata('error_msg', 'error dalam
                     mengupload gambar coba cek ukuran gambar atau ektensi
                      gambar yang di upload harus sesuai yang ditentukan oleh gethelp');
                    redirect('usersprofile');
                }
            } else {
                $newimage = $image;
            }

            $this->users_model->editprofileuser($newimage, $name, $email);
            $this->users_model->updatebiodata($phone, $alamat, $id);
            if ($name == $data['user']['nama']) {
                redirect('usersprofile');
            } else {
                $this->session->set_flashdata('message', 'Profile berhasil di update.');
                redirect('usersprofile');
            }
        } else {
            $this->load->view('home/user_profile', $data);
        }
    }


    public function newpassword()
    {

        $data['user'] = $this->users_model->getuser('', $this->session->userdata('user_data'));


        if ($data['user']['password'] != '') {
            $this->form_validation->set_rules('passsekarang', 'Passsekarang', 'required|trim|min_length[8]|matches[repeatpass]', [
                'required' => 'Password sekarang wajib harus ada',
                'min_length' => 'Password terlalu pendek'
            ]);
            $this->form_validation->set_rules('passbaru', 'Passbaru', 'required|trim|min_length[8]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Password sekarang wajib harus ada',
            ]);
            $this->form_validation->set_rules('repeatpass', 'repeatpass', 'min_length[8]|required|matches[passbaru]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form Wajib Diisi',
                'matches' => 'Form ini harus sama dengan form password baru'
            ]);
        } else {
            $this->form_validation->set_rules('password1', 'password1', 'min_length[8]|required|matches[password1]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form Wajib Diisi',
                'matches' => 'Form ini harus sama dengan form password baru'
            ]);
            $this->form_validation->set_rules('password2', 'password2', 'min_length[8]|required|matches[password2]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form Wajib Diisi',
                'matches' => 'Form ini harus sama dengan form password baru'
            ]);
        }

        if ($this->form_validation->run() == true) {
            if ($data['user']['password'] != '') {
            } else {
                $passnew = $this->input->post('password1');
                $password_hash = password_hash($passnew, PASSWORD_DEFAULT);

                // masukan password user jika password user kosong
                $this->users_model->newpassword($password_hash, $data['user']['email']);
                $this->session->set_flashdata('message', 'Password berhasil dibuat.');
                redirect('usersprofile');
            }
        } else {
            redirect('usersprofile');
        }
    }
    public function verifikasi()
    {

        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));

        if ($data['user']['verifikasi'] == 2 || $data['user']['verifikasi'] == 1) {
            redirect('user');
        }
        $data['title'] = 'Verifikasi Akun - GetHelp';
        $data['css'] = 'css2';
        $data['js'] = '';
        $data['jenis_akun'] = $this->verifikasi_model->getjenisakun();

        $this->form_validation->set_rules('jenis-akun', 'Jenis-akun', 'required', [
            'required' => 'wajib pilih 1 jenis akun !'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/pilihjenisakun', $data);
        } else {
            $jenisakun = $this->input->post('jenis-akun');

            if ($jenisakun == 'Individu') {
                redirect('verifikasi-akun-individu');
            } else {
                redirect('verifikasi-akun-organisasi');
            }
        }
    }

    public function verifikasi_individu()
    {

        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        if ($data['user']['verifikasi'] == 2 || $data['user']['verifikasi'] == 1) {
            redirect('user');
        }

        $data['title'] = 'Verifikasi Akun individu - GetHelp';
        $data['css'] = 'css2';
        $data['js'] = '';
        $data['jenis_akun'] = $this->verifikasi_model->getjenisakun();

        $userid = $data['user']['id'];
        $email = $data['user']['email'];


        $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[biodata.nama_lengkap]', [
            'required' => '*Nama wajib di isi!',
            'is_unique' => '*Nama Sudah dipakai oleh user lain pastikan nama kamu sama dengan ktp'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|numeric|min_length[12]|is_unique[biodata.phone]', [
            'required' => '*Wajib di isi!',
            'numeric' => '*Isi nomor telepon dengan angka saja',
            'min_length' => '*Panjang nomor terlalu pendek',
            'is_unique' => '*Nomor telepon/wa telah dipakai oleh user lain'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '*Alamat wajib di isi!',
        ]);
        $this->form_validation->set_rules('noktp', 'Noktp', 'required|min_length[15]|numeric|is_unique[biodata.noktp]', [
            'required' => '*Wajib di isi!',
            'min_length' => '*No ktp terlalu pendek',
            'numeric' => '*no ktp harus berupa angka',
            'is_unique' => '*no ktp sudah terdaftar oleh user lain'
        ]);
        $this->form_validation->set_rules('bank', 'Bank', 'required', [
            'required' => '*Wajib pilih salah satu'
        ]);
        $this->form_validation->set_rules('no-rek', 'No-rek', 'required|numeric|is_unique[biodata.no_rekening]', [
            'required' => '*Wajib di isi',
            'numeric' => '*nomor rekening cuma boleh angka',
            'is_unique' => '*nomor rekening sudah dipakai oleh user lain'
        ]);
        $this->form_validation->set_rules('nama-prek', 'Nama-prek', 'required', [
            'required' => '*Wajib di isi',
        ]);
        if (empty($_FILES['ktp']['name'])) {
            $this->form_validation->set_rules('ktp', 'Ktp', 'required', [
                'required' => '*Foto Ktp wajib dikirim!'
            ]);
        }

        if (empty($_FILES['selfie']['name'])) {
            $this->form_validation->set_rules('selfie', 'Selfie', 'required', [
                'required' => '*Foto Selfie dengan Ktp wajib dikirim!'
            ]);
        }


        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama');
            $nohp = $this->input->post('nohp');
            $alamat = $this->input->post('alamat');
            $noktp = $this->input->post('noktp');
            $bank = $this->input->post('bank');
            $norek = $this->input->post('no-rek');
            $namaprek = $this->input->post('nama-prek');


            $namafilektp =  $userid . 'ktp';
            $namafileselfie =  $userid . 'selfie';

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1048';
            $config['file_name']  = $namafilektp;
            $config['upload_path'] = './assets/img/users/ktp';
            $config['overwrite']   = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('ktp')) {
                // jika tidak berhasil
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                $this->load->view('templates/home_header', $data);
                $this->load->view('templates/home_topbar', $data);
                $this->load->view('home/verifikasi-individu', $data);
            } else {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '1048';
                $config['file_name']  = $namafileselfie;
                $config['upload_path'] = './assets/img/users/selfie';
                $config['overwrite']   = true;
                $ktp = $this->upload->data('file_name');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('selfie')) {
                    $this->session->set_flashdata('error_msg2', $this->upload->display_errors());
                    $this->load->view('templates/home_header', $data);
                    $this->load->view('templates/home_topbar', $data);
                    $this->load->view('home/verifikasi-individu', $data);
                } else {
                    $selfie = $this->upload->data('file_name');
                    $this->verifikasi_model->masukkan_biodata($userid, $nama, $alamat, $nohp, $noktp, $bank, $norek, $namaprek, $ktp, $selfie);
                    $this->verifikasi_model->updatestatus($userid);

                    $this->_sendemail($nama, $email);
                    redirect('user');
                }
            }
        } else {
            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/verifikasi-individu', $data);
        }
    }

    public function verifikasi_organisasi()
    {

        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('user_data'));
        if ($data['user']['verifikasi'] == 2 || $data['user']['verifikasi'] == 1) {
            redirect('user');
        }

        $data['title'] = 'Verifikasi Akun Organisasi - GetHelp';
        $data['css'] = 'css2';
        $data['js'] = '';
        $data['jenis_akun'] = $this->verifikasi_model->getjenisakun();

        $userid = $data['user']['id'];
        $email = $data['user']['email'];


        $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[biodata.nama_lengkap]', [
            'required' => '*Nama wajib di isi!',
            'is_unique' => '*Nama Sudah dipakai oleh user lain pastikan nama kamu sama dengan ktp'
        ]);
        $this->form_validation->set_rules('nohp', 'Nohp', 'required|numeric|min_length[12]|is_unique[biodata.phone]', [
            'required' => '*Wajib di isi!',
            'numeric' => '*Isi nomor telepon dengan angka saja',
            'min_length' => '*Panjang nomor terlalu pendek',
            'is_unique' => '*nomor telepon sudah dipakai oleh user lain'
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
            'required' => '*Alamat wajib di isi!',
        ]);
        $this->form_validation->set_rules('noktp', 'Noktp', 'required|min_length[15]|numeric|is_unique[biodata.noktp]', [
            'required' => '*Wajib di isi!',
            'min_length' => '*No ktp terlalu pendek',
            'numeric' => '*no ktp harus berupa angka',
            'is_unique' => '* no ktp sudah dipakai oleh user lain'
        ]);
        $this->form_validation->set_rules('bank', 'Bank', 'required', [
            'required' => '*Wajib pilih salah satu'
        ]);
        $this->form_validation->set_rules('no-rek', 'No-rek', 'required|numeric|is_unique[biodata.no_rekening]', [
            'required' => '*Wajib di isi',
            'numeric' => '*nomor rekening cuma boleh angka',
            'is_unique' => '*nomor rekening telah digunakan oleh user lain'
        ]);
        $this->form_validation->set_rules('nama-prek', 'Nama-prek', 'required', [
            'required' => '*Wajib di isi'
        ]);
        $this->form_validation->set_rules('namapj', 'Namapj', 'required', [
            'required' => '*Wajib di isi'
        ]);
        $this->form_validation->set_rules('namaorg', 'Namaorg', 'required|is_unique[organisasi.nama_organisasi]', [
            'required' => '*Wajib di isi',
            'is_unique' => '*Nama Organisasi sudah ada terdaftar'
        ]);
        $this->form_validation->set_rules('nopj', 'Nopj', 'required|numeric|min_length[12]', [
            'required' => '*Wajib di isi!',
            'numeric' => '*Isi nomor telepon dengan angka saja',
            'min_length' => '*Panjang nomor terlalu pendek'
        ]);
        if (empty($_FILES['ktp']['name'])) {
            $this->form_validation->set_rules('ktp', 'Ktp', 'required', [
                'required' => '*Foto Ktp wajib dikirim!'
            ]);
        }

        if (empty($_FILES['selfie']['name'])) {
            $this->form_validation->set_rules('selfie', 'Selfie', 'required', [
                'required' => '*Foto Selfie dengan Ktp wajib dikirim!'
            ]);
        }
        if (empty($_FILES['ktppj']['name'])) {
            $this->form_validation->set_rules('ktppj', 'Ktppj', 'required', [
                'required' => '*Foto Ktp penanggung jawab wajib dikirim!'
            ]);
        }

        if ($this->form_validation->run() == true) {
            $nama = $this->input->post('nama');
            $nohp = $this->input->post('nohp');
            $alamat = $this->input->post('alamat');
            $noktp = $this->input->post('noktp');
            $bank = $this->input->post('bank');
            $norek = $this->input->post('no-rek');
            $namaprek = $this->input->post('nama-prek');
            $namapj = $this->input->post('namapj');
            $nopj = $this->input->post('nopj');
            $namaorg = $this->input->post('namaorg');


            $namafilektp =  $userid . 'ktp';
            $namafileselfie = $userid . 'selfie';
            $namafilektppj =  $userid . 'ktppj';
            $namafileberkasP = $userid . 'berkasP';

            if (empty($_FILES['berkas']['name'])) {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '1048';
                $config['file_name']  = $namafilektp;
                $config['upload_path'] = './assets/img/users/ktp';
                $config['overwrite']   = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('ktp')) {
                    // jika tidak berhasil
                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    $this->load->view('templates/home_header', $data);
                    $this->load->view('templates/home_topbar', $data);
                    $this->load->view('home/verifikasi-organisasi', $data);
                } else {
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size'] = '1048';
                    $config['file_name']  = $namafileselfie;
                    $config['upload_path'] = './assets/img/users/selfie';
                    $config['overwrite']   = true;
                    $ktp = $this->upload->data('file_name');
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('selfie')) {
                        $this->session->set_flashdata('error_msg2', $this->upload->display_errors());
                        $this->load->view('templates/home_header', $data);
                        $this->load->view('templates/home_topbar', $data);
                        $this->load->view('home/verifikasi-organisasi', $data);
                    } else {
                        $config['allowed_types'] = 'jpg|png|jpeg';
                        $config['max_size'] = '1048';
                        $config['file_name']  = $namafilektppj;
                        $config['upload_path'] = './assets/img/users/ktppj';
                        $config['overwrite']   = true;
                        $selfie = $this->upload->data('file_name');
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('ktppj')) {
                            $this->session->set_flashdata('error_msg3', $this->upload->display_errors());
                            $this->load->view('templates/home_header', $data);
                            $this->load->view('templates/home_topbar', $data);
                            $this->load->view('home/verifikasi-organisasi', $data);
                        } else {
                            $ktppj = $this->upload->data('file_name');
                            $this->verifikasi_model->masukkan_organisasi($userid, $namapj, $namaorg, $nopj, $ktppj);
                            $this->verifikasi_model->masukkan_biodata($userid, $nama, $alamat, $nohp, $noktp, $bank, $norek, $namaprek, $ktp, $selfie);
                            $this->verifikasi_model->updatestatus($userid);

                            $this->_sendemail($nama, $email);
                            redirect('user');
                        }
                    }
                }
            } else {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size'] = '1048';
                $config['file_name']  = $namafilektp;
                $config['upload_path'] = './assets/img/users/ktp';
                $config['overwrite']   = true;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('ktp')) {
                    // jika tidak berhasil
                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    $this->load->view('templates/home_header', $data);
                    $this->load->view('templates/home_topbar', $data);
                    $this->load->view('home/verifikasi-organisasi', $data);
                } else {
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $config['max_size'] = '1048';
                    $config['file_name']  = $namafileselfie;
                    $config['upload_path'] = './assets/img/users/selfie';
                    $config['overwrite']   = true;
                    $ktp = $this->upload->data('file_name');
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('selfie')) {
                        $this->session->set_flashdata('error_msg2', $this->upload->display_errors());
                        $this->load->view('templates/home_header', $data);
                        $this->load->view('templates/home_topbar', $data);
                        $this->load->view('home/verifikasi-organisasi', $data);
                    } else {
                        $config['allowed_types'] = 'jpg|png|jpeg';
                        $config['max_size'] = '1048';
                        $config['file_name']  = $namafilektppj;
                        $config['upload_path'] = './assets/img/users/ktppj';
                        $config['overwrite']   = true;
                        $selfie = $this->upload->data('file_name');
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('ktppj')) {
                            $this->session->set_flashdata('error_msg3', $this->upload->display_errors());
                            $this->load->view('templates/home_header', $data);
                            $this->load->view('templates/home_topbar', $data);
                            $this->load->view('home/verifikasi-organisasi', $data);
                        } else {
                            $config['allowed_types'] = 'jpg|png|jpeg|pdf';
                            $config['max_size'] = '1048';
                            $config['file_name']  =  $namafileberkasP;
                            $config['upload_path'] = './assets/img/users/berkasP';
                            $config['overwrite']   = true;
                            $ktppj = $this->upload->data('file_name');
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            if (!$this->upload->do_upload('berkas')) {
                                $this->session->set_flashdata('error_msg4', $this->upload->display_errors());
                                $this->load->view('templates/home_header', $data);
                                $this->load->view('templates/home_topbar', $data);
                                $this->load->view('home/verifikasi-organisasi', $data);
                            } else {
                                $berkaspendukung = $this->upload->data('file_name');
                                $this->verifikasi_model->masukkan_organisasi($userid, $namapj, $namaorg, $nopj, $ktppj, $berkaspendukung);
                                $this->verifikasi_model->masukkan_biodata($userid, $nama, $alamat, $nohp, $noktp, $bank, $norek, $namaprek, $ktp, $selfie);
                                $this->verifikasi_model->updatestatus($userid);

                                $this->_sendemail($nama, $email);
                                redirect('user');
                            }
                        }
                    }
                }
            }
        } else {

            $this->load->view('templates/home_header', $data);
            $this->load->view('templates/home_topbar', $data);
            $this->load->view('home/verifikasi-organisasi', $data);
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


        $this->email->subject('Verifikasi Akun');

        $this->email->message('
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hi, ' . $username . '</h3>
      <p>Terima kasih telah melakukan verifikasi akun anda</p>
      <p>Team kami akan melakukan evaluasi data verifikasi akun anda paling selambatnya 5 hari kerja, kami akan mengirim email
      ke alamat email akun anda jika verifikasi akun anda berhasil, jika tidak berhasil</p>
      <p>kami akan membuka kembali link untuk verifikasi akun anda kembali.</p>
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
