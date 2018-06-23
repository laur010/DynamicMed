<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');

    $data['chart_4'] = $this->patients_model->dashboard_chart_4();
    $data['chart_2'] = $this->patients_model->dashboard_chart_2();
    $data['chart_1'] = $this->patients_model->dashboard_chart_1();
    $data['chart_5'] = $this->patients_model->dashboard_chart_5();
    $data['chart_3'] = $this->patients_model->dashboard_chart_3();

    write_view('dashboard__index','dashboard/dashboard_view', $data);

  }




}
