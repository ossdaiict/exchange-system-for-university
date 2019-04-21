<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
	$this->load->view('common/menu'); 
	//$this->load->view('common/banner');
?>
 <?php
 if(isset($cat))
 {
 ?>
 <!-- Cart view section -->
 <section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-6 col-md-offset-3">
                <div class="aa-myaccount-login">
                <h4>Add Product</h4>
                <?php if(isset($msg)) { echo $msg."<br>"; }
                if(isset($error_msg)) { echo $error_msg."<br>"; }
                ?>
                 <form action="<?=site_url('product/add_product')?>" method="POST" class="aa-login-form" enctype="multipart/form-data">
                  <label for="">Product Name<span>*</span></label>
                  <input name="c_name" type="text" placeholder="iPhone Xs" value="<?=set_value('c_name');?>" required autofocus>
                  <?=form_error('c_name');?>

                  <label for="">Description<span>*</span></label>
                  <textarea name="c_description" class="form-control" value="<?=set_value('c_description')?>" placeholder="A Good description might help you to sell your product" required><?=set_value('c_description')?></textarea>
                  <?=form_error('c_description');?>
                  <div class="row">
                    <div class="col-md-6">
                      <label for="">Price<span>*</span></label>
                        <input name="c_price" type="text" placeholder="Rs. 123" value="<?=set_value('c_price')?>" required>
                        <?=form_error('c_price');?>
                    </div>
                    <div class="col-md-6">
                      <label for="">Is Price Negotiable?<span>*</span></label><br>
                            <input name="c_is_negotiable" type="radio" value="1" class="radio-inline" <?php if(set_value('c_is_negotiable') == 1) { echo "checked"; } ?> required> Yes 
                            <input name="c_is_negotiable" type="radio" value="0" class="radio-inline" <?php if(set_value('c_is_negotiable') == 0) { echo "checked"; } ?> required> No
                            <br>
                            <?=form_error('c_is_negotiable');?>
                            <br>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-6">
                            <label for="">Category<span>*</span></label>
                            <select name="c_category" id="" class="form-control" required>
                                <option value="0" disabled selected>Select Category</option>
                                <?php
                                    foreach($cat as $c)
                                    {
                                ?>
                                <option value="<?=$c->category?>" <?php if(set_value('c_category') == $c->category) { echo "selected"; } ?>><?=$c->category?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <?=form_error('c_category');?>
                            <br>
                      </div>
                      <div class="col-md-6">
                            <label for="">Return Window<span>*</span></label><br>
                            <select name="c_return_window" class="form-control" id="">
                              <option value="" disabled selected>Select Return Type</option>
                              <option value="0">No Return</option>
                              <?php for($i = 1; $i <= 7; $i++) { ?>
                              <option value="<?=$i?>"><?=$i?> Days</option>
                              <?php } ?>
                            </select>
                            <?=form_error('c_return_window');?>
                            <br>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                          <label for="">Image<span>*</span></label><br>
                          <span class="btn btn-file btn-default btn-block"><input type="file" name="c_main_image" accept="image/*" class="btn-default" style="width:100%" required/></span>
                            <?=form_error('c_main_image');?>
                            <?php if(isset($error)) { echo $error; }?>
                            <br>
                      </div>
                      <div class="col-md-6">
                          <label for="">Secondary Images</label>
                          <span class="btn btn-file btn-default btn-block"><input type="file" name="c_sec_image[]" multiple="multiple" accept="image/*" class="btn-default" style="width:100%"></span>
                            <?php if(isset($error)) { echo $error; }?>
                            <br>
                      </div>
                    </div>
                    <button type="submit" class="aa-browse-btn">Add Product</button>
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
 }
 else {
?>
<section id="aa-myaccount">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
        <div class="aa-myaccount-area">         
            <div class="row">
              <div class="col-md-12">
                <div class="aa-myaccount-login">
                  <h4>Report Status</h4>
                  <h5 class="text-danger">You are seeing this because you have 1 or more products that needs some update like change in status or deleting it or marking as available</h5>
                  <h5 class="text-danger">once you update those product's information you will be able to add new product</h5>
                  <table class="table table-responsive table-hover table-striped">
                    <tr>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Description</th>
                      <th width="10%">Operation</th>
                    </tr>
                    <?php
                    for($i = 0; $i < count($past); $i++)
                    {
                    ?>
                    <tr>
                      <td><?=$past[$i]->name?></td>
                      <td><?=$past[$i]->category?></td>
                      <td><?=$past[$i]->price?></td>
                      <td><?=$past[$i]->description?></td>
                      <td style="white-space: nowrap;">
                        <a href="<?=base_url('product/availablity/'.$past[$i]->product_id)?>" class="btn btn-success">Mark as Available</a> &nbsp;
                        <a href="<?=base_url("product/".$past[$i]->product_id)?>" class="btn btn-warning">Product Detail</a>
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
</section>
<?php
 }
?>
 <!-- / Cart view section -->
 <?php
	$this->load->view('common/footer');  
	$this->load->view('common/bottom_script');
?>
