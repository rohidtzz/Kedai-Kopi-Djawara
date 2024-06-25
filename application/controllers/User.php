<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$this->load->model('ModelTransaction');
		$this->load->model('ModelUser');
	}

	public function index()
	{        
		$data['title']	= 'Profile';
		$data['profile'] = "active";
		$data['profiles'] = $this->ModelUser->get_user_by_id($this->session->userdata('user_id'));
        // $this->load->view('dashboard/template/');
		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar',$data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/user/index',$data);
		$this->load->view('dashboard/template/footer');
		
	}

	public function update_profile($id)
	{
		$this->load->library('form_validation');
		

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
		

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('user');
        } else {
            // Collecting user data
            $userData = array(
                'name' => $this->input->post('name'),
            );

            // If password is set, include it in the update
            if($this->input->post('password')) {
                $userData['password'] = md5($this->input->post('password'));
            }

            // Handling file upload
            if (!empty($_FILES['img']['name'])) {
                $config['upload_path'] = 'assets/welcome/img/user/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['img']['name'];

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('img')) {
                    $uploadData = $this->upload->data();
                    $userData['img'] = 'welcome/img/user/'.$uploadData['file_name'];
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('user');
                }
            }

            // Update user data
            if ($this->ModelUser->update_user($id, $userData)) {
				$this->session->set_flashdata('success', 'Profile berhasil diupdate');
				redirect('user');
            } else {
				$this->session->set_flashdata('success', 'Profile gagal diupdate');
				redirect('user');
            }
            redirect('user');
        }
		

	}

	public function transaction()
	{
		$data['title']	= 'Transaction';
		$data['transactions'] = $this->ModelTransaction->get_transactions_by_user_id($this->session->userdata('user_id'));
		$data['transaction'] = "active";
		
		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar',$data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/user/transaction',$data);
		$this->load->view('dashboard/template/footer');

	}
}
