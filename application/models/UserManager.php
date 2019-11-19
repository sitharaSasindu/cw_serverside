<?php
include 'user.php';

class UserManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function userRegistration($firstName, $lastName, $email, $password, $musicGenres)
	{
		$userId = uniqid('usr', true);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$userDetails = array('userId' => $userId, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $password, 'musicGenre' => $musicGenres);
		$this->db->insert('users', $userDetails);
	}


	function validate($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('users', 1);

		$result = $query->row_array(); // get the row first
		print_r($result['password']);

		$aaa = '$2y$10$drwta1FAeiArW';
		echo(password_verify($password, $aaa));

		if ($result && password_verify($password, $aaa)) {
			print_r($result['password']);
		}
		return $query;

//		$userPass = $result->row();
//		if(password_verify($password, $result->password)){
//
//			return $result;
//		}else{
//			return false;
//		}
//		if($pass == "S2e23ed3qfsssccccccs"){

	}

//	}

}
