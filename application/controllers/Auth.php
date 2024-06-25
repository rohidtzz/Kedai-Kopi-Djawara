<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		//ambil model
		$this->load->model('ModelUser');
		$this->load->helper('login');
		
	}

	public function index()
	{
		if($this->session->userdata('roles') == 'admin'){
			redirect('admin'); 
		} else if($this->session->userdata('roles') == 'user'){
			redirect('user');
		}
        $this->load->view('auth/login');
	}

	 // Method untuk memproses login
	 public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->ModelUser->check_login($username, $password);
        
        if ($user) {
            // Jika login berhasil
            $this->session->set_userdata('user_id', $user->id);
			$this->session->set_userdata('name', $user->name);
			$this->session->set_userdata('email', $user->email);
			$this->session->set_userdata('phone', $user->phone);
			$this->session->set_userdata('roles', $user->roles);

			if($user->roles == 'admin'){
				redirect('admin');
				
			}else{
				redirect('/');
			}
        } else {
            // Jika login gagal
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('auth');
        }
    }

    // Method untuk logout
    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }

	public function register()
	{
		$this->load->view('auth/register');
	}
}
