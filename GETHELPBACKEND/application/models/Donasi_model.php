<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donasi_model extends CI_Model
{
    // SELECT campaign.nama_campaign,slug, users.nama, SUM(transaksi_midtrans.gross_amount) AS donasi_terkumpul,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa 
    // FROM `campaign`
    // INNER JOIN transaksi_midtrans ON campaign.id = transaksi_midtrans.campaign_id
    // INNER JOIN users ON campaign.users_id = users.id
    // WHERE campaign.status = 1 AND approve = 1
    // GROUP BY campaign.id, users.id
    public function getalldonasi($slug)
    {
        $this->db->select('*');


        $this->db->join('category', 'campaign.category_id = category.id');
        $this->db->where('slug', $slug);
        $query = $this->db->get('campaign');
        return $query->row_array();
    }
    public function getdonasiygaktif($limit = '')
    {

        if ($limit != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.jumlah_dicairkan');

            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '1';
            $this->db->limit($limit);
            $this->db->where('campaign.status', $where);
            $query = $this->db->get('campaign');
            return $query->result_array();
        } else {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.jumlah_dicairkan');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '1';
            $this->db->where('campaign.status', $where);
            $query = $this->db->get('campaign');
            return $query->result_array();
        }
        /*
        BEGIN
        UPDATE campaign SET campaign.donasi_terkumpul = campaign.donasi_terkumpul + new.gross_amount
        WHERE campaign_id = new.campaign_id;
        END 

        Trigger table transaksi untuk melakukan update terus menerus nilai donasi terkumpul sesuai data transaksi yang masuk di table transaksi
        jika yang masuk 500.000 maka nilainya akan ditambah dengan nilai total donasi secara otomatis
        */
    }

    public function getdonasipending($slug = '')
    {

        if ($slug != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,email,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir, donasi_terkumpul, campaign.gambar,users.verifikasi, campaign.cerita, campaign.tujuan, campaign.penerima_donasi, rincian');

            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '2';
            $this->db->where('campaign.status', $where);
            $this->db->where('slug', $slug);
            $query = $this->db->get('campaign');
            return $query->row_array();
        } else {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir, donasi_terkumpul, campaign.gambar,users.verifikasi, campaign.cerita');

            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '2';
            $this->db->where('campaign.status', $where);

            $query = $this->db->get('campaign');
            return $query->result_array();
        }
        /*
        BEGIN
        UPDATE campaign SET campaign.donasi_terkumpul = campaign.donasi_terkumpul + new.gross_amount
        WHERE campaign_id = new.campaign_id;
        END 

        Trigger table transaksi untuk melakukan update terus menerus nilai donasi terkumpul sesuai data transaksi yang masuk di table transaksi
        jika yang masuk 500.000 maka nilainya akan ditambah dengan nilai total donasi secara otomatis
        */
    }

    public function getdonasiditolak()
    {


        $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita');

        $this->db->join('users', 'campaign.users_id = users.id');
        $this->db->join('category', 'campaign.category_id = category.id');
        $where = '3';
        $this->db->where('campaign.status', $where);
        $query = $this->db->get('campaign');
        return $query->row_array();
    }


    public function ubahstatusdonasi($id, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('campaign_id', $id);
        $this->db->update('campaign');
    }
    public function getdonasiyanghabismasanya()
    {
        $this->db->select('*');


        $where = '1';
        $this->db->where('campaign.status', $where);
        $this->db->where('datediff(tanggal_berakhir, current_date()) =', 0);
        $query = $this->db->get('campaign');
        return $query->result();
    }

    public function getdonasiyangselesai($slug = '')
    {
        if ($slug != '') {
            $this->db->select('*');

            $this->db->where('slug', $slug);
            $this->db->where('campaign.status', 0);
            $this->db->order_by("campaign_id", "desc");
            $query = $this->db->get('campaign');
            return $query->row_array();
        } else {
            $this->db->select('*');
            $this->db->where('campaign.status', 0);
            $this->db->order_by("campaign_id", "desc");
            $query = $this->db->get('campaign');
            return $query->result_array();
        }

        /*
        BEGIN
        UPDATE campaign SET campaign.donasi_terkumpul = campaign.donasi_terkumpul + new.gross_amount
        WHERE campaign_id = new.campaign_id;
        END 

        Trigger table transaksi untuk melakukan update terus menerus nilai donasi terkumpul sesuai data transaksi yang masuk di table transaksi
        jika yang masuk 500.000 maka nilainya akan ditambah dengan nilai total donasi secara otomatis
        */
    }

    //fungsi dibawah untuk insert campaign untuk dari pihak gethelp
    public function insertnewcampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $bukti, $category_id)
    {
        $datenow = date("Y-m-d");

        //masukkan data ke table campaign
        $data = [
            'nama_campaign' =>  $namacampaign,
            'users_id' => 1,
            'slug' => $slug,
            'category_id' => $category_id,
            'tanggal_dibuat' => $datenow,
            'tanggal_berakhir' => $tanggalberakhir,
            'status' => '1',
            'target_donasi' => $targetdonasi,
            'cerita' => $cerita,
            'gambar' => $bukti

        ];

        $this->db->insert('campaign', $data);
    }

    public function updatecampaign($slug, $namacampaign, $tanggalberakhir, $targetdonasi, $cerita, $gambar, $category_id, $status, $jumlahdicairkan)
    {
        //users_id 1 nantinya adalah dari gethelp
        $data = [
            'nama_campaign' =>  $namacampaign,
            'slug' => $slug,
            'category_id' => $category_id,
            'tanggal_berakhir' => $tanggalberakhir,
            'status' => $status,
            'target_donasi' => $targetdonasi,
            'cerita' => $cerita,
            'gambar' => $gambar,
            'jumlah_dicairkan' => $jumlahdicairkan
        ];
        $this->db->where('campaign_id', $this->input->post('id'));
        $this->db->update('campaign', $data);
    }

    public function getcategory($favorit = '')
    {
        if ($favorit != '') {
            $this->db->where('icon !=', '');
            $category = $this->db->get('category')->result_array();
            return $category;
        } else {
            $category = $this->db->get('category')->result_array();
            return $category;
        }
    }

    public function delete($slug)
    {
        $this->db->where('slug', $slug);
        $this->db->delete('campaign');
    }

    public function getlaporan($id = '')
    {
        if ($id != '') {
            $this->db->select('*');
            $this->db->join('campaign ', 'ON campaign.campaign_id = report.campaign_id');
            $this->db->where('report.id', $id);
            $query = $this->db->get('report');
            return $query->row_array();
        }
        $this->db->select('*');
        $this->db->join('campaign ', 'ON campaign.campaign_id = report.campaign_id');
        $query = $this->db->get('report');
        return $query->result_array();
    }

    public function deletelaporan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('report');
    }

    // data transaksi midtrans mulai dari sini
    public function gettransaksi()
    {

        $this->db->select('order_id,campaign.nama_campaign,campaign.campaign_id,nama As username, gross_amount, payment_type, transaction_time AS tanggal_transaksi, va_number, status_code');


        $this->db->join('campaign ', 'ON campaign.campaign_id = transaksi_midtrans.campaign_id');
        $this->db->where('status_code', 200);
        $this->db->order_by("transaction_time", "desc");
        $query = $this->db->get('transaksi_midtrans');
        return $query->result_array();
    }


    public function countpendingcampaign()
    {
        $this->db->select(' COUNT(*) AS total');
        $this->db->where('status', 2);
        $query = $this->db->get('campaign');
        return $query->result_array();
    }

    public function countcampaignselesai()
    {
        $this->db->select(' COUNT(*) AS total');
        $this->db->where('status', 0);
        $query = $this->db->get('campaign');
        return $query->result_array();
    }
    public function countreport()
    {
        $this->db->select(' COUNT(*) AS total');
        $query = $this->db->get('report');
        return $query->row_array();
    }


    public function insertkabar($cid, $keterangan, $datenow, $kabarimg)
    {
        $data = [
            'campaign_id' => $cid,
            'gambar' => $kabarimg,
            'keterangan' => $keterangan,
            'tanggal' => $datenow
        ];
        $this->db->insert('update_campaign', $data);
    }
}
