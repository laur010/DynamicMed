<?php
class MY_Form_validation extends CI_Form_validation{
  function __construct($config = array()){
    parent::__construct($config);
  }
  function my_alpha_numeric($string){

    $re1 = '^[a-zA-Z0-9_,. !;\'"]*$';	# Alphanum 1

    if ($c = preg_match_all ("/".$re1."/is", $string, $matches))
    {
      return true;
    }
    return false;
  }
  function my_alpha($string){

    $re1 = '^[a-zA-Z_,. !;\'"]*$';	# Alpha 1

    if ($c=preg_match_all ("/".$re1."/is", $string, $matches))
    {
      return true;
    }
    return false;
  }

  function my_alpha_numeric_light($string){

    $re1 = '^[a-zA-Z0-9_ ]*$';	# Alpha 1

    if ($c=preg_match_all ("/".$re1."/is", $string, $matches))
    {
      return true;
    }
    return false;
  }

  function my_alpha_light($string){

    $re1 = '^[a-zA-Z_ ]*$';	# Alpha 1

    if ($c=preg_match_all ("/".$re1."/is", $string, $matches))
    {
      return true;
    }
    return false;
  }

  function my_alpha_numeric_username($string){

    $re1 = '^[a-zA-Z0-9_]*$';	# Alpha 1

    if ($c=preg_match_all ("/".$re1."/is", $string, $matches))
    {
      return true;
    }
    return false;
  }

}