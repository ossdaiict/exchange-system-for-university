<?php
class Product_m extends CI_Model
{
  public function get_product_data($where=false)
  {
    if($where)
      $this->db->where($where);
    return $this->db
      ->order_by('date_added', 'DESC')
      ->get('product')
      ->result();
  }
}
