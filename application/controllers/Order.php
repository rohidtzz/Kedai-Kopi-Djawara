<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
		$this->load->helper(array('form'));
        $this->load->library('form_validation');

		//ambil model
		$this->load->model('ModelProduct');
        $this->load->model('ModelTransaction');
    }

	public function index()
	{
		$this->load->model('ModelProduct');
		$data['product'] = $this->ModelProduct->getProduct()->result_array();
		
		$this->load->view('order', $data);
	}

	public function store() {
        $product_id = $this->input->post('product');
        $unit = $this->input->post('unit');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');

        // Ambil informasi produk berdasarkan ID
        $product = $this->ModelProduct->get_product_by_id($product_id);

        // Validasi stok produk
        if ($unit > $product['stock']) {
            redirect('order?status=failed&message=stock_tidak_mencukupi');
        } else {
            // Hitung total harga
            $total = $product['price'] * $unit;

            // Generate nomor order
            $no_order = 'INV-' . mt_rand(100, 9999);

            // Siapkan data untuk disimpan
            $transaction_data = array(
                'product_id' => $product_id,
                'no_order' => $no_order,
                'jumlah' => $unit,
                'status' => 'waiting',
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'totals' => $total
            );

            // Simpan transaksi ke dalam database
            $transaction_id = $this->ModelTransaction->insert_transaction($transaction_data);

            if ($transaction_id) {
                // Kurangi stok produk
                $new_stock = $product['stock'] - $unit;
                $this->ModelProduct->update_product_stock($product_id, $new_stock);

                // Redirect ke halaman pembayaran dengan nomor order
                redirect('payment?trx=' . $no_order);
            } else {
                redirect('order?status=failed');
            }
        }
    }

}
