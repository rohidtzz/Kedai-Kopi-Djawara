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

	public function get_user_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('user');
		return $query->row_array();
	}

	public function get_all_user() {
		$this->db->order_by('id', 'DESC');
		$this->db->where('roles', 'user');
		$query = $this->db->get('user');
		return $query->result_array();
	}

	public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user', $data);
    }

	public function getTotalUsers() {
		return $this->db->count_all('user'); // Assuming 'users' is your users table
	}


    
   
}
