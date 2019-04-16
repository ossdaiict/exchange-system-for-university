<?php
class Register_m extends CI_Model
{
  public function set_do_register_data($data)
  {
    $this->db
      ->insert('user', $data);
    return $this->db->affected_rows() != 1 ? false : true;
  }
  public function get_register_data($where = array())
  {
    return $this->db
        ->get_where('user', $where)
        ->result();
  }
  public function set_verify($where)
  {
    return $this->db->where($where)
          ->update('user', array('is_verified' => 1));
  }
}
