<?php

Class User extends CI_Model{

	private $firstName;
	private $lastName;
	private $email;
	private $active;

	function __construct($email)
	{
		$this->email =$email;
	}

}
