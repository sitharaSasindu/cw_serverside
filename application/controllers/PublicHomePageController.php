<?php


class PublicHomePageController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}


	function RedirectToUserProfile()
	{
		$redirectToUserId = $this->input->post('userId');

		$result = $this->userManager->GetUserDetails($redirectToUserId);

		$data = $result->row_array();
		$firstName = $data['firstName'];
		$lastName = $data['lastName'];
		$musicGenre = $data['musicGenre'];
		$userId = $data['userId'];
		$redirectedUserSessionData = array(
			'redirectedUsersUserId' => $userId,
			'redirectedUsersFirstName' => $firstName,
			'redirectedUsersLastName' => $lastName,
			'redirectedUsersMusicGenre' => $musicGenre,
			'redirectedUserSet' => TRUE
		);
		$this->session->set_userdata($redirectedUserSessionData);

		$this->load->model('PostManager', 'posts');

		$currentUserId = $this->session->userdata('redirectedUsersUserId');
		if ($this->session->userdata('redirectedUserSet') == TRUE) {
			$data['currentUserPosts'] = $this->posts->getPosts($currentUserId);
			$this->load->view('public_home_page', $data);
		} else {
			$this->load->view('login_view');
		}

	}


}
