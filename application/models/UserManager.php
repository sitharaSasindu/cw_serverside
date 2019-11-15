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
		
		$userDetails = array('userId' => $userId, 'firstName'=>$firstName, 'lastName' => $lastName, 'email' =>$email, 'password' => $hashedPassword, 'musicGenre' => 1);
		$this->db->insert('users', $userDetails);
	}

	
	
	

}
