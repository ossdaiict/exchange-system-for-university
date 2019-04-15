<?php
class Profile_m extends CI_Model{
    
    function get_Records($user_id)
    {
        $data= $this->db
          ->select('user_id, name,email, contact_no, alternate_contact_no, photo,gender,address')
          ->from('user')  
          ->where('user_id=',$user_id)
          ->get()
          ->result_array();
        return $data;
    }
   
    

    public function update_data($id) {
        $data=array(
            'name' =>$this->input->post('name'),
            'alternate_contact_no'=>$this->input->post('alternate_contact_no'),
            'address'=>$this->input->post('address'),
            'gender'=>$this->input->post('gender'),
            'photo'=>$this->input->post('photo')
        );
        
        $this->db->where('user_id=', $id);  
        return $this->db->update('user', $data);
        
    }

    function fetch_pass($session_id)
	{
	$fetch_pass=$this->db->query("select password from user where user_id='$session_id'");
    $res=$fetch_pass->row();
    return $res->password;
	}
	function change_pass($session_id,$new_pass)
	{
	$update_pass=$this->db->query("UPDATE user set password='$new_pass'  where user_id='$session_id'");
	}

    
}
?>