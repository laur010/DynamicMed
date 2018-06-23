<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>

<section class="content home">
  <div class="container-fluid">
    <div class="block-header">
      <div class="row">
        <div class="col-lg-7 col-md-6 col-sm-12">
          <h2>Detalii Utilizator
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>DETALII: </strong> <?php echo $user['username']?> </h2>
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
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="last_name">Rol</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select disabled="" id="role" name="role" class="form-control show-tick" data-live-search="false">
                  <?php foreach ($roles as $role): ?>
                    <option <?php if($role['role_id'] == $user['role_id']){ echo "selected='selected'";}?> value="<?php echo $role['role_id'];?>"><?php echo $role['name'];?></option>
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
                  <input disabled type="text" name="username" id="username" class="form-control" value="<?php echo $user['username'];?>" placeholder="Username">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="first_name">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input disabled type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $user['first_name'];?>" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="last_name">Prenume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input disabled type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $user['last_name'];?>" placeholder="Prenume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="phone">Telefon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input disabled type="text" name="phone" id="phone" class="form-control" value="<?php echo $user['phone'];?>" placeholder="Telefon">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email">Email</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input disabled type="text" name="email" id="email" class="form-control" value="<?php echo $user['email'];?>" placeholder="Email">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


