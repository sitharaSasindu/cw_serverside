<?php

Class HomePageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'post');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	/**
	 * Add new post to database
	 *
	 * @return void
	 */
	function newPost()
	{
		if ($this->input->post()) {
			$title = $this->input->post('newpost');
			$time = date('Y-m-d H:i:s');
			$userId = $this->session->userdata('userId');

			$this->post->addNewPost($title, $time, $userId);
			redirect('home');
		}
	}

	/**
	 * Show public home page of the current user
	 *
	 * @return void
	 */
	function showPublicHomePage()
	{
		if ($this->session->userdata('logged_in') == TRUE) {

			$currentUserId = $this->session->userdata('userId');
			$bagOfValues['redirectedUserPosts'] = $this->post->getPosts($currentUserId);
			$this->load->view('home_page', $bagOfValues);
		} else {
			$this->load->view('login_view');
		}
	}

	/**
	 * show general home page of the currently logged user
	 *
	 * @return void
	 */
	function homePage()
	{
		if ($this->session->userdata('logged_in') == TRUE) {

			$currentUserId = $this->session->userdata('userId');
			$bagOfValues['allPosts'] = $this->post->getAllPosts($currentUserId);

			$this->load->view('home_page', $bagOfValues);
		} else {
			$this->load->view('login_view');
		}
	}
}


