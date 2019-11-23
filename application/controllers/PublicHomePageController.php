<?php


class PublicHomePageController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
		$this->load->model('UserManager', 'userManager');
	}


	function RedirectToUserProfile()
	{
		$redirectToUserId = $this->input->post('userId');
		print_r($redirectToUserId);
		$this->load->model('UserManager', 'user');
		$result = $this->userManager->GetUserDetails($redirectToUserId);

		$redirectedUserSessionData = array(
			'redirectedUsersUserId' => $redirectToUserId,
			'redirectedUsersFirstName' => $result->getFirstName(),
			'redirectedUsersLastName' => $result->getLastName(),
			'redirectedUsersMusicGenre' => $this->user->GetFavGenreNames($redirectToUserId),
			'redirectedUsersAvatarUrl' => $result->getProfilePhotoUrl(),
			'redirectedUserSet' => TRUE
		);
		$this->session->set_userdata($redirectedUserSessionData);
		$this->load->model('PostManager', 'posts');

		if ($this->session->userdata('redirectedUserSet') == TRUE) {
			$data['redirectedUserPosts'] = $this->posts->getPosts($redirectToUserId);
			$this->load->view('public_home_page', $data);
		} else {
			$this->load->view('login_view');
		}

	}


}
