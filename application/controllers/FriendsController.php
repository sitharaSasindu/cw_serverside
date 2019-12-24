<?php

class FriendsController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
		$this->load->model('UserManager', 'user');
	}

	/**
	 * Send particular users friend list to friends view
	 *
	 * @return void
	 */
	function showFriends()
	{
		if ($this->session->userdata('logged_in')){
			$currentLoggedUserId = $this->session->userdata('userId');
			$bagOfValues['friends'] = $this->friendsManager->FindFriends($currentLoggedUserId);
			$this->load->view('friends', $bagOfValues);
		}
		else {
			redirect('home');
		}
	}

	/**
	 * Send particular users following list to following view
	 *
	 * @return void
	 */
	function ShowFollowings()
	{
		if ($this->session->userdata('logged_in')){
			$currentLoggedUserId = $this->session->userdata('userId');
			$bagOfValues['friends'] = $this->friendsManager->FindFriends($currentLoggedUserId);
			$bagOfValues['followings'] = $this->friendsManager->getFollowingsDetails($currentLoggedUserId);
			$this->load->view('followings_page', $bagOfValues);
		}
		else {
			redirect('home');
		}
	}

	/**
	 * Send particular users followers list to followers view
	 *
	 * @return void
	 */
	function showFollowers()
	{
		if ($this->session->userdata('logged_in')){
			$currentLoggedUserId = $this->session->userdata('userId');
			$bagOfValues['friends'] = $this->friendsManager->FindFriends($currentLoggedUserId);
			$bagOfValues['followers'] = $this->friendsManager->getFollowersDetails($currentLoggedUserId);
			$this->load->view('followers_page', $bagOfValues);
		}
		else {
			redirect('home');
		}
	}
	/**
	 * Get user's search box input genre and find all the users
	 * registered under that genre
	 *
	 * @return void
	 */
	function showUsersByGenre()
	{
		if ($this->session->userdata('logged_in')) {
			$currentLoggedUserId = $this->session->userdata('userId');
			$genre = $this->input->post('genreSearch');//get search box input
			$searchResultsUserList = $this->friendsManager->queryUsersByGenre($genre);
			if (empty($searchResultsUserList)) {
				$bagOfValues['userListByGenre'] = null;
				$this->load->view('search_results', $bagOfValues);
			} else {
				$followingsUserIdList = $this->friendsManager->getFollowings($currentLoggedUserId);

				$bagOfValues['alreadyFollowedUsers'] = $followingsUserIdList;
				$userListByGenre = $this->user->findUsersDetails($searchResultsUserList);
				$bagOfValues['userListByGenre'] = $userListByGenre;
				$this->load->view('search_results', $bagOfValues);
			}
		}else{
			redirect('home');
		}
	}

	/**
	 * Add user follow record to connection table | remove user record
	 *
	 * @return void
	 */
	function followAUser()
	{
		$followedByUserId = $this->input->post('userId');
		$currentLoggedUserId = $this->session->userdata('userId');
		$followingsUserIdList = $this->friendsManager->getFollowings($currentLoggedUserId);
		$checkIfAlreadyFollowed = in_array($followedByUserId, $followingsUserIdList);

		if (empty($checkIfAlreadyFollowed)) {
			$this->friendsManager->addConnection($currentLoggedUserId, $followedByUserId);
		} else {
			$this->friendsManager->unFollowAUser($followedByUserId, $currentLoggedUserId);
		}
		redirect('followings');
	}
}
