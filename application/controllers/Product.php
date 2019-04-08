<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
		$this->load->model('Product_m', 'pm', true);
	}
	public function index()
	{
		$data = null;
		$data['products'] = $this->pm->get_product_data();
		$this->parser->parse('product', $data);
	}
	public function product_detail($id)
	{
		$data = null;
		$data = $this->pm->get_product_data(['product_id'=>$id]);
		$this->parser->parse('product_detail', $data[0]);
	}
}