<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Observation_records_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('observation_records','observation_record_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS observation_records.observation_record_id, patients.patient_id, ',FALSE)
      ->from('observation_records')
      ->join('patients', 'patients.patient_id = observation_records.patient_id', 'left')
      ->group_by('observation_records.observation_record_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;

    return $result;
  }

  public function exist_record_by_patient_id($patient_id) {
    $this->db->select('observation_records.observation_record_id')
      ->from('observation_records')
      ->where('observation_records.patient_id', $patient_id);

    $result = $this->db->get();
    if(count($result->result_array()) > 0){
      return true;
    }
    return false;
  }


}