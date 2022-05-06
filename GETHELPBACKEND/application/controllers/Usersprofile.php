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

    public function hapusakun()
    {
        $data['user'] = $this->users_model->getuser('', $this->session->userdata('user_data'));
        $id = $data['user']['id'];
        $jenisakun = $data['user']['jenis_akun'];
        $data['biodata'] = $this->users_model->getbiodata($id);
        $data['yayasan'] = $this->users_model->getorganisasi($id);
        if ($data['biodata'] != null) {
            $ktpbiodata = $data['biodata']['ktp'];
            $ktpselfie = $data['biodata']['selfie_ktp'];
        }
        if ($data['yayasan'] != null) {
            $ktppj = $data['yayasan']['ktp_pj'];
            $berkasP = $data['yayasan']['berkas_pendukung'];
        }
        // var_dump($data['user']);
        // die;
        $imageuser = $data['user']['image'];
        $usermail = $this->input->post('email');

        if ($usermail != $data['user']['email']) {
            $this->session->set_flashdata('error_msg2', 'Masukkan email akun anda, bukan email yang lain.');
            redirect('usersprofile');
        } else {
            if ($jenisakun == 'Individu' && $data['biodata'] != null) {
                if ($imageuser != 'default.png') {
                    unlink(FCPATH . 'assets/img/users/profile/' . $imageuser);
                }
                unlink(FCPATH . 'assets/img/users/ktp/' . $ktpbiodata);
                unlink(FCPATH . 'assets/img/users/selfie/' . $ktpselfie);
                $this->session->unset_userdata('user_data');
                $this->session->unset_userdata('access_token');
                $this->session->unset_userdata('jenis-akun');
                $this->users_model->hapus($id);
                $this->users_model->deletebiodata($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        Akun anda berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
                redirect('auth');
            } elseif ($jenisakun == 'Individu' && $data['biodata'] == null) {
                if ($imageuser != 'default.png') {
                    unlink(FCPATH . 'assets/img/users/profile/' . $imageuser);
                }
                $this->session->unset_userdata('user_data');
                $this->session->unset_userdata('access_token');
                $this->session->unset_userdata('jenis-akun');
                $this->users_model->hapus($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        Akun anda berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
                redirect('auth');
            } elseif ($jenisakun != 'Individu') {
                if ($imageuser != 'default.png') {
                    unlink(FCPATH . 'assets/img/users/profile/' . $imageuser);
                }
                unlink(FCPATH . 'assets/img/users/ktp/' . $ktpbiodata);
                unlink(FCPATH . 'assets/img/users/selfie/' . $ktpselfie);
                unlink(FCPATH . 'assets/img/users/ktppj/' . $ktppj);
                if ($data['yayasan']['berkas_pendukung'] != '') {
                    unlink(FCPATH . 'assets/img/users/berkasP/' . $berkasP);
                }
                $this->session->unset_userdata('user_data');
                $this->session->unset_userdata('access_token');
                $this->session->unset_userdata('jenis-akun');
                $this->users_model->hapus($id);
                $this->users_model->deletebiodata($id);
                $this->users_model->deleteorganisasi($id);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        Akun anda berhasil Dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');
                redirect('auth');
            }
        }
    }
    public function newpassword()
    {

        $data['user'] = $this->users_model->getuser('', $this->session->userdata('user_data'));


        if ($data['user']['password'] != '') {
            $this->form_validation->set_rules('passsekarang', 'Passsekarang', 'required|trim|min_length[8]|matches[repeatpass]', [
                'required' => 'Form password sekarang wajib harus ada',
                'min_length' => 'Password terlalu pendek'
            ]);
            $this->form_validation->set_rules('passbaru', 'Passbaru', 'required|trim|min_length[8]', [
                'min_length' => 'Form password baru terlalu pendek',
                'required' => 'Password baru wajib harus ada',
            ]);
            $this->form_validation->set_rules('repeatpass', 'repeatpass', 'min_length[8]|required|matches[passbaru]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form konfirmasi password baru Wajib Diisi',
                'matches' => 'Password baru harus sama dengan form konfirmasi password baru'
            ]);
        } else {
            $this->form_validation->set_rules('password1', 'password1', 'min_length[8]|required|matches[password1]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form password Wajib Diisi',
                'matches' => 'Form ini harus sama dengan form password baru'
            ]);
            $this->form_validation->set_rules('password2', 'password2', 'min_length[8]|required|matches[password2]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'Form konfirmasi password Wajib Diisi',
                'matches' => 'Form password harus sama dengan form konfirmasi password'
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
            if (form_error('passsekarang', ' <span class="pl-3">', '</span>') != null) {
                $this->session->set_flashdata('error_msg', form_error('passsekarang', ' <span class="pl-3">', '</span>'));
                $this->session->set_flashdata('error_msg2', form_error('passbaru', ' <span class="pl-3">', '</span>'));
                $this->session->set_flashdata('error_msg3', form_error('repeatpass', ' <span class="pl-3">', '</span>'));
                redirect('usersprofile');
            } else {
                $this->session->set_flashdata('error_msg', form_error('password1', ' <span class="pl-3">', '</span>'));
                $this->session->set_flashdata('error_msg2', form_error('password2', ' <span class="pl-3">', '</span>'));
                redirect('usersprofile');
            }
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


        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '*Nama wajib di isi!',
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
                    $this->verifikasi_model->updatejenisakun($userid);

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


        $this->form_validation->set_rules('nama', 'Nama', 'required', [
            'required' => '*Nama wajib di isi!',
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
                            $this->verifikasi_model->updatejenisakun($userid, '2');

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
                                $this->verifikasi_model->updatejenisakun($userid, 2);

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
            'smtp_host' => 'mail.gethelpid.com',
            'smtp_user' => 'admin@gethelpid.com',
            'smtp_crypto' => 'ssl',
            'smtp_pass' => '4bZ1Tz-8s!iAU1',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"

        ];
        $image = base_url('assets/img/logo.png');


        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('admin@gethelpid.com', 'GetHelp');
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

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
