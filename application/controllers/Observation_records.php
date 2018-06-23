<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Observation_records extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('observation_records__index','observation_records/observation_records_view');

  }

  public function add($patient_id) {

    $this->load->helper('ui_regions');
    $patient = $this->patients_model->get_where_single_array(array('patient_id' => $patient_id));
    if ($patient['hospitalized'] != 1) {
      redirect('account/logout');
      return;
    }
    $data['analysis_array'] = get_analysis_array();
    $data['patient'] = $patient;
    $data['salons'] = $this->salons_model->get_patients_salons();
    $data['personal'] = $this->users_model->get_users();
    write_view('observation_records__add','observation_records/observation_records_add_view', $data);

  }
  public function edit($observation_record_id) {

    $observation_record = $this->observation_records_model->get_row_array($observation_record_id);
    $data['observation_record'] = $observation_record;

    if ($data['observation_record']['date_open'] == '0000-00-00 00:00:00') {
      $data['observation_record']['date_open'] = '';
    }
    if ($data['observation_record']['date_close'] == '0000-00-00 00:00:00') {
      $data['observation_record']['date_close'] = '';
    }
    if ($data['observation_record']['death_date'] == '0000-00-00 00:00:00') {
      $data['observation_record']['death_date'] = '';
    }

    $data['personal'] = $this->users_model->get_users();

    $data['main_surgery'] = explode("#",$observation_record['main_surgery'])[2];
    $data['personal_main_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['main_surgery'])[1]);
    $data['date_main_surgery'] = explode("#",$observation_record['main_surgery'])[0];

    $data['concurrent_surgery'] = explode("#",$observation_record['concurrent_surgery'])[2];
    $data['personal_concurrent_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['concurrent_surgery'])[1]);
    $data['date_concurrent_surgery'] = explode("#",$observation_record['concurrent_surgery'])[0];

    $data['other_surgery'] = explode("#",$observation_record['other_surgery'])[2];
    $data['personal_other_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['other_surgery'])[1]);
    $data['date_other_surgery'] = explode("#",$observation_record['other_surgery'])[0];

    $patient = $this->patients_model->get_where_single_array(array('patient_id' => $observation_record['patient_id']));
    if ($patient['hospitalized'] != 1) {
      redirect('account/logout');
      return;
    }
    $data['analysis_array'] = get_analysis_array();
    $data['patient_analysis'] = json_decode($observation_record['laboratory_exam'], true);
    $data['patient'] = $patient;
    $data['salons'] = $this->salons_model->get_patients_salons();
    $data['temperature_data_array'] = json_decode($observation_record['temperature_sheet'], true);

    $this->load->helper('ui_regions');
    write_view('observation_records__edit','observation_records/observation_records_edit_view', $data);

  }
  public function details($observation_record_id) {

    $observation_record = $this->observation_records_model->get_row_array($observation_record_id);
    $data['observation_record'] = $observation_record;

    if ($data['observation_record']['date_open'] == '0000-00-00 00:00:00') {
      $data['observation_record']['date_open'] = '';
    }
    if ($data['observation_record']['date_close'] == '0000-00-00 00:00:00') {
      $data['observation_record']['date_close'] = '';
    }
    if ($data['observation_record']['death_date'] == '0000-00-00 00:00:00') {
      $data['observation_record']['death_date'] = '';
    }

    $data['personal'] = $this->users_model->get_users();

    $data['main_surgery'] = explode("#",$observation_record['main_surgery'])[2];
    $data['personal_main_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['main_surgery'])[1]);
    $data['date_main_surgery'] = explode("#",$observation_record['main_surgery'])[0];

    $data['concurrent_surgery'] = explode("#",$observation_record['concurrent_surgery'])[2];
    $data['personal_concurrent_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['concurrent_surgery'])[1]);
    $data['date_concurrent_surgery'] = explode("#",$observation_record['concurrent_surgery'])[0];

    $data['other_surgery'] = explode("#",$observation_record['other_surgery'])[2];
    $data['personal_other_surgery'] = $this->users_model->get_personal_surgery(explode("#",$observation_record['other_surgery'])[1]);
    $data['date_other_surgery'] = explode("#",$observation_record['other_surgery'])[0];

    $patient = $this->patients_model->get_where_single_array(array('patient_id' => $observation_record['patient_id']));

    $data['analysis_array'] = get_analysis_array();
    $data['patient_analysis'] = json_decode($observation_record['laboratory_exam'], true);
    $data['patient'] = $patient;
    $data['salons'] = $this->salons_model->get_patients_salons();
    $data['temperature_data_array'] = json_decode($observation_record['temperature_sheet'], true);
    $this->load->helper('ui_regions');
    write_view('observation_records__details','observation_records/observation_records_details_view', $data);

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
    $results = $this->observation_records_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['observation_record_id'];
      $response->rows[$i]['cell'] = [
        $row['observation_record_id'],
        $row['patient_id']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_observation_record_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $patient_id = intval($this->input->post('patient_id'));

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
      set_action('observation_records_add', $observation_record_data);
      echo json_encode(array('code'=>'1','msg'=>'Foaia de observatie a fost adaugata cu succes.'));
      return;
    }
    else{
      echo json_encode(array('code'=>'0','msg'=>'Foaia de observatie nu a putut fi adaugata din cauza unei erori.'));
      return;
    }

  }

  public function _do_edit(){

    if ($this->form_validation->run('edit_observation_record_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $observation_record_id = intval($this->input->post('observation_record_id'));

    $old_observation_record = $this->observation_records_model->get_where_single_array(array('observation_record_id' => $observation_record_id));

    $date_open = $this->input->post('date_open');
    $date_close = $this->input->post('date_close');
    if ($old_observation_record['date_open'] != $date_open) {
      $date_open = get_date($date_open);
    }
    if ($old_observation_record['date_close'] != $date_close) {
      $date_close = get_date($date_close);
    }
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
    if ($old_observation_record['death_date'] != $death_date) {
      $death_date = get_date($death_date);
    }
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

    $this->observation_records_model->update($observation_record_id, $observation_record_data);

    set_action('observation_records_edit', $observation_record_data);
    echo json_encode(array('code'=>'1','msg'=>'Foaia de observatie a fost editata cu succes.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('observation_records', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Delete observation_record failed.'));
    }

    $observation_record_id = intval($this->input->post('observation_record_id'));
    $observation_record = $this->observation_records_model->get_where_single_array(array('observation_record_id' => $observation_record_id));

    $result = $this->observation_records_model->delete($observation_record_id);

    if ($result) {
      set_action('observation_records_delete', $observation_record);
      echo json_encode(array('code'=>'1','msg'=>'Foaia de observatie a fost stearsa cu succes.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Foaia de observatie nu s-a sters din cauza unei erori.'));
    }

  }

}
