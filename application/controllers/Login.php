<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __contruct()
	{
		parent::__construct();
    if($this->ss->user_id)
			redirect('Product');
	}
	public function index()
	{
		$this->load->database();
		$this->db->query("DROP SCHEMA campus_exchange CASCADE");
		print_r($this->db->get('category')->result());
	}
	public function do_login()
	{
		echo "hello from login";
	}
}