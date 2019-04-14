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
		$data['categories'] = $this->pm->get_all_category_data();
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
		if(count($data)===1)
		{
			$data[0]->product_image=$this->pm->get_product_image_data($id);
			$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$id]);
			$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
			$data[0]->has_reported=$this->pm->get_product_report_data($this->ss->user_id, $id);
			// echo '<pre>';
			// print_r($data[0]);
			// die("hello");
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
			if(count($data)===1 && is_numeric($this->input->post('c_final_price')))
			{
				$buyer_id = ($data[0]->seller_id==$this->ss->user_id)?$this->input->post('c_buyer_id'):$this->ss->user_id;
				$MABer = ($data[0]->seller_id==$this->ss->user_id)?2:1;
				$insert = [
					'product_id'=>$id,
					'buyer_id'=>$buyer_id,
					'final_price'=>$this->input->post('c_final_price')
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

	public function add_review($id)
	{
		$this->fv->set_rules('c_rating', 'Rating', 'trim|required|integer|greater_than_equal_to[1]|less_than_equal_to[5]');
		$this->fv->set_rules('c_review', 'Review', 'trim|max_length[500]');
		if($this->fv->run()==FALSE)
		{
			$data = null;
			$data = $this->pm->get_product_data($this->ss->user_id, $id);
			if(count($data)===1)
			{
				$data[0]->product_image=$this->pm->get_product_image_data($id);
				$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$id]);
				$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
				$data[0]->has_reported=$this->pm->get_product_report_data($this->ss->user_id, $id);
				$this->parser->parse('product_detail', $data[0]);
			}
			else
				redirect('error/404');
		}
		else
		{
			$data = null;
			$data = $this->pm->get_product_data($this->ss->user_id, $id);
			if(count($data)===1)
			{
				$data = [
					'buyer_id'=>$this->ss->user_id,
					'product_id'=>$id,
					'rating'=>$this->input->post('c_rating'),
					'review'=>$this->input->post('c_review')
				];
				$this->pm->add_revier_data($data);
				redirect('product/'.$id);
			}
			else
			{
				redirect('error/404');
			}
		}
	}

  public function report($pid)
  {
		$this->fv->set_rules('c_reason', 'Reason', 'trim|required|min_length[5]|max_length[500]');
    if($this->fv->run()==false)
		{
			$data = $this->pm->get_product_data($this->ss->user_id, $pid);
			if(count($data)===1)
			{
				$data[0]->product_image=$this->pm->get_product_image_data($pid);
				$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$pid]);
				$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
				$data[0]->has_reported=$this->pm->get_product_report_data($this->ss->user_id, $pid);
				$this->parser->parse('product_detail', $data[0]);
			}			
			else
				redirect('error/404');
		}
    else
		{
			$pdata = $this->pm->get_product_data($this->ss->user_id, $pid);
			if(count($pdata)===1 && $this->ss->user_id!=$pdata[0]->seller_id)
			{
				$report_data = [
					'reporter_id'=>$this->ss->user_id,
					'product_id'=>$pid,
					'reason'=>$this->input->post('c_reason')
				];
				$this->pm->set_report_data($report_data);
				$report_count = $this->pm->get_report_data($pid);
				if($report_count == 1 || $report_count > 10)
				{
					$product_data = ['report_status'=>($report_count==1?1:2)];
					$where = ['product_id'=>$id];
					$this->pm->update_product_data($where, $product_data);
				}
				redirect('product/'.$pid);
			}
			else
				redirect('error/404');
		}
	}
	
	public function category($cat)
	{
		$data['products'] = $this->pm->get_all_product_with_x_category_data($this->ss->user_id,0,$cat);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		//die("hello");		
		if(count($data)>0)
			$this->parser->parse('product', $data);
		else
			redirect('error/404');
	}
	public function search()
	{
		$this->fv->set_rules('r_search', 'Search', 'trim|required|alpha_numeric_spaces|max_length[50]');
		if($this->fv->run()==false)
			redirect('error/404');
		else
		{
			$data['products'] = $this->pm->get_product_search_data($this->ss->user_id, 0, $this->input->post('r_search'));
			$data['categories'] = $this->pm->get_all_category_data();
			$this->parser->parse('product', $data);
		}
	}
	public function sort()
	{
		$this->fv->set_rules('r_sort', 'Sort', 'trim|required|integer|greater_than[1]|less_than[8]');
		if($this->fv->run()==false)
		{
			$data['products'] = $this->pm->get_all_product_data($this->ss->user_id, 0);
			$data['categories'] = $this->pm->get_all_category_data();
			$this->parser->parse('product', $data);
		}
		else
		{
			switch($this->input->post('r_sort'))
			{
				case 2:	$sort='name';	$direction='ASC';	break;
				case 3:	$sort='name';	$direction='DESC';	break;
				case 4:	$sort='price';	$direction='ASC';	break;
				case 5:	$sort='price';	$direction='DESC';	break;
				case 6:	$sort='date_added';	$direction='DESC';	break;
				case 7:	$sort='date_added';	$direction='ASC';	break;
			}
			$data['products'] = $this->pm->get_product_sort_data($this->ss->user_id, 0, $sort, $direction);
			$data['categories'] = $this->pm->get_all_category_data();
			$this->parser->parse('product', $data);
		}		
	}
	// public function filter($type)
	// {
	// 	switch($type)
	// 	{
	// 		case "wishlist":

	// 		break
	// 		case "sold":
			
	// 		break
	// 		case "bought":
			
	// 		break
	// 		default:
	// 			redirect('error/404');
	// 		break
	// 	}
	// }
}
