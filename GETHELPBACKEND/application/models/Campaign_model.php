<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Campaign_model extends CI_Model
{
    public function getallcampaign()
    {
        $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
        $this->db->join('users', 'campaign.users_id = users.id');
        $this->db->join('category', 'campaign.category_id = category.id');
        $where = '1';
        $this->db->where('campaign.status', $where);
        $query = $this->db->get('campaign');
        return $query->result_array();
    }

    public function getcampaign($limit, $start, $kategori = '', $keyword = '', $fundraiser = '')
    {
        if ($fundraiser != '' && $kategori != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->order_by("campaign.status", "DESC");
            $this->db->where('users.nama', $fundraiser);
            $this->db->where('category.nama', $kategori);
            $this->db->limit($limit, $start);

            $query = $this->db->get('campaign');
            return $query->result_array();
        } elseif ($kategori != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->where('category.nama', $kategori);
            $this->db->order_by("campaign.status", "DESC");
            $this->db->limit($limit, $start);

            $query = $this->db->get('campaign');
            return $query->result_array();
        } elseif ($keyword != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->like('campaign.nama_campaign', $keyword);
            $this->db->or_like('category.nama', $keyword);
            $this->db->or_like('users.nama', $keyword);
            $this->db->limit($limit, $start);
            $this->db->order_by("campaign.status", "DESC");
            $query = $this->db->get('campaign');
            return $query->result_array();
        } elseif ($fundraiser != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->where('users.nama', $fundraiser);
            $this->db->limit($limit, $start);
            $this->db->order_by("campaign.status", "DESC");
            $query = $this->db->get('campaign');
            return $query->result_array();
        } elseif ($fundraiser != '' && $kategori != '') {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->where('users.nama', $fundraiser);
            $this->db->where('category.nama', $kategori);
            $this->db->limit($limit, $start);
            $this->db->order_by("campaign.status", "DESC");
            $query = $this->db->get('campaign');
            return $query->result_array();
        } else {
            $this->db->select('campaign.campaign_id, category.nama As cnama,users.nama,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.status');
            $this->db->join('users', 'campaign.users_id = users.id');
            $this->db->join('category', 'campaign.category_id = category.id');
            $where = '3';
            $this->db->where('campaign.status !=', $where);
            $this->db->where('campaign.status !=', '2');
            $this->db->limit($limit, $start);
            $this->db->order_by("campaign.status", "DESC");
            $query = $this->db->get('campaign');
            return $query->result_array();
        }
    }

    public function jumlahcampaign()
    {
        $where = 1;
        $this->db->where('campaign.status', $where);
        $query = $this->db->get('campaign');
        return $query->num_rows();
    }

    public function detailcampaign($slug)
    {
        $this->db->select('campaign.campaign_id,users.id, category.nama As cnama,users.nama As dibuat,campaign.nama_campaign,slug,campaign.users_id,target_donasi, campaign.tanggal_dibuat,tanggal_berakhir,datediff(tanggal_berakhir, current_date()) as hari_tersisa, donasi_terkumpul, campaign.gambar, campaign.cerita, campaign.jumlah_dicairkan, campaign.status');
        $this->db->join('users', 'campaign.users_id = users.id');
        $this->db->join('category', 'campaign.category_id = category.id');
        $this->db->where('slug', $slug);
        $query = $this->db->get('campaign');
        return $query->row_array();
    }

    public function getcampaignupdatebyid($id)
    {
        $this->db->where('campaign_id', $id);
        $query = $this->db->get('update_campaign');
        return $query->result_array();
    }

    public function getdonatur($id, $limit, $donatur = 0)
    {
        if ($donatur != 0) {
            $this->db->select('gross_amount,transaction_time,doa');
            $this->db->where('campaign_id', $id);
            $this->db->where('status_code', 200);
            $this->db->limit($limit);
            $this->db->order_by("transaction_time", "desc");
            $query = $this->db->get('transaksi_midtrans');
            return $query->result_array();
        } else {

            $this->db->select('gross_amount,transaction_time,doa');
            $this->db->where('campaign_id', $id);
            $this->db->where('status_code', 200);
            $this->db->where('doa !=', '');
            $this->db->limit($limit);
            $this->db->order_by("transaction_time", "desc");
            $query = $this->db->get('transaksi_midtrans');
            return $query->result_array();
        }
    }

    public function getjumlahdonatur($id)
    {
        $this->db->where('campaign_id', $id);
        $this->db->where('status_code', 200);
        $query = $this->db->get('transaksi_midtrans');
        return $query->num_rows();
    }

    public function getjumlahupdate($id)
    {
        $this->db->where('campaign_id', $id);
        $query = $this->db->get('update_campaign');
        return $query->num_rows();
    }

    public function getdoahome($limit)
    {
        $this->db->select('gross_amount,transaction_time,doa, nama_campaign, slug');
        $this->db->join('campaign', 'transaksi_midtrans.campaign_id = campaign.campaign_id');
        $this->db->where('status_code', 200);
        $this->db->where('doa !=', '');
        $this->db->limit($limit);
        $this->db->order_by("transaction_time", "desc");
        $query = $this->db->get('transaksi_midtrans');
        return $query->result_array();
    }

    public function getdoacampaign($id, $limit)
    {
        $this->db->select('gross_amount,transaction_time,doa');
        $this->db->where('campaign_id', $id);
        $this->db->where('status_code', 200);
        $this->db->where('doa !=', '');
        $this->db->limit($limit);
        $this->db->order_by("transaction_time", "desc");
        $query = $this->db->get('transaksi_midtrans');
        return $query->result_array();
    }

    public function insertlaporan($id, $nama, $email, $nohp, $kategori, $keterangan, $bukti)
    {
        $data = [
            'campaign_id' => $id,
            'nama' => $nama,
            'email' => $email,
            'nomorhp' => $nohp,
            'kategori' => $kategori,
            'detail' => $keterangan,
            'foto_bukti' => $bukti
        ];
        $this->db->insert('report', $data);
    }
}
