<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_images_model extends MY_Model
{
  public function __construct()
  {
    parent::__construct();
    parent::init('profile_images','profile_image_id');
  }

}