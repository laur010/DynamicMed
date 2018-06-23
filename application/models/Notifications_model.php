<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Notifications_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('notifications','notification_id');
  }

  public function exist_active_notifications($user_id) {

    $this->db->where('active', 1);
    $this->db->where('user_id', $user_id);

    $result = $this->db->get('notifications');
    if($result->num_rows() == 1){
      return TRUE;
    }
    return FALSE;

  }

}