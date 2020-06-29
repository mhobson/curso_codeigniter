<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	// constructor of CI_Controller
	public function __construct()
	{
		parent::__construct();
	}

	// index page
	public function index()
	{
		//state and city
		$data['states'] = $this->db->get('states')->result();
		$data['cities'] = $this->db->get('cities')->result();

		// extra data
		$data['extras'] =
			script_tag('assets/js/jquery.mask.min.js') .
			script_tag('assets/js/maskcpfcnpj.js');

		// load views
		$this->load->view('html_header', $data);
		$this->load->view('header');
		$this->load->view(__FUNCTION__);
		$this->load->view('footer');
		$this->load->view('html_footer');
	}
}
