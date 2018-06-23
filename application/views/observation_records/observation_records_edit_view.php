<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script> <!-- Bootstrap Colorpicker Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/multi-select/js/jquery.multi-select.js"></script> <!-- Multi Select Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/jquery-spinner/js/jquery.spinner.js"></script> <!-- Jquery Spinner Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script> <!-- Bootstrap Tags Input Plugin Js -->
<script src="<?php echo base_url();?>theme/assets/js/pages/forms/advanced-form-elements.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){

    var temperature_set_number = <?php echo count($temperature_data_array);?>;

    $(document).on('click', '.add_temperature_set', function(e) {
      e.preventDefault();

      $('.add_temperature_set').hide();
      temperature_set_number++;

      var new_data_set = "";

      new_data_set +=

        '                  <div class="row clearfix">\n' +
        '                    <div class="col-lg-4 col-md-2 col-sm-4">\n' +
        '                        <div class="input-group">\n' +
        '                          <span class="input-group-addon">\n' +
        '                              <i class="zmdi zmdi-calendar"></i>\n' +
        '                          </span>\n' +
        '                          <input type="text" name="temp_date_'+temperature_set_number+'" id="temp_date_'+temperature_set_number+'" class="form-control" placeholder="Selectati data si ora setului de date (AAAA-LL-ZZ HH:MM)">\n' +
        '                        </div>\n' +
        '                    </div>'+
        '                    <div class="col-lg-1 col-md-2 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="breath_'+temperature_set_number+'" id="breath_'+temperature_set_number+'" class="form-control" placeholder="Respiratie">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-lg-1 col-md-2 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="ta_'+temperature_set_number+'" id="ta_'+temperature_set_number+'" class="form-control" placeholder="TA">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-lg-1 col-md-2 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="pulse_'+temperature_set_number+'" id="pulse_'+temperature_set_number+'" class="form-control" placeholder="Puls">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-lg-1 col-md-2 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="temperature_'+temperature_set_number+'" id="temperature_'+temperature_set_number+'" class="form-control" placeholder="Temperatura">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                      <div class="col-lg-1 col-md-1 col-sm-4">\n' +
        '                        <div class="form-group">\n' +
        '                        <input type="text" name="liquid_'+temperature_set_number+'" id="liquid_'+temperature_set_number+'" class="form-control" placeholder="Lichid">\n' +
        '                      </div>\n' +
        '                      </div>\n' +
        '                    <div class="col-lg-1 col-md-1 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="diuresis_'+temperature_set_number+'" id="diuresis_'+temperature_set_number+'" class="form-control" placeholder="Diuretice">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-lg-1 col-md-1 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="shit_'+temperature_set_number+'" id="shit_'+temperature_set_number+'" class="form-control" placeholder="Scaune">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-lg-1 col-md-1 col-sm-4">\n' +
        '                      <div class="form-group">\n' +
        '                        <input type="text" name="diet_'+temperature_set_number+'" id="diet_'+temperature_set_number+'" class="form-control" placeholder="Diete">\n' +
        '                      </div>\n' +
        '                    </div>\n' +
        '                  </div>\n' +
        '                  <div class="row clearfix">\n' +
        '                    <div class="col-sm-12">\n' +
        '                      <button class="add_temperature_set btn btn-raised btn-default btn-round waves-effect col-sm-12">ADAUGA UN NOU SET DE DATE PENTRU DATA SI ORA PREZENTA</button>\n' +
        '                    </div>\n' +
        '                  </div>';

      $('#temperature_tab').append(new_data_set);
    });

    jQuery(document).on('submit','#edit_observation_record_form',function(e){
      e.preventDefault();

      var operation = jQuery('#edit_observation_record_form #operation').val();
      var observation_record_id = jQuery('#edit_observation_record_form #observation_record_id').val();

      var date_open = jQuery('#edit_observation_record_form #date_open').val();
      var date_close = jQuery('#edit_observation_record_form #date_close').val();
      var reference_diagnostic = jQuery('#edit_observation_record_form #reference_diagnostic').val();
      var hospitalized_diagnostic = jQuery('#edit_observation_record_form #hospitalized_diagnostic').val();
      var discharge_diagnostic = jQuery('#edit_observation_record_form #discharge_diagnostic').val();
      var sec_discharge_diagnostic = jQuery('#edit_observation_record_form #sec_discharge_diagnostic').val();
      var main_surgery = jQuery('#edit_observation_record_form #main_surgery').val();
      var personal_main_surgery = jQuery('#edit_observation_record_form #personal_main_surgery').val();
      var date_main_surgery = jQuery('#edit_observation_record_form #date_main_surgery').val();
      var concurrent_surgery = jQuery('#edit_observation_record_form #concurrent_surgery').val();
      var personal_concurrent_surgery = jQuery('#edit_observation_record_form #personal_concurrent_surgery').val();
      var date_concurrent_surgery = jQuery('#edit_observation_record_form #date_concurrent_surgery').val();
      var other_surgery = jQuery('#edit_observation_record_form #other_surgery').val();
      var personal_other_surgery = jQuery('#edit_observation_record_form #personal_other_surgery').val();
      var date_other_surgery = jQuery('#edit_observation_record_form #date_other_surgery').val();
      var clinical_general_exam = jQuery('#edit_observation_record_form #clinical_general_exam').val();
      var status_general_exam = jQuery('#edit_observation_record_form #status_general_exam').val();
      var height_general_exam = jQuery('#edit_observation_record_form #height_general_exam').val();
      var weight_general_exam = jQuery('#edit_observation_record_form #weight_general_exam').val();
      var nutrition_general_exam = jQuery('#edit_observation_record_form #nutrition_general_exam').val();
      var conscious_general_exam = jQuery('#edit_observation_record_form #conscious_general_exam').val();
      var skin_general_exam = jQuery('#edit_observation_record_form #skin_general_exam').val();
      var mucous_general_exam = jQuery('#edit_observation_record_form #mucous_general_exam').val();
      var appendages_general_exam = jQuery('#edit_observation_record_form #appendages_general_exam').val();
      var connective_tissue_general_exam = jQuery('#edit_observation_record_form #connective_tissue_general_exam').val();
      var ganglia_system_general_exam = jQuery('#edit_observation_record_form #ganglia_system_general_exam').val();
      var muscle_tissue_general_exam = jQuery('#edit_observation_record_form #muscle_tissue_general_exam').val();
      var articular_system_general_exam = jQuery('#edit_observation_record_form #articular_system_general_exam').val();
      var respiratory_device_general_exam = jQuery('#edit_observation_record_form #respiratory_device_general_exam').val();
      var cardiovascular_device_general_exam = jQuery('#edit_observation_record_form #cardiovascular_device_general_exam').val();
      var digestive_device_general_exam = jQuery('#edit_observation_record_form #digestive_device_general_exam').val();
      var digestive_system_general_exam = jQuery('#edit_observation_record_form #digestive_system_general_exam').val();
      var urogenital_device_general_exam = jQuery('#edit_observation_record_form #urogenital_device_general_exam').val();
      var nervous_system_general_exam = jQuery('#edit_observation_record_form #nervous_system_general_exam').val();
      var oral_cavity_oncology = jQuery('#edit_observation_record_form #oral_cavity_oncology').val();
      var skin_oncology = jQuery('#edit_observation_record_form #skin_oncology').val();
      var ganglia_oncology = jQuery('#edit_observation_record_form #ganglia_oncology').val();
      var breast_oncology = jQuery('#edit_observation_record_form #breast_oncology').val();
      var genital_organs_oncology = jQuery('#edit_observation_record_form #genital_organs_oncology').val();
      var cytology_oncology = jQuery('#edit_observation_record_form #cytology_oncology').val();
      var prostate_oncology = jQuery('#edit_observation_record_form #prostate_oncology').val();
      var others_oncology = jQuery('#edit_observation_record_form #others_oncology').val();
      var radiological_exam = jQuery('#edit_observation_record_form #radiological_exam').val();
      var ultrasound_exam = jQuery('#edit_observation_record_form #ultrasound_exam').val();
      var cytological_exam = jQuery('#edit_observation_record_form #cytological_exam').val();
      var histopathological_exam = jQuery('#edit_observation_record_form #histopathological_exam').val();
      var extemporaneously_exam = jQuery('#edit_observation_record_form #extemporaneously_exam').val();
      var anatomopathological_exam = jQuery('#edit_observation_record_form #anatomopathological_exam').val();
      var diagnostic_death = jQuery('#edit_observation_record_form #diagnostic_death').val();
      var morphological_code = jQuery('#edit_observation_record_form #morphological_code').val();

      var functional_explorations_name = jQuery('#edit_observation_record_form #functional_explorations_name').val();
      var functional_explorations_code = jQuery('#edit_observation_record_form #functional_explorations_code').val();
      var functional_explorations_nr = jQuery('#edit_observation_record_form #functional_explorations_nr').val();

      var radiological_investigations_name = jQuery('#edit_observation_record_form #radiological_investigations_name').val();
      var radiological_investigations_code = jQuery('#edit_observation_record_form #radiological_investigations_code').val();
      var radiological_investigations_nr = jQuery('#edit_observation_record_form #radiological_investigations_nr').val();

      var therapeutic_procedures_name = jQuery('#edit_observation_record_form #therapeutic_procedures_name').val();
      var therapeutic_procedures_code = jQuery('#edit_observation_record_form #therapeutic_procedures_code').val();
      var therapeutic_procedures_nr = jQuery('#edit_observation_record_form #therapeutic_procedures_nr').val();

      var death_date = jQuery('#edit_observation_record_form #death_date').val();
      var hospitalized_reason_others_info = jQuery('#edit_observation_record_form #hospitalized_reason_others_info').val();
      var anamneza_others_info = jQuery('#edit_observation_record_form #anamneza_others_info').val();
      var disease_history_others_info = jQuery('#edit_observation_record_form #disease_history_others_info').val();
      var epicrisis_others_info = jQuery('#edit_observation_record_form #epicrisis_others_info').val();
      var hospitalized_type_event = document.getElementById("hospitalized_type");
      var hospitalized_type = hospitalized_type_event.value;
      var hospitalized_cause_event = document.getElementById("hospitalized_cause");
      var hospitalized_cause = hospitalized_cause_event.value;
      var discharge_status_event = document.getElementById("discharge_status");
      var discharge_status = discharge_status_event.value;
      var discharge_type_event = document.getElementById("discharge_type");
      var discharge_type = discharge_type_event.value;
      var death_status_event = document.getElementById("death_status");
      var death_status = death_status_event.value;

      var analysis_array = [];
      var analysis_id;
      <?php foreach ($analysis_array as $analysis):?>
      analysis_id = '<?php echo $analysis["id"];?>';

      analysis_array.push({
        id: analysis_id,
        value:  jQuery('#edit_observation_record_form #'+analysis_id).val()
      });
      <?php endforeach; ?>

      var temperature_sheet_array = [];
      var temp_date = '';
      var breath = '';
      var ta = '';
      var pulse = '';
      var temperature = '';
      var liquid = '';
      var diuresis = '';
      var shit = '';
      var diet = '';
      for (var i = 1; i <= temperature_set_number; i++) {
        temp_date = jQuery('#edit_observation_record_form #temp_date_'+i).val();
        breath = jQuery('#edit_observation_record_form #breath_'+i).val();
        ta = jQuery('#edit_observation_record_form #ta_'+i).val();
        pulse = jQuery('#edit_observation_record_form #pulse_'+i).val();
        temperature = jQuery('#edit_observation_record_form #temperature_'+i).val();

        liquid = jQuery('#edit_observation_record_form #liquid_'+i).val();
        diuresis = jQuery('#edit_observation_record_form #diuresis_'+i).val();
        shit = jQuery('#edit_observation_record_form #shit_'+i).val();
        diet = jQuery('#edit_observation_record_form #diet_'+i).val();

        temperature_sheet_array.push({
          date: temp_date,
          breath: breath,
          ta: ta,
          pulse: pulse,
          temperature: temperature,
          liquid: liquid,
          diuresis: diuresis,
          shit: shit,
          diet: diet
        });
      }



      jQuery.ajax({
        type: 'POST',
        data: {
          "operation": operation,
          "observation_record_id": observation_record_id,

          "date_open": date_open,
          "date_close": date_close,
          "hospitalized_type": hospitalized_type,
          "hospitalized_cause": hospitalized_cause,
          "reference_diagnostic": reference_diagnostic,
          "hospitalized_diagnostic": hospitalized_diagnostic,
          "discharge_diagnostic": discharge_diagnostic,
          "sec_discharge_diagnostic": sec_discharge_diagnostic,
          "discharge_status": discharge_status,
          "discharge_type": discharge_type,
          "main_surgery": main_surgery,
          "personal_main_surgery": personal_main_surgery,
          "date_main_surgery": date_main_surgery,
          "concurrent_surgery": concurrent_surgery,
          "personal_concurrent_surgery": personal_concurrent_surgery,
          "date_concurrent_surgery": date_concurrent_surgery,
          "other_surgery": other_surgery,
          "personal_other_surgery": personal_other_surgery,
          "date_other_surgery": date_other_surgery,
          "clinical_general_exam": clinical_general_exam,
          "status_general_exam": status_general_exam,
          "height_general_exam": height_general_exam,
          "weight_general_exam": weight_general_exam,
          "nutrition_general_exam": nutrition_general_exam,
          "conscious_general_exam": conscious_general_exam,
          "skin_general_exam": skin_general_exam,
          "mucous_general_exam": mucous_general_exam,
          "appendages_general_exam": appendages_general_exam,
          "connective_tissue_general_exam": connective_tissue_general_exam,
          "ganglia_system_general_exam": ganglia_system_general_exam,
          "muscle_tissue_general_exam": muscle_tissue_general_exam,
          "articular_system_general_exam": articular_system_general_exam,
          "respiratory_device_general_exam": respiratory_device_general_exam,
          "cardiovascular_device_general_exam": cardiovascular_device_general_exam,
          "digestive_device_general_exam": digestive_device_general_exam,
          "digestive_system_general_exam": digestive_system_general_exam,
          "urogenital_device_general_exam": urogenital_device_general_exam,
          "nervous_system_general_exam": nervous_system_general_exam,
          "oral_cavity_oncology": oral_cavity_oncology,
          "skin_oncology": skin_oncology,
          "ganglia_oncology": ganglia_oncology,
          "breast_oncology": breast_oncology,
          "genital_organs_oncology": genital_organs_oncology,
          "cytology_oncology": cytology_oncology,
          "prostate_oncology": prostate_oncology,
          "others_oncology": others_oncology,
          "radiological_exam": radiological_exam,
          "ultrasound_exam": ultrasound_exam,
          "cytological_exam": cytological_exam,
          "histopathological_exam": histopathological_exam,
          "extemporaneously_exam": extemporaneously_exam,
          "anatomopathological_exam": anatomopathological_exam,
          "diagnostic_death": diagnostic_death,
          "morphological_code": morphological_code,
          "functional_explorations_name": functional_explorations_name,
          "functional_explorations_code": functional_explorations_code,
          "functional_explorations_nr": functional_explorations_nr,
          "radiological_investigations_name": radiological_investigations_name,
          "radiological_investigations_code": radiological_investigations_code,
          "radiological_investigations_nr": radiological_investigations_nr,
          "therapeutic_procedures_name": therapeutic_procedures_name,
          "therapeutic_procedures_code": therapeutic_procedures_code,
          "therapeutic_procedures_nr": therapeutic_procedures_nr,
          "death_status": death_status,
          "death_date": death_date,
          "hospitalized_reason_others_info": hospitalized_reason_others_info,
          "anamneza_others_info": anamneza_others_info,
          "disease_history_others_info": disease_history_others_info,
          "epicrisis_others_info": epicrisis_others_info,
          "analysis_array": analysis_array,
          "temperature_sheet_array": temperature_sheet_array
        },
        url: '<?php echo base_url();?>observation_records/process_request',
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
          <h2>Adaugare Foaie de Observatie
            <small class="text-muted"></small>
          </h2>
        </div>
      </div>
    </div>

    <div class="row clearfix">
      <div class="col-lg-12">
        <div class="card">
          <div class="header">
            <h2><strong>ADAUGARE</strong> Foaie de Observatie pentru <?php echo $patient['first_name']." ".$patient['last_name']?> </h2>
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
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Nume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" readonly name="first_name" id="first_name" class="form-control" value="<?php echo $patient['first_name'];?>" placeholder="Nume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Prenume</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" readonly name="last_name" id="last_name" class="form-control" value="<?php echo $patient['last_name'];?>" placeholder="Prenume">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">CNP</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" readonly name="cnp" id="cnp" class="form-control" value="<?php echo $patient['cnp'];?>" placeholder="CNP">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="email_address_2">Telefon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input type="text" readonly name="phone" id="phone" class="form-control" value="<?php echo $patient['phone'];?>" placeholder="Telefon">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Data Nasterii</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input readonly type="text" name="born_date" id="born_date" class="form-control" value="<?php echo $patient['born_date'];?>" placeholder="AAAA - LL - ZZ">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Domiciliu</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input readonly type="text" name="residence" id="residence" class="form-control" value="<?php echo $patient['residence'];?>" placeholder="Domiciliu">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Cetatenie</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <input readonly type="text" name="nationality" id="nationality" value="<?php echo $patient['nationality'];?>" class="form-control" placeholder="Cetatenie">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Ocupatie</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select disabled id="occupation" name="occupation" class="form-control show-tick" data-live-search="false">
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
                <select disabled id="training_level" name="training_level" class="form-control show-tick" data-live-search="false">
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
                <select disabled id="insurance" name="insurance" class="form-control show-tick" data-live-search="false">
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
                <select disabled id="cnas_type_insurance" name="cnas_type_insurance" class="form-control show-tick" data-live-search="false">
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
                <select disabled id="cnas_category_insurance" name="cnas_category_insurance" class="form-control show-tick" data-live-search="false">
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
                  <input readonly type="text" name="job" id="job" class="form-control" value="<?php echo $patient['job'];?>" placeholder="Loc de Munca">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Grup Sangvin</label>
              </div>
              <div class="col-lg-4 col-md-10 col-sm-8">
                <select disabled id="blood_type" name="blood_type" class="form-control show-tick" data-live-search="false">
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
                <select disabled id="rh" name="rh" class="form-control show-tick" data-live-search="false">
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
                  <input readonly type="text" name="born_weight" id="born_weight" class="form-control" value="<?php echo $patient['born_weight'];?>" placeholder="Greutate la nastere">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Mediul U/R</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select disabled id="environment" name="environment" class="form-control show-tick" data-live-search="false">
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
                  <input disabled id="hospitalized" type="checkbox" <?php if($patient['hospitalized'] == 1) echo "checked";?>>
                  <label for="hospitalized">
                    Spitalizat
                  </label>
                </div>
              </div>
            </div>
            <div class="row clearfix" id="salon_id_div">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="salon_id">Salon</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="salon_id" disabled name="salon_id" class="form-control show-tick" data-live-search="false">
                  <?php foreach ($salons as $salon): ?>
                  <option value="<?php echo $salon['salon_id'];?>" <?php if($salon['salon_id'] == $patient['salon_id']){echo "selected='selected'";}?>><?php echo $salon['department_name']." - ".$salon['salon_name'];?>
                    <?php endforeach;?>
                </select>
              </div>
            </div>
            <?php echo form_open('observation_records/process_request',array("id"=>"edit_observation_record_form")); ?>
            <input type="hidden" id="operation" name="operation" value="edit"/>
            <input type="hidden" id="observation_record_id" name="observation_record_id" value="<?php echo $observation_record['observation_record_id']?>"/>

            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Data deschidere fisa</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="zmdi zmdi-calendar"></i>
                  </span>
                  <input type="text" name="date_open" id="date_open"
                         value="<?php echo $observation_record['date_open']?>"
                         class="form-control datetimepicker" placeholder="Selectati data si ora deschiderii fisei...">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Data inchidere fisa</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="input-group">
                  <span class="input-group-addon">
                      <i class="zmdi zmdi-calendar"></i>
                  </span>
                  <input type="text" name="date_close" id="date_close"
                         value="<?php echo $observation_record['date_close']?>"
                         class="form-control datetimepicker" placeholder="Selectati data si ora inchiderii fisei...">
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Tipul Internarii</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="hospitalized_type" name="hospitalized_type" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$observation_record['hospitalized_type']) echo "selected='selected'"?>>Urgenta
                  <option value="2" <?php if(2==$observation_record['hospitalized_type']) echo "selected='selected'"?>>Trimitere Medic Fam.
                  <option value="3" <?php if(3==$observation_record['hospitalized_type']) echo "selected='selected'"?>>Trimitere Ambulatoriu
                  <option value="4" <?php if(4==$observation_record['hospitalized_type']) echo "selected='selected'"?>>Transfer Interspitalicesc
                  <option value="5" <?php if(5==$observation_record['hospitalized_type']) echo "selected='selected'"?>>La cerere
                  <option value="6" <?php if(6==$observation_record['hospitalized_type']) echo "selected='selected'"?>>Altceva
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Criteriu Internare</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="hospitalized_cause" name="hospitalized_cause" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Urgenta
                  <option value="2" <?php if(2==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Diagnostic
                  <option value="3" <?php if(3==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Tratament
                  <option value="4" <?php if(4==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Nedeplasabil
                  <option value="5" <?php if(5==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Epidemiologic
                  <option value="6" <?php if(6==$observation_record['hospitalized_cause']) echo "selected='selected'"?>>Medic Sef
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="description">Diagnosticul de trimitere</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <textarea rows="4" class="form-control no-resize" id="reference_diagnostic"
                            name="reference_diagnostic" placeholder="Diagnosticul de trimitere..."><?php echo $observation_record['reference_diagnostic'];?></textarea>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="description">Diagnosticul la internare</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <textarea rows="4" class="form-control no-resize" id="hospitalized_diagnostic"
                            name="hospitalized_diagnostic" placeholder="Diagnosticul la internare..."><?php echo $observation_record['hospitalized_diagnostic'];?></textarea>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="description">Diagnosticul principal la externare</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <textarea rows="4" class="form-control no-resize" id="discharge_diagnostic"
                            name="discharge_diagnostic" placeholder="Diagnosticul principal la externare..."><?php echo $observation_record['discharge_diagnostic'];?></textarea>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label for="description">Diagnostice secundare la externare</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <div class="form-group">
                  <textarea rows="4" class="form-control no-resize" id="sec_discharge_diagnostic"
                            name="sec_discharge_diagnostic" placeholder="Diagnosticul secundar la externare (complicatii / comorbiditati)..."><?php echo $observation_record['sec_discharge_diagnostic'];?></textarea>
                </div>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Starea la externare</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="discharge_status" name="discharge_status" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$observation_record['discharge_status']) echo "selected='selected'"?>>Vindecat
                  <option value="2" <?php if(2==$observation_record['discharge_status']) echo "selected='selected'"?>>Ameliorat
                  <option value="3" <?php if(3==$observation_record['discharge_status']) echo "selected='selected'"?>>Stationar
                  <option value="4" <?php if(4==$observation_record['discharge_status']) echo "selected='selected'"?>>Agravat
                  <option value="5" <?php if(5==$observation_record['discharge_status']) echo "selected='selected'"?>>Decedat
                </select>
              </div>
            </div>
            <div class="row clearfix">
              <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                <label >Tipul externarii</label>
              </div>
              <div class="col-lg-10 col-md-10 col-sm-8">
                <select id="discharge_type" name="discharge_type" class="form-control show-tick" data-live-search="false">
                  <option value="1" <?php if(1==$observation_record['discharge_type']) echo "selected='selected'"?>>Externat
                  <option value="2" <?php if(2==$observation_record['discharge_type']) echo "selected='selected'"?>>Externat la cerere
                  <option value="3" <?php if(3==$observation_record['discharge_type']) echo "selected='selected'"?>>Transfer interspitalicesc
                  <option value="4" <?php if(4==$observation_record['discharge_type']) echo "selected='selected'"?>>Decedat
                </select>
              </div>
            </div>
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#surgery_tab">Interventii Chirurgicale</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#clinical_tab">Examen Clinic General</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#laboratory_tab">Examen de Laborator</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#oncology_tab">Examen Oncologic</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#radiological_tab">Examen Radiologic</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#ultrasound_tab">Examen Ecografic</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#other_exams_tab">Alte Examinari</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#death_tab">Decedat</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#others_info">Alte Observatii</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane in active" id="surgery_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Interventie chirurgicala principala</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="main_surgery"
                                  name="main_surgery" placeholder="Interventie chirurgicala principala..."><?php echo $main_surgery;?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix" style="margin-bottom: 10px;">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label>Echipa operatorie</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <?php
                      echo "<select class='form-control show-tick' data-live-search='false' id='personal_main_surgery' name='personal_main_surgery[]' multiple='multiple'>";
                      foreach ($personal as $p){
                        if (in_array($p, $personal_main_surgery)) {
                          echo "<option selected='selected' value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                        else {
                          echo "<option value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                      }
                      echo "</select>";
                      ?>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label>Data interventiei chirurgicale</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="input-group">
                  <span class="input-group-addon">
                      <i class="zmdi zmdi-calendar"></i>
                  </span>
                        <input type="text" name="date_main_surgery" id="date_main_surgery"
                               value="<?php echo $date_main_surgery?>"
                               class="form-control datetimepicker" placeholder="Selectati data si ora interventiei chirurgicale...">
                      </div>
                    </div>
                  </div>

                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Interventie chirurgicala concomitenta</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="concurrent_surgery"
                                  name="concurrent_surgery" placeholder="Interventie chirurgicala concomitenta..."><?php echo $concurrent_surgery;?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix" style="margin-bottom: 10px;">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Echipa operatorie</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <?php
                      echo "<select class='form-control show-tick' data-live-search='false' id='personal_concurrent_surgery' name='personal_concurrent_surgery[]' multiple='multiple'>";
                      foreach ($personal as $p){
                        if (in_array($p, $personal_concurrent_surgery)) {
                          echo "<option selected='selected' value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                        else {
                          echo "<option value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                      }
                      echo "</select>";
                      ?>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Data interventiei chirurgicale</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="input-group">
                  <span class="input-group-addon">
                      <i class="zmdi zmdi-calendar"></i>
                  </span>
                        <input type="text" name="date_concurrent_surgery" id="date_concurrent_surgery"
                               value="<?php echo $date_concurrent_surgery;?>"
                               class="form-control datetimepicker" placeholder="Selectati data si ora interventiei chirurgicale...">
                      </div>
                    </div>
                  </div>

                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Alta interventie chirurgicala</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="other_surgery"
                                  name="other_surgery" placeholder="Alta interventie chirurgicala..."><?php echo $other_surgery;?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix" style="margin-bottom: 10px;">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Echipa operatorie</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <?php
                      echo "<select class='form-control show-tick' data-live-search='false' id='personal_other_surgery' name='personal_other_surgery[]' multiple='multiple'>";
                      foreach ($personal as $p){
                        if (in_array($p, $personal_other_surgery)) {
                          echo "<option selected='selected' value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                        else {
                          echo "<option value='".$p['user_id']."'>".$p['first_name']." ".$p['last_name']."(".$p['role_name'].")</option>";
                        }
                      }
                      echo "</select>";
                      ?>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Data interventiei chirurgicale</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="input-group">
                  <span class="input-group-addon">
                      <i class="zmdi zmdi-calendar"></i>
                  </span>
                        <input type="text" name="date_other_surgery" id="date_other_surgery"
                               value="<?php echo $date_other_surgery;?>"
                               class="form-control datetimepicker" placeholder="Selectati data si ora interventiei chirurgicale...">
                      </div>
                    </div>
                  </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="clinical_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Clinic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="clinical_general_exam"
                                  name="clinical_general_exam" placeholder="Examenul clinic general..."><?php echo json_decode($observation_record['general_exam'], true)['clinical'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Starea Generala</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="status_general_exam" id="status_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['status'];?>"
                               class="form-control" placeholder="Starea Generala">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Talie</label>
                    </div>
                    <div class="col-lg-4 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="height_general_exam" id="height_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['height'];?>"
                               class="form-control" placeholder="Talie">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Greutate</label>
                    </div>
                    <div class="col-lg-4 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="weight_general_exam" id="weight_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['weight'];?>"
                               class="form-control" placeholder="Greutate (kg)">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Stare de nutritie</label>
                    </div>
                    <div class="col-lg-4 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="nutrition_general_exam" id="nutrition_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['nutrition'];?>"
                               class="form-control" placeholder="Stare de nutritie">
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Stare de constienta</label>
                    </div>
                    <div class="col-lg-4 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="conscious_general_exam" id="conscious_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['conscious'];?>"
                               class="form-control" placeholder="Stare de constienta">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Tegumente</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="skin_general_exam" id="skin_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['skin'];?>"
                               class="form-control" placeholder="Tegumente">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Mucoase</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="mucous_general_exam" id="mucous_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['mucous'];?>"
                               class="form-control" placeholder="Mucoase">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Fanere</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="appendages_general_exam" id="appendages_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['appendages'];?>"
                               class="form-control" placeholder="Fanere">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Tesut conjunctiv-adipos</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="connective_tissue_general_exam" id="connective_tissue_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['connective_tissue'];?>"
                               class="form-control" placeholder="Tesut conjunctiv-adipos">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Sistem ganglionar</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="ganglia_system_general_exam" id="ganglia_system_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['ganglia_system'];?>"
                               class="form-control" placeholder="Sistem ganglionar">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Sistem muscular</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="muscle_tissue_general_exam" id="muscle_tissue_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['muscle_tissue'];?>"
                               class="form-control" placeholder="Sistem muscular">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Sistem osteo-articular</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="articular_system_general_exam" id="articular_system_general_exam"
                               value="<?php echo json_decode($observation_record['general_exam'], true)['articular_system'];?>"
                               class="form-control" placeholder="Sistem osteo-articular">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Aparat Respirator</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="respiratory_device_general_exam"
                                  name="respiratory_device_general_exam" placeholder="Aparat respirator..."><?php echo json_decode($observation_record['general_exam'], true)['respiratory_device'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Aparat Cardiovascular</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="cardiovascular_device_general_exam"
                                  name="cardiovascular_device_general_exam" placeholder="Aparat cardiovascular..."><?php echo json_decode($observation_record['general_exam'], true)['cardiovascular_device'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Aparat Digestiv</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="digestive_device_general_exam"
                                  name="digestive_device_general_exam" placeholder="Aparat digestiv..."><?php echo json_decode($observation_record['general_exam'], true)['digestive_device'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Ficat, cai biliare, splina</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="digestive_system_general_exam"
                                  name="digestive_system_general_exam" placeholder="Ficat, cai biliare, splina..."><?php echo json_decode($observation_record['general_exam'], true)['digestive_system'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Aparat uro-genital</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="urogenital_device_general_exam"
                                  name="urogenital_device_general_exam" placeholder="Aparat uro-genital..."><?php echo json_decode($observation_record['general_exam'], true)['urogenital_device'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Sistem nervos, endocrin, organe de simt</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="nervous_system_general_exam"
                                  name="nervous_system_general_exam" placeholder="Sistem nervos, endocrin, organe de simt..."><?php echo json_decode($observation_record['general_exam'], true)['nervous_system'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="laboratory_tab">
                  <?php
                  $index = 0;
                  foreach ($analysis_array as $analysis) {
                    echo '
                    <div class="row clearfix">
                      <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                        <label >'.$analysis["label"].'</label>
                      </div>
                      <div class="col-lg-8 col-md-10 col-sm-8">
                        <div class="form-group">
                          <input type="text" name="'.$analysis["id"].'" id="'.$analysis["id"].'"
                                 value="'.$patient_analysis[$index]['value'].'"
                                 class="form-control" placeholder="'.$analysis["label"].'">
                        </div>
                      </div>
                      <div class="col-lg-2 col-md-10 col-sm-8">
                        <p style="float: right;">'.$analysis["unit"].'</p>
                      </div>
                    </div>';
                    $index++;
                  }
                  ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="oncology_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Cavitate bucala</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="oral_cavity_oncology" id="oral_cavity_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['oral_cavity'];?>"
                               class="form-control" placeholder="Cavitate bucala">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Tegumente</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="skin_oncology" id="skin_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['skin'];?>"
                               class="form-control" placeholder="Tegumente">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Grupe ganglioni palpabile</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="ganglia_oncology" id="ganglia_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['ganglia'];?>"
                               class="form-control" placeholder="Grupe ganglioni palpabile">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >San</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="breast_oncology" id="breast_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['breast'];?>"
                               class="form-control" placeholder="San">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Organe genitale feminine</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="genital_organs_oncology" id="genital_organs_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['genital_organs'];?>"
                               class="form-control" placeholder="Organe genitale feminine">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Citologia secretiei vaginale</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="cytology_oncology" id="cytology_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['cytology'];?>"
                               class="form-control" placeholder="Citologia secretiei vaginale">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Prostata si rect</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="prostate_oncology" id="prostate_oncology"
                               value="<?php echo json_decode($observation_record['oncology_exam'], true)['prostate'];?>"
                               class="form-control" placeholder="Prostata si rect">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Alte</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="others_oncology"
                                  name="others_oncology" placeholder="Alte..."><?php echo json_decode($observation_record['oncology_exam'], true)['others'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="radiological_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Radiologic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="radiological_exam"
                                  name="radiological_exam" placeholder="Examen Radiologic..."><?php echo $observation_record['radiological_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="ultrasound_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Ecografic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="ultrasound_exam"
                                  name="ultrasound_exam" placeholder="Examen Ecografic..."><?php echo $observation_record['ultrasound_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="other_exams_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Citologic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="cytological_exam"
                                  name="cytological_exam" placeholder="Examen Citologic..."><?php echo $observation_record['cytological_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Histopatologic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="histopathological_exam"
                                  name="histopathological_exam" placeholder="Examen Histopatologic..."><?php echo $observation_record['histopathological_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Extemporaneu</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="extemporaneously_exam"
                                  name="extemporaneously_exam" placeholder="Examen Extemporaneu..."><?php echo $observation_record['extemporaneously_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Examen Anatomo-Patologic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="anatomopathological_exam"
                                  name="anatomopathological_exam" placeholder="Examen Anatomo-Patologic..."><?php echo $observation_record['anatomopathological_exam'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="death_tab">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Diagnostic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="diagnostic_death"
                                  name="diagnostic_death" placeholder="Diagnosticul in caz de deces..."><?php echo $observation_record['diagnostic_death'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Codul Morfologic</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="morphological_code" id="morphological_code"
                               value="<?php $observation_record['morphological_code']?>"
                               class="form-control" placeholder="Codul morfologic (in caz de cancer)">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Explorari Functionale</label>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="functional_explorations_name" id="functional_explorations_name"
                               value="<?php echo json_decode($observation_record['functional_explorations'], true)['name'];?>"
                               class="form-control" placeholder="Denumirea">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="functional_explorations_code" id="functional_explorations_code"
                               value="<?php echo json_decode($observation_record['functional_explorations'], true)['code'];?>"
                               class="form-control" placeholder="Codul">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="functional_explorations_nr" id="functional_explorations_nr"
                               value="<?php echo json_decode($observation_record['functional_explorations'], true)['nr'];?>"
                               class="form-control" placeholder="Nr.">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Investigatii Radiologice</label>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="radiological_investigations_name" id="radiological_investigations_name"
                               value="<?php echo json_decode($observation_record['radiological_investigations'], true)['name'];?>"
                               class="form-control" placeholder="Denumirea">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="radiological_investigations_code" id="radiological_investigations_code"
                               value="<?php echo json_decode($observation_record['radiological_investigations'], true)['code'];?>"
                               class="form-control" placeholder="Codul">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="radiological_investigations_nr" id="radiological_investigations_nr"
                               value="<?php echo json_decode($observation_record['radiological_investigations'], true)['nr'];?>"
                               class="form-control" placeholder="Nr.">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Alte proceduri terapeutice</label>
                    </div>
                    <div class="col-lg-6 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="therapeutic_procedures_name" id="therapeutic_procedures_name"
                               value="<?php echo json_decode($observation_record['therapeutic_procedures'], true)['name'];?>"
                               class="form-control" placeholder="Denumirea">
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="therapeutic_procedures_code" id="therapeutic_procedures_code"
                               value="<?php echo json_decode($observation_record['therapeutic_procedures'], true)['code'];?>"
                               class="form-control" placeholder="Codul">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-10 col-sm-8">
                      <div class="form-group">
                        <input type="text" name="therapeutic_procedures_nr" id="therapeutic_procedures_nr"
                               value="<?php echo json_decode($observation_record['therapeutic_procedures'], true)['nr'];?>"
                               class="form-control" placeholder="Nr.">
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Deces</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <select id="death_status" name="death_status" class="form-control show-tick" data-live-search="false">
                        <option value="1" <?php if(1==$observation_record['death']) echo "selected='selected'"?>>Intraoperator
                        <option value="2" <?php if(2==$observation_record['death']) echo "selected='selected'"?>>Postoperator 0 - 23 ore
                        <option value="3" <?php if(3==$observation_record['death']) echo "selected='selected'"?>>Postoperator 24 - 47 ore
                        <option value="4" <?php if(4==$observation_record['death']) echo "selected='selected'"?>>Postoperator > 48 ore
                      </select>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label >Data si ora decesului</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-calendar"></i>
                        </span>
                        <input type="text" name="death_date" id="death_date"
                               value="<?php echo $observation_record['death_date'];?>"
                               class="form-control datetimepicker" placeholder="Selectati data si ora decesului...">
                      </div>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="others_info">
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Motivele Internarii</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="hospitalized_reason_others_info"
                                  name="hospitalized_reason_others_info" placeholder="Motivele Internarii..."><?php echo json_decode($observation_record['others_info'], true)['hospitalized_reason'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Anamneza</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="anamneza_others_info"
                                  name="anamneza_others_info" placeholder="Anamneza..."><?php echo json_decode($observation_record['others_info'], true)['anamneza'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Istoricul Bolii</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="disease_history_others_info"
                                  name="disease_history_others_info" placeholder="Istoricul bolii..."><?php echo json_decode($observation_record['others_info'], true)['disease_history'];?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-4 form-control-label">
                      <label for="description">Epicriza</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-8">
                      <div class="form-group">
                        <textarea rows="4" class="form-control no-resize" id="epicrisis_others_info"
                                  name="epicrisis_others_info" placeholder="Epicriza..."><?php echo json_decode($observation_record['others_info'], true)['epicrisis'];?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div>
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#temperature_sheet">Foaie de Temperatura</a></li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content" id="temperature_tab">

                <div role="tabpanel" class="tab-pane active" id="temperature_sheet">
                  <div class="row clearfix">
                    <div class="col-lg-4 col-md-2 col-sm-4 form-control-label">
                      <label >Data Format (AAAA-LL-ZZ HH:MM)</label>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                      <label>Respiratie</label>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                      <label>TA</label>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                      <label>Puls</label>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4 form-control-label">
                      <label>Temperatura</label>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-4 form-control-label">
                      <label>Lichide ingerate</label>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-4 form-control-label">
                      <label>Diureze</label>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-4 form-control-label">
                      <label>Scaune</label>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-4 form-control-label">
                      <label>Dieta</label>
                    </div>
                  </div>
                  <?php
                  for ($i = 1; $i <= count($temperature_data_array); $i++) {
                    echo '
                  <div class="row clearfix">
                    <div class="col-lg-4 col-md-2 col-sm-4">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-calendar"></i>
                        </span>
                        <input type="text" name="temp_date_'.$i.'" id="temp_date_'.$i.'" value="'.$temperature_data_array[$i-1]['date'].'" class="form-control" placeholder="Selectati data si ora setului de date (AAAA-LL-ZZ HH:MM)">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="breath_'.$i.'" id="breath_'.$i.'" value="'.$temperature_data_array[$i-1]['breath'].'" class="form-control" placeholder="Respiratie">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="ta_'.$i.'" id="ta_'.$i.'" value="'.$temperature_data_array[$i-1]['ta'].'" class="form-control" placeholder="TA">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="pulse_'.$i.'" id="pulse_'.$i.'" value="'.$temperature_data_array[$i-1]['pulse'].'" class="form-control" placeholder="Puls">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="temperature_'.$i.'" id="temperature_'.$i.'" value="'.$temperature_data_array[$i-1]['temperature'].'" class="form-control" placeholder="Temperatura (Grade Celsius)">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="liquid_'.$i.'" id="liquid_'.$i.'" value="'.$temperature_data_array[$i-1]['liquid'].'" class="form-control" placeholder="Lichide">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="diuresis_'.$i.'" id="diuresis_'.$i.'" value="'.$temperature_data_array[$i-1]['diuresis'].'" class="form-control" placeholder="Diuretice">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="shit_'.$i.'" id="shit_'.$i.'" value="'.$temperature_data_array[$i-1]['shit'].'" class="form-control" placeholder="Scaune">
                      </div>
                    </div>
                    <div class="col-lg-1 col-md-2 col-sm-4">
                      <div class="form-group">
                        <input type="text" name="diet_'.$i.'" id="diet_'.$i.'" value="'.$temperature_data_array[$i-1]['diet'].'" class="form-control" placeholder="Diete">
                      </div>
                    </div>
                  </div>';
                  if (count($temperature_data_array) == $i) {
                  echo '
                  <div class="row clearfix">
                    <div class="col-sm-12">
                      <button class="add_temperature_set btn btn-raised btn-default btn-round waves-effect col-sm-12">ADAUGA UN NOU SET DE DATE PENTRU DATA SI ORA PREZENTA</button>
                    </div>
                  </div>
                  ';
                  }
                  }
            ?>
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


