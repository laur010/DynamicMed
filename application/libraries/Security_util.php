<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Security_Util
{
  protected $login_error;

// --------------------------------------------------------------------

  public function __construct() {
    $this->ci = &get_instance();
    $this->ci->load->model('users_model');
  }


  function get_user_id() {
    if($this->ci->session->userdata('logged_in')) return $this->ci->session->userdata('users')['user_id'];
  }


// --------------------------------------------------------------------

  function is_logged_in() {

    if ($this->ci->session) {
      //If user has valid session, and such is logged in
      if ($this->ci->session->userdata('logged_in')) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }
    else {
      return FALSE;
    }

  }

// --------------------------------------------------------------------

  function do_login ($username, $password) {

    if (empty($username) || empty($password)) {
      $this->login_error = "Enter username and password.";
      return FALSE;
    }

    if ($this->ci->users_model->check_user_existence($username) === FALSE) {
      $this->login_error = "Username/password incorrect.";
      return FALSE;
    }


    $user = $this->ci->users_model->get_where_single_array(array('username' => $username));
//    $user = $this->ci->users_model->get_user_by_username($username);
    if (empty($user)) {
      $this->login_error = "Username/password incorrect.";
      return FALSE;
    }


    if(md5($password) == $user['password']) {

      $user_data = array(
        'user' => $user,
        'logged_in' => true
      );

      $this->ci->session->set_userdata($user_data);

      $this->build_allowed_modules($user);

      $this->ci->load->helper('ui_regions');
      write_menu_session();
      return TRUE;
    }
    else {
      $this->login_error = "Username/password incorrect.";
      return FALSE;
    }

  }

  function build_allowed_modules($user) {

    $license = 'license';

    if ($license == NULL) {
      $allowed_modules = $this->ci->users_model->get_basic_modules();
    } else {
      $allowed_modules = $this->ci->users_model->get_user_modules($user);
    }

    $this->ci->session->set_userdata('allowed_modules', $allowed_modules);
  }

  function get_login_error() {
    return $this->login_error;
  }

  function request_is_authorized($page, $function) {

    if(empty($page) || empty($function)) return FALSE;

    $user = $this->ci->session->userdata('user');

    $result = $this->ci->users_model->check_user_permission($user, $page, $function);
    return $result;

  }

  function get_grid_permissions($page) {

    $grid_permission = array('add' => false, 'edit' => false, 'delete' => false);
    $grid_permission['add'] = $this->request_is_authorized($page, 'add');
    $grid_permission['edit'] = $this->request_is_authorized($page, 'edit');
    $grid_permission['delete'] = $this->request_is_authorized($page, 'delete');

    return $grid_permission;
  }

}

