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
			redirect('home');
		} else {
			return FALSE;
		}
	}

	public function Index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		}else{
			redirect('login');
	}}

	function HomePage()
	{

		if ($this->session->userdata('logged_in') == TRUE) {
			$this->load->model('PostManager', 'posts');
			$data['post'] = $this->posts->getPosts();
			$this->load->view('home_page', $data);
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
			$this->load->view('login_view');
	}

	function Friends(){
		$this->load->view('friends');
	}

}
