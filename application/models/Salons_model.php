<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Salons_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('salons','salon_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS salons.*, IF (departments.name is NULL, "Hospital", departments.name) as department_name',FALSE)
      ->from('salons')
      ->join('departments', 'departments.department_id = salons.department_id', 'left')
      ->group_by('salons.salon_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }

  public function get_patients_salons(){

    $this->db->select('salons.salon_id, salons.name as salon_name, departments.name as department_name')
      ->from('salons')
      ->join('departments', 'departments.department_id = salons.department_id', 'left')
      ->group_by('salons.salon_id')
      ->order_by('department_name', 'asc');

    $result = $this->db->get();
    return $result->result_array();

  }

  public function have_space($salon_id) {

    $salon = $this->salons_model->get_where_single_array(array('salon_id' => $salon_id));

    $this->db->select('patients.patient_id')
      ->from('patients')
      ->where('patients.salon_id', intval($salon_id));

    $result = $this->db->get();

    if (count($result->result_array()) >= $salon['capacity'] ) {
      return false;
    }
    return true;

  }
}