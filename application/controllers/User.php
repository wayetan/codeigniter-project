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

    public function resetPassword()
    {
        $email = $this->input->post('email');
        $forgotten = $this->ion_auth->forgotten_password($email);

        // if ($forgotten) { //if there were no errors
        // $this->session->set_flashdata('message', $this->ion_auth->messages());
        //     redirect('auth/login', 'refresh'); //we should display a confirmation page here instead of the login page
        // } else {
        //     $this->session->set_flashdata('message', $this->ion_auth->errors());
        //     redirect('auth/forgot_password', 'refresh');
        // }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('/');
    }
}
