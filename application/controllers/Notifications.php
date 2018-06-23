<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

  public function index() {

    $this->load->helper('ui_regions');
    write_view('notifications__index','notifications/notifications_view');

  }


  public function process_request() {

    $operation = $this->input->post('operation');
    switch ($operation) {
      case 'delete':
        $this->_do_delete();
        break;
      case 'set_inactive':
        $this->_do_set_inactive();
        break;
      case 'other':
        break;
      default:
        break;
    }

  }

  public function _do_set_inactive() {

    $user = $this->session->userdata('user');
    $this->notifications_model->update_where('user_id', $user['user_id'], array('active' => 0));
    echo json_encode(array('code' => '1'));
    return;

  }

  public function _do_delete() {
    $this->input->post('notification_id');
  }

}
