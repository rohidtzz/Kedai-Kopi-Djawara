<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

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
    }

	public function index()
	{
		$trx = $this->input->get('trx');


		$data['transaction'] = $this->ModelTransaction->getTransactionByNoOrder($trx);

		if ($data['transaction'] == null) {
			redirect('/');
		}
		
        // Contoh pengambilan data
        $productId = $data['transaction']['product_id']; // Ganti dengan id produk yang sesuai

        // Mengambil data produk
        $data['product'] = $this->ModelProduct->get_product_by_id($productId);

        // Menghitung total harga (jumlah transaksi * harga produk)
        $data['price'] = $data['transaction']['jumlah'] * $data['product']['price'];

        // Menggabungkan data transaksi ke dalam array $data
        // $data['transaction'] = $transaction;

        // Load view payment.php dengan data yang sudah diproses
        $this->load->view('payment', $data);
	}

	public function process_payment()
    {
        // Ambil data dari form
        $uang = $this->input->post('uang');
        $trx = $this->input->post('trx');

        // Validasi data yang diterima
        if (!$trx || !$uang) {
            redirect('/'); // Redirect jika trx atau uang tidak ada
        }

        // Cek total transaksi dari database
        $transaction = $this->ModelTransaction->getTransactionByNoOrder($trx);

        if ($uang < $transaction['totals']) {
            // Redirect dengan pesan error jika uang kurang
            redirect(base_url("payment?trx={$trx}&status=failed&message=*_uang_anda_kurang"));
        } else {
            // Update status transaksi menjadi 'paid' dan simpan jumlah uang yang dibayar
            $data = array(
                'status' => 'paid',
                'uang' => $uang
            );
            $this->ModelTransaction->updateTransaction($trx, $data);

            // Redirect ke halaman index.php dengan trx sebagai parameter
            redirect(base_url("payment?trx={$trx}&status=success"));
        }
    }
}
