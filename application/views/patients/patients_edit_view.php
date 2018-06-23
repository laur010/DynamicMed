<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){

    var hospitalized = $("#hospitalized").is(":checked");
    if (hospitalized) {
      document.getElementById('hospitalized_div').style.display = '';
    }
    else{
      document.getElementById('hospitalized_div').style.display = 'none';
    }
    jQuery(document).on('change','#hospitalized', function () {
      var hospitalized = $("#hospitalized").is(":checked");
      if (hospitalized) {
        document.getElementById('hospitalized_div').style.display = '';
      }
      else{
        document.getElementById('hospitalized_div').style.display = 'none';
      }
    });
    jQuery(document).on('change','#insurance', function () {
      var event = document.getElementById("insurance");
      var insurance_type = event.value;

      if (insurance_type == 1) {
        document.getElementById('cnas_insurance_div').style.display = '';
      }
      else {
        document.getElementById('cnas_insurance_div').style.display = 'none';
      }
    });

    jQuery(document).on('submit','#edit_patient_form',function(e){
      e.preventDefault();

      var patient_id = jQuery('#edit_patient_form #patient_id').val();
      var operation = jQuery('#edit_patient_form #operation').val();
      // PATIENT DATA
      var first_name = jQuery('#edit_patient_form #first_name').val();
      var last_name = jQuery('#edit_patient_form #last_name').val();
      var cnp = jQuery('#edit_patient_form #cnp').val();
      var phone = jQuery('#edit_patient_form #phone').val();
      var born_date = jQuery('#edit_patient_form #born_date').val();
      var residence = jQuery('#edit_patient_form #residence').val();
      var nationality = jQuery('#edit_patient_form #nationality').val();
      var gender_event = document.getElementById("gender");
      var gender = gender_event.value;
      var occupation_event = document.getElementById("occupation");
      var occupation = occupation_event.value;
      var training_level_event = document.getElementById("training_level");
      var training_level = training_level_event.value;
      var insurance_event = document.getElementById("insurance");
      var insurance = insurance_event.value;
      var cnas_type_insurance_event = document.getElementById("cnas_type_insurance");
      var cnas_type_insurance = cnas_type_insurance_event.value;
      var cnas_category_insurance_event = document.getElementById("cnas_category_insurance");
      var cnas_category_insurance = cnas_category_insurance_event.value;
      if (insurance != 1) {
        cnas_type_insurance = 0;
        cnas_category_insurance = 0;
      }
      var job = jQuery('#edit_patient_form #job').val();
      var blood_type_event = document.getElementById("blood_type");
      var blood_type = blood_type_event.value;
      var rh_event = document.getElementById("rh");
      var rh = rh_event.value;
      var born_weight = jQuery('#edit_patient_form #born_weight').val();
      var environment_event = document.getElementById("environment");
      var environment = environment_event.value;

      // RECORD DATA (HOSPITALIZED CASE)
      var hospitalized = $("#hospitalized").is(":checked");
      var salon_id_event = document.getElementById("salon_id");
      var salon_id = salon_id_event.value;
      if (hospitalized) {
        hospitalized = 1;
      }
      else{
        hospitalized = 0;
      }

      jQuery.ajax({
        type: 'POST',
        data: {
          "patient_id": patient_id,
          "operation": operation,
          "first_name": first_name,
          "last_name": last_name,
          "gender": gender,
          "cnp": cnp,
          "phone": phone,
          "born_date": born_date,
          "residence": residence,
          "nationality": nationality,
          "occupation": occupation,
          "training_level": training_level,
          "insurance": insurance,
          "cnas_type_insurance": cnas_type_insurance,
          "cnas_category_insurance": cnas_category_insurance,
          "job": job,
          "blood_type": blood_type,
          "rh": rh,
          "born_weight": born_weight,
          "environment": environment,

          "hospitalized": hospitalized,
          "salon_id": salon_id
        },
        url: '<?php echo base_url();?>patients/process_request',
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
          <h2>Editare Pacient
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>EDITARE: </strong><?php echo $patient['first_name']." ".$patient['last_name'];?> </h2>
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
            <?php echo form_open('patients/process_request',array("id"=>"edit_patient_form")); ?>
            <input type="hidden" id="operation" name="operation" value="edit"/>
            <input type="hidden" id="patient_id" name="patient_id" value="<?php echo $patient['patient_id'];?>"/>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $patient['first_name'];?>" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Prenume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $patient['last_name'];?>" placeholder="Prenume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Sexul M/F</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="gender" name="gender" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['gender']) echo "selected='selected'"?>>Masculin
                  <option value="2" <?php if(2==$patient['gender']) echo "selected='selected'"?>>Feminin
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">CNP</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="cnp" id="cnp" class="form-control" value="<?php echo $patient['cnp'];?>" placeholder="CNP">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Telefon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $patient['phone'];?>" placeholder="Telefon">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Data Nasterii</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="born_date" id="born_date" class="form-control" value="<?php echo $patient['born_date'];?>" placeholder="AAAA - LL - ZZ">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Domiciliu</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="residence" id="residence" class="form-control" value="<?php echo $patient['residence'];?>" placeholder="Domiciliu">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Cetatenie</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="nationality" id="nationality" value="<?php echo $patient['nationality'];?>" class="form-control" placeholder="Cetatenie">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Ocupatie</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="occupation" name="occupation" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['occupation']) echo "selected='selected'"?>>Fara ocupatie
                  <option value="2" <?php if(2==$patient['occupation']) echo "selected='selected'"?>>Salariat
                  <option value="3" <?php if(3==$patient['occupation']) echo "selected='selected'"?>>Lucrator pe cont propriu
                  <option value="4" <?php if(4==$patient['occupation']) echo "selected='selected'"?>>Patron
                  <option value="5" <?php if(5==$patient['occupation']) echo "selected='selected'"?>>Agricultor
                  <option value="6" <?php if(6==$patient['occupation']) echo "selected='selected'"?>>Elev/Student
                  <option value="7" <?php if(7==$patient['occupation']) echo "selected='selected'"?>>Somer
                  <option value="8" <?php if(8==$patient['occupation']) echo "selected='selected'"?>>Pensionar
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Nivel de Instruire</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="training_level" name="training_level" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['training_level']) echo "selected='selected'"?>>Fara studii
                  <option value="2" <?php if(2==$patient['training_level']) echo "selected='selected'"?>>Ciclu primar
                  <option value="3" <?php if(3==$patient['training_level']) echo "selected='selected'"?>>Ciclu gimnazial
                  <option value="4" <?php if(4==$patient['training_level']) echo "selected='selected'"?>>Scoala profesionala
                  <option value="5" <?php if(5==$patient['training_level']) echo "selected='selected'"?>>Liceu
                  <option value="6" <?php if(6==$patient['training_level']) echo "selected='selected'"?>>Scoala postliceala
                  <option value="7" <?php if(7==$patient['training_level']) echo "selected='selected'"?>>Studii superioare de scurta durata
                  <option value="8" <?php if(8==$patient['training_level']) echo "selected='selected'"?>>Studii superioare
                  <option value="9" <?php if(9==$patient['training_level']) echo "selected='selected'"?>>Nespecificat
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Statut Asigurat</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="insurance" name="insurance" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['insurance']) echo "selected='selected'"?>>Asigurat CNAS
                  <option value="2" <?php if(2==$patient['insurance']) echo "selected='selected'"?>>Asigurare Voluntara
                  <option value="3" <?php if(3==$patient['insurance']) echo "selected='selected'"?>>Neasigurat
                </select>
              </div>
            </div>
            <div class="row clearfix" id="cnas_insurance_div">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Tip asig. CNAS</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="cnas_type_insurance" name="cnas_type_insurance" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['cnas_type_insurance']) echo "selected='selected'"?>>Obligatorie CAS
                  <option value="2" <?php if(2==$patient['cnas_type_insurance']) echo "selected='selected'"?>>Facultativa CAS
                  <option value="3" <?php if(3==$patient['cnas_type_insurance']) echo "selected='selected'"?>>Eurocard
                  <option value="4" <?php if(4==$patient['cnas_type_insurance']) echo "selected='selected'"?>>Acord International
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Categ. asig. CNAS</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="cnas_category_insurance" name="cnas_category_insurance" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Asigurat
                  <option value="2" <?php if(2==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Coasigurat
                  <option value="3" <?php if(3==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Pensionar
                  <option value="4" <?php if(4==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Copil 18 ani
                  <option value="5" <?php if(5==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Elev/Ucenic/Student 18-26 ani
                  <option value="6" <?php if(6==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Gravida
                  <option value="7" <?php if(7==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Veteran
                  <option value="8" <?php if(8==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Revolutionar
                  <option value="9" <?php if(9==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Handicap
                  <option value="10" <?php if(10==$patient['cnas_category_insurance']) echo "selected='selected'"?>>PNS
                  <option value="11" <?php if(11==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Ajutor Social
                  <option value="12" <?php if(12==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Somaj
                  <option value="13" <?php if(13==$patient['cnas_category_insurance']) echo "selected='selected'"?>>Altele
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Loc de Munca</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="job" id="job" class="form-control" value="<?php echo $patient['job'];?>" placeholder="Loc de Munca">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Grup Sangvin</label>
              </div>
              <div class="col-lg-4 col-md-10 col-sm-8">
                <select id="blood_type" name="blood_type" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['blood_type']) echo "selected='selected'"?>>A
                  <option value="2" <?php if(2==$patient['blood_type']) echo "selected='selected'"?>>B
                  <option value="3" <?php if(3==$patient['blood_type']) echo "selected='selected'"?>>AB
                  <option value="4" <?php if(4==$patient['blood_type']) echo "selected='selected'"?>>0
                </select>
              </div>
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Rh</label>
              </div>
              <div class="col-lg-4 col-md-10 col-sm-8">
                <select id="rh" name="rh" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['rh']) echo "selected='selected'"?>>Negativ (-)
                  <option value="2" <?php if(2==$patient['rh']) echo "selected='selected'"?>>Pozitiv (+)
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Greutate la nastere</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" name="born_weight" id="born_weight" class="form-control" value="<?php echo $patient['born_weight'];?>" placeholder="Greutate la nastere">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Mediul U/R</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="environment" name="environment" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$patient['environment']) echo "selected='selected'"?>>Urban
                  <option value="2" <?php if(2==$patient['environment']) echo "selected='selected'"?>>Rural
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">

              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="checkbox">
                  <input id="hospitalized" name="hospitalized" type="checkbox" <?php if($patient['hospitalized'] == 1) echo "checked";?>>
                  <label for="hospitalized">
                    Spitalizat
                  </label>
                </div>
              </div>
            </div>
            <div class="row clearfix" id="hospitalized_div">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="salon_id">Salon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="salon_id" name="salon_id" class="form-control show-tick" data-live-search="false">
                  <?php foreach ($salons as $salon): ?>
                  <option value="<?php echo $salon['salon_id'];?>" <?php if($salon['salon_id'] == $patient['salon_id']){echo "selected='selected'";}?>><?php echo $salon['department_name']." - ".$salon['salon_name'];?>
                    <?php endforeach;?>
                </select>
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