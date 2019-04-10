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
		$data['products'] = $this->pm->get_all_product_data($this->ss->user_id, 0);
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		//die("hello");
		$this->parser->parse('product', $data);
	}

	public function product_detail($id, $user_id)
	{
		$this->ss->set_userdata(['user_id'=>$user_id]);
		$d = null;
		$d = $this->pm->get_product_data($user_id, $id);
		echo "<pre>";
		print_r($d);

		if($d[0]->product_status!=3)
		{
			if($this->ss->user_id==$d[0]->seller_id)
			{
				echo 'seller, ';
				if($d[0]->product_status==0)
				{
					echo 'update_info';
					if($p[0]->wishlist_count>0)
						echo 'MAB_button()';
				}
				else if($d[0]->product_status==1)
					echo 'answer popup';
			}
			else
			{
				if($this->ss->user_id!=$d[0]->buyer_id)
					echo 'add/remove wishlist';
				else if($d[0]->product_status==2)
					echo 'answer popup';
			}
		}
		else
		{
			if($this->ss->user_id==$d[0]->buyer_id)
				echo 'show in buy list';
			else if($this->ss->user_id==$d[0]->seller_id)
				echo 'show in sell list';
		}












		// switch($d[0]->product_status)
		// {
		// 	case 0:
		// 		if($d[0]->seller_id==$this->ss->user_id)
		// 		{
		// 			echo "i am seller";
		// 		}
		// 		else if($d[0]->wishlist_user_id==$this->ss->user_id)
		// 		{
		// 			echo "i can remove from wishlist";
		// 		}
		// 		else
		// 		{
		// 			echo "i am regular buyer/ i can add to wishlist";
		// 		}
		// 	break;

		// 	case 1:
		// 		if($d[0]->seller_id==$this->ss->user_id)
		// 		{
		// 			echo "i will answer popup";
		// 		}
		// 		else if($d[0]->buyer_id==$this->ss->user_id)
		// 		{
		// 			echo "i MABed it";
		// 		}
		// 		else
		// 		{
		// 			echo "i am regular buyer";
		// 		}
		// 		break;

		// 	case 2:
		// 		if($d[0]->seller_id==$this->ss->user_id)
		// 		{
		// 			echo "i will select a buyer for MAB";
		// 		}
		// 		else if($d[0]->buyer_id==$this->ss->user_id)
		// 		{
		// 			echo "i will answer popup";
		// 		}
		// 		else
		// 		{
		// 			echo "i am regular buyer";
		// 		}
		// 	break;

		// 	case 3:
		// 		if($d[0]->seller_id==$this->ss->user_id)
		// 		{
		// 			echo "i sold it";
		// 		}
		// 		else if($d[0]->buyer_id==$this->ss->user_id)
		// 		{
		// 			echo "i bought it";
		// 		}				
		// 	break;

		// }

		// echo "<pre>";
		// print_r($data);
		die("</br>hello");
		$this->parser->parse('product_detail', $data[0]);
	}

	public function toggle_wishlist($id)
	{
		if(is_numeric($id))
		{
			$data = [
				'wishlist_user_id'=>$this->ss->user_id,
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