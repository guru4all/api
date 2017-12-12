<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic_controller extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function emailConfig()
  {
    $config = Array(
     //'protocol' => 'smtp',
     'smtp_host' => 'mail.bluecdf.gr',
     'smtp_port' => 465,
     'smtp_user' => 'esupport@bluecdf.gr', // change it to yours
     'smtp_pass' => 'tHeSupp4Keelp0!', // change it to yours
     'mailtype' => 'html',
     'charset' => 'UTF-8',
     'wordwrap' => TRUE,
     'newline' => "\r\n"

    );

    $this->load->library('email', $config);

    return true;

  }

}
