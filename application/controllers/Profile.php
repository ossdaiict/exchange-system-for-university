  <?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Profile extends CI_Controller
  {
    public function __construct()
    {
      Parent::__construct();
      $this->load->database();
      $this->load->helper(array('form', 'url'));
      $this->load->model('Profile_m', 'pf', true);
      $this->load->helper('string');
      if(!$this->ss->email)
        redirect('login/');
   }
    
    public function index()
    {
      $user_id=$this->ss->userdata('user_id');
      $d=null;
      $d=$this->pf->get_Records($user_id);
      $data['user']=$d;
      $this->load->view("profile",$data);
    }

    public function update_data() 
    {  
      $user_id=$this->ss->userdata('user_id');
      $d['user']=$this->pf->get_Records($user_id);
      $this->fv->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[50]');
      $this->fv->set_rules('address','Address','trim|max_length[200]|min_length[10]');
      $this->fv->set_rules('alternate_contact_no','Alternate Number','trim|integer|min_length[10]|max_length[10]');
      if($this->fv->run()==FALSE)
      {    
          $this->parser->parse('profile',$d);
      }
      else
      {
        $config['upload_path'] = './asset/user/img/user/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2048'; 
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        $config['encrypt_name'] = TRUE;
        $config['detect_mime'] = TRUE;

        $data=array(
          'name' =>$this->input->post('name'),
          'alternate_contact_no'=>$this->input->post('alternate_contact_no'),
          'address'=>$this->input->post('address'),
          'gender'=>$this->input->post('gender'),
        );

        $this->load->library('upload', $config);
        $img = $this->upload->do_upload('profile_photo');
        if ( $img == FALSE)
        {
          $error['err'] = $this->upload->display_errors();
          //die($this->upload->display_errors());
          $this->parser->parse('profile', $error);
        }
        else
        {
          $img = $this->upload->data();
          // print_r($img);
          // die();
          $data['photo']=$img['file_name'];
          $this->parser->parse('profile', $data);
        }

      $id = $this->ss->userdata('user_id');
      $this->pf->update_data($id,$data);
      redirect('profile',$d);
      }
    
    }
    public function change_pass()
	  {
      
      $user_id=$this->ss->userdata('user_id');
      $d['user']=$this->pf->get_Records($user_id);
      $this->fv->set_rules('new_pass', 'New Password', 'trim|required|min_length[8]|max_length[32]');
      $this->fv->set_rules('confirm_pass', 'Confirm Password', 'trim|required|min_length[8]|max_length[32]|matches[new_pass]');
      if($this->fv->run()==FALSE)
      {
        $this->parser->parse('profile',$d);
       
      }
      else{
    
      $old_pass=$this->input->post('old_pass');
			$new_pass=$this->input->post('new_pass');
			$confirm_pass=$this->input->post('confirm_pass');
      $session_id=$this->ss->userdata('user_id');
      $pass= $this->pf->fetch_pass($session_id);
			
			if((!strcmp($old_pass,$pass))&& (!strcmp($new_pass,$confirm_pass))){
				$this->pf->change_pass($session_id,$new_pass);
        $this->view->load('profile',$d);
			}
			else{
          
        $this->parser->parse('profile',$d);
			}
      }	
    }
  
}

