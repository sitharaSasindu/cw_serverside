<?php
include 'user.php';

class UserManager extends CI_Model{

	function genarateUserId(){

	}

	function userRegistration($firstName, $lastName, $email, $password, $musicGenres){
//		$this->load->model('user');
//		$userId = $this->User->getUserId();

		$userActive = 0;
		$this->load->database();
		$userDetails = array('userId' => 42, 'firstName'=>$firstName, 'lastName' => $lastName, 'email' =>$email, 'password' => $password, 'musicGenre' => 1);
		$this->db->insert('user', $userDetails);
	}


}
