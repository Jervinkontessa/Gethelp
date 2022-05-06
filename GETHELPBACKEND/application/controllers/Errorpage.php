<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Errorpage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function notfound()
    {
        $this->load->view('errorpage/error404.php');
    }
}
