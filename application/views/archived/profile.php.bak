<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
  $this->load->view('common/menu'); 
  
  //$this->load->view('common/banner');
  ?>
  
    <!-- AdminLTE style sheet -->
    <link href="<?=$path_prefix?>css/AdminLTE.css" rel="stylesheet">    
  <section class="container"> 
  <div class="container">
    <div class="row">
   
    <?php 
  foreach ( $user as $new_user )
  {
    ?>
<div class="col-md-8 col-md-offset-2" style="margin-top:50px;">

<!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-light-red ">
              <h3 class="widget-user-username"><?php echo $new_user['name'] ?></h3>
              <h5 class="widget-user-desc"><?php echo $new_user['email'] ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?=$path_prefix?>img/user/<?=$new_user['photo']?>" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $new_user['user_id'] ?></h5>
                    <span class="description-text">UserID</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">13,000</h5>
                    <span class="description-text">Reviews</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $new_user['contact_no'] ?></h5>
                    <span class="description-text">Contact Number:</span>
                  </div>
                  <!-- /.description-block -->
                  
                </div>
                <!-- /.col -->
                <ul class="nav nav-stacked">
                <br>
                <li><a href="#">Alternate Contact Number: <?php echo $new_user['alternate_contact_no'] ?></a></li>
                <li><a href="#">Address: <?= $new_user['address'] ?> </a></li>
                <li><a href="#">Gender:  <?php 
                    $a= $new_user['gender'];
                     if($a==0)
                      { echo "Male";}
                    elseif($a==1)
                        { echo "Female";}else{ echo "Other";}
                ?></a></li>
              </ul>  
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
          
        </div>       
        
    
        
        <?php
  }
  ?>

</div> 

<div>
<?php echo form_open_multipart('Profile/update_data'); ?>
  <?php 
  foreach ( $user as $new_user ) {?>

  <div class="panel panel-default edit">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            Edit Inofrmation
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                         <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                               <label> Name:</label> <input type="text" name="name"  value="<?=$new_user['name'];?>"><?=form_error('name');?>
                              </div>                             
                            </div>
                          </div> 
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                              <label>Alternate_Contact_No:</label><input type="number" name="alternate_contact_no" value="<?=$new_user['alternate_contact_no'];?>"><?=form_error('alternate_contact_no');?>
                              </div>                             
                            </div>                            
                          </div>  
                          
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                                 <label>Address:</label>
                                <input type="text" name="address"  value="<?=$new_user['address'];?>"><?=form_error('address');?>
                              </div>                             
                            </div>                            
                          </div>   
                                                     
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                              <label>Gender:</label>
                              <select name="gender">
                                <?php 
                                $g=$new_user['gender'];
                                if(g==0) ?>
                              <option name="male" value="0" >Male</option>
                              <option name="female" value="1" selected>Female</option>
                              <option name="other" value="2">Other</option>
                             </select>
                              </div>                             
                            </div>
                           </div>
                           <div class="row">
                            <div class="col-md-12">
                              <div class="aa-checkout-single-bill">
                              <label>Profile Pic:</label>
                              <input type="file" name="profile_photo" accept="image/*" class="btn-default" style="width:100%" /> <?=(isset($err)?$err:"")?>

                              </div>                             
                            </div>
                           </div>
                            <input type="Submit" value="Submit">
                          
                          </form>
                          </div>
    <?php
  }
  ?>
 


</div>

<div>
<?php echo form_open('Profile/change_pass'); ?>
<?php 
  foreach ( $user as $new_user ) {?>
  
 

  <div class="panel panel-default aa-checkout-login">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Change Password
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                        
                              <label>Old Password :</label>
		                          <input type="password" name="old_pass" id="name" /> <br><br>
                              <label>New Password :</label>
                              <input type="password" name="new_pass" id="password" />
                              <?=form_error('new_pass');?><br/><br/>
                              <label>Confirm Password :</label>
                              <input type="password" name="confirm_pass" id="password" />
                              <?=form_error('confirm_pass');?><br/><br />
		                          <input type="submit" value="Submit" name="change_pass"/><br />
                              </div>
                            </div>
                          </form>
                          </div>
                          <?php
  }
  ?>
</div>
</section> 
<?php
	$this->load->view('common/footer');  
	$this->load->view('common/bottom_script');
?>