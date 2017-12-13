<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function token_get($user_data){

    $tokenData = array(
      "user_id" => $user_data['user_id'],
      "user_first_name" => $user_data['user_first_name'],
      "user_last_name" => $user_data['user_last_name'],
      "user_full_name" => $user_data['user_first_name'].' '.$user_data['user_last_name'],
      "user_geo_location" => $user_data['user_geo_location'],
      "user_office" => $user_data['user_office'],
      "user_email" => $user_data['user_email'],
      "expire" => time()+3600
    );

    $output['token'] = AUTHORIZATION::generateToken($tokenData);
    return $output;
  }

  function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $the_token = json_decode($headers['Authorization']);

            $decodedToken = AUTHORIZATION::validateToken($the_token->token);
            if ($decodedToken->expire > time()) {
              return $decodedToken;
            }
        }
        return "Unauthorised";
       
    }
}
