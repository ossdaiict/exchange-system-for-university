<?php
class Login_m extends CI_Model
{
  public function get_do_login_data($where)
  {
    return $this->db
      ->where($where)
      ->get('user')
      ->result();
  }
}
