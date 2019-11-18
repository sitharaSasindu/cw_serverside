<?php


class FriendsController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('FriendsManager', 'friendsManager');
	}


	function ShowUsersByGenre()
	{
		$genre = $this->input->post('genreSearch');
		$data = $this->friendsManager->QueryUsersByGenre($genre);


//		echo $data;
		print_r($data);


//		$this->load->view('friends', $data);

	}


}
