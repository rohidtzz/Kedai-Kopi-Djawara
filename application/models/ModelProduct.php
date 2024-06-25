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
        $this->db->where('id', $product_id);
        $this->db->update('product', array('stock' => $new_stock));
    }
    
   
}
