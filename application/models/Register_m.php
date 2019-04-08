<?php
class Register_m extends CI_Model
{
  public function set_do_register_data($data)
  {
    $this->db
      ->insert('user', $data);
    return $this->db->affected_rows() != 1 ? false : true;
  }
}
