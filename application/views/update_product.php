<?php //echo '<pre>';print_r($product[0]); die(); ?>
<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
	$this->load->view('common/menu'); 
	//$this->load->view('common/banner');
?>
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="aa-myaccount-login">
                <h4>Update Product</h4>
                <?php if(isset($msg)) { echo $msg."<br>"; }
                if(isset($error)) { echo $error."<br>"; }
                ?>
                 <form action="<?=site_url('Product2/update_product/'.$product[0]->product_id)?>" method="POST" class="aa-login-form" enctype="multipart/form-data">
                  <label for="">Product Name<span>*</span></label>
                  <input name="u_name" type="text" placeholder="iPhone Xs" value="<?=$product[0]->name?>" required autofocus>
                  <?=form_error('u_name');?>

                  <label for="">Description<span>*</span></label>
                  <textarea name="u_description" class="form-control" placeholder="A Good description might help you to sell your product" required><?=$product[0]->description?></textarea>
                  <?=form_error('u_description');?>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">Price<span>*</span></label>
                        <input name="u_price" type="text" placeholder="Rs. 123" value="<?=$product[0]->price?>" required>
                        <?=form_error('c_price');?>
                    </div>
                    <div class="col-md-6">
                      <label for="">Is Price Negotiable?<span>*</span></label><br>
                            <input name="u_is_negotiable" type="radio" value="0" class="radio-inline" <?php if($product[0]->is_negotiable == 0) { echo "checked"; } ?> required> Yes 
                            <input name="u_is_negotiable" type="radio" value="1" class="radio-inline" <?php if($product[0]->is_negotiable == 1) { echo "checked"; } ?> required> No
                            <br>
                            <?=form_error('u_is_negotiable');?>
                            <br>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-6">
                            <label for="">Category<span>*</span></label>
                            <select name="u_category" id="" disabled class="form-control">
                                <option value="0" selected>Select Category</option>
                                <?php
                                    foreach($cat as $c)
                                    {
                                ?>
                                <option value="<?=$c->category?>" <?php if($product[0]->category == $c->category) { echo "selected"; } ?>><?=$c->category?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <?=form_error('u_category');?>
                            <br>
                      </div>
                      <div class="col-md-6">
                            <label for="">Return Window<span>*</span></label><br>
                            <select name="u_return_window" class="form-control" id="">
                              <option value="" disabled><?php echo $product[0]->return_window; ?></option>
                              <option value="0" <?php if($product[0]->return_window == 0) { echo "selected"; } ?>>No Return</option>
                              <?php for($i = 1; $i <= 7; $i++) 
                              { ?>
                                <option value="<?=$i?>" <?php if($product[0]->return_window==$i) { echo 'selected'; } ?> ><?=$i?> Days</option>
                              <?php } ?>
                              <?php echo $product[0]->return_window; ?>
                            </select>
                            <?=form_error('u_return_window');?>
                            <br>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                          <label for="">Image<span>*</span>(your previous image will be deleted)</label><br>
                          <span class="btn btn-file btn-default btn-block"><input type="file" name="u_main_image" accept="image/*" class="btn-default" style="width:100%"/></span>
                            <?=form_error('u_main_image');?>
                            <?php if(isset($error)) { echo $error; }?>
                            <br>
                      </div>
                      <div class="col-md-6">
                          <label for="">Secondary Images (your previous image will be deleted)</label>
                          <span class="btn btn-file btn-default btn-block"><input type="file" name="u_sec_image[]" multiple="multiple" accept="image/*" class="btn-default" style="width:100%"></span>
                            <?php if(isset($error)) { echo $error; }?>
                            <br>
                      </div>
                      <input type="hidden" name="u_product_id" value="<?=$product[0]->product_id?>">
                    </div>
                    <button type="submit" class="aa-browse-btn">Update Product</button>
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
<?php
	$this->load->view('common/footer');  
	$this->load->view('common/bottom_script');
?>