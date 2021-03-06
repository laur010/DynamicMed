<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery(document).on('submit','#add_role_form',function(e){
      e.preventDefault();

      var role_name = jQuery('#add_role_form #role_name').val();
      var oper = jQuery('#add_role_form #operation').val();
      var permissions = jQuery('#add_role_form #optgroup').val();


      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": oper,
          "role_name": role_name,
          "permissions": permissions
        },
        url: '<?php echo base_url();?>roles/process_request',
        dataType: 'json',
        success: function (data) {
          // console.log('data: ' + JSON.stringify(data));
          if (data.code == 1) {
            showSuccessMessage(data.msg);
            document.getElementById('add_role_form').reset();
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
        <h2>Adaugare Rol
          <small class="text-muted"></small>
        </h2>
      </div>
    </div>
  </div>

  <div class="row clearfix">
    <div class="col-lg-12">
      <div class="card">
        <div class="header">
          <h2><strong>ADAUGARE</strong> Rol </h2>
          <ul class="header-dropdown">
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
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
          <?php echo form_open('roles/process_request',array("id"=>"add_role_form")); ?>
            <input type="hidden" id="operation" name="operation" value="add"/>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="role_name" id="role_name"class="form-control" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="permissions">Permisiuni</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <?php
                $old_page = 'default';
                echo "<select id='optgroup' name='permissions[]' class='ms' multiple='multiple'>";
                foreach ($permissions as $p){
                  if ($p['page'] != $old_page) {
                    $old_page = $p['page'];
                    echo "<optgroup label='".ucfirst($p['page'])."'>";
                  }
                  echo "<option value='".$p['permission_id']."'>".$p['label']."</option>";
                }
                echo "</select>";
                ?>
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


