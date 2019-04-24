<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		Parent::__construct();
		$this->load->model('Product_m', 'pm', true);
	}

	public function return_filter_where($path)
	{
		switch($path)
		{
			case "product/wishlist":
				return [
					'p.report_status < '  => 2,
					'p.product_status < ' => 3,
					'p.seller_id != '     => $this->ss->user_id,
					'w.wishlist_user_id !='=>''
				];
		
			break;

			case "product/seller_list":
				return [
					'p.seller_id'     => $this->ss->user_id
				];
			break;

			case "product/bought_list":
				return [
					'p.product_status ' => 3,
					't.buyer_id'     => $this->ss->user_id,
				];
			break;

			default :
				if(substr($path, 0, 17)=="product/category/")
					return [
						'p.report_status < '  => 2,
						'p.product_status < ' => 3,
						'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0),
						'p.category'					=> substr($path, 17)
					];
				else
					return [
						'p.report_status < '  => 2,
						'p.product_status < ' => 3,
						'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0)
					];
			break;

		}
	}

	public function index()
	{
		$data = [];
		$where = [
			'p.report_status < '  => 2,
			'p.product_status < ' => 3,
			'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0)
		];
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['page_info']['path'] = 'product/index';
		$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		//die("hello");
		$this->parser->parse('product', $data);
	}

	public function product_detail($id)
	{
		if(!$this->ss->email)
			redirect('login/');
		$data = null;
		$data = $this->pm->get_product_data($this->ss->user_id, $id);
		if(count($data)===1)
		{
			$this->load->helper('date');
			$data[0]->product_image=$this->pm->get_product_image_data($id);
			$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$id]);
			$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
			$data[0]->has_reported=$this->pm->get_product_report_data($this->ss->user_id, $id);
			$data[0]->seller_data=$this->pm->get_seller_data($data[0]->seller_id);
			if($data[0]->product_status==1)
				$data[0]->buyer_data=$this->pm->get_buyer_data($data[0]->buyer_id);
			// echo '<pre>';
			// print_r($data[0]);
			// die("hello");
			$this->parser->parse('product_detail', $data[0]);
		}
		else
			redirect('error/404');
	}

	public function delete($id)
	{
		$data = $this->pm->get_product_data($this->ss->user_id, $id);
		if(count($data)===1 && $data[0]->seller_id==$this->ss->user_id && $data[0]->product_status==0)
		{
			$this->pm->delete_product_data($id);
			redirect('product/');
		}
		else
			redirect('error/404	');		
	}

	public function toggle_wishlist($id, $redirect_back=false)
	{
		if(!$this->ss->email)
			redirect('login/');
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
	public function mark_as_sold($id)
	{
		if(!$this->ss->email)
			redirect('login/');		
		if(is_numeric($id))
		{
			$data = $this->pm->get_product_data($this->ss->user_id, $id);
			if(count($data)===1 && trim($this->input->post('c_final_price'))!='' && is_numeric((int)$this->input->post('c_final_price')))
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
				if($data[0]->seller_id==$this->ss->user_id)
					send_mail_MAB_by_buyer($insert['buyer_id'].'@daiict.ac.in', $data[0]->product_id, $data[0]->name, $data[0]->seller_id, $insert['final_price']);
				else
					send_mail_MAB_by_buyer($data[0]->seller_id.'@daiict.ac.in', $data[0]->product_id, $data[0]->name, $insert['buyer_id'], $insert['final_price']);
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
		if(!$this->ss->email)
			redirect('login/');		
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
				if($data[0]->seller_id==$this->ss->user_id)
					send_mail_MAB_rejected_by_seller($data[0]->buyer_id.'@daiict.ac.in', $data[0]->name, $data[0]->seller_id);
				else
					send_mail_MAB_rejected_by_seller($data[0]->seller_id.'@daiict.ac.in', $data[0]->name, $data[0]->buyer_id);
			}
			elseif($this->input->post('c_confirm')==="yes")
			{
				if($data[0]->seller_id==$this->ss->user_id)
					send_mail_MAB_accepted($data[0]->buyer_id.'@daiict.ac.in', $data[0]->name, $data[0]->seller_id);
				else
					send_mail_MAB_accepted($data[0]->seller_id.'@daiict.ac.in', $data[0]->name, $data[0]->buyer_id);
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
		if(!$this->ss->email)
			redirect('login/');
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
				$data[0]->seller_data=$this->pm->get_seller_data($data[0]->seller_id);
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
		if(!$this->ss->email)
			redirect('login/');
		$this->fv->set_rules('c_reason', 'Reason', 'trim|required|min_length[5]|max_length[500]');
    if($this->fv->run()==false)
		{
			$data = $this->pm->get_product_data($this->ss->user_id, $pid);
			if(count($data)===1)
			{
				$data[0]->product_image=$this->pm->get_product_image_data($pid);
				$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$pid]);
				$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
				$data[0]->seller_data=$this->pm->get_seller_data($data[0]->seller_id);
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
					$where = ['product_id'=>$pid];
					$this->pm->update_product_data($where, $product_data);
					if($report_count == 10)
						send_mail_report_threshold_to_seller($pdata[0]->seller_id.'@daiict.ac.in', $pdata[0]->name);
				}
				redirect('product/'.$pid);
			}
			else
				redirect('error/404');
		}
	}
	
	public function category($cat)
	{
		$data = [
			'search' => $this->input->post('r_search'),
		];
		$where = [
			'p.report_status < '  => 2,
			'p.product_status < ' => 3,
			'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0),
			'p.category'=>$cat
		];
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['page_info']['path'] = 'product/category/'.$cat;
		$data['products'] = $this->pm->get_all_product_data2($data, $where);
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
			$data = [
				'search' => $this->input->post('r_search'),
			];
			$where = [
				'p.report_status < '  => 2,
				'p.product_status < ' => 3,
				'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0)
			];
			$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
			$data['products'] = $this->pm->get_all_product_data2($data, $where);
			$data['categories'] = $this->pm->get_all_category_data();
			// echo '<pre>';
			// print_r($data);
			// die("ello");
			$this->parser->parse('product', $data);


			// $data['products'] = $this->pm->get_product_search_data($this->ss->user_id, 0, $this->input->post('r_search'));
			// $data['categories'] = $this->pm->get_all_category_data();
			// $this->parser->parse('product', $data);
		}
	}

	public function page($page_no)
	{
		$data = [
			'page_no'=>$page_no,
			'search'=>$this->input->post('r_search'),
			'show'=>$this->input->post('r_show'),
			'sort'=>$this->input->post('r_sort'),
			'path'=>$this->input->post('r_path'),
		];
		$where = $this->return_filter_where($this->input->post('r_path'));
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		//die("hello");
		$this->parser->parse('product', $data);
	}

	public function sort_show()
	{
		// $this->fv->set_rules('r_sort', 'Sort', 'trim|required|integer|greater_than[1]|less_than[8]');
		// if($this->fv->run()==false)
		// {
		// 	$data['products'] = $this->pm->get_all_product_data($this->ss->user_id, 0);
		// 	$data['categories'] = $this->pm->get_all_category_data();
		// 	$this->parser->parse('product', $data);
		// }
		// else
		{
			$data = [
				'search'=>$this->input->post('r_search'),
				'show'=>$this->input->post('r_show'),
				'sort'=>$this->input->post('r_sort'),
			];
			$where = $this->return_filter_where($this->input->post('r_path'));
			$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
			$data['page_info']['path'] = $this->input->post('r_path');
			$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
			$data['categories'] = $this->pm->get_all_category_data();
			// echo "<pre>";
			// print_r($data['products']);
			// echo "</pre>";
			// die("hello");
			$this->parser->parse('product', $data);
		}		
	}

	public function wishlist()
	{
		$data = [];
		$where = [
			'p.report_status < '  => 2,
			'p.product_status < ' => 3,
			'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0),
			'w.wishlist_user_id !='=>''
		];
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['page_info']['path'] = 'product/wishlist';
		$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		// die("hello");
		$this->parser->parse('product', $data);
	}

	public function seller_list()
	{
		if(!$this->ss->email)
			redirect('login/');
		$data = [];
		$where = $this->return_filter_where('product/seller_list');
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['page_info']['path'] = 'product/seller_list';
		$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		// die("hello");
		$this->parser->parse('product', $data);
	}

	public function bought_list()
	{
		if(!$this->ss->email)
			redirect('login/');
		$data = [];
		$where = $this->return_filter_where('product/bought_list');
		$data['page_info'] = $this->pm->get_all_product_count_data2($data, $where);
		$data['page_info']['path'] = 'product/bought_list';
		$data['products'] = $this->pm->get_all_product_data2($data['page_info'], $where);
		$data['categories'] = $this->pm->get_all_category_data();
		// echo "<pre>";
		// print_r($data['products']);
		// echo "</pre>";
		// die("hello");
		$this->parser->parse('product', $data);
	}

	public function receipt($id)
	{
		$data = $this->pm->get_product_data($this->ss->user_id, $id);
		if(count($data)===1)
		{
			$data[0]->product_image=$this->pm->get_product_image_data($id);
			$data[0]->wishlist_data=$this->pm->get_wishlist_user_data(['product_id'=>$id]);
			$data[0]->seller_review=$this->pm->get_seller_review_data($data[0]->seller_id);
			$data[0]->has_reported=$this->pm->get_product_report_data($this->ss->user_id, $id);
			$data[0]->seller_data=$this->pm->get_seller_data($data[0]->seller_id);
			if($data[0]->product_status!=0)
				$data[0]->buyer_data=$this->pm->get_buyer_data($data[0]->buyer_id);
			// echo '<pre>';
			// print_r($data[0]);
			// die("hello");
			$this->parser->parse('receipt', $data[0]);
		}
	}








































	public function add_product_form()
	{
		if(!$this->ss->email)
			redirect('login/');
		$date = time();
		$dt = date("Y-m-d H:m:s", $date);
		$data = null;
		$val = $this->pm->get_status(array('seller_id' => $this->ss->user_id, 
		'expiry_date < ' => $dt));
		if(count($val)>0)
		{
				$data['past'] = $val;
				$this->parser->parse('add_product', $data);
		}
		else 
		{
				$data['cat'] = $this->pm->get_category();
				$this->parser->parse('add_product', $data);   
		}
	}
	public function add_product()
	{
		if(!$this->ss->email)
			redirect('login/');
		$this->load->helper('date');
		$expiry_date = now() + (60*60*24*90);
		$dt = date("Y-m-d H:m:s", $expiry_date);
		$this->fv->set_rules('c_name', 'Product Name', 'trim|required');
		$this->fv->set_rules('c_description', 'Description', 'trim|required');
		$this->fv->set_rules('c_price', 'Price', 'trim|required|numeric');
		$this->fv->set_rules('c_category', 'Category', 'trim|required|callback_cat_check');
		$this->fv->set_rules('c_is_negotiable', 'Negotiable', 'trim|required|less_than[2]|greater_than[-1]');
		$this->fv->set_rules('c_return_window', 'Return Window', 'trim|required|less_than[8]|greater_than[-1]');
		//$this->fv->set_rules('c_image', 'Image', 'required');
		if($this->fv->run() == true && count($_FILES['c_sec_image']['name']) < 5 )
		{
				//varibales for image
				$config['upload_path'] = './asset/user/img/product/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				$config['encrypt_name'] = TRUE;
				$config['detect_mime'] = TRUE;

				//IMAGE UPLOAD and library calling
				$this->load->library('upload', $config);
				$img = $this->upload->do_upload('c_main_image');
				
				//If upload fails redirect to  add product page
				if ($img == FALSE)
				{
						$data['cat'] = $this->pm->get_category();
						$data['error'] = $this->upload->display_errors();
						$this->parser->parse('add_product', $data);
				}
				
				//if upload succeed then insert data
				else
				{
						$ins = null;
						$img = $this->upload->data();
						$ins = [
								'seller_id' => $this->ss->user_id,
								'main_image' => $img['file_name'],
								'name' => $this->input->post('c_name'),
								'description' => $this->input->post('c_description'),
								'price' => $this->input->post('c_price'),
								'category' => $this->input->post('c_category'),
								'return_window' => $this->input->post('c_return_window'),
								'is_negotiable' => $this->input->post('c_is_negotiable'),
								'expiry_date' => $dt
						];
						$stat = $this->pm->add_product($ins);
						$mag['msg'] = "Product added successfully";
						//if insert is successful then upload secondary images
						if($stat == true)
						{
								$id = $this->db->insert_id();
								$uploadImgData = NULL;
								$img = count($_FILES['c_sec_image']['name']);

								//check whether secondary image field contains any value or not
								if($img > 0 && $_FILES['c_sec_image']['name'][0] != "")
								{
										$rr = NULL;
										for($i = 0; $i < $img; $i++)
										{
												$_FILES['file']['name']       = $_FILES['c_sec_image']['name'][$i];
												$_FILES['file']['type']       = $_FILES['c_sec_image']['type'][$i];
												$_FILES['file']['tmp_name']   = $_FILES['c_sec_image']['tmp_name'][$i];
												$_FILES['file']['error']      = $_FILES['c_sec_image']['error'][$i];
												$_FILES['file']['size']       = $_FILES['c_sec_image']['size'][$i];

												//$this->load->library('upload', $config);

												// Upload file to server
												if($this->upload->do_upload('file')){
														// Uploaded file data
														$imageData = $this->upload->data();
														$uploadImgData[$i]['product_id'] = $id;
														$uploadImgData[$i]['other_image'] = $imageData['file_name'];
														if($this->upload->display_errors() == "")
																$mag['error_msg'] = $rr++." files unable to upload due to image size greater than 2 MB.";
												}
										}
										$v = $this->pm->add_image($uploadImgData);
										if($v == true)
										{
											redirect('product/');
										}
										else
										{
											$mag['error_msg'] = "Error uploading other images. please try after sometime";
											redirect('product/');
										}
								}
								//if secondary image doesn't have any value then redirect to page
								else
								{
									redirect('product/');
								}
						}
						else {
								$mag['msg'] = 'Error while inserting try again';
								$this->parser->parse('add_product',$mag);
						}
				}
		}
		else 
		{
				$data['cat'] = $this->pm->get_category();
				$this->parser->parse('add_product', $data);
		}
	}
	public function cat_check($str)
	{
		if(!$this->ss->email)
			redirect('login/');
		$cat = array('category' => $str);
		if( ! $this->pm->get_category_where($cat))
		{
				$this->fv->set_message('cat_check', 'The {field} field must have valid category from the list');
				return FALSE;
		}
		else
		{
				return TRUE;
		}
	}
	public function update_product_form($val)
	{
		if(!$this->ss->email)
			redirect('login/');
		$sel = substr($this->ss->email, 0, 9);
		$wh = array('seller_id' => $sel, 'product_id' => $val);
		$data['product'] = $this->pm->upload_product_check($wh);
		
		//if product is not uploaded by user then redirect to other page(ERROR 404)
		if(count($data['product']) === 0)
		{
				redirect('./product/');
		}

		//else open update form
		else 
		{
				$data['cat'] = $this->pm->get_category();
				$this->parser->parse('update_product', $data);
		}
	}
	public function update_product($id)
	{
		if(!$this->ss->email)
			redirect('login/');
		//$this->parser->parse('update_product', $data);
		$this->fv->set_rules('u_name', 'Product Name', 'trim|required');
		$this->fv->set_rules('u_description', 'Description', 'trim|required');
		$this->fv->set_rules('u_price', 'Price', 'trim|required|numeric');
		$this->fv->set_rules('u_is_negotiable', 'Negotiable', 'trim|required|less_than[2]|greater_than[-1]');
		$this->fv->set_rules('u_return_window', 'Return Window', 'trim|required|less_than[8]|greater_than[-1]');
		if($this->fv->run() == true)
		{
				$where = array('product_id' => $id);
				$upd = NULL;
				$upd = [
						'name' => $this->input->post('u_name'),
						'description' => $this->input->post('u_description'),
						'price' => $this->input->post('u_price'),
						'return_window' => $this->input->post('u_return_window'),
						'is_negotiable' => $this->input->post('u_is_negotiable')
				];
				$this->pm->update_product_m($upd,$where);
				$config['upload_path'] = './asset/user/img/product/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '0';
				$config['max_height'] = '0';
				$config['encrypt_name'] = TRUE;
				$config['detect_mime'] = TRUE;

				//IMAGE UPLOAD and library calling
				$this->load->library('upload', $config);
				if($_FILES['u_main_image']['name'] != '')
				{
						$img = $this->upload->do_upload('u_main_image');

						if ($img == FALSE)
						{
								$data['error'] = $this->upload->display_errors();
								$this->parser->parse('update_product', $data);
						}
						else 
						{
								// $this->load->helper('file');
								// $image_del = $this->pm->get_main_image($id);
								// $path = base_url('/assets/user/img/product/'.$image_del[0]->main_image);
								// echo $path;
								// delete_files($path)or die("UNABLE");
								// unlink(realpath($image_del[0]->main_image))or die("DEL NAI KIYA");
								$img = $this->upload->data();
								$upd = [
										'main_image' => $img['file_name']
								];
								$this->pm->update_product_m($upd,$where);
						}   
				}
				if(count($_FILES['u_sec_image']['name']) > 0 && $_FILES['u_sec_image']['name'][0] != "")
				{
						//$config = NULL;
						$uploadImgData = NULL;
						$img = count($_FILES['u_sec_image']['name']);

						$rr = NULL;
						for($i = 0; $i < $img; $i++)
						{
								$_FILES['file']['name']       = $_FILES['u_sec_image']['name'][$i];
								$_FILES['file']['type']       = $_FILES['u_sec_image']['type'][$i];
								$_FILES['file']['tmp_name']   = $_FILES['u_sec_image']['tmp_name'][$i];
								$_FILES['file']['error']      = $_FILES['u_sec_image']['error'][$i];
								$_FILES['file']['size']       = $_FILES['u_sec_image']['size'][$i];

								// $this->load->library('upload', $config);

								// Upload file to server
								if($this->upload->do_upload('file')){
										// Uploaded file data
										$imageData = $this->upload->data();
										$uploadImgData[$i]['product_id'] = $id;
										$uploadImgData[$i]['other_image'] = $imageData['file_name'];
										if($this->upload->display_errors() != "")
										{
												$mag['error_msg'] = $rr++." files unable to upload due to image size greater than 2 MB.";
										}
								}
						}

						$secondary_image = $this->pm->get_secondary_image(array('product_id' => $id));
						if($secondary_image != NULL)
						{
								$succ = $this->pm->delete_secondary_image(array('product_id' => $id));
						}
						$v = $this->pm->add_image($uploadImgData);
				}
				redirect('./product/update_product_form/'.$id);
		}
		else {
				$sel = substr($this->ss->email, 0, 9);
				$wh = array('seller_id' => $sel, 'product_id' => $id);
				$data['product'] = $this->pm->upload_product_check($wh);
				$data['cat'] = $this->pm->get_category();
				$this->parser->parse('update_product', $data);
		}
	}
	public function availablity($id)
	{
		if(!$this->ss->email)
			redirect('login/');
		$this->load->helper('date');
		$expiry_date = now() + (60*60*24*90);
		$dt = date("Y-m-d H:m:s", $expiry_date);

		$upd = array('expiry_date' => $dt);
		$this->pm->update_product_m($upd, array('product_id' => $id));
		redirect("./product/");
	}





}
