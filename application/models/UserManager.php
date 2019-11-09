<?php
include 'User.php';

class UserManager extends CI_Model{

	function genarateUserId(){

	}

	function userRegistration($firstName, $lastName){
		$this->load->database();
		$data = array('firstName'=>$firstName, 'lastName' => $lastName, 'active' => 'false');
		$this->db->insert('users', $data);
	}

	fucntion
}
