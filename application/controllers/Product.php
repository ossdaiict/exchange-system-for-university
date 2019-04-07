<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __contruct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('product');
	}
	public function do_login()
	{
		echo "hello from login";
	}
}