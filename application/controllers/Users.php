<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
	// constructor of CI_Controller
	public function __construct()
	{
		parent::__construct();

		// load model
		$this->load->model('user');
	}

	// index page
	public function index()
	{
		// get flashdata
		$data['flash'] = $this->session->flashdata();

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

	/* new_user function */
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

		//validate name
		if ($name == null) {
			echo '<span class="denied">Informe o seu nome.</span>';
			echo '<script>$("#name").css({ "box-shadow" : "0 0 5px 1px red" });</script>';
			exit;
		}

		//validate e-mail
		if ($email == null) {
			echo '<span class="denied">Informe o seu e-mail.</span>';
			echo '<script>$("#email").css({ "box-shadow" : "0 0 5px 1px red" });</script>';
			exit;
		}

		// Form Validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'e-mail', 'valid_email|is_unique[users.email]');
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

		//validate password
		if ($this->input->post('password') == null) {
			echo '<span class="denied">Informe uma senha.</span>';
			echo '<script>$("#password").css({ "box-shadow" : "0 0 5px 1px red" });</script>';
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

		/* // imprimir na tela
		echo "<pre>";
		print_r($data);
		*/

		// load model
		$this->load->model('user');

		// submit insert into database
		$this->user->new_user($data);

		// set flashdata
		$this->session->set_flashdata('alerta', '<div>Cadastro realizado com sucesso!</div>');

		//redirect by Ajax
		$this->output->set_content_type('text/javascript')
			->set_output('<script>window.location.replace(" ' . base_url() . ' ")</script>');
	}

	/* get city */
	public function get_city()
	{
		// get id_state from post array from form
		$id_state = $this->input->post('id_state');

		// get cities from model
		$cities = $this->user->get_cities($id_state);

		// return cities
		echo "<option disabled selected value='0'>Selecione a cidade</option>";
		foreach ($cities as $city) {
			echo "<option value=" . $city->id . ">" . $city->city . "</option>";
		}
	}

	/* edit page */
	public function edit($encode)
	{
		// get flashdata
		$data['flash'] = $this->session->flashdata();

		// get user
		$data['user'] = $this->user->get_user($encode);

		// state and city
		$data['states'] = $this->db->get('states')->result();
		$data['cities'] = $this->user->get_cities($data['user'][0]->state);

		// extra data
		$data['extras'] =
			script_tag('assets/js/jquery.mask.min.js') .
			script_tag('assets/js/maskcpfcnpj.js');

		// load views
		$this->load->view('html_header', $data);
		$this->load->view('header');
		$this->load->view(__FUNCTION__, $data);
		$this->load->view('footer');
		$this->load->view('html_footer');
	}
}
