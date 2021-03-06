<?php

Class HomePageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'post');
		$this->load->model('FriendsManager', 'friendsManager');
		$this->load->model('UserManager', 'user');
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
			$userList = $this->friendsManager->getFollowings($currentUserId);//get array of following users
			array_push($userList, $currentUserId);

			$allPosts = $this->post->getAllPosts($currentUserId);
			$bagOfValues['currentlyPostedUsersDetails'] = $this->user->findUsersDetails($userList);
			$bagOfValues['allPosts'] = $allPosts;

			$this->load->view('home_page', $bagOfValues);
		} else {
			$this->load->view('login_view');
		}
	}

	function userProfile()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$currentUserId = $this->session->userdata('userId');

			$allPosts = $this->post->getPublicHomePosts($currentUserId);
			$bagOfValues['currentlyPostedUsersDetails'] = $this->user->findUsersDetails($currentUserId);

			$bagOfValues['allPosts'] = $allPosts;
			$this->load->view('user_profile', $bagOfValues);
		} else {
			$this->load->view('login_view');
		}
	}
}


