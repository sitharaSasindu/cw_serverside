<?php
include 'Post.php';

class PostManager extends CI_Model
{

	//add post to db
//	private $friendsManager;

	function addNewPost($title, $date, $userId)
	{

		$postId = uniqid('post', true);
		$newPostDetails = array('postId' => $postId, 'userId' => $userId, 'title' => $title, 'timestamp' => $date);
		$this->db->insert('posts', $newPostDetails);
	}

	function getPosts($userId)
	{
		$this->db->where('userId', $userId);
		$query = $this->db->get('posts');

		$userPosts = array();
		foreach ($query->result() as $row) {
			$userPosts[] = new Post($row->userId, $row->postId, $row->title, $row->timestamp);
		}
		return $userPosts;
	}


	function getAllPosts($currentUserId)
	{
		$currentUserPosts = $this->getPosts($currentUserId);

		$this->load->model('PostManager', 'posts');
		$this->load->model('FriendsManager', 'friendsManager');
		$followingsUserId = $this->friendsManager->GetFollowings();

		$followingsUsersPosts = array();
		foreach ($followingsUserId as $key2 => $item) {
			$followingsUsersPosts = $this->getPosts($item);
		}

		$followingsPostListArray = array();
		foreach ($followingsUsersPosts as $row) {
			$followingsPostListArray[] = array($row->getUserId(), $row->getPostId(), $row->getPostBody(), $row->getTimestamp());
		}

		$currentUserPostList = array();
		foreach ($currentUserPosts as $row) {
			$checkPostBody = $this->turnUrlIntoHyperlink($row->getPostBOdy());
			$currentUserPostList[] = array($row->getUserId(), $row->getPostId(), $checkPostBody, $row->getTimestamp());
		}

		$allPosts = array_merge($currentUserPostList, $followingsPostListArray);
		usort($allPosts, array($this, "date_compare"));
		rsort($allPosts);

		return $allPosts;
	}

	function date_compare($element1, $element2)
	{
		$datetime1 = strtotime($element1['3']);
		$datetime2 = strtotime($element2['3']);
		return $datetime1 - $datetime2;
	}

	function turnUrlIntoHyperlink($string)
	{
		$reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
		$imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
		if (preg_match_all($reg_exUrl, $string, $url)) {

			// Loop through all matches
			foreach ($url[0] as $newLinks) {
				if (strstr($newLinks, ":") === false) {
					$link = 'http://' . $newLinks;
				} else {
					$link = $newLinks;
				}

				$search = $newLinks;
				$temp = explode(".", $newLinks);

				$extension = end($temp);

				if (in_array($extension, $imgExts)) {
					$replace = '<img src= "' . $link . '"  style = "max-width:100%">';

				} else {
					$replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';
				}

				$string = str_replace($search, $replace, $string);
			}
		}

		return $string;
	}

}
