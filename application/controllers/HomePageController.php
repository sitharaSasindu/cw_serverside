<?php

Class HomePageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	function NewPost()
	{

		if ($this->input->post()) {
			$title = $this->input->post('newpost');
			$time = date('Y-m-d H:i:s');
			$userId = $this->session->userdata('userId');

			$this->load->model('PostManager', 'posts');
			$data['results'] = $this->posts->getPosts();
//			echo $data['results']->title;

			$this->load->model('PostManager', 'newPost');
			$newPost = $this->newPost->addNewPost($title, $time, $userId);
		}
	}




}
