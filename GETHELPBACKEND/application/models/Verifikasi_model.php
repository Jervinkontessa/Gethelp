<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi_model extends CI_Model
{
    public function getjenisakun()
    {
        return $this->db->get('jenis_akun')->result_array();
    }

    public function masukkan_biodata($userid, $nama, $alamat, $nohp, $noktp, $bank, $norek, $namaprek, $ktp, $selfie)
    {
        //masukkan data ke table biodata
        $data = [
            'users_id' => $userid,
            'nama_lengkap' => $nama,
            'alamat' => $alamat,
            'phone' => $nohp,
            'noktp' => $noktp,
            'ktp' => $ktp,
            'selfie_ktp' => $selfie,
            'no_rekening' => $norek,
            'nama_bank' => $bank,
            'nama_pemilik_rekening' => $namaprek
        ];

        $this->db->insert('biodata', $data);
    }

    public function masukkan_organisasi($userid, $namapj, $namaorg, $nopj, $ktppj, $berkas = '')
    {
        //masukkan data ke table biodata
        $data = [
            'users_id' => $userid,
            'nama_organisasi' => $namaorg,
            'nama_pj' => $namapj,
            'phone_org' => $nopj,
            'ktp_pj' => $ktppj,
            'berkas_pendukung' => $berkas
        ];

        $this->db->insert('organisasi', $data);
    }

    public function updatejenisakun($userid, $jenis = '')
    {
        if ($jenis != '') {
            $this->db->set('id_jenisakun', $jenis);
            $this->db->set('verifikasi', 2);
            $this->db->where('users.id', $userid);
            $this->db->update('users');
        } else {

            $this->db->set('verifikasi', 2);
            $this->db->where('users.id', $userid);
            $this->db->update('users');
        }
    }
}
