<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
	// constructor of CI_Controller
	public function __construct()
	{
		parent::__construct();
	}

	// index page
	public function index()
	{
		// load views
		$this->load->view('html_header');
		$this->load->view('header');
		$this->load->view(__FUNCTION__);
		$this->load->view('footer');
		$this->load->view('html_footer');
	}
}
