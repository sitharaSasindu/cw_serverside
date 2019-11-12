<?php
/**
 * Created by PhpStorm.
 * User: #Property_Of_Ss
 * Date: 10/26/2019
 * Time: 10:10 AM
 */


Class UserController extends CI_Controller{

	public function Index(){
		$this->load->view('login_view');
	}

	function Login(){
		$this->load->view('home_page');
	}

	function Register(){
		$this->load->view('register');
	}

	function Tasks(){

	}


}
