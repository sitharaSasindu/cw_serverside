<?php

class FriendsManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function QueryUsersByGenre($genre)
	{
		$this->db->select('musicGenre, userId, lastName, firstName');
		$query = $this->db->get('users');

		$selected = array();
		foreach ($query->result() as $row) {

			if (strpos($row->musicGenre, $genre) !== false) {
				$selected[] = array($row->userId, $row->firstName, $row->lastName);
			}
		}
		return $selected;
	}


	function QueryUsersByGenre2($genre)
	{
		$this->db->select('musicGenre, userId, lastName, firstName');
		$query = $this->db->get('users');

		$selected = array();
		foreach ($query->result() as $row) {

			if (strpos($row->musicGenre, $genre) !== false) {
				$selected[] = $row->userId;
			}
		}
		return $selected;
	}

	function AddConnection($CurrentLoggedUserId, $followedByUserId)
	{
		$newConnection = array('user_follows' => $followedByUserId, 'user' => $CurrentLoggedUserId);
		$this->db->insert('connection', $newConnection);
	}

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

	function GetFollowings()
	{
		$currentLoggedUserId = $this->session->userdata('userId');
		$this->db->select('user_follows, user');
		$query = $this->db->get('connection');

//		$followings = Array();
		foreach ($query->result() as $row) {

			if ($currentLoggedUserId === $row->user) {
				$followings[] = $row->user_follows;
			}
		}
		return $followings;
	}

	function GetFollowersNames(){
		$followersUserIds = $this->GetFollowers();
		$followersNames = array();
		foreach ($followersUserIds as $key => $item) {
			$this->db->where('userId', $followersUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$name = $row->firstName + $row->lastName;
				$followersNames[] = array($row->firstName, $row->lastName);
			}
		}
		return $followersNames;
	}


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
