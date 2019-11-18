<?php


class PostManager extends CI_Model
{
	function addNewPost($title, $date, $userId){

		$postId = uniqid('post', true);
		$newPostDetails = array('postId' => $postId, 'userId' => $userId, 'title'=>$title, 'timestamp' => $date);
		$this->db->insert('posts', $newPostDetails);
	}



	function getPosts()
	{
		$this->db->where('userId', $this->session->userdata('userId'));
		$result = $this->db->get('posts');
		if ($result->num_rows() == 0) {
			return false;
		}
			return $result->result();

//		$fetchedPosts = array();
//		$postDate = array();
//		foreach ($result->result() as $row) {
//			$fetchedPosts[] = $row->title;
//			$postDate[] = $row->timestamp;
//		}


	}

}
