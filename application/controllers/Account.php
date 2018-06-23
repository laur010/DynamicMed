<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

  public function index() {

  }

  public function logout()
  {
    $this->session->unset_userdata('user');
    $this->session->unset_userdata('logged_in');
    $this->session->sess_destroy();

    redirect(base_url().'login');

  }


}
