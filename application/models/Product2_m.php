<?php
class Product2_m extends CI_Model
{
    public function get_category()
    {
        return $this->db->get('category')->result();
    }
    public function add_product($ins)
    {
        $this->db
            ->insert('product', $ins);
        return $this->db->affected_rows() != 1 ? false : true;
    }
}
?>