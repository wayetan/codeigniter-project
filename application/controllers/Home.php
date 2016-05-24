<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function index()
	{
    //$this->body_class[] = 'Home';

		// $this->page_title = 'Welcome!';

    // $this->current_section = 'Home';

		//this->_render_page('Home/index');
		$this->load->view('welcome_message');
	}
}
