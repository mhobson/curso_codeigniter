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
		// state and city
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

	public function new_user()
	{
		// get from form
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$birth = $this->input->post('birth');
		$cpf = $this->input->post('cpf');
		$gender = $this->input->post('gender');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$password = $this->input->post('password');

		$data = array(
			'name' => $name,
			'email' => $email,
			'birth' => $birth,
			'cpf' => $cpf,
			'gender' => $gender,
			'state' => $state,
			'city' => $city,
			'password' => $password
		);

		echo "<pre>";
		print_r($data);
	}
}
