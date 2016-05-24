<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends Auth_Controller
{
    public function index()
    {
        //echo 'Hello from the dashboard';
        $this->render('dashboard/index_view');
    }
}
