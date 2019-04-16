<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
	}
	public function index()
	{
		redirect('error/404');
	}

	public function TC()
	{
		$this->load->view('t_and_c');
	}
}