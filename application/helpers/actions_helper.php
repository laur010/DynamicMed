<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('set_action'))
{
  function set_action($module, $data)
  {
    $ci =  &get_instance();
    $user = $ci->session->userdata('user');
    $page = explode('_', $module)[0];
    $function = explode('_', $module)[1];

    $message = 'Unknown Message';

    if ($page == 'users') {
      if ($function == 'add') {
        $message = 'Utilizatorul '.$user['username'].' a adaugat un nou user cu numele '.$data['username'].'.';
      }
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat utilizatorul '.$data['username'].'.';
      }
      if ($function == 'delete') {
        $message = 'Utilizatorul '.$user['username'].' a sters utilizatorul '.$data['username'].'.';
      }
    }
    if ($page == 'roles') {
      if ($function == 'add') {
        $message = 'Utilizatorul '.$user['username'].' a adaugat rolul cu numele '.$data['name'].'.';
      }
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat rolul '.$data['name'].'.';
      }
      if ($function == 'delete') {
        $message = 'Utilizatorul '.$user['username'].' a sters rolul '.$data['name'].'.';
      }
    }
    if ($page == 'departments') {
      if ($function == 'add') {
        $message = 'Utilizatorul '.$user['username'].' a adaugat sectia cu numele '.$data['name'].'.';
      }
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat sectia '.$data['name'].'.';
      }
      if ($function == 'delete') {
        $message = 'Utilizatorul '.$user['username'].' a sters sectia '.$data['name'].'.';
      }
    }
    if ($page == 'salons') {
      if ($function == 'add') {
        $message = 'Utilizatorul '.$user['username'].' a adaugat salonul cu numele '.$data['name'].'.';
      }
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat salonul '.$data['name'].'.';
      }
      if ($function == 'delete') {
        $message = 'Utilizatorul '.$user['username'].' a sters salonul '.$data['name'].'.';
      }
    }
    if ($page == 'patients') {
      if ($function == 'add') {
        $message = 'Utilizatorul '.$user['username'].' a adaugat pacientul '.$data['first_name'].' '.$data['last_name'].'.';
      }
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat datele pactientului '.$data['first_name'].' '.$data['last_name'].'.';
      }
      if ($function == 'delete') {
        $message = 'Utilizatorul '.$user['username'].' a sters pactientul '.$data['first_name'].' '.$data['last_name'].'.';
      }
    }
    if ($page == 'profile') {
      if ($function == 'edit') {
        $message = 'Utilizatorul '.$user['username'].' a editat profilui lui.';
      }
    }
    $action_data = array(
      'user_id' => $user['user_id'],
      'page' => $page,
      'function' => $function,
      'message' => $message
    );
    $ci->actions_model->insert($action_data);


    /*
     * Send notification to Admin user every time something is happen in application.
     */
    $notification_class = 0;
    if ($function == 'add') {
      $notification_class = 1;
    }
    if ($function == 'edit') {
      $notification_class = 2;
    }
    if ($function == 'delete') {
      $notification_class = 3;
    }

    $notification_data = array(
      'user_id' => 1,
      'active' => 1,
      'class_type' => $notification_class,
      'message' => $message
    );
    $ci->notifications_model->insert($notification_data);


  }
}