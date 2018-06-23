<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Migrate extends CI_Controller {

  public function __construct()
  {
    parent::__construct();

    is_cli()
    or exit("Execute via command line: php index.php migrate index [rootUser] [rootPassword]");

    $this->load->library('migration');
  }

  public function index($rootUser = NULL, $rootPass = NULL)
  {

    if ($rootUser != NULL && $rootPass != NULL) {

      $this->db->username = $rootUser;
      $this->db->password = $rootPass;
      $this->db->close();
      $this->db->reconnect();
    }
    else if ($rootUser != NULL || $rootPass != NULL) {
      die("Please provide both the database root user and password. You can alternatively rely on the data from config, by using no parameter.");
    }

    echo "Starting the migration.\n";

    $migrate = $this->migration->current();

    if($migrate === TRUE) {
      echo "Already to the lastest version.\n";
    }
    else if(! $migrate){
      show_error($this->migration->error_string());
    }
    else {
      echo 'Successfully migrated to version ' . $migrate . ".\n";
    }
  }
}
