<?php


class FriendsManager extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	function QueryUsersByGenre($genre){

		$this->db->select('musicGenre, userId, lastName, firstName');
//		$this->db->from('users');

		$query= $this->db->get('users');

		$selected = [];
		foreach ($query->result() as $row)
		{

			if (strpos($row->musicGenre, $genre) !== false)
			{
				$selected[] = array($row->userId);
			}
		}
//		print_r($selected);

		return $selected;

	}





}
