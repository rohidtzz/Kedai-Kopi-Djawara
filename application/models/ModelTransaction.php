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
}
?>
