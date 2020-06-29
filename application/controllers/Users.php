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
		$birth = date('Y-m-d', strtotime(str_replace('/', '-', $this->input->post('birth'))));
		$cpf = $this->input->post('cpf');
		$gender = $this->input->post('gender');
		$state = $this->input->post('state');
		$city = $this->input->post('city');
		$password = hash('sha256', $this->input->post('password'));

		// If birth is empty, keep null
		if (empty($this->input->post('birth'))) {
			$birth = null;
		}

		// Form Validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'e-mail', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'senha', 'min_length[6]');

		// set messages
		$this->form_validation->set_message('valid_email', 'Informe um %s válido.');
		$this->form_validation->set_message('is_unique', 'Este %s já está cadastrado em nosso sistema.');
		$this->form_validation->set_message('min_length', 'A %s deve ter pelo menos 6 dígitos.');

		// set delimiters
		$this->form_validation->set_error_delimiters('<span class="denied">', '</span>');

		// check rules
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
			exit;
		}

		// generate encode
		$encode = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 10, 6);

		$data = array(
			'name' => $name,
			'email' => $email,
			'birth' => $birth,
			'cpf' => $cpf,
			'gender' => $gender,
			'state' => $state,
			'city' => $city,
			'encode' => $encode,
			'password' => $password
		);

		echo "<pre>";
		print_r($data);
	}
}
