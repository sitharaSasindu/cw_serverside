<?php
include 'user.php';

class UserManager extends CI_Model{
	

	function userRegistration($firstName, $lastName, $email, $password, $musicGenres){
//		$this->load->model('user');
//		$this->User->setUserId();
//		$userId = $this->User->getUserId();
//		$userActive = 0;

		$userId = uniqid('usr', true);
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		
		$userDetails = array('userId' => $userId, 'firstName'=>$firstName, 'lastName' => $lastName, 'email' =>$email, 'password' => $password, 'musicGenre' => $musicGenres);
		$this->db->insert('users', $userDetails);
	}


	function __construct(){
		parent::__construct();
	}


	function validate($email,$password){

		$this->db->where('email',$email);
		$pass = $this->db->where('password',$password);
//		if($pass == "S2e23ed3qfsssccccccs"){
			$result = $this->db->get('users',1);
			return $result;
		}

//	}

}
