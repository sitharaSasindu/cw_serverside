<?php


class FriendsController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	function ShowUsersByGenre()
	{
		$genre = $this->input->post('genreSearch');
		$userListByGenre = $this->friendsManager->QueryUsersByGenre($genre);
		$userListByGenre2 = $this->friendsManager->QueryUsersByGenre2($genre);
		$followingsUserIds = $this->friendsManager->GetFollowings();

//		print_r($followingsUserIds);
//		echo "KKKKKKK";
//		print_r($userListByGenre2);

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

//		$sendData['alreadyFollowedUsers'] = array_diff($followingsUserIds, $userListByGenre2);
		$sendData['userListByGenre'] = $userListByGenre;
//		echo "KKKKKKK";
//		print_r($sendData['alreadyFollowedUsers']);

		$this->load->view('find_friends', $sendData);

	}

	function followAUser()
	{
			$followedByUserId = $this->input->post('followedByUserId');
			echo $followedByUserId;
			$currentLoggedUserId = $this->session->userdata('userId');

			$this->load->model('FriendsManager', 'newConnection');
			$newConnection = $this->newConnection->AddConnection($currentLoggedUserId, $followedByUserId );
	}

	function FindFriends(){
		$this->load->model('FriendsManager', 'friendsManager');

		$data['friends'] = $this->friendsManager->FindFriends();
		$data['followers'] = $this->friendsManager->GetFollowersNames();
		$data['followings'] = $this->friendsManager->GetFollowingsNames();

		$this->load->view('friends', $data);
	}

	function CheckFollowing(){



	}

}
