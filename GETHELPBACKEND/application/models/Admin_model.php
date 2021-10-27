<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{


    public function getadminbyemail($email)
    {

        // $admin = $this->db->get_where('admin', ['email' => $email])->row_array();
        $this->db->where('email', $email);
        $this->db->or_where('nama', $email);

        $admin = $this->db->get('admin')->row_array();
        return $admin;
    }


    public function tambahadmin($email, $password, $nama)
    {
        $data_user = array(
            'nama' => htmlspecialchars($nama),
            'email' => htmlspecialchars($email),
            'image' => 'default.png',
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'day_created' => time()
        );
        $this->db->insert('admin', $data_user);
    }

    public function editprofile($newimage, $name, $email)
    {
        $this->db->set('image', $newimage);
        $this->db->set('nama', $name);
        $this->db->where('email', $email);
        $this->db->update('admin');
    }

    public function changepassword($password_hash)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('admin');
    }

    public function getadmin()
    {
        $admin = $this->db->get('admin')->result_array();

        return $admin;
    }
}
