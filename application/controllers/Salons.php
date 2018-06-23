<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salons extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('salons__index','salons/salons_view');

  }

  public function add() {

    $this->load->helper('ui_regions');
    $data['departments'] = $this->departments_model->get_all_array();
    write_view('salons__add','salons/salons_add_view', $data);

  }
  public function edit($salon_id) {

    $salon = $this->salons_model->get_row_array($salon_id);
    $data['salon'] = $salon;
    $data['departments'] = $this->departments_model->get_all_array();
    $this->load->helper('ui_regions');
    write_view('salons__edit','salons/salons_edit_view', $data);

  }
  public function details($salon_id) {

    $salon = $this->salons_model->get_row_array($salon_id);
    $data['salon'] = $salon;
    $data['departments'] = $this->departments_model->get_all_array();
    $this->load->helper('ui_regions');
    write_view('salons__details','salons/salons_details_view', $data);

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
    $results = $this->salons_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['salon_id'];
      $response->rows[$i]['cell'] = [
        $row['salon_id'],
        $row['name'],
        $row['department_name'],
        $row['capacity']
      ];
    }
    echo json_encode($response);
  }

  public function _do_add(){

    if ($this->form_validation->run('add_salon_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('name');
    $department_id = intval($this->input->post('department_id'));
    $capacity = intval($this->input->post('capacity'));
    $description = $this->input->post('description');

    $salon_data = array(
      'name' => $name,
      'department_id' => $department_id,
      'capacity' => $capacity,
      'description' => $description
    );
    $salon_id = $this->salons_model->insert($salon_data);

    if ($salon_id > 0) {
      set_action('salons_add', $salon_data);
      echo json_encode(array('code'=>'1','msg'=>'Salon '.$name.' was added successful.'));
      return;
    }
    else{
      echo json_encode(array('code'=>'0','msg'=>'salon '.$name.' was not added.'));
      return;
    }

  }

  public function _do_edit(){

    $salon_id = intval($this->input->post('salon_id'));

    if ($this->form_validation->run('edit_salon_form') == FALSE) {
      echo json_encode(array('code' => '0', 'msg' => validation_errors(' ', ' ')));
      return;
    }

    $name = $this->input->post('name');
    $department_id = intval($this->input->post('department_id'));
    $capacity = intval($this->input->post('capacity'));
    $description = $this->input->post('description');

    $salon_data = array(
      'name' => $name,
      'department_id' => $department_id,
      'capacity' => $capacity,
      'description' => $description
    );

    $this->salons_model->update($salon_id, $salon_data);

    set_action('salons_edit', $salon_data);
    echo json_encode(array('code'=>'1','msg'=>'Salon '.$name.' was edited successful.'));
    return;

  }

  public function _do_delete(){

    if (!$this->security_util->request_is_authorized('salons', 'delete')) {
      echo json_encode(array('code'=>'0','msg'=>'Delete salon failed.'));
    }

    $salon_id = intval($this->input->post('salon_id'));
    $salon = $this->salons_model->get_where_single_array(array('salon_id' => $salon_id));
    $salon_data = array(
      'name' => $salon['name']
    );

    $result = $this->salons_model->delete($salon_id);

    if ($result) {
      set_action('salons_delete', $salon_data);
      echo json_encode(array('code'=>'1','msg'=>'Salon deleted successful.'));
    }
    else {
      echo json_encode(array('code'=>'0','msg'=>'Delete salon failed.'));
    }


  }

}
