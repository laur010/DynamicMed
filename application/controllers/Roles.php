<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('roles__index','roles/roles_view');
  }

  public function add() {

    $this->load->helper('ui_regions');
    $data['permissions'] = $this->permissions_model->get_all_array();
    write_view('roles__add','roles/roles_add_view', $data);

  }
  public function edit($role_id) {

    $role = $this->roles_model->get_row_array($role_id);
    $data['role'] = $role;
    $data['permissions'] = $this->permissions_model->get_all_array();
    $data['role_permissions'] = $this->roles_model->get_role_permissions($role['role_id']);
    $this->load->helper('ui_regions');
    write_view('roles__edit','roles/roles_edit_view', $data);

  }
  public function details($role_id) {

    $role = $this->roles_model->get_row_array($role_id);
    $data['role'] = $role;
    $data['permissions'] = $this->permissions_model->get_all_array();
    $data['role_permissions'] = $this->roles_model->get_role_permissions($role['role_id']);
    $this->load->helper('ui_regions');
    write_view('roles__details','roles/roles_details_view', $data);

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
    $results = $this->roles_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['role_id'];
      $response->rows[$i]['cell'] = [
        $row['role_id'],
        $row['name']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_role_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('role_name');
    $permissions_array = $this->input->post('permissions');
    if (isset($permissions_array)) {
      $permissions = array_map('intval', $permissions_array);
    }
    else {
      $permissions = array();
    }

    $role_data = array(
      'name' => $name
    );
    $role_id = $this->roles_model->insert($role_data);


    foreach ($permissions as $permission_id) {
      $role_permission_data = array(
        'role_id' => $role_id,
        'permission_id' => $permission_id
      );
      $this->roles_permissions_model->insert($role_permission_data);
    }

    if ($role_id > 0) {
      set_action('roles_add', $role_data);
      echo json_encode(array('code'=>'1','msg'=>'Role '.$name.' was added successful.'));
      return;
    }
    else{
      echo json_encode(array('code'=>'0','msg'=>'Role '.$name.' was not added.'));
      return;
    }

  }

  public function _do_edit(){

    $role_id = $this->input->post('role_id');

    if ($this->form_validation->run('edit_role_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('role_name');
    $permissions = array_map('intval', $this->input->post('permissions'));

    $role_data = array(
      'name' => $name
    );
    $this->roles_model->update($role_id, $role_data);

    $this->roles_permissions_model->delete_where(array('role_id' => $role_id));
    foreach ($permissions as $permission_id) {
      $role_permission_data = array(
        'role_id' => $role_id,
        'permission_id' => $permission_id
      );
      $this->roles_permissions_model->insert($role_permission_data);
    }

    set_action('roles_edit', $role_data);
    echo json_encode(array('code'=>'1','msg'=>'Role '.$name.' was edited successful.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('roles', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Delete role failed.'));
    }

    $role_id = $this->input->post('role_id');
    $role = $this->roles_model->get_where_single_array(array('role_id' => $role_id));
    $role_data = array(
      'name' => $role['name']
    );

    if ($this->roles_model->exist_user_by_role_id($role_id)){
      echo json_encode(array('code'=>'0','msg'=>'Un utilizator foloseste acest rol.'));
      return;
    }

    $result = $this->roles_model->delete($role_id);

    if ($result) {
      set_action('roles_delete', $role_data);
      echo json_encode(array('code'=>'1','msg'=>'Role deleted successful.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Delete role failed.'));
    }


  }

}
