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
		$this->load->helper('login');
		cek_admin();
	}
	public function index()
	{    
		$data['title']	= 'Dashboard';
		$data['dashboard'] = "active";


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
			redirect('/admin/product?status=failed');
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
			   redirect('/admin/product/?status=success&message=product_berhasil_ditambahkan');
			} else {
			   redirect('/admin/product?status=failed$&message=product_gagal_ditambahkan');
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
				redirect('/admin/product?status=failed');
			} else {
				$image_data = $this->upload->data();
				$image_path = 'welcome/img/menu/' . $image_data['file_name'];
				$product_data['img'] = $image_path; // Add image path to update data
			}
		}
	
		// Update product in the database
		$update_status = $this->ModelProduct->updateProduct($product_id, $product_data);
	
		if ($update_status) {
			redirect('/admin/product/?status=success&message=product_berhasil_diupdate');
		} else {
			redirect('/admin/product?status=failed&message=product_gagal_diupdate');
		}


    }

	public function delete_product($product_id) {
		// Load the product model
		$this->load->model('ModelProduct');
	
		// Delete the product from the database
		$delete_status = $this->ModelProduct->deleteProduct($product_id);
	
		if ($delete_status) {
			redirect('/admin/product/?status=success&message=product_berhasil_dihapus');
		} else {
			redirect('/admin/product?status=failed&message=product_gagal_dihapus');
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
			redirect('/admin/transaction/?status=success&message=transaction_berhasil_diupdate');
		} else {
			redirect('/admin/transaction?status=failed&message=transaction_gagal_diupdate');
		}


    }

	public function user()
	{
		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar');
		$this->load->view('dashboard/template/topbar');
		$this->load->view('dashboard/admin/user');
		$this->load->view('dashboard/template/footer');

	}

	public function profile()
	{
		$this->load->view('dashboard/template/header');
		$this->load->view('dashboard/template/sidebar');
		$this->load->view('dashboard/template/topbar');
		$this->load->view('dashboard/admin/add_product');
		$this->load->view('dashboard/template/footer');

	}
}
