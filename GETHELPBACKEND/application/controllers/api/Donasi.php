<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


use Restserver\Libraries\REST_Controller;

class Donasi extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('donasi_model');
    }

    public function campaign_get($slug = '')
    {

        if ($slug != '') {
            $data = $this->donasi_model->getdonasiygaktif($slug);

            if ($data) {
                $this->response(['data' => $data], REST_Controller::HTTP_OK);
            } else {
                //BAD_REQUEST (404) being the HTTP response code
                $this->response("Slug campaign tak ditemukan.", REST_Controller::HTTP_NOT_FOUND);
            }
        } elseif (null !== $this->get('c')) {
            $category = $this->get('c');

            $data = $this->donasi_model->getdonasiygaktif('', $category);

            if ($data) {
                $this->response(['data' => $data], REST_Controller::HTTP_OK);
            } else {
                //BAD_REQUEST (404) being the HTTP response code
                $this->response("Campaign dengan category tak ditemukan.", REST_Controller::HTTP_NOT_FOUND);
            }
        } elseif (null !== $this->get('s')) {
            $nama = $this->get('s');
            $where = "nama_campaign LIKE '" . $nama . "'";;

            $data = $this->donasi_model->getdonasiygaktif('', '', $where);

            if ($data) {
                $this->response(['data' => $data], REST_Controller::HTTP_OK);
            } else {
                //BAD_REQUEST (404) being the HTTP response code
                $this->response("Campaign dengan category tak ditemukan.", REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $data = $this->donasi_model->getdonasiygaktif();
            $this->response(['data' => $data], REST_Controller::HTTP_OK);
        }
    }

    public function buatdonasi_post()
    {
    }
}
