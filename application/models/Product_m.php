<?php
class Product_m extends CI_Model
{
  public function get_product_data($where=false)
  {
    if($where)
      $this->db->where($where);
    return $this->db
      ->select('product.*, wishlist.user_id')
      ->from('product')
      ->join('wishlist', "product.product_id=wishlist.product_id and wishlist.user_id={$this->ss->user_id}", 'left')
      ->order_by('date_added', 'DESC')
      ->get()
      ->result();
  }
  public function get_wishlist_data($where)
  {
    return $this->db
      ->where($where)
      ->get('wishlist')
      ->result();
  }
  public function delete_wishlist_data($data)
  {
    $this->db->delete('wishlist', $data);
    return $this->db->affected_rows();
  }  
  public function set_wishlist_data($data)
  {
    $this->db->insert('wishlist', $data);
    return $this->db->affected_rows();
  }

}
