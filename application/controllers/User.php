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
        //echo 'Here we will make the login form';
        //$this->data['message'] = 'here will be the login form';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->render('user/login_view');
        } else {
            $remember = (bool) $this->input->post('remember');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->ion_auth->login($username, $password, $remember)) {
                if ($this->input->post('ajax')) {
                    $response['logged_in'] = 1;
                    header('content-type:application/json');
                    echo json_encode($response);
                    exit;
                }
                redirect('dashboard');
            } else {
                if ($this->input->post('ajax')) {
                    $response['error'] = $this->ion_auth->errors();
                    header('content-type:application/json');
                    echo json_encode($response);
                    exit;
                }
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect('user/login');
            }
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('login');
    }
}
