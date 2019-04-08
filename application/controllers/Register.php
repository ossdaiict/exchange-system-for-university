<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
		$this->load->model('Register_m', 'rm', true);
		$this->load->helper('string');
    if($this->ss->email)
			redirect('product/');
	}
	public function index()
	{
		$this->parser->parse('register',[]);
		//$this->load->view('register');
	}
	public function do_register()
	{
    $this->fv->set_rules('c_user_id', 'DA Student ID', 'trim|required|integer|exact_length[9]|is_unique[user.user_id]');
    $this->fv->set_rules('c_password', 'Password', 'trim|required|min_length[8]|max_length[32]');
    $this->fv->set_rules('c_name', 'Name', 'trim|required|min_length[3]|max_length[50]');
    $this->fv->set_rules('c_contact_no', 'Contact No', 'trim|required|integer|exact_length[10]');
    $this->fv->set_rules('c_agreement', 'Agreement', 'trim|required|integer|greater_than[0]',array('required' => 'Read and Accept T&C to continue!'));
    if($this->fv->run()==FALSE)
    {
			$this->parser->parse('register',[]);
    }
    else
    {
      $creds=null;
			$creds=[
				'user_id'=>$this->input->post('c_user_id'),
				'password'=>$this->input->post('c_password'),
				'name'=>$this->input->post('c_name'),
				'contact_no'=>$this->input->post('c_contact_no'),
				'verification_secret'=>random_string('alnum', 32),
				'is_verified'=> 0
			];
      $register=false;
			$register=$this->rm->set_do_register_data($creds);
			$msg['msg']=$register?'<p>Check your mail to verify account</p>':'<p>Try Again</p>';
			$this->load->view('register', $msg);
    }
	}
	public function verify($user_id, $secret)
	{
		//validate both fields
		//if error show a error page
		//else set is_verified to 1
		// redirect to login
	}
}