<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departments extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('departments__index','departments/departments_view');

  }

  public function add() {

    $this->load->helper('ui_regions');
    write_view('departments__add','departments/departments_add_view');

  }
  public function edit($department_id) {

    $department = $this->departments_model->get_row_array($department_id);
    $data['department'] = $department;
    $this->load->helper('ui_regions');
    write_view('departments__edit','departments/departments_edit_view', $data);

  }
  public function details($department_id) {

    $department = $this->departments_model->get_row_array($department_id);
    $data['department'] = $department;
    $this->load->helper('ui_regions');
    write_view('departments__details','departments/departments_details_view', $data);

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
    $results = $this->departments_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['department_id'];
      $response->rows[$i]['cell'] = [
        $row['department_id'],
        $row['name']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_department_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('name');

    $department_data = array(
      'name' => $name
    );
    $department_id = $this->departments_model->insert($department_data);

    if ($department_id > 0) {
      set_action('departments_add', $department_data);
      echo json_encode(array('code'=>'1','msg'=>'Department '.$name.' was added successful.'));
      return;
    }
    else{
      echo json_encode(array('code'=>'0','msg'=>'Department '.$name.' was not added.'));
      return;
    }

  }

  public function _do_edit(){

    $department_id = $this->input->post('department_id');

    if ($this->form_validation->run('edit_department_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('name');

    $department_data = array(
      'name' => $name
    );

    $this->departments_model->update($department_id, $department_data);

    set_action('departments_edit', $department_data);
    echo json_encode(array('code'=>'1','msg'=>'Department '.$name.' was edited successful.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('departments', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Delete department failed.'));
    }

    $department_id = $this->input->post('department_id');
    $department = $this->departments_model->get_where_single_array(array('department_id' => $department_id));
    $department_data = array(
      'name' => $department['name']
    );

    $result = $this->departments_model->delete($department_id);

    if ($result) {
      set_action('departments_delete', $department_data);
      echo json_encode(array('code'=>'1','msg'=>'Department deleted successful.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Delete department failed.'));
    }


  }

}
