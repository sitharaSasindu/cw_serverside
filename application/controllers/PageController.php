<?php


class PageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function LoggedIn()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function Index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		}else{
		$this->load->view('login_view');
	}}

	function HomePage()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->load->view('home_page');
		}else {
			$this->load->view('login_view');
		}
	}

	function Register()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		}else {
			$this->load->view('register');
		}
	}

	function Login()
	{
//		if ($this->session->userdata('logged_in') == TRUE) {
//			redirect('home');
//		} else {
			$this->load->view('login_view');
//		}
	}


}
