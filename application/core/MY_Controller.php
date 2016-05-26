<?php

defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->data['page_title'] = 'Busy Daisy';
        $this->data['page_description'] = 'busy_daisy';
        $this->data['before_closing_head'] = '';
        $this->data['before_closing_body'] = '';
    }

    protected function render($the_view = null, $template = null)
    {
        if ($template == 'json' || $this->input->is_ajax_request()) {
            header('Content-Type: application/json');
            echo json_encode($this->data);
        } elseif (is_null($template)) {
            $this->load->view($the_view, $this->data);
        } else {
            $this->data['the_view_content'] = (is_null($the_view)) ? '' : $this->load->view($the_view, $this->data, true);
            $this->load->view('templates/'.$template.'_view', $this->data);
        }
    }
}

class Auth_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        if ($this->ion_auth->logged_in() === false) {
            redirect('user/login');
        }
    }
    protected function render($the_view = null, $template = 'auth_master')
    {
        parent::render($the_view, $template);
    }
}
