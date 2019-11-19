<?php


class FriendsController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	function ShowUsersByGenre()
	{
		$genre = $this->input->post('genreSearch');
		$data = $this->friendsManager->QueryUsersByGenre($genre);



//		$count = count($data[0]);
//
//for($i=0; $i<=$count; $i++){
//
//}
		$sendData['user'] = $data;
//		print_r($sendData['user']);

		$this->load->view('friends', $sendData);

	}

	function add_personal()
	{
		$id = $this->uri->segment(3);
		//im confusing this part
//		$jid = $this->Jsprofile->get_jsid($id);
		print_r($this->input->post('title'));
echo "jjjj";
		$data = array(
			'js_personal_title' => $this->input->post('title'),
			'js_personal_desc' => $this->input->post('decs'),
			'tbl_jobseeker_jobseeker_id' => $id[0]['jobseeker_id'],
			'tbl_jobseeker_tbl_user_u_id'=>$id
		);
		// echo json_encode($data);

		print_r($data);
//		$this->db->insert('tbl_js_personal',$data);





			$title = $this->input->post('userId');
			$time = date('Y-m-d H:i:s');
			$userId = $this->session->userdata('userId');

			$this->load->model('PostManager', 'posts');
			$data['results'] = $this->posts->getPosts();
//			echo $data['results']->title;

			$this->load->model('PostManager', 'newPost');
			$newPost = $this->newPost->addNewPost($title, $time, $userId);



	}


}
