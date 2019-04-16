<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
		$this->load->model('Login_m', 'lm', true);
    if($this->ss->email)
			redirect('product/');
	}
	public function index()
	{
		$this->parser->parse('login',[]);
		//$this->load->view('login');
	}
	public function do_login()
	{
    $this->fv->set_rules('r_user_id', 'DA Student ID', 'trim|required|integer|exact_length[9]');
    $this->fv->set_rules('r_password', 'Password', 'trim|required|min_length[8]|max_length[32]');
    if($this->fv->run()==FALSE)
    {
			$this->parser->parse('login',[]);
    }
    else
    {
      $creds=null;
			$creds=[
				'user_id'=>$this->input->post('r_user_id'),
				'password'=>$this->input->post('r_password'),
				'is_verified'=>1
			];
      $login=null;
			$login=$this->lm->get_do_login_data($creds);
			if(count($login)==1)
			{
        $this->ss->set_userdata([
          'user_id'=>$login[0]->user_id,
					'email'=>$login[0]->email,
        ]);
        redirect('product/');
      }
      else
      {
				$error['error']='<p>Invalid ID or Password</p>';
				$this->load->view('login', $error);
      }
    }
	}

	public function lost_password()
	{
		$this->fv->set_rules('r_user_id', 'UserID', 'trim|required|integer|exact_length[9]');
		if($this->fv->run()==false)
		{
			redirect('login/');
		}
		else
		{
			$data = $this->lm->get_user_data($this->input->post('r_user_id'));
			if(count($data) == 1)
			{
				//send mail consisting existing password
				$var = send_mail_forgot_password($data[0]->email, $data[0]->password);
				if($var == TRUE)
				{
					$msg['msg'] = 'check your DA-mail for further instruction.';
				}
				else {
					$msg['msg'] = "Unable to reset password please check your details properly";
				}
				$this->parser->parse('login', $msg);
			}
			else
			{
				redirect('login/');
			}
		}
	}

}