<?php
include 'Post.php';
class PostManager extends CI_Model
{

	//add post to db
	function addNewPost($title, $date, $userId){

		$postId = uniqid('post', true);
		$newPostDetails = array('postId' => $postId, 'userId' => $userId, 'title'=>$title, 'timestamp' => $date);
		$this->db->insert('posts', $newPostDetails);
	}

	function getPosts($userId)
	{
		$this->db->where('userId', $userId);
		$query = $this->db->get('posts');

		$userPosts =array();
		foreach ($query->result() as $row) {
			$userPosts[] = new Post($row->userId, $row->postId, $row->title, $row->timestamp);
		}
		return $userPosts;
	}


	function getAllPosts()
	{
		$currentUserId = $this->session->userdata('userId');
		$this->db->where('userId', $currentUserId);
		$result = $this->db->get('posts');
		foreach ($result->result() as $row) {
				$currentUserPosts[] = array($row->userId,$row->title, $row->timestamp);
	}


		$this->load->model('PostManager', 'posts');
		$this->load->model('FriendsManager', 'friendsManager');
		$followingsUserId = $this->friendsManager->GetFollowings();


		foreach ($followingsUserId as $key2 => $item) {
			$this->db->where('userId', $followingsUserId[$key2]);
			$result = $this->db->get('posts');
			foreach ($result->result() as $row) {
				$followingsUsersPosts[] = array($row->userId, $row->title, $row->timestamp);
			}
		}


		$allPosts = array_merge($currentUserPosts,$followingsUsersPosts);
		usort($allPosts, array($this, "date_compare"));

		print_r($allPosts);

return $allPosts;


	}

	function date_compare($element1, $element2) {
		$datetime1 = strtotime($element1['2']);
		$datetime2 = strtotime($element2['2']);
		return $datetime1 - $datetime2;
	}


}
