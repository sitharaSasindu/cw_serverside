<?php


class FriendsController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	function ShowFriends(){
		$this->load->model('FriendsManager', 'friendsManager');

		$data['friends'] = $this->friendsManager->FindFriends();
		$data['followers'] = $this->friendsManager->GetFollowersNames();
		$data['followings'] = $this->friendsManager->GetFollowingsNames();
		$this->load->view('friends', $data);
	}


//	function ShowGenreListOnRegistration(){
//		$this->load->model('UserManager', 'user');
//		$genreList = $this->user->ShowGenreList();
//		print_r($genreList);
//
//		$this->load->view('register', $genreList);
//	}

	function ShowFollowings(){
		$data['followings'] = $this->friendsManager->GetFollowingsNames();
		$this->load->view('followings_page', $data);
	}

	function ShowFollowers(){
		$data['followers'] = $this->friendsManager->GetFollowersNames();
		$this->load->view('followers_page', $data);
	}

	//search function
	function ShowUsersByGenre()
	{
		$genre = $this->input->post('genreSearch');
		$userListByGenre2 = $this->friendsManager->QueryUsersByGenre($genre);

		$followingsUserIds = $this->friendsManager->GetFollowings();

		if(empty(array_diff($followingsUserIds, $userListByGenre2))) {
			if(!empty(array_diff($userListByGenre2, $followingsUserIds))) {
				$sendData['alreadyFollowedUsers'] = array_diff($userListByGenre2, $followingsUserIds);
			}
		}else{
			if(sizeof($userListByGenre2) >= sizeof($followingsUserIds)){
				$sendData['alreadyFollowedUsers'] = array_diff($userListByGenre2, $followingsUserIds);
			}else{
				$sendData['alreadyFollowedUsers'] = array_diff($followingsUserIds, $userListByGenre2);
			}
		}

		$this->load->model('UserManager', 'user');
		$userListByGenre = $this->user->findUsersDetails($userListByGenre2);
		print_r($userListByGenre);

		$sendData['userListByGenre'] = $userListByGenre;
		$this->load->view('search_results', $sendData);

	}

	//add record to connection table to follow user
	function followAUser()
	{
			$followedByUserId = $this->input->post('followedByUserId');
			$currentLoggedUserId = $this->session->userdata('userId');

			$this->load->model('FriendsManager', 'newConnection');
			$newConnection = $this->newConnection->AddConnection($currentLoggedUserId, $followedByUserId );
	}





}
