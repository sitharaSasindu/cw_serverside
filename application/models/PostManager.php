<?php


class PostManager extends CI_Model
{
	function addNewPost($title, $date, $userId){

		$postId = uniqid('post', true);
		$newPostDetails = array('postId' => $postId, 'userId' => $userId, 'title'=>$title, 'timestamp' => $date);
		$this->db->insert('posts', $newPostDetails);
	}

	function getPosts($userId)
	{
		$this->db->where('userId', $userId);
		$result = $this->db->get('posts');
		if ($result->num_rows() == 0) {
			return false;
		}
//		print_r($result->result());
			return $result->result();

//		$fetchedPosts = array();
//		$postDate = array();
//		foreach ($result->result() as $row) {
//			$fetchedPosts[] = $row->title;
//			$postDate[] = $row->timestamp;
//		}


	}



	function getPosts2($userId)
	{
		$this->db->where('userId', $userId);
		$result = $this->db->get('posts');
		if ($result->num_rows() == 0) {
			return false;
		}



		$followers =array();
		foreach ($result->result() as $row) {
			$followers[] = $row->timestamp;
		}

		print_r($followers);

		usort($followers, 'date_compare');

//		print_r($result->result());
		return $result;

//		$fetchedPosts = array();
//		$postDate = array();
//		foreach ($result->result() as $row) {
//			$fetchedPosts[] = $row->title;
//			$postDate[] = $row->timestamp;
//		}


	}

	function date_compare($element1, $element2) {
		$datetime1 = strtotime($element1['timestamp']);
		$datetime2 = strtotime($element2['timestamp']);
		return $datetime1 - $datetime2;
	}

	function GetFollowingsPosts(){
		$this->load->model('PostManager', 'posts');
		$this->load->model('FriendsManager', 'friendsManager');
		$followingsUserId[] = $this->friendsManager->GetFollowings();
//			print_r($data['followings'][1]);

		$data = [];
		foreach ($followingsUserId[0] as $key => $item) {
			$data[] = $this->posts->getPosts($followingsUserId[0][$key]);

//echo $key;
		}
//		print_r($data);
		return $data;
	}

}
