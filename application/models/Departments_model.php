<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Departments_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('departments','department_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS departments.*',FALSE)
      ->from('departments')
      ->group_by('departments.department_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }

}