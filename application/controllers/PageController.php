<?php


class PageController extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Usermanager', 'userManager');

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
//		$redirectToUserId = $this->input->post('redirectToUserId');

//		$result = $this->userManager->GetUserDetails($redirectToUserId);



		redirect('login');
//		echo $redirectToUserId;
//		$email    = $this->input->post('email',TRUE);
//		$password = $this->input->post('password',TRUE);
//		$validate = $this->UserManager->validate($email,$password);
//		if($validate->num_rows() > 0){
//			$data  = $validate->row_array();
//			$firstName  = $data['firstName'];
//			$lastName  = $data['lastName'];
//			$musicGenre  = $data['musicGenre'];
//			$email = $data['email'];
//			$userId = $data['userId'];
//			$sessionData = array(
//				'userId' => $userId,
//				'firstName'  => $firstName,
//				'lastName' => $lastName,
//				'musicGenre'=> $musicGenre,
//				'email'     => $email,
//				'logged_in' => TRUE
//			);
//			$this->session->set_userdata($sessionData);
//			$this->load->view('home_page');
//
//		}else{
//			echo $this->session->set_flashdata('msg','Username or Password is Wrong');
//			redirect('login');
//		}
	}

}
