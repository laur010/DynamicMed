<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('permissions', 'permission_id');
  }

}