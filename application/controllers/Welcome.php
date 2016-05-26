<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends MY_Controller
{
    public function index()
    {
        $this->load->library('ion_auth');
        if ($this->ion_auth->logged_in() === true) {
            //SAuth_Controller->render('welcome_message');
            $this->render('welcome_message', 'auth_master');
        } else {
            $this->render('welcome_message', 'public_master');
        }
    }
}
