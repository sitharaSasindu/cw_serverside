<?php

Class HomePageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'post');
		$this->load->model('FriendsManager', 'friendsManager');
	}


	function FindFriends()
	{
		$this->load->view('find_friends');
	}

	function Friends()
	{
		$this->load->view('friends');
	}

	//add new post
	function NewPost()
	{
		if ($this->input->post()) {
			$title = $this->input->post('newpost');
			$time = date('Y-m-d H:i:s');
			$userId = $this->session->userdata('userId');

			$this->load->model('PostManager', 'newPost');
			$newPost = $this->newPost->addNewPost($title, $time, $userId);
			redirect('home');
		}
	}

//show current logged users public home page
	function showPublicHomePage()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->load->model('PostManager', 'posts');

			$currentUserId = $this->session->userdata('userId');
			$data['redirectedUserPosts'] = $this->posts->getPosts($currentUserId);
			$this->load->view('home_page', $data);
		} else {
			$this->load->view('login_view');
		}
	}


	function HomePage()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			$this->load->model('PostManager', 'posts');

			$currentUserId = $this->session->userdata('userId');
			$result['allPosts'] = $this->posts->getAllPosts($currentUserId);


			$this->load->view('home_page', $result);
		} else {
			$this->load->view('login_view');
		}


	}

	function date_compare($element1, $element2)
	{
		$datetime1 = strtotime($element1['timestamp']);
		$datetime2 = strtotime($element2['timestamp']);
		return $datetime1 - $datetime2;
	}



}


