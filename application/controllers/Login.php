<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {

		$this->load->view('login/login_view');

	}

  public function do_login() {

    $this->load->library('session');

    $username = $this->input->post('username');
	  $password = $this->input->post('password');


    $this->load->library('security_util');

    if ($this->security_util->do_login($username, $password) === TRUE) {
      redirect(base_url().'dashboard/index');
    }
    else{
      $this->session->sess_destroy();
      $this->session->set_flashdata('login_error', $this->security_util->get_login_error());
      redirect('login','refresh');
    }

  }


}
