<?php
include 'User.php';
include 'Genre.php';

class UserManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Insert user registration details into Database
	 *
	 * @param $firstName
	 * @param $lastName
	 * @param $email
	 * @param $userName
	 * @param string $password user entered
	 * @param $photoUrl users avatar URL
	 * @param $selectedGenre an array of selected music genres
	 *
	 * @return bool if the user doesn't exist under that email and
	 *  successfully inserted registration details into database
	 */
	function userRegistration($firstName, $lastName, $userName, $email, $password, $photoUrl, $selectedGenre)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $userName);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return false;
		} else {
			$userId = uniqid('usr', true);
			$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

			$userDetails = array('userId' => $userId, 'firstName' => $firstName, 'lastName' => $lastName, 'userName' => $userName, 'email' => $email, 'password' => $hashedPassword, 'photoUrl' => $photoUrl);
			$this->db->insert('users', $userDetails);

			foreach ($selectedGenre as $key => $item1) {//insert user fav genres into genre connection table
				$userFavGenre = array('userId' => $userId, 'genreId' => $selectedGenre[$key]);
				$this->db->insert('genre_connection', $userFavGenre);
			}
			return true;
		}
	}

	/**
	 * Get available music genres on the genre table
	 * to show it in the registration form
	 *
	 * @return array music genre list array
	 */
	function getAvailableGenres()
	{
		$this->db->select('genreId, genreName');
		$query = $this->db->get('genre');

		$genreList = array();
		foreach ($query->result() as $row) {
			$genreList[] = new Genre($row->genreId, $row->genreName);
		}
		return $genreList;
	}

	/**
	 * Returns the favourite genre list of one user or
	 * multiple users
	 *
	 * @param $userId array of user ids
	 *
	 * @return array favourite genre names list of users
	 */
	function findUsersFavGenres($userId)
	{
		$genreList = $this->getAvailableGenres();
		$this->db->where('userId', $userId);
		$query = $this->db->get('genre_connection');

		$favGenreNameList = array();
		foreach ($query->result() as $row) {
			foreach ($genreList as $item) {
				if ($item->getGenreId() == $row->genreId) {
					$favGenreNameList[] = $item->getGenreName();
				}
			}
		}
		return $favGenreNameList;
	}

	/**
	 * Validate the login form details with the
	 * user credentials on the database
	 *
	 * @param $userName
	 * @param string $password user entered
	 *
	 * @return bool|obj if user doesn't exits return false
	 * if exist return object of user details
	 */
	function validate($userName, $password)
	{
		$this->db->where('userName', $userName);
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

	/**
	 * Check user exits
	 *
	 * @param $userName
	 *
	 * @return bool if user available
	 */
	function userExists($userName)
	{
		$this->db->where('userName', $userName);
		$query = $this->db->get('users');

		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Returns array of user details of particular users 
	 *
	 * @param $userId array of userIds 
	 * 
	 * @return array user details
	 */
	function findUsersDetails($userId)
	{
		if(is_array($userId)){
			foreach ($userId as $key => $item) {
				$this->db->where('userId', $userId[$key]);
				$query = $this->db->get('users');

				foreach ($query->result() as $row) {
					$userDetails[] = new user($row->userId, $row->firstName, $row->lastName, $row->photoUrl);
				}
			}
			return $userDetails;
		} else {
			$this->db->where('userId', $userId);
			$query = $this->db->get('users');

			$userDetails = array();
			foreach ($query->result() as $row) {
				$userDetails = new user($row->userId, $row->firstName, $row->lastName, $row->photoUrl);
			}
		return $userDetails;
		}
	}

	/**
	 * Verify the user password with the hashed password on the database
	 *
	 * @param string $password user entered
	 * @param string $hashedPassword from the database
	 *
	 * @return bool if password matches with the hash
	 */
	function verifyPasswordHash($password, $hashedPassword)
	{
		if (password_verify($password, $hashedPassword)) {
			return true;
		} else {
			return false;
		}
	}

}
