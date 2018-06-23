<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Patients_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('patients','patient_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS patients.*, departments.name as department_name, salons.name as salon_name',FALSE)
      ->from('patients')
      ->join('salons', 'salons.salon_id = patients.salon_id', 'left')
      ->join('departments', 'departments.department_id = salons.department_id', 'left')
      ->group_by('patients.patient_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }

  public function get_last_observation_record($patient_id) {

    $this->db->select('observation_records.*')
      ->from('observation_records')
      ->where('observation_records.patient_id', $patient_id)
      ->order_by('observation_records.date_open', 'desc')
      ->limit(1);

    $result = $this->db->get();
    return $result->row_array();

  }

  public function dashboard_chart_1() {


    $this->db->select('patients.blood_type, patients.rh')
      ->from('patients');

    $result = $this->db->get();
    $patients_array = $result->result_array();

    $dashboard_result = array(
      array('label' => '0-I','pozitiv' => 0, 'negativ' => 0),
      array('label' => 'A-II','pozitiv' => 0, 'negativ' => 0),
      array('label' => 'B-III','pozitiv' => 0, 'negativ' => 0),
      array('label' => 'AB-IV','pozitiv' => 0, 'negativ' => 0)
    );

    foreach ($patients_array as $patient) {

      if ($patient['blood_type'] == 1) {
        if ($patient['rh'] == 1) {
          $dashboard_result[1]['negativ']++;
        }
        else{
          $dashboard_result[1]['pozitiv']++;
        }
      }
      if ($patient['blood_type'] == 2) {
        if ($patient['rh'] == 1) {
          $dashboard_result[2]['negativ']++;
        }
        else{
          $dashboard_result[2]['pozitiv']++;
        }
      }
      if ($patient['blood_type'] == 3) {
        if ($patient['rh'] == 1) {
          $dashboard_result[3]['negativ']++;
        }
        else{
          $dashboard_result[4]['pozitiv']++;
        }
      }
      if ($patient['blood_type'] == 4) {
        if ($patient['rh'] == 1) {
          $dashboard_result[0]['negativ']++;
        }
        else{
          $dashboard_result[0]['pozitiv']++;
        }
      }

    }

    return $dashboard_result;



  }
  public function dashboard_chart_2() {

    $this->db->select('patients.gender')
      ->from('patients');

    $result = $this->db->get();
    $patients_array = $result->result_array();
    $male = 0;
    $female = 0;
    foreach ($patients_array as $patient) {
      if ($patient['gender'] == 1) {
        $male++;
      }
      else {
        $female++;
      }
    }

    return array($male, $female);




  }
  public function dashboard_chart_3() {

    $dashboard_result = array();

    $this->db->select('observation_records.date_open, observation_records.hospitalized_type')
      ->from('observation_records');

    $result = $this->db->get();

    $records_array = $result->result_array();

    foreach ($records_array as $record) {
      if ($record['date_open'] != '0000-00-00 00:00:00') {
        $month = intval(date('m', strtotime($record['date_open'])));
        $year = intval(date('y', strtotime($record['date_open'])));
        $data = array(
          'label' => '20'.$year.' Q'.$month,
          'number' => 1
        );
        $exist = 0;
        $index = 0;
        foreach ($dashboard_result as $aux) {
          if ($aux['label'] == $data['label']) {
            $exist = 1;
            $dashboard_result[$index]['number']++;
          }
          $index++;
        }
        if ($exist == 0) {
          array_push($dashboard_result, $data);
        }
      }
    }

    return $dashboard_result;

  }
  public function dashboard_chart_4() {

    $this->db->select('observation_records.laboratory_exam, patients.gender')
      ->from('observation_records')
      ->join('patients', 'observation_records.patient_id = patients.patient_id', 'left');

    $result = $this->db->get();

    $lab_array = $result->result_array();

    $analysis_type = get_analysis_array();
    $dashboard_result = array(
      array('label' => 'RBC','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'VSH','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Hematocrit(HT)','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Hemoglobina(Hb)','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Reticulocite','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Leucocite, WBC','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Neutrofile','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Enzinofile','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Bazofile','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Limfocite','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'Monocite','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'MCH','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'MCHC','under' => 0, 'good' => 0, 'over' => 0),
      array('label' => 'MCV','under' => 0, 'good' => 0, 'over' => 0)
    );
    foreach ($lab_array as $analysis_row) {
      $analysis = json_decode($analysis_row['laboratory_exam'], true);


      $index = 0;
      foreach ($analysis as $a) {
        if ($analysis_row['gender'] == 1) { // MALE
          $min_value = explode('-', $analysis_type[$index]['man_value'])[0];
          $max_value = explode('-', $analysis_type[$index]['man_value'])[1];
        }
        else { // FEMALE
          $min_value = explode('-', $analysis_type[$index]['woman_value'])[0];
          $max_value = explode('-', $analysis_type[$index]['woman_value'])[1];
        }

        if ($a['value'] < $min_value && $a['value'] != '') {
          $dashboard_result[$index]['under']++;
        }
        else if ($a['value'] > $max_value && $a['value'] != '') {
          $dashboard_result[$index]['over']++;
        }
        else if ($a['value'] != ''){
          $dashboard_result[$index]['good']++;
        }
        $index++;
        if ($index > 13) break;
      }



    }
    return $dashboard_result;

  }

  public function dashboard_chart_5() {

    $dashboard_result = array(
      array('label' => 'Ianuarie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Februarie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Martie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Aprilie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Mai', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Iunie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Iulie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'August', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Septembrie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Octombrie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Noiembrie', 'data_set_1' => 0, 'data_set_2' => 0),
      array('label' => 'Decembrie', 'data_set_1' => 0, 'data_set_2' => 0)
    );

    $this->db->select('observation_records.date_open, observation_records.hospitalized_type')
      ->from('observation_records');

    $result = $this->db->get();

    $records_array = $result->result_array();

    foreach ($records_array as $record) {
      if ($record['date_open'] != '0000-00-00 00:00:00') {
        $month = intval(date('m', strtotime($record['date_open'])));
        if ($record['hospitalized_type'] == 1) {
          $dashboard_result[$month-1]['data_set_1']++;
        }
        elseif($record['hospitalized_type'] == 2) {
          $dashboard_result[$month-1]['data_set_2']++;
        }
      }

    }

    return $dashboard_result;

  }

}