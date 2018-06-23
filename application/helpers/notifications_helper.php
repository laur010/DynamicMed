<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('get_notification_type'))
{
  function get_notification_type($class)
  {

    /*
     * 1 - Add Notification
     * 2 - Edit Notification
     * 3 - Delete Notification
     * 4 - Account Notification
     * 5 - Settings Notification
     * else - Info Notification
     */

    if ($class == 1) {
      $div_class = ' bg-green';
      $icon_class = 'zmdi zmdi-shopping-cart';
    }
    else if ($class == 2) {
      $div_class = ' bg-amber';
      $icon_class = 'zmdi zmdi-edit';
    }
    else if ($class == 3) {
      $div_class = ' bg-red';
      $icon_class = 'zmdi zmdi-delete';
    }
    else if ($class == 4) {
      $div_class = ' bg-blue';
      $icon_class = 'zmdi zmdi-account';
    }
    else if ($class == 5) {
      $div_class = ' bg-light-blue';
      $icon_class = 'zmdi zmdi-settings';
    }
    else {
      $div_class = ' bg-grey';
      $icon_class = 'zmdi zmdi-comment-text';
    }

    $result['div_class'] = $div_class;
    $result['icon_class'] = $icon_class;

    return $result;

  }
}