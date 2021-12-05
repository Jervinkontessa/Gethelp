<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


use Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }

    public function login_post()
    {
        $email = $this->post('email');
        $password = $this->post('password');


        //validasi post data
        if (!empty($email) && !empty($password)) {

            $user = $this->users_model->getuser('', $email);

            if ($user) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $this->response([
                        'status' => 200,
                        'message' => 'User login successful.',
                        'data' => [$user]
                    ], REST_Controller::HTTP_OK);
                } else {
                    // Set the response and exit
                    //BAD_REQUEST (400) being the HTTP response code
                    $this->response("Password anda salah.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        } else {
            // Set the response and exit
            //BAD_REQUEST (404) being the HTTP response code
            $this->response("User email tidak ditemukan.", REST_Controller::HTTP_NOT_FOUND);
        }
    }


    public function register_post()
    {
        $email = strip_tags($this->post('email'));
        $username = strip_tags($this->post('username'));
        $phone = strip_tags($this->post('phone'));
        $password = strip_tags($this->post('password'));

        $jenisakun = strip_tags($this->post('jenisakun'));

        //validasi post data
        if (!empty($email) && !empty($username) && !empty($phone) && !empty($password)  && !empty($jenisakun)) {
            //cek password apakah matching dengan pass 2


            $user = $this->users_model->getuser('', $email);

            if ($user > 0) {
                // Set the response and exit
                $this->response("Email sudah terdaftar di website ini.", REST_Controller::HTTP_BAD_REQUEST);
            } else {
                $insert = $this->users_model->adduser($email, $username, $phone, $password, $jenisakun);

                // Check apakah data user sudah dimasukkan
                if ($insert) {
                    // Set the response and exit
                    $this->response([
                        'status' => 200,
                        'message' => 'registrasi berhasil.',
                    ], REST_Controller::HTTP_OK);
                } else {
                    // Set the response and exit
                    //BAD_REQUEST (400) being the HTTP response code
                    $this->response("Registrasi gagal.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        } else {
            // Set the response and exit
            //BAD_REQUEST (400) being the HTTP response code
            $this->response("Harap isi form semua.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function profile_get($userid = 0)
    {
        // cek apakah id user ada atau tidak
        if ($userid != 0) {
            $user = $this->users_model->getuser($userid, '');

            if (!empty($user)) {
                $this->response(['data' => $user], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No user was found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            //BAD_REQUEST (400) being the HTTP response code
            $this->response("Harap mengirim id user.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function usertransaksi_get($userid = 0)
    {
        // cek apakah id user ada atau tidak
        if ($userid != 0) {
            $user = $this->users_model->gettransaksi($userid);

            if (!empty($user)) {
                $this->response(['data' => $user], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => FALSE,
                    'message' => 'No user was found.'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            //BAD_REQUEST (400) being the HTTP response code
            $this->response("Harap mengirim id user.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function verifikasi_put($id)
    {
        $this->post('');
    }
}
