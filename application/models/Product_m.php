<?php
class Product_m extends CI_Model
{
  public function get_all_product_data2($page_info, $where)
  {
    if(isset($page_info['sort']))
      switch($page_info['sort'])
      {
        case 0: $sort2=0; $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC'; break;
        case 1:	$sort2=1; $sort = 'p.name ASC';         break;
        case 2:	$sort2=2; $sort = 'p.name DESC';        break;
        case 3:	$sort2=3; $sort = 'p.price ASC';  	    break;
        case 4:	$sort2=4; $sort = 'p.price DESC';	      break;
        case 5:	$sort2=5; $sort = 'p.date_added DESC';	break;
        case 6:	$sort2=6; $sort = 'p.date_added ASC';	  break;
      }
    else
    {
      $sort2 = 0;
      $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC';
    }

      $search=(isset($page_info['search']) && $page_info['search']!='' ? $page_info['search'] : 0 );
      $show=(isset($page_info['show']) ? $page_info['show'] : 2 );
      $page_no=(isset($page_info['page_no']) ? $page_info['page_no'] : 1 );

    $this->db
      ->select('p.*, w.wishlist_user_id, t.buyer_id, t.date_sold')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id=".($this->ss->user_id?$this->ss->user_id:0), 'left')
      ->join('transaction t', "p.product_id=t.product_id and t.date_sold!=''", 'left');
    if($where!==false)
      $this->db
        ->where($where);
    
    if($search!==0)
      $this->db
        ->group_start()
        ->like('p.name', $search)
        ->or_like('p.description', $search)
        ->group_end();

    $data2 = $this->db
      ->order_by($sort)
      ->limit($show)
      ->offset(($page_no-1)*$show)
      ->get()
      ->result();
    //die($this->db->last_query());
    return $data2;
  }

  public function get_all_product_count_data2($page_info, $where)
  {
    if(isset($page_info['sort']))
      switch($page_info['sort'])
      {
        case 0: $sort2=0; $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC'; break;
        case 1:	$sort2=1; $sort = 'p.name ASC';         break;
        case 2:	$sort2=2; $sort = 'p.name DESC';        break;
        case 3:	$sort2=3; $sort = 'p.price ASC';  	    break;
        case 4:	$sort2=4; $sort = 'p.price DESC';	      break;
        case 5:	$sort2=5; $sort = 'p.date_added DESC';	break;
        case 6:	$sort2=6; $sort = 'p.date_added ASC';	  break;
      }
    else
    {
      $sort2 = 0;
      $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC';
    }

      $search=(isset($page_info['search']) && $page_info['search']!='' ? $page_info['search'] : 0 );
      $show=(isset($page_info['show']) ? $page_info['show'] : 2 );
      $page_no=(isset($page_info['page_no']) ? $page_info['page_no'] : 1 );


    $this->db
      ->select('count(*) as count')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id=".($this->ss->user_id?$this->ss->user_id:0), 'left')
      ->join('transaction t', "p.product_id=t.product_id and t.date_sold!=''", 'left');
      if($where!==false)
      $this->db
        ->where($where);
      
    if($search!==0)
      $this->db
        ->group_start()
        ->like('p.name', $search)
        ->or_like('p.description', $search)
        ->group_end();

    $datatata =  $this->db
      ->get()
      ->result()[0]->count;

    return [
      'page_no'=>$page_no,
      'search'=>($search===0?'':$search),
      'show'=>$show,
      'sort'=>$sort2,
      'path'=>(isset($page_info['path'])?$page_info['path']:''),
      'total_product'=>$datatata
    ];
  }


















































  // public function get_all_product_data($page_info)
  // {
  //   if(isset($page_info['sort']))
  //     switch($page_info['sort'])
  //     {
  //       case 0: $sort2=0; $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC'; break;
  //       case 1:	$sort2=1; $sort = 'p.name ASC';         break;
  //       case 2:	$sort2=2; $sort = 'p.name DESC';        break;
  //       case 3:	$sort2=3; $sort = 'p.price ASC';  	    break;
  //       case 4:	$sort2=4; $sort = 'p.price DESC';	      break;
  //       case 5:	$sort2=5; $sort = 'p.date_added DESC';	break;
  //       case 6:	$sort2=6; $sort = 'p.date_added ASC';	  break;
  //     }
  //   else
  //   {
  //     $sort2=0;
  //     $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC';        
  //   }

  //     $search=(isset($page_info['search']) && $page_info['search']!='' ? $page_info['search'] : 0 );
  //     $show=(isset($page_info['show']) ? $page_info['show'] : 2 );
  //     $page_no=(isset($page_info['page_no']) ? $page_info['page_no'] : 1 );

  //   $this->db
  //     ->select('p.*, w.wishlist_user_id')
  //     ->from('product p')
  //     ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id=".($this->ss->user_id?$this->ss->user_id:0), 'left')
  //     ->where([
  //               'p.report_status < '  => 2,
  //               'p.product_status < ' => 3,
  //               'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0)
  //       ]);
      
  //   if($search!==0)
  //     $this->db
  //       ->group_start()
  //       ->like('p.name', $search)
  //       ->or_like('p.description', $search)
  //       ->group_end();

  //   $data2 = $this->db
  //     ->order_by($sort)
  //     ->limit($show)
  //     ->offset(($page_no-1)*$show)
  //     ->get()
  //     ->result();
  //   //die($this->db->last_query());
  //   return $data2;
  // }

  // public function get_all_product_count_data($page_info)
  // {
  //   if(isset($page_info['sort']))
  //     switch($page_info['sort'])
  //     {
  //       case 0: $sort2=0; $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC'; break;
  //       case 1:	$sort2=1; $sort = 'p.name ASC';         break;
  //       case 2:	$sort2=2; $sort = 'p.name DESC';        break;
  //       case 3:	$sort2=3; $sort = 'p.price ASC';  	    break;
  //       case 4:	$sort2=4; $sort = 'p.price DESC';	      break;
  //       case 5:	$sort2=5; $sort = 'p.date_added DESC';	break;
  //       case 6:	$sort2=6; $sort = 'p.date_added ASC';	  break;
  //     }
  //     else
  //     {
  //       $sort2=0;
  //       $sort = 'p.report_status ASC, p.product_status ASC, p.date_added DESC';        
  //     }

  //     $search=(isset($page_info['search']) && $page_info['search']!='' ? $page_info['search'] : 0 );
  //     $show=(isset($page_info['show']) ? $page_info['show'] : 2 );
  //     $page_no=(isset($page_info['page_no']) ? $page_info['page_no'] : 1 );


  //   $this->db
  //     ->select('count(*) as count')
  //     ->from('product p')
  //     ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id=".($this->ss->user_id?$this->ss->user_id:0), 'left')
  //     ->where([
  //               'p.report_status < '  => 2,
  //               'p.product_status < ' => 3,
  //               'p.seller_id != '     => ($this->ss->user_id?$this->ss->user_id:0)
  //       ]);
      
  //   if($search!==0)
  //     $this->db
  //       ->group_start()
  //       ->like('p.name', $search)
  //       ->or_like('p.description', $search)
  //       ->group_end();

  //   $datatata =  $this->db
  //     ->get()
  //     ->result()[0]->count;

  //   return [
  //     'page_no'=>$page_no,
  //     'search'=>($search===0?'':$search),
  //     'show'=>$show,
  //     'sort'=>$sort2,
  //     'total_product'=>$datatata
  //   ];
  // }

  // public function get_all_product_data($logged_in_user_id, $status)
  // {
  //   $data = $this->db
  //     ->select('p.*, w.wishlist_user_id')
  //     ->from('product p')
  //     ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
  //     ->where('p.report_status !=', 2)
  //     ->where('p.product_status !=', 3)
  //     //what about sold product
  //     ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC')
  //     ->get()
  //     ->result();
  //   return $data;
  // }

  public function delete_product_data($id)
  {
    $this->db->delete('product', ['product_id'=>$id]);
  }


  public function get_all_product_with_x_category_data($logged_in_user_id, $status, $category)
  {
    $data = $this->db
      ->select('p.*, w.wishlist_user_id')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
      ->where('p.report_status !=', 2)
      ->where('p.product_status !=', 3)
      ->where('p.category', $category)
      //what about sold product
      ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC')
      ->get()
      ->result();

    return $data;
  }

  public function get_product_data($logged_in_user_id, $id=false)
  {
    $data = $this->db
      ->select('p.*, w.wishlist_user_id, t.buyer_id, t.final_price, t.date_sold, ur.rating')
      ->from('product p')
      ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
      ->join('transaction t', 'p.product_id=t.product_id', 'left')
      ->join('user_review ur', 'p.product_id=ur.product_id', 'left')
      ->where("p.product_id={$id} and ((p.seller_id = {$logged_in_user_id} or t.buyer_id=$logged_in_user_id) or (p.report_status < 2 and p.product_status < 3))")
      //->where(['seller_id'=>$logged_in_user_id,'buyer_id'=>$logged_in_user_id, 'report_status < '=>2, 'product_status < '=>3])
      ->get()
      ->result();
    //die($this->db->last_query());
    $data2 = $this->db
      ->select('count(product_id) AS wishlist_count')
      ->where(['product_id'=>$id])
      ->group_by('product_id')
      ->get('wishlist')
      ->result();

    if(count($data) > 0)
      $data[0]->wishlist_count=((count($data2) > 0 ) ? ($data2[0]->wishlist_count) : (0) );

    return $data;
  }

  public function get_product_image_data($id)
  {
    return $this->db
      ->where(['product_id'=>$id])
      ->get('product_image')
      ->result();
  }

  public function get_wishlist_data($where)
  {
    return $this->db
      ->where($where)
      ->get('wishlist')
      ->result();
  }

  public function get_wishlist_user_data($where)
  {
    return $this->db
      ->select('w.*, u.name')
      ->from('wishlist w')
      ->join('user u', 'u.user_id=w.wishlist_user_id')
      ->where($where)
      ->get()
      ->result();
  }

  public function delete_wishlist_data($data)
  {
    $this->db->delete('wishlist', $data);
    return $this->db->affected_rows();
  } 

  public function set_wishlist_data($data)
  {
    $this->db->insert('wishlist', $data);
    return $this->db->affected_rows();
  }

  public function set_transaction_data($data)
  {
    $this->db->insert('transaction', $data);
    return $this->db->affected_rows();
  }

  public function update_product_data($where, $data)
  {
    $this->db
      ->set($data)
      ->where($where)
      ->update('product');
  }

  public function update_transaction_with_current_date_data($where)
  {
    $this->db
      ->set('date_sold', 'CURRENT_TIMESTAMP', FALSE)
      ->where($where)
      ->update('transaction');
  }

  public function delete_transaction_data($where)
  {
    $this->db
      ->where($where)
      ->delete('transaction');
  }

  public function get_seller_review_data($id)
  {
    return $this->db
    ->select('u.name, u.photo, ur.rating, ur.rating, ur.review, ur.date_added')
    ->from('product p')
    ->join('user_review ur', 'p.product_id=ur.product_id')
    ->join('user u', 'ur.buyer_id=u.user_id')
    ->where(['p.seller_id'=>$id])
    ->get()
    ->result();
    //die($this->db->last_query());
  }

  public function add_revier_data($data)
  {
    $this->db->insert('user_review', $data);
  }

  public function set_report_data($data)
  {
    $this->db->insert('product_report', $data);
  }

  public function get_report_data($id)
  {
    return $this->db
      ->select('count(product_id) as count')
      ->where(['product_id'=>$id])
      ->get('product_report')
      ->result()[0]
      ->count;
  }

  public function get_product_report_data($logged_in_user_id, $pid)
  {
    return $this->db
      ->select('count(product_id) as count')
      ->where(['product_id'=>$pid, 'reporter_id'=>$logged_in_user_id])
      ->get('product_report')
      ->result()[0]->count;
  }

  public function get_all_category_data()
  {
    return $this->db
      ->get('category')
      ->result();
  }

  // public function get_product_search_data($logged_in_user_id, $status, $match)
  // {
  //   $data = $this->db
  //     ->select('p.*, w.wishlist_user_id')
  //     ->from('product p')
  //     ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
  //     ->where('p.report_status !=', 2)
  //     ->where('p.product_status !=', 3)
  //     ->like('p.name', $match)
  //     ->or_like('p.description', $match)
  //     //what about sold product
  //     ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC')
  //     ->get()
  //     ->result();


  //     //add paging
      
  //   // $data = $this->db
  //   //   ->select('p.*, w.wishlist_user_id, count(w2.product_id) AS wishlist_count')
  //   //   ->from('product p')
  //   //   ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
  //   //   ->join('wishlist w2', 'p.product_id=w2.product_id', 'left')
  //   //   ->where(['p.product_status'=>$status]) //bring all product !!!!
  //   //   ->group_by('w2.product_id')
  //   //   ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC')
  //   //   ->get()
  //   //   ->result();


  //   return $data;
  // }

  // public function get_product_sort_data($logged_in_user_id, $status, $sort, $direction)
  // {
  //   $data = $this->db
  //     ->select('p.*, w.wishlist_user_id')
  //     ->from('product p')
  //     ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
  //     ->where('p.report_status !=', 2)
  //     ->where('p.product_status !=', 3)
  //     //what about sold product
  //     ->order_by('p.'.$sort, $direction)
  //     ->get()
  //     ->result();


  //     //add paging
      
  //   // $data = $this->db
  //   //   ->select('p.*, w.wishlist_user_id, count(w2.product_id) AS wishlist_count')
  //   //   ->from('product p')
  //   //   ->join('wishlist w', "p.product_id=w.product_id and w.wishlist_user_id={$logged_in_user_id}", 'left')
  //   //   ->join('wishlist w2', 'p.product_id=w2.product_id', 'left')
  //   //   ->where(['p.product_status'=>$status]) //bring all product !!!!
  //   //   ->group_by('w2.product_id')
  //   //   ->order_by('p.report_status, p.product_status','ASC' ,'p.date_added', 'DESC')
  //   //   ->get()
  //   //   ->result();


  //   return $data;
  // }
  
  public function get_seller_data($seller_id)
  {
    return $this->db
      ->select('name, contact_no, email')
      ->where(['user_id'=>$seller_id])
      ->get('user')
      ->result();
  }
















































































  public function get_category()
  {
      return $this->db->get('category')->result();
  }
  public function get_category_where($cat)
  {
      return $this->db->get_where('category', $cat)->result();
  }
  public function get_status($user)
  {
      return $this->db->get_where('product', $user)->result();
  }
  public function add_product($ins)
  {
      $this->db
          ->insert('product', $ins);
      return $this->db->affected_rows() != 1 ? false : true;
  }
  public function add_image($img = array())
  {
      return $this->db
          ->insert_batch('product_image', $img);
      // return $this->db->affected_rows() < 0 ? false : true;
  }
  public function upload_product_check($where)
  {
      return $this->db->get_where('product', $where)->result();
  }
  public function update_product_m($upd, $wh)
  {
      $this->db->where($wh)->update('product', $upd);
  }
  public function get_main_image($id)
  {
      return $this->db->select('main_image')
              ->get_where('product', array('product_id' => $id))
              ->result();
  }
  public function get_secondary_image($where)
  {
      return $this->db->select('other_image')
              ->get_where('product_image', $where)
              ->result();
  }
  public function delete_secondary_image($id)
  {
      return $this->db->where($id)
              ->delete('product_image');
  }



}
