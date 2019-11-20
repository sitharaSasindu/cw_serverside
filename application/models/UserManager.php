<?php
include 'user.php';

class UserManager extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	function userRegistration($firstName, $lastName, $email, $password, $photoUrl, $musicGenres)
	{
		$userId = uniqid('usr', true);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		$userDetails = array('userId' => $userId, 'firstName' => $firstName, 'lastName' => $lastName, 'email' => $email, 'password' => $hashedPassword, 'photoUrl' => $photoUrl, 'musicGenre' => $musicGenres);
		$this->db->insert('users', $userDetails);
	}


	function validate($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('users', 1);

		$result = $query->row_array(); // get the row first
//		print_r($result['password']);


		echo (password_verify($password, $result['password']));

		echo "aaaa";
		print_r(GetUserDetails1());
		if((password_verify($password, $result['password']))){

		}

//		return $query;
//		if ($result && password_verify($password, $aaa)) {
//			print_r($result['password']);
//		}
//		return $query;

//		$userPass = $result->row();
//		if(password_verify($password, $result->password)){
//
//			return $result;
//		}else{
//			return false;
//		}
//		if($pass == "S2e23ed3qfsssccccccs"){

	}


function GetUserDetails($userId){
	$this->db->where('userId', $userId);
	$query = $this->db->get('users');

	return $query;
}

	function GetUserDetails1(){
		$currentLoggedUserId = $this->session->userdata('userId');
		$this->db->where('userId', $currentLoggedUserId);
		$query = $this->db->get('users');

	foreach ($query->result() as $row) {
			$userDetails = new user($row->userId, $row->firstName, $row->lastName, $row->email, $row->password, $row->musicGenre);
	}

		return $userDetails;
	}

}
