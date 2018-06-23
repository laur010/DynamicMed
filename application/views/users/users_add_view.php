<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery(document).on('submit','#add_user_form',function(e){
      e.preventDefault();

      var username = jQuery('#add_user_form #username').val();
      var password = jQuery('#add_user_form #password').val();
      var confirm_password = jQuery('#add_user_form #confirm_password').val();
      var first_name = jQuery('#add_user_form #first_name').val();
      var last_name = jQuery('#add_user_form #last_name').val();
      var event = document.getElementById("role_id");
      var role_id = event.value;
      var phone = jQuery('#add_user_form #phone').val();
      var email = jQuery('#add_user_form #email').val();
      var oper = jQuery('#add_user_form #operation').val();

      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": oper,
          "username": username,
          "password": password,
          "confirm_password": confirm_password,
          "first_name": first_name,
          "last_name": last_name,
          "phone": phone,
          "email": email,
          "role_id": role_id
        },
        url: '<?php echo base_url();?>users/process_request',
        dataType: 'json',
        success: function (data) {
          if (data.code == 1) {
            showSuccessMessage(data.msg);
            document.getElementById('add_user_form').reset();
          }
          else {
            showErrorMessage(data.msg);
          }

        }
      });
    });
  });
</script>

<section class="content home">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Adaugare Utilizator
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>ADAUGARE</strong> Utilizator </h2>
            <ul class="header-dropdown">
              <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <i class="zmdi zmdi-more"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                  <li><a href="javascript:void(0);">Action</a></li>
                  <li><a href="javascript:void(0);">Another action</a></li>
                  <li><a href="javascript:void(0);">Something else</a></li>
                </ul>
              </li>
              <li class="remove">
                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
              </li>
            </ul>
          </div>
          <div class="body">
            <?php echo form_open('users/process_request',array("id"=>"add_user_form")); ?>
            <input type="hidden" id="operation" name="operation" value="add"/>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="role">Rol</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="role_id" name="role_id" class="form-control show-tick" data-live-search="false">
                  <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role_id'];?>"><?php echo $role['name'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="username">Username</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="password">Parola</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control" placeholder="Parola">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="confirm_password">Confirma Parola</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirma Parola">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="first_name">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="last_name">Prenume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Prenume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="phone">Telefon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Telefon">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email">Email</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-sm-8 offset-sm-2">
                <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Salveaza</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


