<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Auth extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function token_get($user_email = null)
    {
        $output = $this->auth_model->token_get($user_email);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $decodedToken = $this->auth_model->token_post();

        if($decodedToken == "Unauthorised")
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        else
            $this->set_response($decodedToken, REST_Controller::HTTP_OK);        
    }
}