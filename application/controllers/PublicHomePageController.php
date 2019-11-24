<?php

class PublicHomePageController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'posts');
		$this->load->model('FriendsManager', 'friendsManager');
		$this->load->model('UserManager', 'userManager');
	}

	/**
	 * Show the public home page of selected user
	 *
	 * @return void
	 */
	function redirectToUserProfile()
	{
		$redirectToUserId = $this->input->post('userId');//get user id of the redirect user
		$result = $this->userManager->findUsersDetails($redirectToUserId);

		print_r($result);
		$redirectedUserSessionData = array(
			'redirectedUsersUserId' => $redirectToUserId,
			'redirectedUsersFirstName' => $result->getFirstName(),
			'redirectedUsersLastName' => $result->getLastName(),
			'redirectedUsersMusicGenre' => $this->userManager->findUsersFavGenres($redirectToUserId),
			'redirectedUsersAvatarUrl' => $result->getProfilePhotoUrl(),
			'redirectedUserSet' => TRUE
		);
		$this->session->set_userdata($redirectedUserSessionData);

		if ($this->session->userdata('redirectedUserSet') == TRUE) {
			$bagOfValues['redirectedUserPosts'] = $this->posts->getPosts($redirectToUserId);
			$this->load->view('public_home_page', $bagOfValues);
		} else {
			$this->load->view('login_view');
		}

	}

}
