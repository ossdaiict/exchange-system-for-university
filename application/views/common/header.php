<?php
  $path_prefix=base_url('asset/user/');
?>
<!-- Start header section -->
  <header id="aa-header">
    <!-- start header top  -->
    <!-- <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  <li><a href="<?=site_url('profile/');?>">My Account</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/add_product_form');?>">Add product</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/wishlist');?>">Wishlist</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/bought');?>">Bought Items</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/seller');?>">Seller Items</a></li>
                  <li>
<?php
                      if($this->ss->email)
                      {
?>                      <a href="<?=site_url('logout/')?>">Logout</a>
<?php                 }
                      else
                      {
?>                      <a href="" data-toggle="modal" data-target="#login-modal">Login</a>
<?php                 }
?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <!-- / header top  -->

    <!-- start header bottom  -->
    <div class="aa-header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-bottom-area">
              <!-- logo  -->
              <div class="aa-logo">
                <!-- Text based logo -->
                <a href="index.html">
                  <span class="fa fa-shopping-cart"></span>
                  <p>daily<strong>Shop</strong> <span>Your Shopping Partner</span></p>
                </a>
                <!-- img based logo -->
                <!-- <a href="index.html"><img src="<?=$path_prefix?>img/logo.jpg" alt="logo img"></a> -->
              </div>
              <!-- / logo  -->
               <!-- cart box -->

              <!-- / cart box -->
              <!-- search box -->
              <div class="aa-search-box">
                <form action="<?=site_url('product/search');?>" method="POST">
                  <input type="text" name="r_search" id="" placeholder="e.g., Discrete Mathematics " value="<?=(isset($page_info['search'])?$page_info['search']:'')?>">
                  <button type="submit"><span class="fa fa-search"></span></button>
                </form>
              </div>
              <!-- / search box -->             
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->

    <!-- Login Modal -->  
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">                      
        <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4>Login or Register</h4>
          <form action="<?=site_url('login/do_login')?>" method="POST" class="aa-login-form">
            <label for="">DA Student ID<span>*</span></label>
            <input name="r_user_id" type="text" placeholder="201xxxxxx" value="<?=set_value('r_user_id');?>" required>
            <?=form_error('r_user_id');?>
              <label for="">Password<span>*</span></label>
              <input name="r_password" type="password" placeholder="Password" required>
              <?=form_error('r_password');?>
              <?=isset($error)?$error:''?>
              <button type="submit" class="aa-browse-btn">Login</button>
              <label class="rememberme" for="rememberme"><input type="checkbox" id="rememberme"> Remember me </label>
              <p class="aa-lost-password"><a href="#">Lost your password?</a></p>
              <div class="aa-register-now">
                Don't have an account?<a href="<?=site_url('register')?>">Register now!</a>
              </div>
            </form>
          </div>                        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>