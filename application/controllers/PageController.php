<?php


class PageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Usermanager', 'userManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	public function LoggedIn()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		} else {
			return FALSE;
		}
	}

	public function Index()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		} else {
			redirect('login');
		}
	}

	function Register()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		} else {
			$this->load->view('register');
		}
	}

	function Login()
	{
		if ($this->session->userdata('logged_in') == TRUE) {
			redirect('home');
		} else {
			$this->load->view('login_view');
		}
	}

	function RedirectToUserProfile(){
		$redirectToUserId = $this->input->post('userId');

		$result = $this->userManager->GetUserDetails($redirectToUserId);

			$data  = $result->row_array();
			$firstName  = $data['firstName'];
			$lastName  = $data['lastName'];
			$musicGenre  = $data['musicGenre'];
			$userId = $data['userId'];
			$redirectedUserSessionData = array(
				'redirectedUsersUserId' => $userId,
				'redirectedUsersFirstName'  => $firstName,
				'redirectedUsersLastName' => $lastName,
				'redirectedUsersMusicGenre'=> $musicGenre,
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

	function FindFriends(){
		$this->load->model('FriendsManager', 'friendsManager');

		$data['friends'] = $this->friendsManager->FindFriends();
		$data['followers'] = $this->friendsManager->GetFollowersNames();
		$data['followings'] = $this->friendsManager->GetFollowingsNames();

		$this->load->view('friends', $data);
	}


	function ShowFollowings(){
		$data['followings'] = $this->friendsManager->GetFollowingsNames();
		$this->load->view('followings_page', $data);
	}

	function ShowFollowers(){
		$data['followers'] = $this->friendsManager->GetFollowersNames();
		$this->load->view('followers_page', $data);
	}



}
