<?php
class ContactsController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('contact_list_page');
//		if ($this->session->userdata('logged_in')){
//			$this->load->view('contact_list_page');
//		}
//		else {
//			redirect('home');
//		}
	}

}
