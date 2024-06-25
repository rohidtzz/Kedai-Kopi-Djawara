<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelUser extends CI_Model
{
	public function check_login($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password)); // pastikan password di-hash dengan md5
        $query = $this->db->get('user'); // pastikan tabel 'users' ada di database
        return $query->row(); // kembalikan data pengguna jika ada
    }


    
   
}
