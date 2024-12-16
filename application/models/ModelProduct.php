<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelProduct extends CI_Model
{
    //manajemen product
    public function getProduct() { return $this->db->get('product'); }
    public function productWhere($where) { return $this->db->get_where('product', $where); }
    public function simpanProduct($data = null) { $this->db->insert('product',$data); }

	public function deleteProduct($product_id) {
        $this->db->where('id', $product_id);
        return $this->db->delete('product');
    }

	public function updateProduct($product_id, $data) {
        $this->db->where('id', $product_id);
        return $this->db->update('product', $data);
    }

	public function get_all_products() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function get_product_by_id($product_id) {
        $query = $this->db->get_where('product', array('id' => $product_id));
        return $query->row_array();
    }

	public function getProductById($id) {
        $query = $this->db->get_where('product', array('id' => $id));
        return $query->row_array();
    }

    public function update_product_stock($product_id, $new_stock) {
		// Validasi product_id
		if (empty($product_id) || !is_numeric($new_stock) || $new_stock < 0) {
			return false; // Return false jika input tidak valid
		}
	
		// Mulai transaksi database untuk memastikan data konsisten
		$this->db->trans_start();
	
		// Update stok produk
		$this->db->where('id', $product_id);
		$this->db->update('product', array('stock' => $new_stock));
	
		// Selesaikan transaksi
		$this->db->trans_complete();
	
		// Cek apakah transaksi berhasil
		if ($this->db->trans_status() === FALSE) {
			// Log error jika diperlukan
			log_message('error', "Failed to update product stock for product ID: $product_id");
			return false; // Gagal memperbarui stok
		}
	
		return true; // Berhasil memperbarui stok
	}

	public function getTotalProducts() {
		return $this->db->count_all('product'); // Assuming 'products' is your products table
	}
    
   
}
