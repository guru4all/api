<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function register($data){
    date_default_timezone_set('Europe/Athens');
    $this->load->helper('string');
    unset($data['user_password_confirm']);
    $data['user_status'] = 0;
    $data['user_activation_code'] = time().random_string('alnum', 32);
    $data['user_created_at'] = date("Y-m-d H:i:s");
    $this->db->insert('users', $data);
    $insert_id = $this->db->insert_id();
    if($insert_id)
      return  $data;
    else
      return false;
  }

}
