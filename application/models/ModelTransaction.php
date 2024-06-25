<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelTransaction extends CI_Model {

    public function insert_transaction($data) {
        $this->db->insert('transaction', $data);
        return $this->db->insert_id();
    }

	public function get_all_transaction() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('transaction');
        return $query->result_array();
    }

	public function updateTransaction_status($transaction_id, $data) {
        $this->db->where('id', $transaction_id);
        return $this->db->update('transaction', $data);
    }

	public function get_all_transaction_and_product() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('transaction');
        $transactions = $query->result_array();

        // Load product model
        $this->load->model('ModelProduct');

        // Add product data to each transaction
        foreach ($transactions as &$transaction) {
            $transaction['product'] = $this->ModelProduct->getProductById($transaction['product_id']);
        }

        return $transactions;
    }

	public function get_transactions_by_user_id($user_id) {
		$this->db->order_by('id', 'DESC');
		$this->db->where('user_id', $user_id);
        $query = $this->db->get('transaction');
        $transactions = $query->result_array();

        // Load product model
        $this->load->model('ModelProduct');

        // Add product data to each transaction
        foreach ($transactions as &$transaction) {
            $transaction['product'] = $this->ModelProduct->getProductById($transaction['product_id']);
        }

        return $transactions;
    }


	public function getTransactionByNoOrder($trx)
    {
        // Ambil data transaksi berdasarkan nomor order (trx)
        $query = $this->db->get_where('transaction', array('no_order' => $trx));
        return $query->row_array();
    }

	public function updateTransaction($trx, $data)
    {
        // Update data transaksi berdasarkan nomor order (trx)
        $this->db->where('no_order', $trx);
        return $this->db->update('transaction', $data);
    }

	public function getTodaySales() {
		$today = date('Y-m-d'); // Get today's date
		$this->db->select_sum('totals'); // Assuming 'amount' is your sales amount field
		$this->db->where('status', 'paid');
		$this->db->where('created_at', $today); // Assuming 'date' is your transaction date field
		$query = $this->db->get('transaction'); // Assuming 'transactions' is your transactions table
		return $query->row()->totals;
	}

	public function getTotalSales() {
		$this->db->select_sum('totals'); // Assuming 'amount' is your sales amount field
		$this->db->where('status', 'paid');
		$query = $this->db->get('transaction'); // Assuming 'transactions' is your transactions table
		return $query->row()->totals;
	}

}
?>
