<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	function __construct()
	{
            parent::__construct();
        if($this->session->userdata('logged_in')):
            $this->load->model('Admin_model');
        else:
            redirect(base_url());
        endif;
	}

	public function index()
	{
        echo "this is to check";
	}
}
