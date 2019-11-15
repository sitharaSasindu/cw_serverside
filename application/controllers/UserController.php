<?php
/**
 * Created by PhpStorm.
 * user: #Property_Of_Ss
 * Date: 10/26/2019
 * Time: 10:10 AM
 */


Class UserController extends CI_Controller{

	public function Index(){
		$this->load->helper('url');
		$this->load->view('login_view');
	}

	function Login(){
		$firstName = $this->input->post('firstName');
		$lastName = $this->input->post('lastName');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$musicGenres = $this->input->post('musicGenres');

		$this->load->model('UserManager', 'newUser');
		$newUser = $this->newUser->userRegistration(44, $firstName, $lastName, $email, $password, 23);

		$this->load->view('home_page');
	}

	function Register(){



		$this->load->view('register');
	}

	function Tasks(){

	}


}
