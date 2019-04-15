  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>          
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <ul class="nav navbar-nav">
            <li><a href="<?=site_url('profile/');?>">My Account</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/add_product_form');?>">Add product</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/');?>">Product List</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/wishlist');?>">Wishlist</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/bought_list');?>">Bought Items</a></li>
                  <li class="hidden-xs"><a href="<?=site_url('product/seller_list');?>">Seller Items</a></li>
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
          </div><!--/.nav-collapse -->
        </div>
      </div> 
      </div>
    </div>
  </section>
  <!-- / menu -->  