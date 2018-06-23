<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patients extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('patients__index','patients/patients_view');

  }

  public function add() {

    $this->load->helper('ui_regions');
    $data['salons'] = $this->salons_model->get_patients_salons();
    $data['analysis_array'] = get_analysis_array();
    $data['personal'] = $this->users_model->get_users();
    write_view('patients__add','patients/patients_add_view', $data);

  }
  public function edit($patient_id) {

    $patient = $this->patients_model->get_row_array($patient_id);
    $data['patient'] = $patient;
    $data['salons'] = $this->salons_model->get_patients_salons();
    $this->load->helper('ui_regions');
    write_view('patients__edit','patients/patients_edit_view', $data);

  }
  public function details($patient_id) {

    $patient = $this->patients_model->get_row_array($patient_id);
    $data['patient'] = $patient;
    $data['salons'] = $this->salons_model->get_patients_salons();
    $this->load->helper('ui_regions');
    write_view('patients__details','patients/patients_details_view', $data);

  }

  public function process_request() {

    $operation = $this->input->post('operation');
    switch ($operation) {
      case 'add':
        $this->_do_add();
        break;
      case 'edit':
        $this->_do_edit();
        break;
      case 'delete':
        $this->_do_delete();
        break;
      case 'other':
        break;
      default:
        break;
    }

  }

  public function get_grid(){

    $params = [
      'page' => intval($this->input->post("page")),
      'limit' => intval($this->input->post("rows")),
      'sort_by' => $this->input->post("sidx"),
      'sort_direction' => $this->input->post("sord")
    ];

    $params['search'] = [];
    if ($this->input->post("_search") == 'true') {
      $params['search'] = [
        'field' => $this->input->post("searchField"),
        'op' => $this->input->post("searchOper"),
        'value' => $this->input->post("searchString"),
        'filters' => empty($this->input->post("filters")) ? '' : $this->input->post("filters")
      ];
    }
    $results = $this->patients_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['patient_id'];
      $response->rows[$i]['cell'] = [
        $row['patient_id'],
        $row['first_name'],
        $row['last_name'],
        $row['cnp'],
        $row['phone'],
        $row['hospitalized'],
        $row['department_name'],
        $row['salon_name']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_patient_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $gender = $this->input->post('gender');
    $cnp = $this->input->post('cnp');
    $phone = $this->input->post('phone');
    $born_date = $this->input->post('born_date');
    $residence = $this->input->post('residence');
    $nationality = $this->input->post('nationality');
    $occupation = $this->input->post('occupation');
    $training_level = $this->input->post('training_level');
    $insurance = $this->input->post('insurance');
    $cnas_type_insurance = intval($this->input->post('cnas_type_insurance'));
    $cnas_category_insurance = intval($this->input->post('cnas_category_insurance'));
    $job = $this->input->post('job');
    $blood_type = intval($this->input->post('blood_type'));
    $rh = intval($this->input->post('rh'));
    $born_weight = $this->input->post('born_weight');
    $environment = intval($this->input->post('environment'));

    if (!check_date($born_date)) {
      echo json_encode(array('code'=>'0','msg'=>'Data nasterii este invalida.'));
      return;
    }

    $hospitalized = $this->input->post('hospitalized');
    $salon_id = intval($this->input->post('salon_id'));
    if ($hospitalized) {
      if (!$this->salons_model->exist_item($salon_id)) {
        echo json_encode(array('code'=>'0','msg'=>'Invalid salon!'));
        return;
      }
      if (!$this->salons_model->have_space($salon_id)) {
        echo json_encode(array('code'=>'0','msg'=>'Acest salon nu mai are locuri libere.'));
        return;
      }
    }
    else {
      $salon_id = 0;
    }

    $patient_data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'gender' => $gender,
      'cnp' => $cnp,
      'phone' => $phone,
      'hospitalized' => $hospitalized,
      'salon_id' => $salon_id,
      'born_date' => $born_date,
      'residence' => $residence,
      'nationality' => $nationality,
      'occupation' => $occupation,
      'training_level' => $training_level,
      'insurance' => $insurance,
      'cnas_type_insurance' => $cnas_type_insurance,
      'cnas_category_insurance' => $cnas_category_insurance,
      'job' => $job,
      'blood_type' => $blood_type,
      'rh' => $rh,
      'born_weight' => $born_weight,
      'environment' => $environment
    );
    $patient_id = $this->patients_model->insert($patient_data);

    $message = '';
    if ($patient_id > 0) {
      set_action('patients_add', $patient_data);
      $message .= 'Pacientul '.$first_name.' '.$last_name.' a fost adaugat cu succes. ';
    }
    else{
      echo json_encode(array('code' => '0','msg' => 'Pacientul '.$first_name.' '.$last_name.' nu a fost adaugat din cauza unei erori.'));
      return;
    }

    if ($hospitalized) {

      $date_open = get_date($this->input->post('date_open'));
      $date_close = get_date($this->input->post('date_close'));
      $hospitalized_type = $this->input->post('hospitalized_type');
      $hospitalized_cause = $this->input->post('hospitalized_cause');
      $hospitalized_diagnostic = $this->input->post('hospitalized_diagnostic');
      $reference_diagnostic = $this->input->post('reference_diagnostic');
      $discharge_diagnostic = $this->input->post('discharge_diagnostic');
      $sec_discharge_diagnostic = $this->input->post('sec_discharge_diagnostic');
      $discharge_status = $this->input->post('discharge_status');
      $discharge_type = $this->input->post('discharge_type');
      $death_status = $this->input->post('death_status');
      $death_date = get_date($this->input->post('death_date'));
      $diagnostic_death = $this->input->post('diagnostic_death');
      $morphological_code = $this->input->post('morphological_code');
      $functional_exploration_data = array(
        'name' => $this->input->post('functional_explorations_name'),
        'code' => $this->input->post('functional_explorations_code'),
        'nr' => $this->input->post('radiological_investigations_nr')
      );
      $radiological_investigations_data = array(
        'name' => $this->input->post('radiological_investigations_name'),
        'code' => $this->input->post('radiological_investigations_code'),
        'nr' => $this->input->post('radiological_investigations_nr')
      );
      $therapeutic_procedures_data = array(
        'name' => $this->input->post('therapeutic_procedures_name'),
        'code' => $this->input->post('therapeutic_procedures_code'),
        'nr' => $this->input->post('therapeutic_procedures_nr')
      );

      $main_surgery = $this->input->post('main_surgery');
      $personal_main_surgery_array = $this->input->post('personal_main_surgery');
      if (!isset($personal_main_surgery_array)) {
        $personal_main_surgery_array = array();
      }
      $personal_main_surgery = array_map('intval', $personal_main_surgery_array);
      $date_main_surgery = $this->input->post('date_main_surgery');
      $main_surgery_data = $date_main_surgery."#";
      foreach ($personal_main_surgery as $p){
        $main_surgery_data .= "|".$p."|";
      }
      $main_surgery_data = str_replace("||","|",$main_surgery_data);
      $main_surgery_data .= "#".$main_surgery;

      $concurrent_surgery = $this->input->post('concurrent_surgery');
      $personal_concurrent_surgery_array = $this->input->post('personal_concurrent_surgery');
      if (!isset($personal_concurrent_surgery_array)) {
        $personal_concurrent_surgery_array = array();
      }
      $personal_concurrent_surgery = array_map('intval', $personal_concurrent_surgery_array);
      $date_concurrent_surgery = $this->input->post('date_concurrent_surgery');
      $concurrent_surgery_data = $date_concurrent_surgery."#";
      foreach ($personal_concurrent_surgery as $p){
        $concurrent_surgery_data .= "|".$p."|";
      }
      $concurrent_surgery_data = str_replace("||","|",$concurrent_surgery_data);
      $concurrent_surgery_data .= "#".$concurrent_surgery;

      $other_surgery = $this->input->post('other_surgery');
      $personal_other_surgery_array = $this->input->post('personal_other_surgery');
      if (!isset($personal_other_surgery_array)) {
        $personal_other_surgery_array = array();
      }
      $personal_other_surgery = array_map('intval', $personal_other_surgery_array);
      $date_other_surgery = $this->input->post('date_other_surgery');
      $other_surgery_data = $date_other_surgery."#";
      foreach ($personal_other_surgery as $p){
        $other_surgery_data .= "|".$p."|";
      }
      $other_surgery_data = str_replace("||","|",$other_surgery_data);
      $other_surgery_data .= "#".$other_surgery;
      $cytological_exam = $this->input->post('cytological_exam');
      $extemporaneously_exam = $this->input->post('extemporaneously_exam');
      $histopathological_exam = $this->input->post('histopathological_exam');

      $general_exam_data = array(
        'clinical' => $this->input->post('clinical_general_exam'),
        'status' => $this->input->post('status_general_exam'),
        'height' => $this->input->post('height_general_exam'),
        'weight' => $this->input->post('weight_general_exam'),
        'nutrition' => $this->input->post('nutrition_general_exam'),
        'conscious' => $this->input->post('conscious_general_exam'),
        'skin' => $this->input->post('skin_general_exam'),
        'mucous' => $this->input->post('mucous_general_exam'),
        'appendages' => $this->input->post('appendages_general_exam'),
        'connective_tissue' => $this->input->post('connective_tissue_general_exam'),
        'ganglia_system' => $this->input->post('ganglia_system_general_exam'),
        'muscle_tissue' => $this->input->post('muscle_tissue_general_exam'),
        'articular_system' => $this->input->post('articular_system_general_exam'),
        'respiratory_device' => $this->input->post('respiratory_device_general_exam'),
        'cardiovascular_device' => $this->input->post('cardiovascular_device_general_exam'),
        'digestive_device' => $this->input->post('digestive_device_general_exam'),
        'digestive_system' => $this->input->post('digestive_system_general_exam'),
        'urogenital_device' => $this->input->post('urogenital_device_general_exam'),
        'nervous_system' => $this->input->post('nervous_system_general_exam')
      );
      $oncology_exam_data = array(
        'oral_cavity' => $this->input->post('oral_cavity_oncology'),
        'skin' => $this->input->post('skin_oncology'),
        'ganglia' => $this->input->post('ganglia_oncology'),
        'breast' => $this->input->post('breast_oncology'),
        'genital_organs' => $this->input->post('genital_organs_oncology'),
        'cytology' => $this->input->post('cytology_oncology'),
        'prostate' => $this->input->post('prostate_oncology'),
        'others' => $this->input->post('others_oncology')
      );
      $radiological_exam = $this->input->post('radiological_exam');
      $ultrasound_exam = $this->input->post('ultrasound_exam');
      $anatomopathological_exam = $this->input->post('anatomopathological_exam');
      $others_info_data = array(
        'hospitalized_reason' => $this->input->post('hospitalized_reason_others_info'),
        'anamneza' => $this->input->post('anamneza_others_info'),
        'disease_history' => $this->input->post('disease_history_others_info'),
        'epicrisis' => $this->input->post('epicrisis_others_info')
      );

      $temperature_sheet_array = $this->input->post('temperature_sheet_array');

      $analysis_array = $this->input->post('analysis_array');
      $laboratory_exam = array();
      foreach ($analysis_array as $analysis) {
        $analysis_aux = array(
          'id' => $analysis['id'],
          'value' => $analysis['value']
        );
        array_push($laboratory_exam, $analysis_aux);
      }


      $observation_record_data = array(
        'patient_id' => $patient_id,
        'date_open' => $date_open,
        'date_close' => $date_close,
        'hospitalized_type' => $hospitalized_type,
        'hospitalized_cause' => $hospitalized_cause,
        'hospitalized_diagnostic' => $hospitalized_diagnostic,
        'reference_diagnostic' => $reference_diagnostic,
        'discharge_diagnostic' => $discharge_diagnostic,
        'sec_discharge_diagnostic' => $sec_discharge_diagnostic,
        'main_surgery' => $main_surgery_data,
        'concurrent_surgery' => $concurrent_surgery_data,
        'other_surgery' => $other_surgery_data,
        'discharge_status' => $discharge_status,
        'discharge_type' => $discharge_type,
        'death' => $death_status,
        'death_date' => $death_date,
        'diagnostic_death' => $diagnostic_death,
        'morphological_code' => $morphological_code,
        'functional_explorations' => json_encode($functional_exploration_data),
        'radiological_investigations' => json_encode($radiological_investigations_data),
        'therapeutic_procedures' => json_encode($therapeutic_procedures_data),
        'cytological_exam' => $cytological_exam,
        'extemporaneously_exam' => $extemporaneously_exam,
        'histopathological_exam' => $histopathological_exam,
        'general_exam' => json_encode($general_exam_data),
        'oncology_exam' => json_encode($oncology_exam_data),
        'laboratory_exam' => json_encode($laboratory_exam),
        'radiological_exam' => $radiological_exam,
        'ultrasound_exam' => $ultrasound_exam,
        'anatomopathological_exam' => $anatomopathological_exam,
        'others_info' => json_encode($others_info_data),
        'progress_diagnostic_sheet' => '',
        'temperature_sheet' => json_encode($temperature_sheet_array),
        'discount_sheet' => ''
      );

      $observation_record_id = $this->observation_records_model->insert($observation_record_data);
      if ($observation_record_id > 0) {
        $message .= 'Foaia de observatie a fost adaugata cu succes.';
      }
      else {
        $message .= 'Din cauza unei erori foaia de observatie nu a putut fi adauga cu succes.';
      }
      echo json_encode(array('code'=>'1', 'msg' => $message));
      return;
    }
    else{
      echo json_encode(array('code'=>'1', 'msg' => $message));
      return;
    }



  }

  public function _do_edit(){

    $patient_id = intval($this->input->post('patient_id'));

    if ($this->form_validation->run('edit_patient_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $gender = $this->input->post('gender');
    $cnp = $this->input->post('cnp');
    $phone = $this->input->post('phone');
    $born_date = $this->input->post('born_date');
    $residence = $this->input->post('residence');
    $nationality = $this->input->post('nationality');
    $occupation = $this->input->post('occupation');
    $training_level = $this->input->post('training_level');
    $insurance = $this->input->post('insurance');
    $cnas_type_insurance = intval($this->input->post('cnas_type_insurance'));
    $cnas_category_insurance = intval($this->input->post('cnas_category_insurance'));
    $job = $this->input->post('job');
    $blood_type = intval($this->input->post('blood_type'));
    $rh = intval($this->input->post('rh'));
    $born_weight = $this->input->post('born_weight');
    $environment = intval($this->input->post('environment'));

    if (!check_date($born_date)) {
      echo json_encode(array('code'=>'0','msg'=>'Data nasterii este invalida.'));
      return;
    }

    $hospitalized = $this->input->post('hospitalized');
    $salon_id = intval($this->input->post('salon_id'));
    if ($hospitalized) {
      if (!$this->salons_model->exist_item($salon_id)) {
        echo json_encode(array('code'=>'0','msg'=>'Invalid salon!'));
        return;
      }
      if (!$this->salons_model->have_space($salon_id)) {
        echo json_encode(array('code'=>'0','msg'=>'Acest salon nu mai are locuri libere.'));
        return;
      }
    }
    else {
      $salon_id = 0;
    }

    $patient_data = array(
      'first_name' => $first_name,
      'last_name' => $last_name,
      'gender' => $gender,
      'cnp' => $cnp,
      'phone' => $phone,
      'hospitalized' => $hospitalized,
      'salon_id' => $salon_id,
      'born_date' => $born_date,
      'residence' => $residence,
      'nationality' => $nationality,
      'occupation' => $occupation,
      'training_level' => $training_level,
      'insurance' => $insurance,
      'cnas_type_insurance' => $cnas_type_insurance,
      'cnas_category_insurance' => $cnas_category_insurance,
      'job' => $job,
      'blood_type' => $blood_type,
      'rh' => $rh,
      'born_weight' => $born_weight,
      'environment' => $environment
    );

    $this->patients_model->update($patient_id, $patient_data);

    set_action('patients_edit', $patient_data);
    echo json_encode(array('code'=>'1','msg'=>'Pacientul '.$first_name.' '.$last_name.' a fost editat cu succes.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('patients', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Stergerea pacientului a esuat.'));
    }

    $patient_id = $this->input->post('patient_id');
    $patient = $this->patients_model->get_where_single_array(array('patient_id' => $patient_id));
    $patient_data = array(
      'first_name' => $patient['first_name'],
      'last_name' => $patient['last_name']
    );

    if ($this->observation_records_model->exist_record_by_patient_id($patient_id)){
      echo json_encode(array('code'=>'0','msg'=>'Acest pacient are fise medicale active.'));
      return;
    }

    $result = $this->patients_model->delete($patient_id);

    if ($result) {
      set_action('patients_delete', $patient_data);
      echo json_encode(array('code'=>'1','msg'=>'Pacientul a fost sters cu succes.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Stergerea pacientului a esuat.'));
    }


  }

}
