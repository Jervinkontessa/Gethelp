<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function totaluser()
    {
        $this->db->select(' COUNT(*) AS total');
        $this->db->where('status', 1);
        $this->db->where('role', 'user');
        $query = $this->db->get('users');
        return $query->result_array();
    }
    public function getuserlogin($email = '')
    {

        $this->db->select('*');
        $this->db->where('users.email', $email);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function getuserbiodata($id = '')
    {
        $this->db->select('*');
        $this->db->join('users', 'users.id = biodata.users_id');
        $this->db->where('biodata.users_id', $id);
        $query = $this->db->get('biodata');
        return $query->row_array();
    }
    public function getuserdetail($id = '')
    {
        $this->db->select('*, jenis_akun.nama AS jenis_akun');
        $this->db->join('users', 'users.id = biodata.users_id');
        $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');
        $this->db->where('biodata.users_id', $id);
        $query = $this->db->get('biodata');
        return $query->row_array();
    }

    public function getorganisasi($id)
    {
        $this->db->select('*');
        $this->db->where('users_id', $id);
        $query = $this->db->get('organisasi');
        return $query->row_array();
    }
    public function getuser($id = '', $email = '')
    {
        if ($id != '') {
            $this->db->select('users.id,users.nama,users.email,users.password,jenis_akun.nama AS jenis_akun,users.image,users.tanggal_dibuat,users.verifikasi,users.status,users.role');
            $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');
            $this->db->where('users.id', $id);
            $query = $this->db->get('users');
            return $query->row_array();
        } elseif ($email != '') {
            $this->db->select('users.id,users.nama,users.email,users.password,jenis_akun.nama AS jenis_akun,users.image,users.tanggal_dibuat,users.verifikasi,users.status,users.role');
            $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');
            $this->db->where('users.email', $email);
            $query = $this->db->get('users');
            return $query->row_array();
        } else {
            $this->db->select('users.id,users.nama,users.email,users.password,jenis_akun.nama AS jenis_akun,users.image,users.tanggal_dibuat,users.verifikasi,users.status,users.role');
            $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');

            $this->db->where('users.role', 'user');
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    public function getbiodata($id)
    {
        $this->db->select('*');

        $this->db->where('users_id', $id);
        $query = $this->db->get('biodata');
        return $query->row_array();
    }

    public function gettransaksi($nama = '')
    {
        $this->db->select('campaign.nama_campaign, transaksi_midtrans.campaign_id, gross_amount, transaction_time, status_code, payment_type');
        $this->db->join('campaign', 'transaksi_midtrans.campaign_id = campaign.campaign_id');
        $this->db->like('transaksi_midtrans.nama', $nama);
        $this->db->where('transaksi_midtrans.status_code', 200);
        $this->db->order_by('transaksi_midtrans.transaction_time', 'DESC');
        $this->db->limit(5);

        $query = $this->db->get('transaksi_midtrans');
        return $query->result_array();

        // SELECT campaign.nama_campaign, users.nama, gross_amount, transaction_time, status_code, payment_type, bank
        // FROM `transaksi_midtrans`
        // JOIN users ON transaksi_midtrans.users_id = users.id
        // JOIN campaign ON campaign.campaign_id = transaksi_midtrans.campaign_id
        // WHERE transaksi_midtrans.users_id = 1
    }

    public function getcampaign($id = '', $search = '')
    {
        if ($search != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');

            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $this->db->where('campaign.users_id', $id);
            $this->db->like('campaign.nama', $search);
            $this->db->order_by('campaign.tanggal_dibuat', 'DESC');
            $this->db->limit(5);
            $query = $this->db->get('campaign');
            return $query->result_array();
        } else {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');

            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $this->db->where('campaign.users_id', $id);
            $this->db->order_by('campaign.tanggal_dibuat', 'DESC');
            $this->db->limit(5);
            $query = $this->db->get('campaign');
            return $query->result_array();
        }
    }

    public function adduser($email, $username, $pass, $status)
    {
        $datenow = date("Y-m-d");
        if ($pass != '') {
            $datauser = [
                'nama' => htmlspecialchars($username),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => password_hash($pass, PASSWORD_DEFAULT),
                'tanggal_dibuat' => $datenow,
                'verifikasi' => 0,
                'status' => $status, // harus aktifasi
                'id_jenisakun' => 1,
                'role' => 'user'
            ];

            $insert = $this->db->insert('users', $datauser);
            return $insert ? $this->db->insert_id() : false;
        } else {
            $datauser = [
                'nama' => htmlspecialchars($username),
                'email' => htmlspecialchars($email),
                'image' => 'default.png',
                'password' => $pass,
                'tanggal_dibuat' => $datenow,
                'verifikasi' => 0,
                'status' => $status, // harus aktifasi
                'id_jenisakun' => 1,
                'role' => 'user'
            ];

            $insert = $this->db->insert('users', $datauser);
            return $insert ? $this->db->insert_id() : false;
        }
    }



    public function ubahstatus($status, $verifikasi, $id)
    {
        $this->db->set('verifikasi', $verifikasi);
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('users');
    }
    public function update($email, $date)
    {

        $this->db->where('email', $email);
        $this->db->update('users', $date);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    public function editprofileuser($newimage, $name, $email)
    {
        $this->db->set('nama', $name);
        $this->db->set('image', $newimage);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    public function updatebiodata($phone, $alamat, $id)
    {
        $this->db->set('alamat', $alamat);
        $this->db->set('phone', $phone);
        $this->db->where('users_id', $id);
        $this->db->update('biodata');
    }

    public function newpassword($pass, $email)
    {
        $this->db->set('password', $pass);
        $this->db->where('email', $email);
        $this->db->update('users');
    }

    // dibawah untuk admin
    public function editprofile($newimage, $name, $email)
    {

        $this->db->set('nama', $name);
        $this->db->set('image', $newimage);

        $this->db->where('email', $email);

        $this->db->update('users');
    }

    public function changepassword($password_hash)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('email', $this->session->userdata('admin_data'));
        $this->db->update('users');
    }

    public function deletebiodata($id)
    {
        $this->db->where('users_id', $id);
        $this->db->delete('biodata');
    }

    public function deleteorganisasi($id)
    {
        $this->db->where('users_id', $id);
        $this->db->delete('organisasi');
    }
}
