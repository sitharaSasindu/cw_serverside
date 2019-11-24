<?php

class FriendsManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function QueryUsersByGenre($genre)
	{
		$this->db->select('genreId, genreName');
		$this->db->where('genreName', $genre);
		$query = $this->db->get('genre');
		$searchedGenreId = $query->row()->genreId;

		$usersSelected = array();
		$this->db->select('genreId, userId');
$this->db->where('genreId', $searchedGenreId);
		$query2 = $this->db->get('genre_connection');

		foreach ($query2->result() as $row) {

			$usersSelected[] = $row->userId;
		}
		return $usersSelected;
	}


//	function QueryUsersByGenre2($genre)
//	{
//
//		$this->db->select('userId, lastName, firstName');
//		$query = $this->db->get('users');
//
//		$selected = array();
//		foreach ($query->result() as $row) {
//
//			if (strpos($row->musicGenre, $genre) !== false) {
//				$selected[] = $row->userId;
//			}
//		}
//		return $selected;
//	}

	function AddConnection($CurrentLoggedUserId, $followedByUserId)
	{
		$newConnection = array('user_follows' => $followedByUserId, 'user' => $CurrentLoggedUserId);
		$this->db->insert('connection', $newConnection);
	}

	//get friends user id list from follower snad followings and return friend list names
	function FindFriends()
	{
		$friendsUserIds = array_intersect($this->GetFollowers(), $this->GetFollowings());
		$friendsNames = array();
		foreach ($friendsUserIds as $key => $item) {
			$this->db->where('userId', $friendsUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$friendsNames[] = array($row->firstName, $row->lastName);
			}
		}
		return $friendsNames;
	}

	//get followers user ids and return array of user ids
	function GetFollowers()
	{
		$currentLoggedUserId = $this->session->userdata('userId');
		$this->db->select('user_follows, user');
		$query = $this->db->get('connection');

		$followers = Array();
		foreach ($query->result() as $row) {

			if ($currentLoggedUserId === $row->user_follows) {
				$followers[] = $row->user;
			}
		}
		return $followers;
	}

	//get followeings user ids from the connection table
	function GetFollowings()
	{
		$currentLoggedUserId = $this->session->userdata('userId');
		$this->db->select('user_follows, user');
		$query = $this->db->get('connection');

		$followings = Array();
		foreach ($query->result() as $row) {

			if ($currentLoggedUserId === $row->user) {
				$followings[] = $row->user_follows;
			}
		}
		return $followings;
	}

	//get names of the followers from the user table
	function GetFollowersNames(){
		$followersUserIds = $this->GetFollowers();
		$followersNames = array();
		foreach ($followersUserIds as $key => $item) {
			$this->db->where('userId', $followersUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$followersNames[] = array($row->firstName, $row->lastName);
			}
		}
		return $followersNames;
	}

//get names of followings from user table
	function GetFollowingsNames(){
		$followingsUserIds = $this->GetFollowings();
		$followingsNames = array();
		foreach ($followingsUserIds as $key => $item) {
			$this->db->where('userId', $followingsUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$name = $row->firstName + $row->lastName;
				$followingsNames[] = array($row->firstName, $row->lastName);
			}
		}
		return $followingsNames;
	}




}
