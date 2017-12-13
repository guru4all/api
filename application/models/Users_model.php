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
    $data['user_password'] = password_hash ( $data['user_password'], PASSWORD_DEFAULT);
    $this->db->insert('users', $data);
    $insert_id = $this->db->insert_id();
    if($insert_id)
      return  $data;
    else
      return false;
  }

  function check_activation_code($user_activation_code){

    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('user_activation_code', $user_activation_code);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
      return $query->row()->user_id;
    else
      return false;
  }

  function enable_user($user_id){
    $this->db->where('user_id', $user_id);
    $this->db->update('users', array(
      'user_status'=> 1));

    return $this->db->affected_rows();
  }

  function check_login($data){

    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('user_email', $data['user_email']);
    $query = $this->db->get();
    if ($query->num_rows() > 0 && $query->row()->user_status > 0)
    {
      $hashed_password = $query->row()->user_password;

      if(password_verify ($data['user_password'], $hashed_password ))
        return $query->row_array();
      else
        return false;
    }
    else
      return false;
  }

}
