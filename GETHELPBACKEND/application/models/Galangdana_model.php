<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Galangdana_model extends CI_Model
{
    public function insertnewcampaign($userid, $judul, $slug, $tujuan, $penerima, $rincian, $kategori, $thumbnail, $tgldibuat, $tglberakhir, $status, $cerita, $targetdonasi)
    {
        $data = [
            'users_id' => $userid,
            'nama_campaign' => $judul,
            'slug' =>  $slug,
            'tujuan' => $tujuan,
            'penerima_donasi' => $penerima,
            'rincian' =>  $rincian,
            'category_id' => $kategori,
            'gambar' => $thumbnail,
            'tanggal_dibuat' => $tgldibuat,
            'tanggal_berakhir' => $tglberakhir,
            'status' => $status,
            'cerita' => $cerita,
            'target_donasi' => $targetdonasi,
            'jumlah_dicairkan' => '0'
        ];
        $this->db->insert('campaign', $data);
    }
}
