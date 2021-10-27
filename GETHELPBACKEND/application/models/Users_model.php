<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function getuser($id = '')
    {
        if ($id != '') {
            $this->db->select('users.id,users.nama,users.email,users.password,jenis_akun.nama AS jenis_akun,users.phone,users.image,ktp,selfie_ktp,npwp,users.tanggal_dibuat,users.verifikasi,users.status,users.alamat');
            $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');
            $this->db->where('users.id', $id);
            $query = $this->db->get('users');
            return $query->row_array();
        } else {
            $this->db->select('users.id,users.nama,users.email,users.password,jenis_akun.nama AS jenis_akun,users.phone,users.image,ktp,selfie_ktp,npwp,users.tanggal_dibuat,users.verifikasi,users.status,users.alamat');
            $this->db->join('jenis_akun', 'users.id_jenisakun = jenis_akun.id');
            $query = $this->db->get('users');
            return $query->result_array();
        }
    }

    public function ubahstatus($status, $verifikasi, $id)
    {
        $this->db->set('verifikasi', $verifikasi);
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('users');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('users');
    }
}
