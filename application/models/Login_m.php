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
  public function get_user_data($id)
  {
    return $this->db
      ->where(['is_verified'=> 1, 'user_id'=>$id])
      ->get('user')
      ->result();
  }
}
