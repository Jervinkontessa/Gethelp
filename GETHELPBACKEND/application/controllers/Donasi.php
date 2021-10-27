<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //kalo belum login
        // is_logged_in();
        $this->load->model('admin_model');
        $this->load->model('donasi_model');
        $this->load->helper('string');
    }
    public function index()
    {
        $data['title'] = "Data Campaign Yang Sedang Berjalan";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasiygaktif();
        $data['donasihabis'] = $this->donasi_model->getdonasiyanghabismasanya();
        $data['donasiditolak'] = $this->donasi_model->getdonasiditolak();
        $data['category'] = $this->donasi_model->getcategory();
        $tgl = date('Y-m-d');
        $lama = 4;
        $where = "datediff(current_date(), tanggal_dibuat) >'" . $lama . "'";

        if ($data['donasiditolak'] != '') {
            $this->db->where($where);
            $this->db->where('status', 3);
            $this->db->delete('campaign');
        }

        if ($data['donasihabis'] != '') {
            $this->db->set('status', 0);
            $this->db->where('tanggal_berakhir =', $tgl);
            $this->db->update('campaign');
        }

        $this->form_validation->set_rules('namacampaign', 'NamaCampaign', 'required|trim|min_length[10]', [
            'min_length' => 'nama campaign terlalu pendek',
        ]);
        $this->form_validation->set_rules('tanggalberakhir', 'TanggalBerakhir', 'required');
        $this->form_validation->set_rules('targetdonasi', ' TargetDonasi', 'required|trim|min_length[7]', [

            'min_length' => 'Target Donasi Minimal Rp.1.000.000'
        ]);
        $this->form_validation->set_rules('cerita', ' Cerita', 'required', [

            'required' => 'Cerita wajib diisi!'
        ]);
        $this->form_validation->set_rules('category', ' Category', 'required', [

            'required' => 'Category wajib dipilih'
        ]);


        if ($this->form_validation->run() == true) {
            $namacampaign = $this->input->post('namacampaign');
            $tanggalberakhir = $this->input->post('tanggalberakhir');
            $targetdonasi = preg_replace("/[^0-9]/", "", $this->input->post('targetdonasi'));
            $cerita = $this->input->post('cerita');
            $category_id = $this->input->post('category');
            $slug = url_title($namacampaign, 'dash', true);
            $rand = random_string('alnum', 15);
            $cerita = $this->input->post('cerita');



            $uploadimage = $_FILES['image']['name'];

            if (!empty($uploadimage)) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '4048';
                //kb
                $config['file_name']  = $rand;
                $config['upload_path'] = './assets/img/donasithumb/';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    // jika tidak berhasil

                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    redirect('donasi');
                } else {

                    $bukti = $this->upload->data('file_name');
                }
                $this->donasi_model->insertnewcampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $bukti, $category_id);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Campaign baru berhasil ditambahkan</div>');
                redirect('donasi');
            }
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/index', $data);
            $this->load->view('templates/footer');
        }
    }
    public function selesai()
    {
        $data['title'] = "Data Campaign telah selesai";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasiyangselesai();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/donasiselesai', $data);
        $this->load->view('templates/footer');
    }

    public function uploadbukti()
    {
        $slug = $this->input->post('slug');
        $data['donasi'] = $this->donasi_model->getdonasiyangselesai($slug);

        $rand = random_string('alnum', 15);
        $gambar = $data['donasi']['bukti_transfer'];

        $uploadimage = $_FILES['image']['name'];

        //cek jika ada gambar yang akan diupload
        if (!empty($uploadimage)) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '4048';
            //kb
            $config['file_name']  = $rand;
            $config['upload_path'] = 'assets/img/buktitransfer/';
            $config['overwrite']   = true;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                // jika tidak berhasil

                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                redirect('donasi/selesai');
            } else {
                $oldimage = $data['donasi']['bukti_transfer'];

                unlink(FCPATH . 'assets/img/buktitransfer/' . $oldimage);
                $gambar = $this->upload->data('file_name');
            }
            $this->donasi_model->uploadbuktitransfer($slug, $gambar);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         upload bukti transfer berhasil</div>');
            redirect('donasi/selesai');
        } else {
            $this->donasi_model->uploadbuktitransfer($slug, $gambar);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         upload bukti transfer berhasil</div>');
            redirect('donasi/selesai');
        }
    }

    public function edit($slug)
    {
        $data['title'] = "Edit Campaign";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasiygaktif($slug);
        $data['category'] = $this->donasi_model->getcategory();

        $this->form_validation->set_rules('namacampaign', 'NamaCampaign', 'required|trim|min_length[10]', [
            'min_length' => 'nama campaign terlalu pendek',
        ]);
        $this->form_validation->set_rules('tanggalberakhir', 'TanggalBerakhir', 'required');
        $this->form_validation->set_rules('targetdonasi', ' TargetDonasi', 'required|trim|min_length[7]', [

            'min_length' => 'Target Donasi Minimal Rp.1.000.000'
        ]);
        $this->form_validation->set_rules('cerita', ' Cerita', 'required', [

            'required' => 'Cerita wajib diisi!'
        ]);
        $this->form_validation->set_rules('category', ' Category', 'required', [

            'required' => 'Category wajib dipilih'
        ]);

        if ($this->form_validation->run() == true) {
            $namacampaign = $this->input->post('namacampaign');
            $tanggalberakhir = $this->input->post('tanggalberakhir');
            $targetdonasi =  preg_replace("/[^0-9]/", "", $this->input->post('targetdonasi'));

            $cerita = $this->input->post('cerita');
            $category_id = $this->input->post('category');
            $status = $this->input->post('status');
            $slug = url_title($namacampaign, 'dash', true);
            $rand = random_string('alnum', 15);
            $cerita = $this->input->post('cerita');
            $gambar = $data['donasi']['gambar'];

            $uploadimage = $_FILES['image']['name'];

            //cek jika ada gambar yang akan diupload
            if (!empty($uploadimage)) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '4048';
                //kb
                $config['file_name']  = $rand;
                $config['upload_path'] = './assets/img/donasithumb/';
                $config['overwrite']   = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    // jika tidak berhasil

                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    redirect('donasi');
                } else {
                    $oldimage = $data['donasi']['gambar'];

                    unlink(FCPATH . 'assets/img/donasithumb/' . $oldimage);
                    $gambar = $this->upload->data('file_name');
                }
                $this->donasi_model->updatecampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $gambar, $category_id, $status);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Data Campaign berhasil diupdate</div>');
                redirect('donasi');
            } else {
                $this->donasi_model->updatecampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $gambar, $category_id, $status);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Data Campaign berhasil diupdate</div>');
                redirect('donasi');
            }
        } else {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/edit', $data);
            $this->load->view('templates/footer');
        }
    }

    public function detail($slug)
    {
        $data['title'] = "Detail Campaign";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasiygaktif($slug);

        $data['category'] = $this->donasi_model->getcategory();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function delete($slug)
    {
        $data['donasi'] = $this->donasi_model->getdonasiygaktif($slug);

        $this->load->library('upload');
        $oldimage = $data['donasi']['gambar'];
        unlink(FCPATH . 'assets/img/donasithumb/' . $oldimage);

        $this->donasi_model->delete($slug);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus</div>');
        redirect('donasi');
    }

    // Upload image summernote
    function upload_image_summernote()
    {

        if (isset($_FILES["image"]["name"])) {
            $config['upload_path'] = './assets/img/cerita';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';


            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image')) {
                $this->upload->display_errors();
                return FALSE;
            } else {
                $data = $this->upload->data();

                //Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/img/cerita/' .  $data['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['width'] = 300;
                $config['height'] = 300;
                $config['new_image'] = './assets/img/cerita/' .  $data['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                echo base_url() . './assets/img/cerita/' .  $data['file_name'];
            }
        }
    }

    // Delete image Summernote
    function delete_image_summernote()
    {
        $src = $this->input->post('src');
        $file_name = str_replace(base_url(), '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }


    // data transaksi midtrans mulai disini
    public function transaksi()
    {
        $data['title'] = "Data Transaksi Yang Berhasil";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['transaksi'] = $this->donasi_model->gettransaksi();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/datatransaksi', $data);
        $this->load->view('templates/footer');
    }

    public function pending()
    {
        $data['title'] = "Request Donasi";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasipending();




        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/pending', $data);
        $this->load->view('templates/footer');
    }

    public function pendingdetail($slug)
    {
        $data['title'] = "Detail Pending Campaign";
        $data['user'] = $this->admin_model->getadminbyemail($this->session->userdata('email'));
        $data['donasi'] = $this->donasi_model->getdonasipending($slug);
        $data['category'] = $this->donasi_model->getcategory();

        $status = $this->input->post('status');
        $id = $this->input->post('id');

        $this->donasi_model->terimadonasi($id, $status);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Campaign Status Diubah</div>');
        redirect('donasi/pending');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/pendingdetail', $data);
        $this->load->view('templates/footer');
    }
}