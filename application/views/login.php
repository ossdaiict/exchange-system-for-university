<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
	$this->load->view('common/menu'); 
	//$this->load->view('common/banner');
?>
<?php
  if(isset($msg))
  {
?>
    <script>
      alert("<?=$msg?>");
    </script>
<?php
  }
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
                <h4>Login</h4>
                 <form action="<?=site_url('login/do_login')?>" method="POST" class="aa-login-form">
                  <label for="">DA Student ID<span>*</span></label>
                  <input name="r_user_id" type="text" placeholder="201xxxxxx" value="<?=set_value('r_user_id');?>" required autofocus>
                  <?=form_error('r_user_id');?>
                   <label for="">Password<span>*</span></label>
                    <input name="r_password" type="password" placeholder="Password">
                    <?=form_error('r_password');?>
                    <?=isset($error)?$error:''?>
                    </br>
                    <button type="submit" formaction="<?=site_url('login/do_login')?>" class="aa-browse-btn">Login</button>
                    <button type="submit" formaction="<?=site_url('login/lost_password')?>" class="aa-browse-btn pull-right">Reset Password</button>
                    </br>
                    </br>
                    <p class="aa-lost-password">Don't have an account?<a href="<?=site_url('register/')?>"> Register now!</a></p>
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