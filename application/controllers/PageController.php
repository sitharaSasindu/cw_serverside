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

	function CheckLoggedIn()
	{
		if ($this->session->userdata('logged_in') !== false) {
			return true;
		} else {
			return false;
		}
	}

	public function Index()
	{
		if (CheckLoggedIn) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function Register()
	{
//		if ($this->session->userdata('logged_in') !== false) {
//			redirect('home');
//		} else {
			$this->load->view('register');
//		}
	}

	function Login()
	{
		if (CheckLoggedIn) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function Friends()
	{
		if (CheckLoggedIn) {
			redirect('showFriends');
		} else {
			$this->load->view('login_view');
		}
	}

	function Followers()
	{
		if (CheckLoggedIn) {
			redirect('showFollowers');
		} else {
			redirect('login');
		}
	}

	function Followings()
	{
//		if (CheckLoggedIn) {
//			redirect('showFollowings');
//		} else {
//			redirect('login');
//		}
		if (CheckLoggedIn) {
			redirect('showFollowings');
		} else {
			redirect('login');
		}

	}

	function Home()
	{
		if (CheckLoggedIn) {
			redirect('home');
		} else {
			redirect('login');
		}
	}

	function showPublicHomePage()
	{
		if (CheckLoggedIn) {
			redirect('showPublicHome');
		} else {
			redirect('login');
		}
	}

}
