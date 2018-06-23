<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('write_menu_session'))
{
  function write_menu_session()
  {
    $ci =  & get_instance();

    $modules = $ci->session->userdata('allowed_modules');


    $menu ="";
    $items =  array();
    foreach($modules as $i) {
      if(!in_array($i["page"],$items)) {
        $items[] = $i["page"];
      }
    }
    $menu .= '<li class="header">MAIN</li>';
    // DASHBOARD
    if(in_array("dashboard", $items)) {
      $menu .='<li class="##dashboard##"><a href="'.base_url().'dashboard"><i class="zmdi zmdi-home"></i><span>Grafice</span></a></li>';
    }
    // PATIENTS
    if(in_array("patients", $items)) {
      $menu .='<li class="##patients##"><a href="'.base_url().'patients"><i class="zmdi zmdi-assignment-account"></i><span>Pacienti</span></a></li>';
    }

    // HOSPITAL STRUCTURE
    $hospital_structure = array('departments', 'salons');
    if (!empty(array_intersect($hospital_structure, $items))) {
      $menu .='<li class="##hospital_structures##"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-balance"></i><span>Structura Spital</span></a>';
      $menu .= '<ul class="ml-menu">';
      if(in_array("departments", $items)) {
        $menu .= '<li class="##departments##"><a href="'.base_url().'departments">Sectii</a></li>';
      }
      if(in_array("salons",$items)) {
        $menu .='<li class="##salons##"><a href="'.base_url().'salons">Saloane</a></li>';
      }
      $menu .= '</ul>';
      $menu .= '</li>';
    }
    $records_structure = array('observation_records', 'temperature_records', 'evolution_records', 'payments_records');
    if (!empty(array_intersect($records_structure, $items))) {
      $menu .='<li class="##records##"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-file-text"></i><span>Fise Medicale</span></a>';
      $menu .= '<ul class="ml-menu">';
      if(in_array("observation_records", $items)) {
        $menu .= '<li class="##observation_records##"><a href="'.base_url().'observation_records">Foi de Observatie</a></li>';
      }
      $menu .= '</ul>';
      $menu .= '</li>';
    }

    // ADMIN SETTINGS
    $admin_settings = array('users', 'roles', 'actions');
    if (!empty(array_intersect($admin_settings, $items))) {
      $menu .='<li class="##admin_settings##"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Setari Admin</span></a>';
      $menu .= '<ul class="ml-menu">';
      if(in_array("users", $items)) {
        $menu .= '<li class="##users##"><a href="'.base_url().'users">Utilizatori</a></li>';
      }
      if(in_array("roles",$items)) {
        $menu .='<li class="##roles##"><a href="'.base_url().'roles">Roluri</a></li>';
      }
      if(in_array("actions",$items)) {
        $menu .='<li class="##actions##"><a href="'.base_url().'actions">Actiuni</a></li>';
      }
      $menu .= '</ul>';
      $menu .= '</li>';
    }
    $menu .= '<li class="header">END</li>';

    $ci->session->set_userdata('menu', $menu);
  }
}
if (!function_exists('write_view'))
{
  function write_view($permission, $view, $data = NULL)
  {
    $page = explode('__', $permission)[0];
    $function = explode('__', $permission)[1];


    $ci =  &get_instance();
    $ci->load->library('security_util');
    $user_id = $ci->session->userdata('user')['user_id'];
    $user = $ci->users_model->get_where_single_array(array('user_id' => $user_id));
    $role = $ci->roles_model->get_where_single_array(array('role_id' => $user['role_id']));
    if ($ci->session->userdata('logged_in')) {
      if ($ci->security_util->request_is_authorized($page, $function)) {
        /*
         * Header Data
         */
        $header_data['menu'] = set_menu($page);
        $header_data['title'] = ucfirst($page);
        $header_data['name'] = $user['first_name']." ".$user['last_name'];
        $header_data['user_role'] = $role['name'];
        $header_data['active_image'] = $ci->profile_images_model->get_where_single_array(array('profile_image_id' => $user['profile_image_id']));;
        $header_data['user_notifications']['rows'] = $ci->notifications_model->get_where(array('user_id' => $user['user_id']), 10);
        $header_data['user_notifications']['active'] = $ci->notifications_model->exist_active_notifications($user['user_id']);

        /*
         * If page is index then we have to load header and footer too.
         * Add and Edit function just reload a part of page and not the entire page.
         */
        if ($function == 'index') {
          $ci->load->view('template/header', $header_data);
          $data['grid_permissions'] = $ci->security_util->get_grid_permissions($page);
          $ci->load->view($view, $data);
          $ci->load->view('template/footer');
        }
        else {
          $ci->load->view('template/header', $header_data);
          $ci->load->view($view, $data);
          $ci->load->view('template/footer');
        }

      }
      else {
        redirect('account/logout');
      }
    }
    else {
      redirect('account/logout');
    }
  }
}

if (!function_exists('set_menu')) {
  function set_menu($page) {

    $ci =  & get_instance();
    $menu = $ci->session->userdata('menu');

    switch ($page) {
      case 'dashboard':
        $menu = str_replace('##dashboard##','active', $menu);
        break;
      case 'users':
        $menu = str_replace('##admin_settings##','active open', $menu);
        $menu = str_replace('##users##','active', $menu);
        break;
      case 'roles':
        $menu = str_replace('##admin_settings##','active open', $menu);
        $menu = str_replace('##roles##','active', $menu);
        break;
      case 'actions':
        $menu = str_replace('##admin_settings##','active open', $menu);
        $menu = str_replace('##actions##','active', $menu);
        break;
      case 'departments':
        $menu = str_replace('##hospital_structures##','active open', $menu);
        $menu = str_replace('##departments##','active', $menu);
        break;
      case 'salons':
        $menu = str_replace('##hospital_structures##','active open', $menu);
        $menu = str_replace('##salons##','active', $menu);
        break;
      case 'patients':
        $menu = str_replace('##patients##','active', $menu);
        break;
      case 'observation_records':
        $menu = str_replace('##records##','active open', $menu);
        $menu = str_replace('##observation_records##','active', $menu);
        break;
    }
    return $menu;

  }
}
