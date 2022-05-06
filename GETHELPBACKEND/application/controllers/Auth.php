<?php

use Google\Service\Directory\UserName;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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

        $this->load->model('users_model');
    }

    public function index()
    {

        include_once APPPATH . "libraries/vendor/autoload.php";
        $google_client = new Google_Client();

        $google_client->setClientId('1000357075665-3i9llbnnnlakgkfpbml3acni2o4qrklp.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('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'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/GETHELPBACKEND/auth'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);

                $google_service = new Google_Service_Oauth2($google_client);

                $data = $google_service->userinfo->get();

                $user = $this->users_model->getuser('', $data['email']);

                if ($user) {
                    //update data login terakhir
                    $datenow = date("Y-m-d");
                    $user_data = array(
                        'terakhir_login' => $datenow
                    );

                    $this->users_model->update($data['email'], $user_data);
                } else {
                    //insert data
                    $username = $data['given_name'] . ' ' . $data['family_name'];
                    $this->users_model->adduser($data['email'], $username, '', 1);
                    $this->_sendemail($data['given_name'] . ' ' . $data['family_name'], $data['email'], '', '');
                }
                $this->session->set_userdata('user_data', $data['email']);
            }
        }
        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            $login_button = '<a href="' . $google_client->createAuthUrl() . '"  ><img src="' . base_url() . 'assets/img/btn_google.png" alt="Button login with google" width="55%"/></a>';

            $this->form_validation->set_rules('email', 'Email', 'required', [
                'required' => ' Email wajib di isi!'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'trim|required', [
                'required' => 'Password wajib di isi!'
            ]);
            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                $data['login_button'] = $login_button;
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login', $data);
                $this->load->view('templates/auth_footer');
            } else {
                // validation success
                $this->_login();
            }
        } else {
            redirect('usersprofile');
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->users_model->getuserlogin($email);


        //jika user ada
        if ($user) {
            //jika usernya aktif
            if ($user['status'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    if ($user['role'] == 'admin') {
                        $data =  $user['email'];
                        $this->session->set_userdata('admin_data', $data);
                        redirect('admin');
                    } else {
                        $data =  $user['email'];
                        $this->session->set_userdata('user_data', $data);
                        redirect('usersprofile');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                    Password anda salah!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                    </div>');
                    redirect('auth');
                }
            } else if ($user['status'] == 2) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
            akun anda belum teraktivasi coba cek email anda
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
             </button>
            </div>');

                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
            akun anda telah diblokir karena telah melanggar aturan yang berlaku
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
            </div>');

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger  alert-dismissible" role="alert">
            user tidak ditemukan tolong registrasi akun anda atau login dengan akun google
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');

            redirect('auth');
        }
    }



    public function registration()
    {
        include_once APPPATH . "libraries/vendor/autoload.php";
        $google_client = new Google_Client();

        $google_client->setClientId('1000357075665-3i9llbnnnlakgkfpbml3acni2o4qrklp.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('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'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/GETHELPBACKEND/auth'); //Define your Redirect Uri

        $google_client->addScope('email');

        $google_client->addScope('profile');

        if (isset($_GET["code"])) {
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if (!isset($token["error"])) {
                $google_client->setAccessToken($token['access_token']);

                $this->session->set_userdata('access_token', $token['access_token']);


                $data = $google_service->userinfo->get();

                $user = $this->users_model->getuserlogin($data['email']);

                if ($user) {
                    //update data login terakhir
                    $datenow = date("Y-m-d");
                    $user_data = array(
                        'terakhir_login' => $datenow
                    );

                    $this->users_model->update($data['email'], $user_data);
                } else {
                    //insert data


                    $this->users_model->adduser($data['email'], $data['given_name'] . ' ' . $data['family_name'], '', 1);
                    $this->_sendemail($data['given_name'] . ' ' . $data['family_name'], $data['email'], '', '');
                }

                $this->session->set_userdata('user_data', $data['email']);
            }
        }
        $login_button = '';
        if (!$this->session->userdata('access_token')) {
            $login_button = '<a href="' . $google_client->createAuthUrl() . '"  ><img src="' . base_url() . 'assets/img/btn_google.png" alt="Button login with google" width="55%"/></a>';


            $this->form_validation->set_rules('name', 'Name', 'required|trim', [
                'required' => 'form ini wajib di isi!'
            ]);
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
                'is_unique' => 'email ini sudah terdaftar!',
                'required' => 'form ini wajib di isi!',
                'valid_email' => 'format email salah'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[12]', [
                'min_length' => 'Password terlalu pendek',
                'required' => 'form ini wajib di isi!'
            ]);


            if ($this->form_validation->run() == true) {

                $username = $this->input->post('name');
                $email = $this->input->post('email');

                $pass = $this->input->post('password');


                //siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->users_model->adduser($email, $username, $pass, 2);
                $this->db->insert('user_token', $user_token);

                $this->_sendemail($username, $email, 'verifikasi', $token);


                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            Selamat akun anda sudah terdaftar, silahkan cek email anda untuk aktivasi akun
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
            </div>');
                redirect('auth');
            } else {

                $data['title'] = 'Registrasi Akun';
                $data['login_button'] = $login_button;
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/registrasi', $data);
                $this->load->view('templates/auth_footer');
            }
        } else {

            redirect('usersprofile');
        }
    }

    private function _sendemail($username, $to, $type, $token)
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

        if ($type == 'verifikasi') {

            $this->email->subject('Aktivasi Akun');

            $this->email->message('
            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
        <tbody>
          <td align="center">
            <table>
              <tbody>
                <tr>
                  <td valign="top">
        <h3>Selamat bergabung, ' . $username . '</h3>
  <p>Terima kasih telah membuat akun di website kami </p>
  <p>gethelpid adalah sarana digital yang bertujuan untuk memudahkan anda dalam berdonasi
    dan membantu para pengalang dana untuk lebih mudah dalam hal mengalang dana secara online.
  </p>
  <p>Silahkan aktivasi akun anda, <b>jangan dibagikan ke orang lain!</b> <a href="' . base_url() . 'auth/verify?email=' . $to . '&token=' . urlencode($token) . '" >Activasi akun</a></p>
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
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('
            <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hai, ' . $username . '</h3>
            <p>Silahkan untuk melakukan ganti password <b>jangan dibagikan ke orang lain!</b>: <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '" >Reset Password</a></p>
            <p>Link diatas hanya berlaku untuk 1 hari, jika lewat dari 1 hari maka link diatas,</p>
            <p>Tidak aktif lagi maka anda harus meminta link yang baru <a href= "' . base_url('auth/lupapassword') . '">disini</a></p>
            <p>Hormat kami,</p>
  <p style="margin-bottom:10px">
  <img src="' . $image . '" style="width: 30%;">
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tbody>
                </table>
            ');
        } else {
            $this->email->subject('Akun baru');

            $this->email->message('
        <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
        <tbody>
          <td align="center">
            <table>
              <tbody>
                <tr>
                  <td valign="top">
        <h3>Selamat bergabung, ' . $username . '</h3>
  <p>Terima kasih telah membuat akun di website kami </p>
  <p>gethelpid adalah sarana digital yang bertujuan untuk memudahkan anda dalam berdonasi
    dan membantu para pengalang dana untuk lebih mudah dalam hal mengalang dana secara online.
  </p>
  <p>Silahkan login dengan akun anda dan mulailah donasi pertama mu di gethelpid <a href="' . base_url('auth') . '">Login</a></p>
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

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->users_model->getuserlogin($email);


        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('status', 1);
                    $this->db->where('email', $email);
                    $this->db->update('users');


                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    ' . $email . ' telah teraktivasi, silahkan login ke akun.</div>');

                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Akun gagal di aktivasi! token telah expired</div>');

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aktivasi akun gagal! token tak ditemukan</div>');

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Aktivasi akun gagal! email salah</div>');

            redirect('auth');
        }
    }

    public function lupapassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');

            $user = $this->db->get_where('users', ['email' => $email, 'status' => 1])->row_array();

            if ($user) {

                //kalo ada user
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendemail($user['nama'], $email, 'forgot', $token);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                Email link reset password telah dikirimkan ke email anda tolong segera di cek link berlaku untuk 1 hari 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>');

                redirect('auth/lupapassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                 Email belum terdaftar atau belum teraktivasi!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
                 </div>');

                redirect('auth/lupapassword');
            }
        }
    }
    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->users_model->getuserlogin($email);

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);

                    $this->changepassword();
                } else {

                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                Reset password gagal! Token sudah expired 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>');

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                Reset password gagal! Token tidak ditemukan.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                </div>');

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
                 Reset password gagal! Email salah.
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
                 </div>');

            redirect('auth');
        }
    }
    public function changepassword()
    {
        //agar tidak sembarang ubah password tanpa email
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }


        $this->form_validation->set_rules('password1', 'password', 'trim|required|min_length[6]|matches[password2]', [
            'min_length' => 'Password harus minimal 6 huruf atau angka',
            'matches' => 'form password tidak sama dengan form ulangi password!'
        ]);
        $this->form_validation->set_rules('password2', 'repeat password', 'trim|required|matches[password1]', [
            'matches' => 'Harus sama dengan form password diatas!'
        ]);


        if ($this->form_validation->run() == false) {

            $data['title'] = 'Ganti Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/change-password');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                 password telah diganti silahkan login dengan password baru anda
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
                 </div>');

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_data');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        You have been logged out!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');

        redirect('auth');
    }

    public function userlogout()
    {
        $this->session->unset_userdata('user_data');
        $this->session->unset_userdata('access_token');
        $this->session->unset_userdata('jenis-akun');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
        You have been logged out!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
        </div>');

        redirect(base_url());
    }
}
