<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('users__index','users/users_view');

  }

  public function add() {

    $this->load->helper('ui_regions');
    $data['roles'] = $this->roles_model->get_all_array();
    write_view('users__add','users/users_add_view', $data);

  }
  public function edit($user_id) {

    $user = $this->users_model->get_row_array($user_id);
    $data['user'] = $user;
    $data['roles'] = $this->roles_model->get_all_array();
    $this->load->helper('ui_regions');
    write_view('users__edit','users/users_edit_view', $data);

  }
  public function details($user_id) {

    $user = $this->users_model->get_row_array($user_id);
    $data['user'] = $user;
    $data['roles'] = $this->roles_model->get_all_array();
    $this->load->helper('ui_regions');
    write_view('users__details','users/users_details_view', $data);

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
    $results = $this->users_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['user_id'];
      $response->rows[$i]['cell'] = [
        $row['user_id'],
        $row['username'],
        $row['first_name'],
        $row['last_name'],
        $row['role_name'],
        $row['email']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_user_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $confirm_password = $this->input->post('confirm_password');
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $role_id = $this->input->post('role_id');
    $phone = $this->input->post('phone');
    $email = $this->input->post('email');


    if ($this->users_model->check_user_existence($username)) {
      echo json_encode(array('code'=>'0','msg'=>'User '.$username.' already exist.'));
      return;
    }

    $user_data = array(
      'username' => $username,
      'password' => md5($password),
      'first_name' => $first_name,
      'last_name' => $last_name,
      'role_id' => $role_id,
      'phone' => $phone,
      'email' => $email,
      'profile_image_id' => 0
    );
    $user_id = $this->users_model->insert($user_data);

    if ($user_id > 0) {
      set_action('users_add', $user_data);
      echo json_encode(array('code'=>'1','msg'=>'User '.$username.' was added successful.'));
      return;
    }
    else{
      echo json_encode(array('code'=>'0','msg'=>'User '.$username.' was not added.'));
      return;
    }

  }

  public function _do_edit(){

    $user_id = $this->input->post('user_id');

    $user = $this->users_model->get_where_single_array(array('user_id' => $user_id));
    if ($this->form_validation->run('edit_user_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $username = $this->input->post('username');
    $first_name = $this->input->post('first_name');
    $last_name = $this->input->post('last_name');
    $role_id = $this->input->post('role');
    $phone = $this->input->post('phone');
    $email = $this->input->post('email');

    if ($user['username'] != $username) {
      if ($this->users_model->check_user_existence($username)) {
        echo json_encode(array('code'=>'0','msg'=>'User '.$username.' already exist.'));
        return;
      }
    }

    $user_data = array(
      'username' => $username,
      'first_name' => $first_name,
      'last_name' => $last_name,
      'role_id' => $role_id,
      'phone' => $phone,
      'email' => $email
    );

    $this->users_model->update($user_id, $user_data);

    set_action('users_edit', $user_data);
    echo json_encode(array('code'=>'1','msg'=>'User '.$username.' was edited successful.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('users', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Delete user failed.'));
    }

    $user_id = $this->input->post('user_id');
    $user = $this->users_model->get_where_single_array(array('user_id' => $user_id));
    $user_data = array(
      'username' => $user['username'],
      'first_name' => $user['first_name'],
      'last_name' => $user['last_name'],
      'role_id' => $user['role_id'],
      'phone' => $user['phone'],
      'email' => $user['email']
    );

    $result = $this->users_model->delete($user_id);

    if ($result) {
      set_action('users_delete', $user_data);
      echo json_encode(array('code'=>'1','msg'=>'User deleted successful.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Delete user failed.'));
    }


  }

}
