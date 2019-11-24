<?php

class FriendsManager extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Returns list of users registered under a particular genre
	 *
	 * @param $genre search box value
	 *
	 * @return array favourite genre names list of users
	 */
	function queryUsersByGenre($genre)
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

	/**
	 * Insert new connection between two users into
	 * connection table
	 *
	 * @param $CurrentLoggedUserId
	 * @param $followedByUserId
	 *
	 * @return void
	 */
	function addConnection($CurrentLoggedUserId, $followedByUserId)
	{
		$newConnection = array('user_follows' => $followedByUserId, 'user' => $CurrentLoggedUserId);
		$this->db->insert('connection', $newConnection);
	}

	/**
	 * Returns the particular user's friend list
	 * by intersecting followers and followings in his account
	 *
	 * @param $userId
	 *
	 * @return array of friends' user details
	 */
	function findFriends($userId)
	{
		$friendsUserIds = array_intersect($this->getFollowers($userId), $this->getFollowings($userId));
		$friendsNames = array();
		foreach ($friendsUserIds as $key => $item) {
			$this->db->where('userId', $friendsUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$friendsNames[] = new User($row->userId, $row->firstName, $row->lastName, $row->photoUrl);
			}
		}
		return $friendsNames;
	}

	/**
	 * Returns currently logged users followers list
	 *
	 * @param $userId
	 *
	 * @return array of user ids of followers
	 */
	function getFollowers($userId)
	{
		$this->db->select('user_follows, user');
		$query = $this->db->get('connection');

		$followers = Array();
		foreach ($query->result() as $row) {

			if ($userId === $row->user_follows) {
				$followers[] = $row->user;
			}
		}
		return $followers;
	}

	/**
	 * Returns currently logged user's followings list
	 *
	 * @param $userId
	 *
	 * @return array of user ids followings
	 */
	function getFollowings($userId)
	{
		$this->db->select('user_follows, user');
		$query = $this->db->get('connection');

		$followings = Array();
		foreach ($query->result() as $row) {

			if ($userId === $row->user) {
				$followings[] = $row->user_follows;
			}
		}
		return $followings;
	}

	/**
	 * Returns all the details of current user's followers
	 *
	 * @param $userId
	 *
	 * @return array followers details
	 */
	function getFollowersDetails($userId)
	{
		$followersUserIds = $this->getFollowers($userId);
		$followersUserDetails = array();
		foreach ($followersUserIds as $key => $item) {
			$this->db->where('userId', $followersUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$followersUserDetails[] = new User($row->userId, $row->firstName, $row->lastName, $row->photoUrl);
			}
		}
		return $followersUserDetails;
	}

	/**
	 * Returns all the following users' details of current user
	 *
	 * @param $userId
	 *
	 * @return array user details
	 */
	function getFollowingsDetails($userId)
	{
		$followingsUserIds = $this->getFollowings($userId);
		$followingsUsersDetails = array();
		foreach ($followingsUserIds as $key => $item) {
			$this->db->where('userId', $followingsUserIds[$key]);
			$query = $this->db->get('users');

			foreach ($query->result() as $row) {
				$followingsUsersDetails[] = new User($row->userId, $row->firstName, $row->lastName, $row->photoUrl);
			}
		}
		return $followingsUsersDetails;
	}

}
