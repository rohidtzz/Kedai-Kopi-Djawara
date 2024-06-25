<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->model('ModelProduct');
		$this->load->model('ModelTransaction');
		$this->load->model('ModelUser');
		$this->load->helper('login');
		cek_admin();
	}
	public function index()
	{    
		$data['title']	= 'Dashboard';
		$data['dashboard'] = "active";

		$data['today_sales'] = $this->ModelTransaction->getTodaySales();
		$data['total_users'] = $this->ModelUser->getTotalUsers();
		$data['total_products'] = $this->ModelProduct->getTotalProducts();
		$data['total_transactions'] = $this->ModelTransaction->getTotalSales();


		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar', $data);
		$this->load->view('dashboard/admin/index');
		$this->load->view('dashboard/template/footer');

	}

	public function product()
	{
		$data['title']	= 'Product';
		$data['products'] = $this->ModelProduct->get_all_products();
		$data['product'] = "active";

		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar', $data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/admin/product',$data);
		$this->load->view('dashboard/template/footer');

	}

	public function add_product(){

		$name = $this->input->post('name');
        $price = $this->input->post('price');
        $stock = $this->input->post('stock');
        $img = $this->input->post('img');

		// Handle image upload
		$config['upload_path'] = 'assets/welcome/img/menu/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048; // 2MB

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('img')) {
			$error = array('error' => $this->upload->display_errors());
			redirect('/admin/product');
		} else{
			$image_data = $this->upload->data();
   			$image_path = 'welcome/img/menu/' . $image_data['file_name'];


			// Siapkan data untuk disimpan
			$product_data = array(
			   'name' => $name,
			   'price' => $price,
			   'stock' => $stock,
			   'img' => $image_path,
			);
	   
			// Simpan transaksi ke dalam database
			$transaction_id = $this->ModelProduct->simpanProduct($product_data);
	   
			if ($transaction_id) {
				$this->session->set_flashdata('success', 'Product berhasil ditambahkan');
			   redirect('/admin/product');
			} else {
				$this->session->set_flashdata('error', 'Product gagal ditambahkan');
			   redirect('/admin/product');
			}
		}


    }

	public function update_product($product_id){

		$name = $this->input->post('name');
		$price = $this->input->post('price');
		$stock = $this->input->post('stock');
		$img = $_FILES['img']['name'];
	
		// Load the product model
		$this->load->model('ModelProduct');
	
		// Prepare data to be updated
		$product_data = array(
			'name' => $name,
			'price' => $price,
			'stock' => $stock,
		);
	
		// Check if an image is uploaded
		if (!empty($img)) {
			// Handle image upload
			$config['upload_path'] = 'assets/welcome/img/menu/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			$config['max_size'] = 2048; // 2MB
	
			$this->load->library('upload', $config);
	
			if (!$this->upload->do_upload('img')) {
				$error = array('error' => $this->upload->display_errors());
				redirect('/admin/product');
			} else {
				$image_data = $this->upload->data();
				$image_path = 'welcome/img/menu/' . $image_data['file_name'];
				$product_data['img'] = $image_path; // Add image path to update data
			}
		}
	
		// Update product in the database
		$update_status = $this->ModelProduct->updateProduct($product_id, $product_data);
	
		if ($update_status) {
			$this->session->set_flashdata('success', 'Product berhasil diupdate');
			redirect('/admin/product');
		} else {
			$this->session->set_flashdata('error', 'Product gagal diupdate');
			redirect('/admin/product');
		}


    }

	public function delete_product($product_id) {
		// Load the product model
		$this->load->model('ModelProduct');
	
		// Delete the product from the database
		$delete_status = $this->ModelProduct->deleteProduct($product_id);
	
		if ($delete_status) {
			$this->session->set_flashdata('success', 'product berhasil dihapus');
			redirect('/admin/product');
		} else {
			$this->session->set_flashdata('error', 'product gagal dihapus');
			redirect('/admin/product');
		}
	}

	public function transaction()
	{
		$data['title']	= 'Transaction';
		$data['transactions'] = $this->ModelTransaction->get_all_transaction_and_product();
		$data['transaction'] = "active";

		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar',$data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/admin/transaction',$data);
		$this->load->view('dashboard/template/footer');

	}

	public function update_transaction($transaction_id){

		$status = $this->input->post('status');
	
		// Load the transaction model
		$this->load->model('ModelTransaction');
	
		// Prepare data to be updated
		$transaction_data = array(
			'status' => $status,
		);
	
		// Update transaction in the database
		$update_status = $this->ModelTransaction->updateTransaction_status($transaction_id, $transaction_data);
	
		if ($update_status) {
			$this->session->set_flashdata('success', 'Transaction berhasil diupdate');
			redirect('/admin/transaction');
		} else {
			$this->session->set_flashdata('error', 'Transaction gagal diupdate');
			redirect('/admin/transaction');
		}


    }

	public function users()
	{
		$data['title']	= 'User';
		$data['users'] = $this->ModelUser->get_all_user();
		$data['user'] = "active";

		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar',$data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/admin/user',$data);
		$this->load->view('dashboard/template/footer');

	}

	public function update_users($id)
	{
		$this->load->library('form_validation');

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/users');
        } else {
            // Collecting user data
            $userData = array(
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
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
                    redirect('admin/users');
                }
            }

            // Update user data
            if ($this->ModelUser->update_user($id, $userData)) {
				$this->session->set_flashdata('success', 'User berhasil diupdate');
				redirect('admin/users');
            } else {
				$this->session->set_flashdata('success', 'User gagal diupdate');
				redirect('admin/users');
            }
            redirect('admin/users');
        }
		

	}

	public function profile()
	{
		$data['title']	= 'Profile';
		$data['profile'] = "active";
		$data['profiles'] = $this->ModelUser->get_user_by_id($this->session->userdata('user_id'));


		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar',$data);
		$this->load->view('dashboard/template/topbar',$data);
		$this->load->view('dashboard/admin/profile',$data);
		$this->load->view('dashboard/template/footer');

	}

	public function update_profile($id)
	{
		$this->load->library('form_validation');
		

        // Set validation rules
        $this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with errors
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/profile');
        } else {
            // Collecting user data
            $userData = array(
                'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
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
                    redirect('admin/profile');
                }
            }

            // Update user data
            if ($this->ModelUser->update_user($id, $userData)) {
				$this->session->set_flashdata('success', 'Profile berhasil diupdate');
				redirect('admin/profile');
            } else {
				$this->session->set_flashdata('success', 'Profile gagal diupdate');
				redirect('admin/profile');
            }
            redirect('admin/profile');
        }
		

	}
}
