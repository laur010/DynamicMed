<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Actions_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('actions','action_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS actions.*, users.username',FALSE)
      ->from('actions')
      ->join('users', 'users.user_id = actions.user_id')
      ->group_by('actions.action_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }

}