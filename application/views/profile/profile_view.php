<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>

<script src="<?php echo base_url();?>theme/inspina/js/plugins/cookie/jquery.cookie.js"></script>

<script type="text/javascript">

  function change_profile_picture(id) {

    jQuery.ajax({
      type: 'POST',
      data: {
        "image_id": id,
        "operation": "change_profile_picture"
      },
      url: '<?php echo base_url();?>profile/process_request',
      dataType: 'json',
      success: function (data) {
        if (data.code == 1) {
          showSuccessMessage(data.msg);
          setTimeout(function(){
            location.reload();
          }, 1000);
        }
        else {
          showErrorMessage(data.msg);
        }
      }
    });

  }
  function delete_profile_picture(id) {

    jQuery.ajax({
      type: 'POST',
      data: {
        "image_id": id,
        "operation": "delete_profile_picture"
      },
      url: '<?php echo base_url();?>profile/process_request',
      dataType: 'json',
      success: function (data) {
        if (data.code == 1) {
          showSuccessMessage(data.msg);
          setTimeout(function(){
            location.reload();
          }, 1000);
        }
        else {
          showErrorMessage(data.msg);
        }
      }
    });

  }
  jQuery(document).ready(function(){

    jQuery(document).on('submit','#account_settings_form',function(e){
      e.preventDefault();

      var first_name = jQuery('#account_settings_form #first_name').val();
      var last_name = jQuery('#account_settings_form #last_name').val();
      var city = jQuery('#account_settings_form #city').val();
      var country = jQuery('#account_settings_form #country').val();
      var email = jQuery('#account_settings_form #email').val();
      var address = jQuery('#account_settings_form #address').val();
      var operation = jQuery('#account_settings_form #operation').val();
      var user_id = jQuery('#account_settings_form #user_id').val();

      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": operation,
          "first_name": first_name,
          "last_name": last_name,
          "city": city,
          "email": email,
          "address": address,
          "country": country,
          "user_id": user_id
        },
        url: '<?php echo base_url();?>profile/process_request',
        dataType: 'json',
        success: function (data) {
          // console.log('data: ' + JSON.stringify(data));
          if (data.code == 1) {
            showSuccessMessage(data.msg);
          }
          else {
            showErrorMessage(data.msg);
          }

        }
      });
    });

    jQuery(document).on('submit','#security_settings_form',function(e){
      e.preventDefault();

      var username = jQuery('#security_settings_form #username').val();
      var old_password = jQuery('#security_settings_form #old_password').val();
      var new_password = jQuery('#security_settings_form #new_password').val();
      var operation = jQuery('#security_settings_form #operation').val();
      var user_id = jQuery('#security_settings_form #user_id').val();

      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": operation,
          "username": username,
          "old_password": old_password,
          "new_password": new_password,
          "user_id": user_id
        },
        url: '<?php echo base_url();?>profile/process_request',
        dataType: 'json',
        success: function (data) {
          // console.log('data: ' + JSON.stringify(data));
          if (data.code == 1) {
            document.getElementById('security_settings_form').reset();
            showSuccessMessage(data.msg);
          }
          else {
            document.getElementById('security_settings_form').reset();
            showErrorMessage(data.msg);
          }
        }
      });
    });

    jQuery(document).on('submit','#add_profile_img_form',function(e){
      e.preventDefault();
      window.location="<?php echo base_url();?>profile/process_request";
    });

    jQuery(document).on('change','#nr_notifications',function(e){
      e.preventDefault();

      // Set new cookie or change it;
      $.cookie('nr_notifications', $('#nr_notifications').val(), { expires : 365 });
      // Refresh page (easy way) OR Edit select without refresh.

    });

  });


</script>

<section class="content home">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Profile
            <small class="text-muted">Welcome to CTL Profile</small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-4 col-md-12">
        <div class="card member-card">
          <div class="header l-cyan">
            <h4 class="m-t-10"><?php echo $user['first_name']." ".$user['last_name'];?></h4>
          </div>
          <div class="member-img">
            <a href="<?php echo base_url();?>profile" class="">
              <img src="<?php echo base_url();?>upload/profile_images/<?php echo $active_image['name'];?>" class="rounded-circle" alt="profile-image">
            </a>
          </div>
          <div class="body">
            <div class="col-12">
              <ul class="social-links list-unstyled">
                <li><a title="facebook" href="http://www.facebook.com" target="_blank"><i class="zmdi zmdi-facebook"></i></a></li>
                <li><a title="twitter" href="http://www.twitter.com" target="_blank"><i class="zmdi zmdi-twitter"></i></a></li>
                <li><a title="instagram" href="http://www.instagram.com" target="_blank"><i class="zmdi zmdi-instagram"></i></a></li>
              </ul>
              <p class="text-muted"><?php if($user['address'] == '') echo $user['address']; else echo "Address: ".$user['address'];?></p>
            </div>
            <hr>
            <div class="row">
              <div class="col-6">
                <h5>0</h5>
                <small>Prieteni</small>
              </div>
              <div class="col-6">
                <h5><?php echo count($user_notifications);?></h5>
                <small>Notificari</small>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about">Informatii</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pictures">Imagini</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane body active" id="about">
              <small class="text-muted">Adresa de email: </small>
              <p><?php echo $user['email']?></p>
              <hr>
              <small class="text-muted">Telefon: </small>
              <p><?php echo $user['phone']?></p>
              <hr>
            </div>
            <div class="tab-pane body" id="pictures">
              <ul class="new_friend_list list-unstyled row">
                <?php foreach ($profile_images as $p_image): ?>
                  <li class="col-lg-4 col-md-2 col-sm-6 col-4">
                    <a id="myLink_change" title="Set profile pictures"
                       href="#" onclick="change_profile_picture(<?php echo $p_image['profile_image_id']?>);return false;">
                      <img src="<?php echo base_url()."upload/profile_images/".$p_image['name'];?>" class="img-thumbnail" alt="User Image">
                      <h6 class="users_name"><?php echo $p_image['name'];?></h6>
                    </a>
                    <a id="myLink_del" title="Delete profile pictures"
                       href="#" onclick="delete_profile_picture(<?php echo $p_image['profile_image_id']?>);return false;">x</a>
                  </li>
                <?php endforeach;?>
              </ul>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="header">
            <h2><strong>Profile Image Upload</strong></h2>
            <ul class="header-dropdown">
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <form action="<?php echo base_url();?>profile/add_profile_img" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
              <div class="dz-message">
                <div class="drag-icon-cph"> <i class="material-icons">touch_app</i> </div>
                <h3>Aici puteti incarca imagini noi.</h3>
                <em>This is just a dropzone for your <strong>profile</strong> image.</em></div>
              <div class="fallback">
                <input name="userfile" id="userfile" type="file" />
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8 col-md-12">
        <div class="card">
          <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#timeline">Notificari</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Setari</a></li>
          </ul>
        </div>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="timeline">
            <ul class="cbp_tmtimeline">
              <li>
                <time class="cbp_tmtime" datetime="2017-11-04T03:45">
                </time>
                <div class="cbp_tmicon">
                  <i class="zmdi zmdi-label"></i>
                </div>
                <div class="cbp_tmlabel">
                  <h2>Aici puteti citi toate notificarile.</h2>
                  <p>Daca doriti sa vizualizati mai multe notificari pe pagina de profil selectati numarul de notificari dorit din select-ul de mai jos.</p>
                  <select id="nr_notifications" class="form-control show-tick">
                    <option value="10" <?php if(isset($_COOKIE['nr_notifications']) && $_COOKIE['nr_notifications'] == 10) echo 'selected="selected"';?>>10 Notifications</option>
                    <option value="20" <?php if(isset($_COOKIE['nr_notifications']) && $_COOKIE['nr_notifications'] == 20) echo 'selected="selected"';?>>20 Notifications</option>
                    <option value="50" <?php if(isset($_COOKIE['nr_notifications']) && $_COOKIE['nr_notifications'] == 50) echo 'selected="selected"';?>>50 Notifications</option>
                    <option value="100" <?php if(isset($_COOKIE['nr_notifications']) && $_COOKIE['nr_notifications'] == 100) echo 'selected="selected"';?>>100 Notifications</option>
                  </select>
                </div>
              </li>
              <?php
              if(isset($_COOKIE['nr_notifications'])) $nr_notifications = $_COOKIE['nr_notifications']; else $nr_notifications = 10;
              foreach ($user_notifications as $notification): if(--$nr_notifications < 0) break;?>
              <li>
                <div>
                  <div class="col-lg-12">
                    <time class="cbp_tmtime" datetime="2017-11-01T03:45">
                      <span style="font-size: 12px;"><?php echo $notification['timestamp'];?></span>
                    </time>
                  </div>

                  <div class="cbp_tmicon <?php echo get_notification_type($notification['class_type'])['div_class'];?>">
                    <i class="<?php echo get_notification_type($notification['class_type'])['icon_class'];?>"></i>
                  </div>
                  <div class="cbp_tmlabel">
                    <p><?php echo $notification['message'];?></p>
                  </div>
                </div>
              </li>
              <?php endforeach;?>
            </ul>
          </div>
          <div role="tabpanel" class="tab-pane" id="usersettings">
            <div class="card">
              <div class="header">
                <h2><strong>Security</strong> Settings</h2>
              </div>
              <div class="body">
                <?php echo form_open('profile/process_request',array("id"=>"security_settings_form")); ?>
                <input type="hidden" id="operation" name="operation" value="security_settings"/>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id'];?>"/>
                <div class="form-group">
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Parola Curenta">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Noua Parola">
                </div>
                <button type="submit" class="btn btn-info btn-round waves-effect">Salveaza</button>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="header">
                <h2><strong>Account</strong> Settings</h2>
              </div>
              <div class="body">
                <?php echo form_open('profile/process_request',array("id"=>"account_settings_form")); ?>
                <input type="hidden" id="operation" name="operation" value="account_settings"/>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $user['user_id'];?>"/>
                  <div class="row clearfix">
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $user['first_name'];?>" placeholder="Nume">
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name'];?>" placeholder="Prenume">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="city" name="city" value="<?php echo $user['city'];?>" placeholder="Oras">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $user['email'];?>" placeholder="Email">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <div class="form-group">
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $user['country'];?>" placeholder="Tara">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="address" name="address" placeholder="Address Line 1"><?php echo $user['address'];?></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-round waves-effect">Salveaza</button>
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


