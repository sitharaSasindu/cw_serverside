<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * user: #Property_Of_Ss
 * Date: 10/26/2019
 * Time: 10:10 AM
 */
Class UserController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
	}

	public function Index()
	{
		$this->load->view('login_view');


	}

	function ValidateRegistration()
	{

	}

	function Login()
	{
		if ($this->input->post()) {
			$rules = array(
				array(
					'field' => 'firstName',
					'label' => 'First Name',
					'rules' => 'required'
				),
				array(
					'field' => 'lastName',
					'label' => 'Last Number',
					'rules' => 'required'
				),
				array(
					'field' => 'email',
					'label' => 'Email Address',
					'rules' => 'required',
					'errors' => array(
						'required' => 'Please Enter a Email Address.',
					),
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'callback_passwordValidation',
				)
			);


			$this->form_validation->set_rules('passwordVerify', 'Confirm Password', 'required|matches[password]');
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('register');
			} else {
				$firstName = $this->input->post('firstName');
				$lastName = $this->input->post('lastName');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
//				$musicGenres = $this->input->post('musicGenres');

				$this->load->model('UserManager', 'newUser');
				$newUser = $this->newUser->userRegistration($firstName, $lastName, $email, $password, 23);
				$this->load->view('home_page');
//				redirect(base_url('contacts'));
			}
		}
	}


	function Register()
	{
		$this->load->view('register');
	}


	/**
	 * Validate the password
	 *
	 * @param string $password
	 *
	 * @return bool
	 */
	public function passwordValidation($password = '')
	{
		$password = trim($password);
		$regex_lowercase = '/[a-z]/';
		$regex_uppercase = '/[A-Z]/';
		$regex_number = '/[0-9]/';
		$regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
		if (empty($password)) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field is required.');
			return FALSE;
		}
		if (preg_match_all($regex_lowercase, $password) < 1) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must be at least one lowercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_uppercase, $password) < 1) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must be at least one uppercase letter.');
			return FALSE;
		}
		if (preg_match_all($regex_number, $password) < 1) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must have at least one number.');
			return FALSE;
		}
//		if (preg_match_all($regex_special, $password) < 1) {
//			$this->form_validation->set_message('passwordValidation', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
//			return FALSE;
//		}
		if (strlen($password) < 8) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must be at least 8 characters in length.');
			return FALSE;
		}
	}


}
