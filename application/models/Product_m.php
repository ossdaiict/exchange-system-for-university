<?php
class Product_m extends CI_Model
{
  public function get_all_product_data($logged_in_user_id, $status)
  {
    $data = $this->db
      ->select('p.*, w.wishlist_user_id')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
      ->where('p.report_status !=', 2)
      //what about sold product
      ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC',)
      ->get()
      ->result();


      //add paging
      
    // $data = $this->db
    //   ->select('p.*, w.wishlist_user_id, count(w2.product_id) AS wishlist_count')
    //   ->from('product p')
    //   ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
    //   ->join('wishlist w2', 'p.product_id=w2.product_id', 'left')
    //   ->where(['p.product_status'=>$status]) //bring all product !!!!
    //   ->group_by('w2.product_id')
    //   ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC',)
    //   ->get()
    //   ->result();


    return $data;
  }

  public function get_product_data($logged_in_user_id, $id=false)
  {
    $data = $this->db
      ->select('p.*, w.wishlist_user_id, t.buyer_id, t.price, t.date_sold')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
      ->join('transaction t', 'p.product_id=t.product_id', 'left')
      ->where(['p.product_id'=>$id])
      ->get()
      ->result();

    $data2 = $this->db
      ->select('count(product_id) AS wishlist_count')
      ->where(['product_id'=>$id])
      ->group_by('product_id')
      ->get('wishlist')
      ->result();

    if(count($data) > 0)
      $data[0]->wishlist_count=((count($data2) > 0 ) ? ($data2[0]->wishlist_count) : (0) );

    return $data;
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
