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

				$phone = trim($phone);
				$phone = strip_tags($phone);
				$phone= str_replace(" ","",$phone);
				$phone= str_replace("(","",$phone);
				$phone= str_replace(".","",$phone);
		
				if(!preg_match('/[^+0-9]/',trim($phone))){
		
					if(substr(trim($phone), 0, 3)=='+62'){
						$phone= trim($phone);
					}
					elseif(substr($phone, 0, 1)=='0'){
						$phone= '62'.substr($phone, 1);
					}
				}

				$data = array(
					"api_key" => "ae8598f8f95f150d3e25e1111f52f1e25dcb9420",
					"receiver" => $phone,
					"data" => array("message" => "Terima kasih telah memesan produk kami. Nomor order anda adalah " . $no_order . ". Silahkan lakukan pembayaran."),
				);

				$jsonData = json_encode($data);

				$curl = curl_init();

				curl_setopt_array($curl, array(
					CURLOPT_URL => 'https://server2.goowa.id/api/send-message',
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => '',
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 0,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => 'POST',
					CURLOPT_POSTFIELDS => $jsonData,
					CURLOPT_HTTPHEADER => array(
						'Content-Type: application/json'
					),
				));

				$response = curl_exec($curl);
				curl_close($curl);

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
