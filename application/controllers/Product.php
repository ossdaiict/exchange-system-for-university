<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
		$this->load->model('Product_m', 'pm', true);
		if(!$this->ss->email)
			redirect('login/');
	}
	public function index()
	{
		$data = null;
		$where = [
			'status' => 0
		];
		$data['products'] = $this->pm->get_product_data($where);
		$this->parser->parse('product', $data);
	}
	public function product_detail($id)
	{
		$data = null;
		$data = $this->pm->get_product_data(['product_id'=>$id]);
		$this->parser->parse('product_detail', $data[0]);
	}
	public function toggle_wishlist($id)
	{
		if(is_numeric($id))
		{
			$data = [
				'user_id'=>$this->ss->user_id,
				'product_id'=>$id
			];
			$op = count($this->pm->get_wishlist_data($data));
			if($op===1)
				$op = $this->pm->delete_wishlist_data($data);
			else if($op===0)
				$this->pm->set_wishlist_data($data);
			redirect('product/');
			}
		else
			redirect('error');
	}
	public function get_product_update($id)//load product info and redirect to product update page for seller
	{

	}
	public function set_product_update($id)//update product info and redirect to product page??
	{

	}
}