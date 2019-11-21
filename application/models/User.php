<?php

Class user extends CI_Model{

	private $userId;
	private $firstName;
	private $lastName;
	private $profilePhotoUrl;

	function __construct($userId, $firstName, $lastName, $profilePhotoUrl)
	{
		$this->userId = $userId;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->profilePhotoUrl = $profilePhotoUrl;
	}
	public function getUserId(){return $this->userId;}

	public function getFirstName(){return $this->firstName;}

	public function getLastName(){return $this->lastName;}

	public function getProfilePhotoUrl(){return $this->profilePhotoUrl;}
}
