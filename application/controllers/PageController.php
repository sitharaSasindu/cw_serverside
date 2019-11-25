<?php


class PageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
//		if ($this->session->userdata('logged_in') !== TRUE) {
//			redirect('home');
//		}
//		$this->CheckLoggedIn();
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
		if (checkLoggedIn) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function register()
	{
		if (checkLoggedIn) {
			redirect('home');
		} else {
			redirect('registerView');
		}
	}

	function login()
	{
		if (checkLoggedIn) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function friends()
	{
		if (checkLoggedIn) {
			redirect('showFriends');
		} else {
			$this->load->view('login_view');
		}
	}

	function followers()
	{
		if (checkLoggedIn) {
			redirect('showFollowers');
		} else {
			redirect('login');
		}
	}

	function followings()
	{
		if (checkLoggedIn) {
			redirect('showFollowings');
		} else {
			redirect('login');
		}

	}

	function home()
	{
		if (checkLoggedIn) {
			redirect('home');
		} else {
			redirect('login');
		}
	}

	function showPublicHomePage()
	{
		if (checkLoggedIn) {
			redirect('showPublicHome');
		} else {
			redirect('login');
		}
	}

}
