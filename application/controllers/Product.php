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

	public function product_detail($id)
	{
		$data = null;
		$data = $this->pm->get_product_data($this->ss->user_id, $id);
		// echo "<pre>";
		// print_r($data);


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


		if(count($data)===1)
		{
			$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$id]);
			// echo "<pre>";
			// print_r($data);
			// die("</br>hello");
			$this->parser->parse('product_detail', $data[0]);			
		}
		else
			redirect('error/404');
	}

	public function toggle_wishlist($id, $redirect_back=false)
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
			if($redirect_back)
				redirect('product/'.$id);
			else
				redirect('product/');
			}
		else
			redirect('error/404');
	}
	public function get_product_update($id)//load product info and redirect to product update page for seller
	{
		echo "product update page goes here";
	}
	public function set_product_update($id)//update product info and redirect to product page??
	{

	}

	public function mark_as_sold($id)
	{
		if(is_numeric($id))
		{
			$data = $this->pm->get_product_data($this->ss->user_id, $id);
			if(count($data)===1 && is_numeric($this->input->post('c_price')))
			{
				$buyer_id = ($data[0]->seller_id==$this->ss->user_id)?$this->input->post('c_buyer_id'):$this->ss->user_id;
				$MABer = ($data[0]->seller_id==$this->ss->user_id)?2:1;
				$insert = [
					'product_id'=>$id,
					'buyer_id'=>$buyer_id,
					'price'=>$this->input->post('c_price')
				];
				$this->pm->update_product_data(['product_id'=>$id], ['product_status'=>$MABer]);
				$this->pm->set_transaction_data($insert);
				redirect('product/'.$id);
			}
			else
				redirect('error/404');
		}
		else
			redirect('error/404');
	}

	public function answer_popup($pid)
	{
		$data = $this->pm->get_product_data($this->ss->user_id, $pid);		
		// echo '<pre>';
		// print_r($data);
		// die($this->ss->user_id.'</br>'.$this->input->post('c_confirm')."timestamp error");
		if(
			count($data)===1 && 
			($data[0]->seller_id==$this->ss->user_id && $data[0]->product_status==1)
			|| ($data[0]->buyer_id==$this->ss->user_id && $data[0]->product_status==2)  
			&& ($this->input->post('c_confirm')==="no" || $this->input->post('c_confirm')==="yes")
		)
		{
			if($this->input->post('c_confirm')==="no")
			{
				$this->pm->update_product_data(['product_id'=>$pid], ['product_status'=>0]);
				$this->pm->delete_transaction_data(['product_id'=>$pid]);
			}
			elseif($this->input->post('c_confirm')==="yes")
			{
				$this->pm->update_product_data(['product_id'=>$pid], ['product_status'=>3]);
				$this->pm->update_transaction_with_current_date_data(['product_id'=>$pid]);
			}
			redirect('product/'.$pid);
		}
		else
			redirect('error/404');
	}
}
