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
                <h4>Register</h4>
                 <form action="<?=site_url('register/do_register')?>" method="POST" class="aa-login-form">
                  <label for="">DA Student ID<span>*</span></label>
                  <input name="c_user_id" type="text" placeholder="201xxxxxx" value="<?=set_value('c_user_id');?>" required autofocus>
                  <?=form_error('c_user_id');?>

                  <label for="">Name<span>*</span></label>
                  <input name="c_name" type="text" placeholder="John Doe" value="<?=set_value('c_name');?>" required>
                  <?=form_error('c_name');?>

                  <label for="">Contact No<span>*</span></label>
                    <input name="c_contact_no" type="password" placeholder="9879xxxxxx" required>
                    <?=form_error('c_contact_no');?>

                  <label for="">Password<span>*</span></label>
                    <input name="c_password" type="password" placeholder="Password" required>
                    <?=form_error('c_password');?>

                    <label class="rememberme" for="rememberme"><input name="c_agreement" type="checkbox" value="1" id="rememberme" required>
                      <a href="<?=site_url('agreement/')?>">I have read and agree to T&C ?</a>
                      <?=form_error('c_agreement');?>

                    </label>
                    <p class="aa-lost-password"><a href="<?=site_url('login/')?>">Have an Account ?</a></p>

                    <?=isset($msg)?$msg:''?>
                    <button type="submit" class="aa-browse-btn">Register</button>
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