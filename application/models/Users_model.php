<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('users', 'user_id');
  }

  public function get_grid()
  {

    $this->db
      ->select('SQL_CALC_FOUND_ROWS users.*, roles.name as role_name',FALSE)
      ->from('users')
      ->join('roles', 'roles.role_id = users.role_id', 'left')
      ->group_by('users.user_id');

    $result = [];

    $query = $this->db->get();
    $result['rows'] = $query->result_array();
    $count_query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
    $result['count'] = $count_query->row()->count;


    return $result;
  }

  public function check_user_existence ($username) {

    $this->db->where('username', $username);

    $result = $this->db->get('users');
    if($result->num_rows() == 1){
      return TRUE;
    }
    return FALSE;

  }

  public function get_basic_modules() {

    $this->db->select('permissions.*')
      ->from('permissions')
      ->join('roles_permissions', 'permissions.permission_id = roles_permissions.permission_id');

    $result = $this->db->get();
    return $result->result_array();

  }

  public function get_user_modules($user) {

    $this->db->select('permissions.*')
      ->from('permissions')
      ->join('roles_permissions', 'permissions.permission_id = roles_permissions.permission_id AND roles_permissions.role_id = '.$user['role_id']);

    $result = $this->db->get();
    return $result->result_array();

  }

  public function check_user_permission($user, $page, $function) {

    $this->db->select('*')
      ->from('permissions')
      ->join('roles_permissions', 'roles_permissions.permission_id = permissions.permission_id AND roles_permissions.role_id = '.$user['role_id'])
      ->where('permissions.page', $page)
      ->where('permissions.function', $function);

    $result = $this->db->get();
    if($result->num_rows() == 1){
      return TRUE;
    }
    return FALSE;

  }

  public function get_users(){
    $this->db->select('users.first_name, users.last_name, users.user_id, roles.name as role_name')
      ->from('users')
      ->join('roles', 'roles.role_id = users.role_id', 'left');

    $result = $this->db->get();
    return $result->result_array();
  }

  public function get_personal_surgery($string){

    // String: |id1|id2| ...

    $string = substr($string, 1, -1);
    $users_array = explode('|', $string);

    $this->db->select('users.first_name, users.last_name, users.user_id, roles.name as role_name');
    $this->db->from('users');
    if (count($users_array) > 0) {
      $this->db->where_in('users.user_id', $users_array);
    }
    $this->db->join('roles', 'roles.role_id = users.role_id', 'left');

    $result = $this->db->get();
    return $result->result_array();

  }

}