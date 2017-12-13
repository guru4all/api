<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function token_get($user_email){
    $tokenData = array();
    $tokenData['id'] = time().$user_email; 
    $output['token'] = AUTHORIZATION::generateToken($tokenData);
    return $output;
  }

  function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
              return $decodedToken;
            }
        }
        return "Unauthorised";
    }
}
