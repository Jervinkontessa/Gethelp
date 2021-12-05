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

        $google_client->setClientId('22017256387-cm08ge081u55qm8p855nj3ptdd6cavdi.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('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'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/GETHELPBACKEND/auth/'); //Define your Redirect Uri

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

        $google_client->setClientId('22017256387-cm08ge081u55qm8p855nj3ptdd6cavdi.apps.googleusercontent.com'); //Define your ClientID

        $google_client->setClientSecret('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'); //Define your Client Secret Key

        $google_client->setRedirectUri('http://localhost/GETHELPBACKEND/auth/'); //Define your Redirect Uri

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
  <p>Gethelp.startup adalah sarana digital yang bertujuan untuk memudahkan anda dalam berdonasi
    dan membantu para pengalang dana untuk lebih mudah dalam hal mengalang dana secara online.
  </p>
  <p>Silahkan aktivasi akun anda, <b>jangan dibagikan ke orang lain!</b> <a href="' . base_url() . 'auth/verify?email=' . $to . '&token=' . urlencode($token) . '" >Activasi akun</a></p>
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
  <img src="https://lh3.googleusercontent.com/fife/AAWUweV1sQgDoYdYEdj3u-3dHsN4HYxE3XSnGi6OD1ykr8r_lwxRvKmY0JDedBVcFGKvKmzyB2yDCdW1hhgEdCifL858A1BhTl6F-gjCYBpeu_xsQ-JVE2DAzbg3_WW29AtaWyI2pGk8JEFTH5uC0lwpDo_vtBT2oekPEKVYnlGFTd90E40AtSL8WGwqzDzQ1SfN3CWa8GKbD62sLYn9cyiS3tHA7v4JdAf9Y1Xd3X3kQBv-ymdDtts2FJpu-c7sYp9fbjE57PIJSXXqY0WYlZBstM3qZEbhlYeu4KV_U2wuUkZ8ZEz-8CBUu7OvwjBa_ZM8g-cru7q4WJ2vOTXmdNGAgybTxGhvNOxUHsEy5f8ihQiwAh8lkxKMTcLRs5dSgdD3KsvemZmdR6WwyUYQ_ZCCv9OxyzAL64W1gkZyxkNba9F6QDeKXO82M8FZOMneCbvIV72fee1W8Eb3xqqsTNC3qD43w1K82yuH58Wqh0zOp9QdA64VL3ndIDAGd5xC3NFbyGiHeP80-sIhL8b0vVBkk2wD1YCCHOhWOX5fJUhIw_BOcQZlCf5830lKSJ_65ZMMeot9GwR1ZhWkpd0uGBH5oFfr-AG6VfVcnai31lDIcj6Vzuvo8yyzpnkhnVJDoph6XiUBCwEMqPHoponpCbkQInMoFeEPdB6DbAfh5YqR9Z0_1WbcXBN77Yhd0A4A3X7xoIi4aREMyezSTzfQN_J2qvkPBRu5XymR6svHdebQwH67IismZiauwQZHZ9DEdLsd-7CqauU2tn5xnBMbU-cn5RAqnAYXdGAcmGAI7TvNRS8JIZngAsPsZQ8ibFswHrfnxZTsK2Kqa_0WWjppN75Mx68Bda7NobW0bza2ekFIfaK6VBw_geqeIfa86Qc12FaNxHdpXRrX68u168d07V2CJZA-ilxzzOrAyrjwmIZcn7VKSnRXfC_u8i1sy7sMtsMv8atw_spEoHrCLnBAsRdCrIqUeVsrvRL4VQN_9Jl5ZOpZg-op2GzlaZn1U7AEUXE1BwI0PaFEpDMq8fDhMsX9vMgCM6sVTGu4sdMiNmj8g1-koVOdrGZESTexeEg2vFv4cDyTX3PqqGHmtgw5keRjquIvLofcwV32-lDDYNAyib5oZzOH1TO8EjGf8ayEeVaXKJZ1NZYqlVuF3dNMqUhs4SwfMevr3BwRQCjqmBeWGbKJTpyf8LBmDiSx0YafmfKqA46D5QlWeZoE7gzWP8XEoOQORhZz2CNIRh7F5Z4fzwlC0qUnaG9rbY2B_rEZ36Fk5J1b6lVy0J2QeKfjL3eQxRJ0QuBBd6vvf6mCRiqEUrOZpacQE8axHu6dvg6In-xuYnm04_Vp-JsFwUHmv6ymWqdRDvwDrV7icWuJFwKR-xkDAilmh_1e0J_-lZR2igSXEsC7jF19h9DKiExLnPdMi5dDrovARmQtXQ37GgDJ6PJvuQ7aPfA_Iui-Wn6VoHb_JvNJQ250lFATziMij47GRVVtLfA1GS1neIRCnGhGX310TCYixkFn7F6CjuXrpUVg0bEAHgqYLpo9nYSqgzK_YDrIAF8RUkE2q5SLkIESQTz-kOfenIuMMAuB89ykzbiaOOZghoy4ZZ0mmUbwPGj9FTbKDCVK92BiZsh5daG4AbaeancxBTklklmbIrXWDyinOy9wCFGktMlBGxHpR13AO_5qI-TusE8dV-Qw07Dp4Nsc2j4GEjf5Exz9xCwpIPOll_lb-qOmRDIO8PCrK0BZzxMi8Lvym0Ae99oV1Ii-zADDR5eJ9E2yJBTAhF1yMepk8_bxrikBpn-xcxpMKAcx5OLkSqYE1BGcJduu-LL8csVu6o1GXj-Unw-Z9MpOALkUp9viTZiYh0tSee2Tp0BAhuq9WNCj9AIbcMPlYPbdncVIXtROTS_BF-W88QXqNzAn5Vk2crKicumo7oBS2jzJI_kpyY8y4t0YiDN8v60fB6VmSZQHmJmhIu7-aGKsVpw71tzBQxV8268yfHgTP4umtKYisdkEgC4Up_seuZoLSeK1nPf9SCio7icSgkZ2ej08bIiVHYGEDNGa-rk4FwR9zt_iKLqZ7_yTJVMeSp9ZH4vDpsmFCVjnwMFWZbNgjWWwLVO5tCAxTV_VAI8TNI5uKdhAZJuO58Zj__1KGmpezlJk6xiYkL75AdCEw_LTCCVXjpTiY0JBZFSku1Lsh9sRKObeX69PlMan_lG_A0L0TSU7UWZkIVpjCkv42V9auKoPd4SMYrrrVVXH8AGPRftfE7J4pAZ2iwZIBHTLJqzUKA_Dinznovf24F7mqkPaLMakdO6Py9HYOYkWLI-CZCK7bS_3f6SweJSoL7R7c4MCr3ixFK9kHDpZsbmauqdxmEELeIOft9d0JX7R8hYBZJKTJs5OWygHB0DzZOWx7RcB73HkUxGwM4afg7jlp10JA9kZlWNiiMwl2M9a81sGnjZHhZGJGADfjQQZKJ88ECu64bXLEDm9tM3yT2AgPSs8vvKrhGz3eibP7lMPNu0THEABCAYX6sBla9wsCaIODAK2EvcHk7lm5fvYWIAJQ-a6BHrHH50x-i6O4L7fgb4bLecnlnO3jUkkm5JBCrPK5pQpEka1G9LpiDhOzRcN2IH7wo1hERuHaPzfJd6njlEeroK-X4-2td1H7g4Z900RrvJvzgmNTh9pD1aa6F5UNA7BJK01s0rIL9TnGBJv472WI5axvtrOOd9UqpXvBgnSmgqYRjGJMxVxzxiXfPt-arjN7PmGURuboMTrsBCxynss3zrWZnF8kv0ol-VKqxHKMaT-qNMnxjsRvxJxMZYfaFYNa7hIV0vo4RMLhfJvTIQnBiC9F9h_SKxBAFsFEWPI7seKLamjDwbFTR4yXAXIVpjst50OtjzY0CujMMn7z1KqNnVhREnBlDBhvqHr-LITtkEcqcVdnIsGyC_SA6RAyNIe5Wu-vD1sZlVxlcUdzw4BjH5UnEmbXTv8vMnbvd4SHhpUzJ49YkZ_iRQ-PPCAOyiDfbsr9T0u32rJSmuSH8GZzoiA7qK2R7L_zwqudKiTWGGwKf-NTPtD6NlZRswuzmj4x9fjQLEZCh8kj8hLJxwB3nZU6n9OsjeJoi_w2_yqUN9Y-5xaLDTjkuyftGzGoHhu0f6Gh-4dtS21i84VCt8HEr6wj_h0CLPv7IBQRM6fBISTe0jY-Lf4qUgj76vOYesxy77btAO_VAhP0vC3j2LpMXdgxO_XSGAOPhl2JW-6Z8q8vJaiRjfetJ4zFqpqRnj-yEc9_6tG40xfpkYuFCOwoXDdNkEPPZ5znUCyBJyIzaIGCNwuhIPRJ5DOlYnIf_MGrBTUZAVkGmxei9h6RYeltf4jRc4lj_Gtc_6984FoLEjAuW6_HPJYh5M1LKdUy5rCP53A06BNiIZoqQJJeGuUcTy41RZb9i14XtgzL2ydBdmUCKP9JUfQiZ9fFY0BUP77M-5H0USBM-bHHHWOWfIMYFUunvjdFie5_BWpznugA0Yt4dS1st0XcZLT-helSZMbh2OzWwLpGCWIkx5gyg2y8ucirYzVlluW9R1g3lxZMUuTpsH4fxZKfgchPNMcvWt_gZnR9paDr9Pl954_pVpJJaxmf3RJKxBxTsMdIisN0kozHkf_xu4iUDntkVcrBgjd_vHUtwXvENr7wMzH1W0ptjuQfn5FTUwnPVFb9tbmQxaOgFync1NerTR_Ded5Qphfe6qe88cdHb8LM-rmtDVoR3Ad_TuILoc=s118-w118-h67-no" style="width: 30%;">
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
  <p>Gethelp.startup adalah sarana digital yang bertujuan untuk memudahkan anda dalam berdonasi
    dan membantu para pengalang dana untuk lebih mudah dalam hal mengalang dana secara online.
  </p>
  <p>Silahkan login dengan akun anda dan mulailah donasi pertama mu di Gethelp <a href="http://localhost/GETHELPBACKEND/auth">Login</a></p>
  <p>Hormat kami,</p>
  <p style="margin-bottom:10px">
  <img src="https://lh3.googleusercontent.com/fife/AAWUweV1sQgDoYdYEdj3u-3dHsN4HYxE3XSnGi6OD1ykr8r_lwxRvKmY0JDedBVcFGKvKmzyB2yDCdW1hhgEdCifL858A1BhTl6F-gjCYBpeu_xsQ-JVE2DAzbg3_WW29AtaWyI2pGk8JEFTH5uC0lwpDo_vtBT2oekPEKVYnlGFTd90E40AtSL8WGwqzDzQ1SfN3CWa8GKbD62sLYn9cyiS3tHA7v4JdAf9Y1Xd3X3kQBv-ymdDtts2FJpu-c7sYp9fbjE57PIJSXXqY0WYlZBstM3qZEbhlYeu4KV_U2wuUkZ8ZEz-8CBUu7OvwjBa_ZM8g-cru7q4WJ2vOTXmdNGAgybTxGhvNOxUHsEy5f8ihQiwAh8lkxKMTcLRs5dSgdD3KsvemZmdR6WwyUYQ_ZCCv9OxyzAL64W1gkZyxkNba9F6QDeKXO82M8FZOMneCbvIV72fee1W8Eb3xqqsTNC3qD43w1K82yuH58Wqh0zOp9QdA64VL3ndIDAGd5xC3NFbyGiHeP80-sIhL8b0vVBkk2wD1YCCHOhWOX5fJUhIw_BOcQZlCf5830lKSJ_65ZMMeot9GwR1ZhWkpd0uGBH5oFfr-AG6VfVcnai31lDIcj6Vzuvo8yyzpnkhnVJDoph6XiUBCwEMqPHoponpCbkQInMoFeEPdB6DbAfh5YqR9Z0_1WbcXBN77Yhd0A4A3X7xoIi4aREMyezSTzfQN_J2qvkPBRu5XymR6svHdebQwH67IismZiauwQZHZ9DEdLsd-7CqauU2tn5xnBMbU-cn5RAqnAYXdGAcmGAI7TvNRS8JIZngAsPsZQ8ibFswHrfnxZTsK2Kqa_0WWjppN75Mx68Bda7NobW0bza2ekFIfaK6VBw_geqeIfa86Qc12FaNxHdpXRrX68u168d07V2CJZA-ilxzzOrAyrjwmIZcn7VKSnRXfC_u8i1sy7sMtsMv8atw_spEoHrCLnBAsRdCrIqUeVsrvRL4VQN_9Jl5ZOpZg-op2GzlaZn1U7AEUXE1BwI0PaFEpDMq8fDhMsX9vMgCM6sVTGu4sdMiNmj8g1-koVOdrGZESTexeEg2vFv4cDyTX3PqqGHmtgw5keRjquIvLofcwV32-lDDYNAyib5oZzOH1TO8EjGf8ayEeVaXKJZ1NZYqlVuF3dNMqUhs4SwfMevr3BwRQCjqmBeWGbKJTpyf8LBmDiSx0YafmfKqA46D5QlWeZoE7gzWP8XEoOQORhZz2CNIRh7F5Z4fzwlC0qUnaG9rbY2B_rEZ36Fk5J1b6lVy0J2QeKfjL3eQxRJ0QuBBd6vvf6mCRiqEUrOZpacQE8axHu6dvg6In-xuYnm04_Vp-JsFwUHmv6ymWqdRDvwDrV7icWuJFwKR-xkDAilmh_1e0J_-lZR2igSXEsC7jF19h9DKiExLnPdMi5dDrovARmQtXQ37GgDJ6PJvuQ7aPfA_Iui-Wn6VoHb_JvNJQ250lFATziMij47GRVVtLfA1GS1neIRCnGhGX310TCYixkFn7F6CjuXrpUVg0bEAHgqYLpo9nYSqgzK_YDrIAF8RUkE2q5SLkIESQTz-kOfenIuMMAuB89ykzbiaOOZghoy4ZZ0mmUbwPGj9FTbKDCVK92BiZsh5daG4AbaeancxBTklklmbIrXWDyinOy9wCFGktMlBGxHpR13AO_5qI-TusE8dV-Qw07Dp4Nsc2j4GEjf5Exz9xCwpIPOll_lb-qOmRDIO8PCrK0BZzxMi8Lvym0Ae99oV1Ii-zADDR5eJ9E2yJBTAhF1yMepk8_bxrikBpn-xcxpMKAcx5OLkSqYE1BGcJduu-LL8csVu6o1GXj-Unw-Z9MpOALkUp9viTZiYh0tSee2Tp0BAhuq9WNCj9AIbcMPlYPbdncVIXtROTS_BF-W88QXqNzAn5Vk2crKicumo7oBS2jzJI_kpyY8y4t0YiDN8v60fB6VmSZQHmJmhIu7-aGKsVpw71tzBQxV8268yfHgTP4umtKYisdkEgC4Up_seuZoLSeK1nPf9SCio7icSgkZ2ej08bIiVHYGEDNGa-rk4FwR9zt_iKLqZ7_yTJVMeSp9ZH4vDpsmFCVjnwMFWZbNgjWWwLVO5tCAxTV_VAI8TNI5uKdhAZJuO58Zj__1KGmpezlJk6xiYkL75AdCEw_LTCCVXjpTiY0JBZFSku1Lsh9sRKObeX69PlMan_lG_A0L0TSU7UWZkIVpjCkv42V9auKoPd4SMYrrrVVXH8AGPRftfE7J4pAZ2iwZIBHTLJqzUKA_Dinznovf24F7mqkPaLMakdO6Py9HYOYkWLI-CZCK7bS_3f6SweJSoL7R7c4MCr3ixFK9kHDpZsbmauqdxmEELeIOft9d0JX7R8hYBZJKTJs5OWygHB0DzZOWx7RcB73HkUxGwM4afg7jlp10JA9kZlWNiiMwl2M9a81sGnjZHhZGJGADfjQQZKJ88ECu64bXLEDm9tM3yT2AgPSs8vvKrhGz3eibP7lMPNu0THEABCAYX6sBla9wsCaIODAK2EvcHk7lm5fvYWIAJQ-a6BHrHH50x-i6O4L7fgb4bLecnlnO3jUkkm5JBCrPK5pQpEka1G9LpiDhOzRcN2IH7wo1hERuHaPzfJd6njlEeroK-X4-2td1H7g4Z900RrvJvzgmNTh9pD1aa6F5UNA7BJK01s0rIL9TnGBJv472WI5axvtrOOd9UqpXvBgnSmgqYRjGJMxVxzxiXfPt-arjN7PmGURuboMTrsBCxynss3zrWZnF8kv0ol-VKqxHKMaT-qNMnxjsRvxJxMZYfaFYNa7hIV0vo4RMLhfJvTIQnBiC9F9h_SKxBAFsFEWPI7seKLamjDwbFTR4yXAXIVpjst50OtjzY0CujMMn7z1KqNnVhREnBlDBhvqHr-LITtkEcqcVdnIsGyC_SA6RAyNIe5Wu-vD1sZlVxlcUdzw4BjH5UnEmbXTv8vMnbvd4SHhpUzJ49YkZ_iRQ-PPCAOyiDfbsr9T0u32rJSmuSH8GZzoiA7qK2R7L_zwqudKiTWGGwKf-NTPtD6NlZRswuzmj4x9fjQLEZCh8kj8hLJxwB3nZU6n9OsjeJoi_w2_yqUN9Y-5xaLDTjkuyftGzGoHhu0f6Gh-4dtS21i84VCt8HEr6wj_h0CLPv7IBQRM6fBISTe0jY-Lf4qUgj76vOYesxy77btAO_VAhP0vC3j2LpMXdgxO_XSGAOPhl2JW-6Z8q8vJaiRjfetJ4zFqpqRnj-yEc9_6tG40xfpkYuFCOwoXDdNkEPPZ5znUCyBJyIzaIGCNwuhIPRJ5DOlYnIf_MGrBTUZAVkGmxei9h6RYeltf4jRc4lj_Gtc_6984FoLEjAuW6_HPJYh5M1LKdUy5rCP53A06BNiIZoqQJJeGuUcTy41RZb9i14XtgzL2ydBdmUCKP9JUfQiZ9fFY0BUP77M-5H0USBM-bHHHWOWfIMYFUunvjdFie5_BWpznugA0Yt4dS1st0XcZLT-helSZMbh2OzWwLpGCWIkx5gyg2y8ucirYzVlluW9R1g3lxZMUuTpsH4fxZKfgchPNMcvWt_gZnR9paDr9Pl954_pVpJJaxmf3RJKxBxTsMdIisN0kozHkf_xu4iUDntkVcrBgjd_vHUtwXvENr7wMzH1W0ptjuQfn5FTUwnPVFb9tbmQxaOgFync1NerTR_Ded5Qphfe6qe88cdHb8LM-rmtDVoR3Ad_TuILoc=s118-w118-h67-no" style="width: 30%;">
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
