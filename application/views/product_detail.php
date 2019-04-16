<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
	$this->load->view('common/menu'); 
	//$this->load->view('common/banner');
?>
<style>
  .star-rating {
    line-height:32px;
    font-size:1.25em;
  }

  .star-rating .fa-star{color: #ff6600;}
  .star-rating .fa-star-o{color: #ff6600;}
</style>

  <!-- product category -->
  <section id="aa-product-details">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-product-details-area">
            <div class="aa-product-details-content">
              <div class="row">
                <!-- Modal view slider -->
                <div class="col-md-5 col-sm-5 col-xs-12">                              
                  <div class="aa-product-view-slider">                                
                    <div id="demo-1" class="simpleLens-gallery-container">
                      <div class="simpleLens-container">
                        <div class="simpleLens-big-image-container"><a data-lens-image="<?=$path_prefix;?>img/product/{main_image}" class="simpleLens-lens-image"><img src="<?=$path_prefix;?>img/product/{main_image}" class="simpleLens-big-image"></a></div>
                      </div>
                      <div class="simpleLens-thumbnails-container">
                        <a data-big-image="<?=$path_prefix;?>img/product/{main_image}" data-lens-image="<?=$path_prefix;?>img/product/{main_image}" class="simpleLens-thumbnail-wrapper" href="#">
                          <img src="<?=$path_prefix;?>img/product/{main_image}" style="height:50px;width:50px;">
                        </a>
<?php
                          foreach($product_image as $oi)
                          {
?>
                            <a data-big-image="<?=$path_prefix;?>img/product/<?=$oi->other_image;?>" data-lens-image="<?=$path_prefix;?>img/product/<?=$oi->other_image;?>" class="simpleLens-thumbnail-wrapper" href="#">
                              <img src="<?=$path_prefix;?>img/product/<?=$oi->other_image;?>" style="height:50px;width:50px;">
                            </a>

<?php
                          }
?>


                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal view content -->
                <div class="col-md-7 col-sm-7 col-xs-12">
                  <div class="aa-product-view-content">
                    <h3>{name}</h3>
                    <?php
                      if($product_status!=3)
                        if($report_status==1)
                          echo '<p style="color:red;">Alert : Product is reported by someone, check before buying.</p>';
                        elseif($report_status==2)
                          echo '<p style="color:red;">Alert : Product blocked from display due to enough reports.</p>';
                    ?>

                    <div class="aa-price-block">
                      <p>Price : {price}</p>
                    </div>
                    <p>Description : {description}</p>
                    <div class="aa-prod-quantity">
                      Category : <?=$category?>
                    </div>
                    <div class="aa-prod-view-bottom" style="border:none;">

                    <?php
					echo '<p>'.$return_window.' Day return window.</p>';
					echo ($is_negotiable==1?"<p>Price is Negotiable</p>":"");
					echo ($wishlist_count>0?"<p>".$wishlist_count." student(s) wishlisted this item</p>":"");
		if($product_status!=3) //unsold
		{
			if($this->ss->user_id==$seller_id) //seller
			{
				if($product_status==0) //available
				{
?>
          <a class="aa-add-to-cart-btn" href="<?=site_url('product/update_product_form/'.$product_id)?>">Update Product</a>
          <a  class="aa-add-to-cart-btn" href="<?=base_url('product/delete/'.$product_id);?>">Delete Product</a>
<?php
					if($wishlist_count>0)
          {
?>
            <div class="row">
            <form action="<?=site_url('product/mark_as_sold/'.$product_id)?>" method="POST" class="form-group" style="margin-top:10px">
<?php
              if($seller_id==$this->ss->user_id)
              {
?>
                <div class="col-md-4">
                <select name="c_buyer_id" class="form-control input-lg">
<?php
                  foreach($wishlist_data as $wd)
                  {
?>
                    <option value="<?=$wd->wishlist_user_id?>"><?=$wd->name?></option>
<?php
                  }
?>
                </select>
                </div>
<?php
              }
?>






                <div class="col-md-4">
                <input name="c_final_price" class="form-control input-lg" type="text" placeholder="Final price">
                </div>
                <div class="col-md-4">
                <input class="aa-add-to-cart-btn" style="background-color:white;" type="submit" value="Mark as Sold">
                </div>





            </form>
                </div>
<?php
          }
				}
				else if($product_status==1)
        {
?>
          <form action="<?=site_url('product/answer_popup/'.$product_id)?>" method="POST">
            <p>A user has marked this product as bought with final price of <?=$price?> , please confirm the same !</p> 
            <input type="radio" name="c_confirm" value="no"> NO, i didn't purchase</br>
            <input type="radio" name="c_confirm" value="yes"> YES, i did</br>
            <button type="submit">Confirm</button>
          </form>
<?php 
        }
				else if($product_status==2)
					echo '<p style="color:yellow">Status : Waiting for buyer\'s confirmation</p>';
			}
			else
			{
				if($this->ss->user_id!=$buyer_id && $report_status<2)
				{
					echo '<p style="color:green">Status : Available</p>';          
?>
          <?=$this->ss->user_id==$wishlist_user_id?
          'Seller : '.$seller_data[0]->name.'</br>Contact No: '.$seller_data[0]->contact_no.'</br>Email : '.$seller_data[0]->email.'</br>'
          :
          ''          
          ?>
					<a class="aa-add-to-cart-btn" href="<?=base_url('product/toggle_wishlist/'.$product_id.'/1');?>"><?=$this->ss->user_id!=$wishlist_user_id?'+ wishlist':'- wishlist'?></a>
<?php
          if($has_reported==0 && $this->ss->user_id!=$seller_id)
          {
?>
            <button style="background-color:white" type="button" class="aa-add-to-cart-btn" onclick="toggle_report_form();">Report</button>
            <form action="<?=site_url('product/report/'.$product_id);?>" method="POST" id="report_form" style="display:none;" class="form-group row">
              <div class="col-md-12" style="margin-top:15px;">
                <div class="row">
                  <div class="col-md-6">
                  <textarea name="c_reason" class="form-control" id="" cols="20" rows="3" required placeholder="Reason of reporting."></textarea>
                  </div>
                  <div class="col-md-2">
                    <input type="submit" value="Report" class="btn btn-danger pull-right" style="background-color:#ff6666">                          
                  </div>
                </div>
              </div>
            </form>
<?php
          }
?>
<?php
          if($wishlist_user_id==$this->ss->user_id)
          {
            ?>
                <div class="row">
                <form action="<?=site_url('product/mark_as_sold/'.$product_id)?>" class="form-group" style="margin-top:15px;" method="POST">
                <div class="col-md-4">
                <input name="c_final_price" class="form-control input-lg" type="text" placeholder="Final price">
                </div>
                <div class="col-md-4">
                <input class="aa-add-to-cart-btn" style="background-color:white;" type="submit" value="Mark as Bought">
                </div>
                </form>
                </div>

            <?php
          }
				}
				else if($product_status==1)
          echo '<p style="color:yellow">Status : Waiting for seller\'s confirmation</p>';
				else if($product_status==2)
        {
?>
          <form action="<?=site_url('product/answer_popup/'.$product_id)?>" method="POST" class="form-group">
            <p>Seller of this product has marked you as buyer with final price of <?=$price?> for this product, please confirm the same !</p> 
            <input type="radio" name="c_confirm" value="no" class="form-contro"> NO, i didn't purchase</br>
            <input type="radio" name="c_confirm" value="yes" class="form-contrl"> YES, i did</br>
            <button type="submit" class="btn btn-danger" style="background-color:#ff6666">Confirm</button>
          </form>
<?php
        }
			}
		}
		else
		{
			if($this->ss->user_id==$buyer_id)
        echo '<p style="color:green">Status : Bought by you'.($rating===NULL?', please consider reviewing seller</p>':'</p>');
			else if($this->ss->user_id==$seller_id)
        echo '<p style="color:green">Status : Sold</p>';
		}
?>

<script>
  function toggle_report_form()
  {
    //alert("helllllo");
    var report_form = document.getElementById('report_form');
    if(report_form.style.display=='block')
      report_form.style.display='none';
    else
      report_form.style.display='block';
  }
</script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="aa-product-details-bottom">
              <ul class="nav nav-tabs" id="myTab2">
                <li><a href="#review" data-toggle="tab">Reviews</a></li>                
                <!-- <li><a href="#description" data-toggle="tab">Description</a></li> -->
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane fade in active" id="review">
                  <div class="aa-product-review-area">
                    <h4><?=count($seller_review)?> Review(s) on seller</h4> 
                    <ul class="aa-review-nav">
<?php 
                      foreach($seller_review as $sr)
                      {
?>
                        <li>
                          <div class="media">
                            <div class="media-left">
                              <a href="#">
                                <img class="media-object" src="<?=$path_prefix;?>img/user/<?=$sr->photo?>" alt="user image">
                              </a>
                            </div>
                            <div class="media-body">
                              <h4 class="media-heading"><strong><?=$sr->name?></strong> - <span><?=nice_date($sr->date_added,'d-M-Y')?></span></h4>
                              <div class="aa-product-rating">
<?php
                                for($i=0;$i<5;$i++)
                                {
                                  if($i<$sr->rating)
                                  {
?>
                                    <span class="fa fa-star"></span>
<?php
                                  }
                                  else
                                  {
?>
                                    <span class="fa fa-star-o"></span>
<?php
                                  }
                                }
?>
                              </div>
                              <p><?=$sr->review?></p>
                            </div>
                          </div>
                        </li>

<?php
                      }
?>
                      
                    </ul>

<?php
                      if($product_status==3 && $this->ss->user_id==$buyer_id && $rating===NULL)
                      {
?>
                        <h4>Add a review</h4>
                        <form action="<?=site_url('product/add_review/'.$product_id);?>" method="POST" class="aa-review-form" method="POST">
                          <div class="aa-your-rating">
                            <p>Your Rating</p>
                              <div class="star-rating">
                                <span class="fa fa-star-o" data-rating="1"></span>
                                <span class="fa fa-star-o" data-rating="2"></span>
                                <span class="fa fa-star-o" data-rating="3"></span>
                                <span class="fa fa-star-o" data-rating="4"></span>
                                <span class="fa fa-star-o" data-rating="5"></span>
                                <input type="hidden" name="c_rating" class="rating-value" value="0">
                              </div><?=form_error('c_rating');?>
                            </br>
                          </div>
                          <div class="form-group">
                            <label for="message">Your Review for seller</label>
                            <textarea name="c_review" class="form-control" rows="3" id="message"></textarea>
                            <?=form_error('c_review');?>
                          </div>
                          <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                        </form>
<?php
                      }
?>




                 </div>
                </div>
                <!-- <div class="tab-pane fade" id="description">
                  <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                  <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, culpa!</li>
                    <li>Lorem ipsum dolor sit amet.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor qui eius esse!</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, modi!</li>
                  </ul>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum, iusto earum voluptates autem esse molestiae ipsam, atque quam amet similique ducimus aliquid voluptate perferendis, distinctio!</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis ea, voluptas! Aliquam facere quas cumque rerum dolore impedit, dicta ducimus repellat dignissimos, fugiat, minima quaerat necessitatibus? Optio adipisci ab, obcaecati, porro unde accusantium facilis repudiandae.</p>
                </div> -->
              </div>
            </div>
            <!-- Related product -->
            <!-- <div class="aa-product-related-item">
              <h3>Related Products</h3>
              <ul class="aa-product-catg aa-related-item-slider">

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/man/polo-shirt-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>

                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
 
                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/women/girl-2.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>

                   <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/man/t-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                  </figure>
                  <figcaption>
                    <h4 class="aa-product-title"><a href="#">T-Shirt</a></h4>
                    <span class="aa-product-price">$45.50</span>
                  </figcaption>
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>

                   <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/women/girl-3.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                </li>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/man/polo-shirt-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                      
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>
                </li>

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/women/girl-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#">Lorem ipsum doller</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>

                  <span class="aa-badge aa-sold-out" href="#">Sold Out!</span>
                </li>    

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/man/polo-shirt-4.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">Polo T-Shirt</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>
                  </div>

                  <span class="aa-badge aa-hot" href="#">HOT!</span>
                </li> 

                <li>
                  <figure>
                    <a class="aa-product-img" href="#"><img src="<?=$path_prefix;?>img/product/women/girl-1.png" alt="polo shirt img"></a>
                    <a class="aa-add-card-btn"href="#"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                     <figcaption>
                      <h4 class="aa-product-title"><a href="#">This is Title</a></h4>
                      <span class="aa-product-price">$45.50</span><span class="aa-product-price"><del>$65.50</del></span>
                    </figcaption>
                  </figure>                     
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal"><span class="fa fa-search"></span></a>                            
                  </div>

                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>                                                                                   
              </ul>
                                
              <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">                                
                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image="<?=$path_prefix;?>img/product/view-slider/large/polo-shirt-1.png">
                                          <img src="<?=$path_prefix;?>img/product/view-slider/medium/polo-shirt-1.png" class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                              <div class="simpleLens-thumbnails-container">
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="<?=$path_prefix;?>img/product/view-slider/large/polo-shirt-1.png"
                                     data-big-image="<?=$path_prefix;?>img/product/view-slider/medium/polo-shirt-1.png">
                                      <img src="<?=$path_prefix;?>img/product/view-slider/thumbnail/polo-shirt-1.png">
                                  </a>                                    
                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="<?=$path_prefix;?>img/product/view-slider/large/polo-shirt-3.png"
                                     data-big-image="<?=$path_prefix;?>img/product/view-slider/medium/polo-shirt-3.png">
                                      <img src="<?=$path_prefix;?>img/product/view-slider/thumbnail/polo-shirt-3.png">
                                  </a>

                                  <a href="#" class="simpleLens-thumbnail-wrapper"
                                     data-lens-image="<?=$path_prefix;?>img/product/view-slider/large/polo-shirt-4.png"
                                     data-big-image="<?=$path_prefix;?>img/product/view-slider/medium/polo-shirt-4.png">
                                      <img src="<?=$path_prefix;?>img/product/view-slider/thumbnail/polo-shirt-4.png">
                                  </a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3>T-Shirt</h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price">$34.99</span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!</p>
                            <h4>Size</h4>
                            <div class="aa-prod-view-size">
                              <a href="#">S</a>
                              <a href="#">M</a>
                              <a href="#">L</a>
                              <a href="#">XL</a>
                            </div>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">
                                Category: <a href="#">Polo T-Shirt</a>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="#" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="#" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div>
                </div>
              </div>
            </div>   -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / product category -->


  <!-- Subscribe section -->
  <!-- <section id="aa-subscribe">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-subscribe-area">
            <h3>Subscribe our newsletter </h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, velit!</p>
            <form action="" class="aa-subscribe-form">
              <input type="email" name="" id="" placeholder="Enter your Email">
              <input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- / Subscribe section -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
  var $star_rating = $('.star-rating .fa');

  var SetRatingStar = function() {
    return $star_rating.each(function() {
      if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
        return $(this).removeClass('fa-star-o').addClass('fa-star');
      } else {
        return $(this).removeClass('fa-star').addClass('fa-star-o');
      }
    });
  };

  $star_rating.on('click', function() {
    $star_rating.siblings('input.rating-value').val($(this).data('rating'));
    return SetRatingStar();
  });

  SetRatingStar();
  $(document).ready(function() {

  });
</script>

<?php
	$this->load->view('common/footer');  
	$this->load->view('common/bottom_script');
?>