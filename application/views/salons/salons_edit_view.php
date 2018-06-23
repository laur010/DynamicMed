<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){

    jQuery(document).on('submit','#edit_salon_form',function(e){
      e.preventDefault();

      var salon_id = jQuery('#edit_salon_form #salon_id').val();
      var name = jQuery('#edit_salon_form #name').val();
      var event = document.getElementById("department_id");
      var department_id = event.value;
      var capacity = jQuery('#edit_salon_form #capacity').val();
      var description = jQuery('#edit_salon_form #description').val();
      var oper = jQuery('#edit_salon_form #operation').val();

      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": oper,
          "name": name,
          "department_id": department_id,
          "capacity": capacity,
          "description": description,
          "salon_id": salon_id
        },
        url: '<?php echo base_url();?>salons/process_request',
        dataType: 'json',
        success: function (data) {
          if (data.code == 1) {
            showSuccessMessage(data.msg);
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
          <h2>Editare Salon
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>EDITARE:</strong> <?php echo $salon['name'];?></h2>
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
            <?php echo form_open('salons/process_request',array("id"=>"edit_salon_form")); ?>
            <input type="hidden" id="operation" name="operation" value="edit"/>
            <input type="hidden" id="salon_id" name="salon_id" value="<?php echo $salon['salon_id']?>"/>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="last_name">Sectie</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="department_id" name="department_id" class="form-control show-tick" data-live-search="false">
                  <?php foreach ($departments as $department): ?>
                    <option value="<?php echo $department['department_id'];?>" <?php if($department['department_id'] == $salon['department_id']){echo "selected='selected'";}?>><?php echo $department['name'];?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="name">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="name" id="name"class="form-control" value="<?php echo $salon['name']?>" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="capacity">Capacitate</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="capacity" id="capacity"class="form-control" value="<?php echo $salon['capacity']?>" placeholder="Capacitate">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="description">Descriere</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <textarea rows="4" class="form-control no-resize" id="description" name="description" placeholder="Descriere"><?php echo $salon['description']?></textarea>
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


