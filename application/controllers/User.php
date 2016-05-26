<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
    }

    public function index()
    {
        $this->render('welcome_message');
    }

    public function login()
    {
        $remember = (bool) $this->input->post('remember');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($this->ion_auth->login($username, $password, $remember)) {
            $response['success'] = 1;
            header('content-type:application/json');
            echo json_encode($response);
        } else {
            $response['error'] = $this->ion_auth->errors();
            header('content-type:application/json');
            echo json_encode($response);
        }
    }

    public function register()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');

        if ($this->ion_auth->register($username, $password, $email)) {
            $response['success'] = 1;
            header('content-type:application/json');
            echo json_encode($response);
        } else {
            $response['error'] = $this->ion_auth->errors();
            header('content-type:application/json');
            echo json_encode($response);
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('/');
    }
}
