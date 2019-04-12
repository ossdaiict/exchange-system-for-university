<?php
class Product2_m extends CI_Model
{
    public function get_category()
    {
        return $this->db->get('category')->result();
    }
    public function get_category_where($cat)
    {
        return $this->db->get_where('category', $cat)->result();
    }
    public function add_product($ins)
    {
        $this->db
            ->insert('product', $ins);
        return $this->db->affected_rows() != 1 ? false : true;
    }
    public function add_image($img = array())
    {
        return $this->db
            ->insert_batch('product_image', $img);
        // return $this->db->affected_rows() < 0 ? false : true;
    }
}
?>