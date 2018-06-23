<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('roles','role_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS roles.*',FALSE)
      ->from('roles')
      ->group_by('roles.role_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }
  public function get_role_permissions($role_id) {

    $this->db->select('permissions.*')
      ->from('permissions')
      ->join('roles_permissions', 'roles_permissions.permission_id = permissions.permission_id')
      ->where('roles_permissions.role_id', $role_id);

    $result = $this->db->get();
    return $result->result_array();

  }

  public function exist_user_by_role_id($role_id) {
    $this->db->select('users.user_id')
      ->from('users')
      ->where('users.role_id', $role_id);

    $result = $this->db->get();
    if(count($result->result_array()) > 0){
      return true;
    }
    return false;
  }

}