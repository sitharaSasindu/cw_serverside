<?php

Class user extends CI_Model{

	private $userId;
	private $firstName;
	private $lastName;
	private $email;
	private $active;
	private $password;
	private $musicGenre;

	function __construct($userId, $firstName, $lastName, $email, $password, $musicGenre)
	{
		$this->userId = $userId;
		$this->email =$email;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->password = $password;
		$this->musicGenre = $musicGenre;
	}
	public function getUserId(){return $this->userId;}

	public function setActive($active){$this->active = $active;}

	public function getFirstName(){return $this->firstName;}

	public function getLastName(){return $this->lastName;}

	public function getEmail(){return $this->email;}

	public function getActive(){return $this->active;}

	public function getPassword(){return $this->password;}

}
