<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Err extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
	}

	public function index($err_code=404)
	{
		$this->load->view('error_'.$err_code);
	}
}