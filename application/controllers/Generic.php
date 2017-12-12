<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generic extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function email_config()
  {
        $config = Array(
         'protocol' => 'smtp',
         'smtp_host' => 'mail.bluecdf.gr',
         'smtp_port' => 465,
         'smtp_user' => 'admin@yourdomainname.com', // change it to yours
         'smtp_pass' => '******', // change it to yours
         'mailtype' => 'html',
         'charset' => 'UTF-8',
         'wordwrap' => TRUE
      );

      $this->load->library('email', $config);
      return true;

  }

}
