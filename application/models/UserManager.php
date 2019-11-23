<?php
include 'User.php';
include 'Genre.php';

class UserManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	/*user registration insert data into user table
	 * */
	function UserRegistration($firstName, $lastName, $email, $password, $photoUrl, $selectedGenre)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return false;
		} else {
			$userId = uniqid('usr', true);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			$userDetails = array('userId' => $userId, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $hashedPassword, 'photoUrl' => $photoUrl);
			$this->db->insert('users', $userDetails);

			foreach ($selectedGenre as $key => $item1) {
					$userFavGenre = array('userId' =>$userId , 'genreId' => $selectedGenre[$key]);
					$this->db->insert('genre_connection', $userFavGenre);
				}
			return true;
		}
	}


//get genrelist from the genre table on register page
	function ShowGenreList()
	{
		$this->db->select('genreId, genreName');
		$query = $this->db->get('genre');

		$genreList = array();
		foreach ($query->result() as $row) {
			$genreList[] = new Genre($row->genreId, $row->genreName);
		}
		return $genreList;
	}


	function GetGenreNames($userId)
	{
		$genreList = $this->ShowGenreList();
		$this->db->select('genreId, userId');
		$this->db->where('userId', $userId);
		$query = $this->db->get('genre_connection');

		$favGenreIdList = array();
		foreach ($query->result() as $row){
			$favGenreIdList = $row->genreName;
		}


//		foreach($genreListSelected as $selected){
//			foreach($genreListSelected as $key => $item1){
//			print_r($selected[$key]);
//			foreach ($genreList as $item) {
////			print_r($item->getGenreName());
////				print_r($genreListSelected);
//
//				if ($selected[$key] == $item->getGenreName() ) {
//					$favGenreIdList[] = $item->getGenreId();
//				}
//			}
//			}
//		}


		print_r($favGenreIdList);
		return $favGenreIdList;

	}


	//login validation
	function validate($email, $password)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) {
			$user = $query->row();
			$accountHashedPassword = $user->password;
			if ($this->verifyPasswordHash($password, $accountHashedPassword)) {
				return $query;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	function GetUserDetails($userId)
	{
		$this->db->where('userId', $userId);
		$query = $this->db->get('users');

		return $query;
	}

	function GetUserDetails1($userId)
	{
		$this->db->where('userId', $userId);
		$query = $this->db->get('users');
		$user = $query->row();

//	foreach ($query->result() as $row) {
		$userDetails = new user($user->userId, $user->firstName, $user->lastName, $user->photoUrl);
//	}

		return $userDetails;
	}

	//verify login password
	function verifyPasswordHash($password, $hashedPassword)
	{
		if (password_verify($password, $hashedPassword)) {
			return true;
		} else {
			return false;
		}
	}


}
