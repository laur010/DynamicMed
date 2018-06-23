<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actions extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('actions__index','actions/actions_view');

  }

  public function details($action_id) {

    $action = $this->actions_model->get_row_array($action_id);
    $data['action'] = $action;
    $this->load->helper('ui_regions');
    write_view('actions__details','actions/actions_details_view', $data);

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
    $results = $this->actions_model->get_grid();
    $all_results = $results['count'];
    $total_pages = ceil($all_results / $params['limit']);

    $response = new stdClass();
    $response->page    = $params['page'];
    $response->total   = $total_pages;
    $response->records = $all_results;

    foreach ($results['rows'] as $i => $row) {
      $response->rows[$i]['id']   = $row['action_id'];
      $response->rows[$i]['cell'] = [
        $row['action_id'],
        $row['username'],
        $row['message'],
        $row['timestamp']
      ];
    }
    echo json_encode($response);
  }
}
