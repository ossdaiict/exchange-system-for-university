<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
	$this->load->view('common/menu'); 
	//$this->load->view('common/banner');
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
                <h4>Upload Product</h4>
                <?php if(isset($msg)) { echo $msg."<br>"; }
                if(isset($error_msg)) { echo $error_msg."<br>"; }
                ?>
                 <form action="<?=site_url('Product2/add_product')?>" method="POST" class="aa-login-form" enctype="multipart/form-data">
                  <label for="">Product Name<span>*</span></label>
                  <input name="c_name" type="text" placeholder="iPhone Xs" value="<?=set_value('c_name');?>" required autofocus>
                  <?=form_error('c_name');?>

                  <label for="">Description<span>*</span></label>
                  <textarea name="c_description" class="form-control" value="<?=set_value('c_description')?>" placeholder="A Good description might help you to sell your product" required><?=set_value('c_description')?></textarea>
                  <?=form_error('c_description');?>

                  <label for="">Price<span>*</span></label>
                    <input name="c_price" type="text" placeholder="Rs. 123" value="<?=set_value('c_price')?>" required>
                    <?=form_error('c_price');?>

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

                    <label for="">Image<span>*</span></label><input type="file" name="c_main_image" accept="image/*" class="form-control" style="width:100%" required>
                      <?=form_error('c_main_image');?>
                      <?php if(isset($error)) { echo $error; }?>
                      <br>
                    <label for="">Secondary Images</label><input type="file" name="c_sec_image[]" multiple="multiple" accept="image/*" class="form-control" style="width:100%">
                      <?php if(isset($error)) { echo $error; }?>
                      <br>
                    <button type="submit" class="aa-browse-btn">Upload Product</button>
                  </form>
                </div>
              </div>
            </div>          
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->
 <?php
	$this->load->view('common/footer');  
	$this->load->view('common/bottom_script');
?>