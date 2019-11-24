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
		$this->load->model('UserManager', 'newUser');
	}

	/**
	 *Pass available genre list on the database
	 *to register view
	 *
	 * @return void
	 */
	function registrationView()
	{
		$genreList = $this->newUser->getAvailableGenres();
		$musicGenreList = array(
			'genre' => $genreList
		);
		$this->load->view('register', $musicGenreList);
	}

	/**
	 * Send user registration details
	 * to UserManager model to insert into DB
	 *
	 * @return void
	 */
	function registration()
	{
		if ($this->input->post()) {
			if ($this->registrationFormValidation()) {
				$this->load->view('register');
			} else {
				$firstName = $this->input->post('firstName');
				$lastName = $this->input->post('lastName');
				$userName = $this->input->post('userName');
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$photoUrl = $this->input->post('photoUrl');
				$selectedGenreList = $this->input->post('selectedGenres');

				$this->newUser->userRegistration($firstName, $lastName, $userName, $email, $password, $photoUrl, $selectedGenreList);
				redirect('login');
			}
		}
	}

	/**
	 * Validate the registration form against given rule set
	 *
	 * @return bool if true
	 */
	function registrationFormValidation()
	{
		$validationRules = array(
			array(
				'field' => 'firstName',
				'label' => 'First Name',
				'rules' => 'required'
			),
			array(
				'field' => 'lastName',
				'label' => 'Last Name',
				'rules' => 'required'
			),
			array(
				'field' => 'userName',
				'label' => 'User Name',
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
			),
			array(
				'field' => 'photoUrl',
				'label' => 'Avatar Url',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules('passwordVerify', 'Confirm Password', 'required|matches[password]');//confirm password rule
		$this->form_validation->set_rules($validationRules);
		if ($this->form_validation->run() == False) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Validate the password
	 *
	 * @param string $password user entered
	 *
	 * @return bool if strong enough password
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
		if (preg_match_all($regex_special, $password) < 1) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
			return FALSE;
		}
		if (strlen($password) < 8) {
			$this->form_validation->set_message('passwordValidation', 'The {field} field must be at least 8 characters in length.');
			return FALSE;
		}
	}


	/**
	 * Validate login details with the user credentials
	 * on the database
	 *
	 */
	function checkLogin()
	{
		if ($this->loginFormValidation()) {
			$userName = $this->input->post('userName', TRUE);
			$password = $this->input->post('password', TRUE);
			$validate = $this->newUser->validate($userName, $password);
			if ($validate) {
				$data = $validate->row_array();//get first row of the array
				$firstName = $data['firstName'];
				$lastName = $data['lastName'];
				$userName = $data['userName'];
				$avatarUrl = $data['photoUrl'];
				$email = $data['email'];
				$userId = $data['userId'];
				$userFavGenres = $this->newUser->findUsersFavGenres($userId);
				$sessionData = array(
					'userId' => $userId,
					'firstName' => $firstName,
					'lastName' => $lastName,
					'userName' => $userName,
					'musicGenre' => $userFavGenres,
					'email' => $email,
					'avatarUrl' => $avatarUrl,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sessionData);
				redirect('home');
			} else {
				echo $this->session->set_flashdata('msg', 'Username or Password is Wrong');
				$this->load->view('login_view');
			}
		}
	}

	/**
	 * Validate the login form against given rule set
	 *
	 * @return bool if true
	 */
	function loginFormValidation()
	{
		$this->form_validation->set_rules('userName', 'UserName', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Logout function
	 * simply destroy the current session on the browser
	 * redirect the current page to login page
	 * @return void
	 */
	function logOut()
	{
		$this->session->sess_destroy();
		redirect('login');
	}

}
