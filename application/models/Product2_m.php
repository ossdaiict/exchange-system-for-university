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
    public function get_status($user)
    {
        return $this->db->get_where('product', $user)->result();
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
    public function upload_product_check($where)
    {
        return $this->db->get_where('product', $where)->result();
    }
    public function update_product_m($upd, $wh)
    {
        $this->db->where($wh)->update('product', $upd);
    }
    public function get_main_image($id)
    {
        return $this->db->select('main_image')
                ->get_where('product', array('product_id' => $id))
                ->result();
    }
    public function get_secondary_image($where)
    {
        return $this->db->select('other_image')
                ->get_where('product_image', $where)
                ->result();
    }
    public function delete_secondary_image($id)
    {
        return $this->db->where($id)
                ->delete('product_image');
    }
}
?>