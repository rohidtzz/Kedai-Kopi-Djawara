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
