<?php
	$path_prefix=base_url('asset/user/');
	$this->load->view('common/top_script');
	$this->load->view('common/header');
  $this->load->view('common/menu'); 
  
  //$this->load->view('common/banner');
  ?>
  <!-- AdminLTE style sheet -->
  <link href="<?=$path_prefix?>css/AdminLTE.css" rel="stylesheet">

  <section id="aa-account"> 
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            <div class="aa-myaccount-area">  
              <div class="row">  
                <div  class="col-md-8 col-md-offset-2" style="margin-top:50px;">
                 <div class="aa-myaccount-login">
                    <div class="row">
                      <?php 
                      foreach ( $user as $new_user )
                      {
                      ?>
                      <div>
                        <!-- Widget: user widget style 1 -->
                          <div class="box box-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-light-red ">
                              <h3 class="widget-user-username" style="color:white;"><?php echo $new_user['name'] ?></h3>
                              <h5 class="widget-user-desc" style="color:white;"><?php echo $new_user['email'] ?></h5>
                            </div>
                            <div class="widget-user-image">
                              <img class="img-circle" src="<?=$path_prefix?>img/user/<?=$new_user['photo']?>" alt="User Avatar">
                            </div>
                            <div class="box-footer">
                              <div class="row">
                                <div class="col-sm-4 border-right">
                                  <div class="description-block">
                                    <h5 class="description-header">UserID</h5>
                                    <span class="description-text"> <?php echo $new_user['user_id'] ?></span>
                                  </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                <div class="description-block">
                                            <h5 class="description-header">Gender</h5>
                                            <span class="description-text"><?php 
                                                $a= $new_user['gender'];
                                                if($a==0)
                                                { echo "Male";}
                                                elseif($a==1)
                                                { echo "Female";}else{ echo "Other";}
                                                ?></span>
                                          </div>
                                  <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                  <div class="description-block">
                                    <h5 class="description-header">Contact Number</h5>
                                    <span class="description-text"><?php echo $new_user['contact_no'] ?></span>
                                  </div>
                                  <!-- /.description-block -->
                                  
                              </div>

                              </div>  
                                <div class="row" >
                                        <div class="col-sm-6"style=" border-top: 1px solid #f4f4f4;border-right: 1px solid #f4f4f4;">
                                          <div class="description-block">
                                            <h5 class="description-header">Alternate Contact No</h5>
                                            <span class="description-text"><?= $new_user['alternate_contact_no'] ?></span>
                                          </div>
                                          <!-- /.description-block -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6 "style=" border-top: 1px solid #f4f4f4;">


                                        <div class="description-block">
                                    <h5 class="description-header">Address</h5>
                                    <span class="description-text"><?= $new_user['address'] ?></span>
                                  </div>


                                      </div>  
                                          <!-- /.description-block -->
                                </div>  
                                  
                                
                                <!-- /.box --
                                
                              </div>
                              <!-- /.row -->
                            </div>
                          </div>
                          <!-- /.widget-user -->

                          
                      <?php
                      }
                      ?> 
                    </div>
                    <div class="row">
                      <?=validation_errors();?>
                    </div>
                    <div class="row">   
                      <?php echo form_open_multipart('Profile/update_data'); ?>
                      <?php 
                      foreach ( $user as $new_user ) {?>
                      
                        <div class="panel panel-default edit " >
                            <div class="panel-heading toggle_container">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"  >
                                  Update Information
                                </a>
                              </h4>
                            </div> 
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse " style="padding:20px;" >
                          <div class="form-group">
                            <label >Name</label>
                            <input type="text" class="form-control" name="name" value="<?=$new_user['name'];?>"> <?=form_error('name');?>
                          </div>

                          <div class="form-group">
                            <label >Address</label>
                            <input type="text" class="form-control" name="address" value="<?=$new_user['address'];?>"> <?=form_error('address');?>
                          </div>

                          <div class="form-group">
                            <label>Alternate Contact No:</label>
                            <input type="text" class="form-control" name="alternate_contact_no" value="<?=$new_user['alternate_contact_no'];?>"> <?=form_error('alternate_contact_no');?>
                          </div>
                          <div class="form-row">
                            <div class=" col form-group">
                              <label >Gender</label>
                              <?php
                                  $options = array(
                                  '0' => 'Male',
                                  '1' => 'Female',
                                  '2' => 'Other', 
                                  );
                                  $selected_gender= $new_user['gender'];
                                  echo form_dropdown('gender', $options, $selected_gender); ?>
                            </div>
              
                            <div class=" col form-group">
                              <label>Profile Picture</label>
                              <input type="file" class="form-control" name="profile_photo" accept="image/*"  /> <?=(isset($err)?$err:"")?>
                            </div>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-default">Submit</button>
                          </div>
                          
                        </div>  
                        
                      <?php
                      }
                      ?>
                    </form> 
                    </div>
                    <div class="row">
                      <?php echo form_open('Profile/change_pass'); ?>
                        <div class="panel panel-default edit">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Change Password
                              </a>
                            </h4>
                          </div> 
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" style="padding:20px;">
                            <div class="form-group">
                                <label>Old Password :</label>
                                <input type="password" class="form-control"  name="old_pass" id="name" placeholder="Old Password" /> 
                            </div>
                            <div class="form-group">
                              <label>New Password :</label>
                              <input type="password" class="form-control"  name="new_pass" id="password" placeholder="New Password"  />
                              <?=form_error('new_pass');?>
                            </div>
                            <div class="form-group">
                              <label>Confirm Password :</label>
                              <input type="password" class="form-control" name="confirm_pass" id="password" placeholder="New Password" />
                              <?=form_error('confirm_pass');?>
                            </div>       
                            <div class="form-group">
                              <button type="submit" class="btn btn-default">Submit</button>
                            </div>                     
                        </div>  
                      </form>       
                    </div>
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
