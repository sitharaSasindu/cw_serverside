<?php
class PageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	function checkLoggedIn()
	{
		if ($this->session->userdata('logged_in') !== false) {
			return true;
		} else {
			return false;
		}
	}

	public function Index()
	{
		if ($this->checkLoggedIn()) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function register()
	{
		if ($this->checkLoggedIn()) {
			redirect('home');
		} else {
			redirect('registerView');
		}
	}

	function login()
	{
		if ($this->checkLoggedIn()) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function friends()
	{
		if ($this->checkLoggedIn()) {
			redirect('showFriends');
		} else {
			$this->load->view('login_view');
		}
	}

	function followers()
	{
		if ($this->checkLoggedIn()) {
			redirect('showFollowers');
		} else {
			redirect('login');
		}
	}

	function followings()
	{
		if ($this->checkLoggedIn()) {
			redirect('showFollowings');
		} else {
			redirect('login');
		}

	}

	function home()
	{
		if ($this->checkLoggedIn()) {
			redirect('home');
		} else {
			redirect('login');
		}
	}

	function showPublicHomePage()
	{
		if ($this->checkLoggedIn()) {
			redirect('showPublicHome');
		} else {
			redirect('login');
		}
	}

}
