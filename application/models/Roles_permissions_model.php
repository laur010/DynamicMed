<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles_permissions_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('roles_permissions','role_permission_id');
  }

}