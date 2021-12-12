<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //kalo belum login
        is_logged_in();
        $this->load->model('users_model');
        $this->load->model('donasi_model');
        $this->load->helper('string');
    }
    public function index()
    {
        $data['title'] = "Data Campaign Yang Sedang Berjalan";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['donasi'] = $this->donasi_model->getdonasiygaktif();

        $data['donasihabis'] = $this->donasi_model->getdonasiyanghabismasanya();
        $data['donasiditolak'] = $this->donasi_model->getdonasiditolak();

        // var_dump($data['donasiditolak']);
        // die;
        $data['category'] = $this->donasi_model->getcategory();
        $tgl = date('Y-m-d');
        // $lama = 4;
        // $where = "datediff(current_date(), tanggal_dibuat) >'" . $lama . "'";


        if ($data['donasiditolak'] != '') {


            $this->db->where('status', 3);
            $this->db->delete('campaign');
            unlink(FCPATH . 'assets/img/donasithumb/' . $data['donasiditolak']['gambar']);
        }

        if ($data['donasihabis'] != '') {
            $this->db->set('status', 0);
            $this->db->where('tanggal_berakhir <', $tgl);
            $this->db->update('campaign');
        }

        $this->form_validation->set_rules('namacampaign', 'NamaCampaign', 'required|trim|min_length[10]', [
            'min_length' => 'nama campaign terlalu pendek',
        ]);
        $this->form_validation->set_rules('tanggalberakhir', 'TanggalBerakhir', 'required');
        $this->form_validation->set_rules('targetdonasi', ' TargetDonasi', 'required|trim|min_length[8]', [

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
            $cerita = $this->input->post('cerita');
            $namaimage = 'thumb' . $namacampaign;


            $uploadimage = $_FILES['image']['name'];

            if (!empty($uploadimage)) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                //kb
                $config['file_name']  = $namaimage;
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
             Campaign baru berhasil ditambahkan
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button></div>');
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
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['donasi'] = $this->donasi_model->getdonasiyangselesai();




        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/donasiselesai', $data);
        $this->load->view('templates/footer');
    }

    public function edit($slug)
    {
        $data['title'] = "Edit Campaign";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['donasi'] = $this->donasi_model->getalldonasi($slug);
        $data['category'] = $this->donasi_model->getcategory();



        $this->form_validation->set_rules('namacampaign', 'NamaCampaign', 'required|trim|min_length[10]', [
            'min_length' => 'nama campaign terlalu pendek',
        ]);
        $this->form_validation->set_rules('tanggalberakhir', 'TanggalBerakhir', 'required');
        $this->form_validation->set_rules('targetdonasi', ' TargetDonasi', 'required|trim|min_length[7]', [

            'min_length' => 'Target Donasi Minimal Rp.1.000.000'
        ]);
        $this->form_validation->set_rules('jumlahdicairkan', 'Jumlahdicairkan', 'required');
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
            $jumlahdicairkan = preg_replace("/[^0-9]/", "", $this->input->post('jumlahdicairkan'));
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
                $config['max_size'] = '1048';
                //kb
                $config['file_name']  = $rand;
                $config['upload_path'] = './assets/img/donasithumb/';
                $config['overwrite']   = true;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    // jika tidak berhasil

                    $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                    redirect('donasi/edit');
                } else {
                    $oldimage = $data['donasi']['gambar'];

                    unlink(FCPATH . 'assets/img/donasithumb/' . $oldimage);
                    $gambar = $this->upload->data('file_name');
                }
                $this->donasi_model->updatecampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $gambar, $category_id, $status, $jumlahdicairkan);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Data Campaign berhasil diupdate
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button>
             </div>');
                redirect('donasi');
            } else {
                $this->donasi_model->updatecampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $gambar, $category_id, $status, $jumlahdicairkan);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             Data Campaign berhasil diupdate
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button></div>');
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

    public function update($slug)
    {
        $data['title'] = "Tambah kabar terbaru Campaign";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['donasi'] = $this->donasi_model->getalldonasi($slug);

        // var_dump($data['donasi']);
        // die;

        if (empty($_FILES['bukti']['name'])) {
            $this->form_validation->set_rules('bukti', 'Bukti', 'required', [
                'required' => '*Foto bukti wajib dikirim!'
            ]);
        }
        $this->form_validation->set_rules('keterangan', ' Keterangan', 'required', [

            'required' => 'Keterangan wajib diisi!'
        ]);


        if ($this->form_validation->run() == true) {
            $cid = $data['donasi']['campaign_id'];
            $keterangan = $this->input->post('keterangan');
            $datenow = date("Y-m-d");
            $namaimage =  'bukti' . $data['donasi']['campaign_id'] . $datenow;

            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '1048';
            $config['overwrite']   = true;
            $config['file_name']  = $namaimage;
            $config['upload_path'] = './assets/img/buktitransfer/';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('bukti')) {
                // jika tidak berhasil
                $this->session->set_flashdata('error_msg', $this->upload->display_errors());
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('donasi/update', $data);
                $this->load->view('templates/footer');
            } else {

                $kabarimg = $this->upload->data('file_name');
                $this->donasi_model->insertkabar($cid, $keterangan, $datenow, $kabarimg);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
             kabar Campaign berhasil ditambahkan
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
         </button></div>');
                redirect('donasi');
            }
        } else {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/update', $data);
            $this->load->view('templates/footer');
        }
    }

    public function delete($slug)
    {
        $data['donasi'] = $this->donasi_model->getalldonasi($slug);

        $this->load->library('upload');
        $oldimage = $data['donasi']['gambar'];

        // var_dump($oldimage);
        // die;
        unlink(FCPATH . 'assets/img/donasithumb/' . $oldimage);
        $this->donasi_model->delete($slug);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>');
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



    public function report()
    {
        $data['title'] = "Data Laporan Yang Masuk";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['laporan'] = $this->donasi_model->getlaporan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('donasi/datalaporan', $data);
        $this->load->view('templates/footer');
    }

    public function reportdelete($id)
    {
        $data['laporan'] = $this->donasi_model->getlaporan($id);

        $oldimage = $data['laporan']['foto_bukti'];
        unlink(FCPATH . 'assets/img/buktilaporan/' . $oldimage);

        $this->donasi_model->deletelaporan($id);


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Berhasil dihapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('donasi/report');
    }

    public function download($filename)
    {
        $folder = 'assets/img/buktilaporan/';


        force_download($folder . $filename, NULL);
    }

    public function pending()
    {
        $data['title'] = "Request Donasi";
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
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
        $data['user'] = $this->users_model->getuserlogin($this->session->userdata('admin_data'));
        $data['donasi'] = $this->donasi_model->getdonasipending($slug);
        $data['category'] = $this->donasi_model->getcategory();

        $email = $data['donasi']['email'];
        $slug = $data['donasi']['slug'];
        // var_dump($data['donasi']);
        // die;
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'wajib di pilih'
        ]);


        if ($this->form_validation->run() == true) {
            $namacampaign = $this->input->post('namacampaign');
            $status = $this->input->post('status');
            $id  = $this->input->post('id');
            $pembuat = $this->input->post('pembuat');

            // var_dump($status);
            // die;
            if ($status == '1') {
                $this->donasi_model->ubahstatusdonasi($id, $status);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status campaign berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>');
                $this->_sendemail($pembuat, $email, $namacampaign, $slug, 'diterima');
                redirect('donasi/pending');
            } elseif ($status == '2') {
                redirect('donasi/pending');
            } else {
                $this->donasi_model->ubahstatusdonasi($id, 3);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Status campaign berhasil diubah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button></div>');
                $this->_sendemail($pembuat, $email, $namacampaign, $slug, 'ditolak');
                redirect('donasi/pending');
            }
        } else {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('donasi/pendingdetail', $data);
            $this->load->view('templates/footer');
        }
    }



    private function _sendemail($username, $to, $campaign, $slug, $type)
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

        $url = base_url('campaign/') . $slug;
        $image = base_url('assets/img/logo.png');
        $this->load->library('email', $config);
        $this->email->initialize($config);


        $this->email->from('gethelp.startup@gmail.com', 'GetHelp');
        $this->email->to($to);


        $this->email->subject('Status request galana dana');

        if ($type == 'diterima') {

            $this->email->message('
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hi, ' . $username . '</h3>
      <p>kami ingin mengabari anda tentang status</p>
      <p>Galang dana yang anda buat <b>' . $campaign . '</b>
      Kami telah mengaktifkan galang dana anda.</p>
      <p>anda bisa mengunjungi campaign anda <a href="' . $url . '" target="_blank">disini</a></p>
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
        } else {
            $this->email->message('
                <table width="100%" bgcolor="#ffffff" border="0" cellpadding="10" cellspacing="0" align="center"> 
            <tbody>
              <td align="center">
                <table>
                  <tbody>
                    <tr>
                      <td valign="top">
            <h3>Hi, ' . $username . '</h3>
            <p>kami ingin mengabari anda tentang status</p>
            <p>Galang dana yang anda buat <b>' . $campaign . '</b>
            Kami tidak bisa mengaktifkan galang dana anda.</p>
            <p>Hal ini bisa terjadi karena data campaign kurang jelas atau campaign anda memiliki data yang tidak valid, harap cek kembali data campaign anda</p>
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
}
