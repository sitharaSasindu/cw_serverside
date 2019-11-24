<?php
include 'Post.php';

class PostManager extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'post');
		$this->load->model('FriendsManager', 'friendsManager');
	}

	/**
	 * Add new post into database table
	 *
	 * @param $title
	 * @param $date
	 * @param $userId
	 *
	 * @return void
	 */
	function addNewPost($title, $date, $userId)
	{
		$postId = uniqid('post', true);
		$newPostDetails = array('postId' => $postId, 'userId' => $userId, 'title' => $title, 'timestamp' => $date);
		$this->db->insert('posts', $newPostDetails);
	}

	/**
	 * Returns all the posts of a particular user
	 *
	 * @param $userId
	 *
	 * @return array of posts
	 */
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

	/**
	 * Returns all the relevant(currentUsr | followings) posts
	 *
	 * @param $currentUserId
	 *
	 * @return array of posts
	 */
	function getAllPosts($currentUserId)
	{
		$currentUserPosts = $this->getPosts($currentUserId);
		$followingsUsersId = $this->friendsManager->getFollowings($currentUserId);//get array of following users

		$followingsUsersPosts = array();
		foreach ($followingsUsersId as $row) {//get all the posts of following user by user
			$followingsUsersPosts = $this->getPosts($row);
		}

		$followingsPostListArray = array();
		foreach ($followingsUsersPosts as $row) {//get all the posts of the following users and assign them to array
			$checkPostBody = $this->createHyperlinks($row->getPostBody());
			$followingsPostListArray[] = new Post($row->getUserId(), $row->getPostId(), $checkPostBody, $row->getTimestamp());
		}

		$currentUserPostList = array();
		foreach ($currentUserPosts as $row) { //get all the posts of the current user
			$checkPostBody = $this->createHyperlinks($row->getPostBody());
			$currentUserPostList[] = new Post($row->getUserId(), $row->getPostId(), $checkPostBody, $row->getTimestamp());
		}

		$allPosts = array_merge($currentUserPostList, $followingsPostListArray);
		usort($allPosts, function($timestamp1, $timestamp2) {
			$time1 = new DateTime($timestamp2->getTimeStamp());
			$time2 = new DateTime($timestamp1->getTimeStamp());

			if ($time1 == $time2) {
				return 0;
			}
			return $time1 < $time2 ? -1 : 1;
		});
		return $allPosts;
	}

	/**
	 * Check and identify if URL exists within a string
	 * if that url consist of a image, automatically display it
	 *
	 * @param $stringText
	 *
	 * @return string hyperlinked
	 */
	function createHyperlinks($stringText)
	{
		$regexUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
		$imageTypes = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
		if (preg_match_all($regexUrl, $stringText, $url)) {

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

				if (in_array($extension, $imageTypes)) {//combine html image tags with the string to show it in thw browser
					$replace = '<img src= "' . $link . '"  style = "max-width:100%">';

				} else {
					$replace = '<a href="' . $link . '" title="' . $newLinks . '" target="_blank">' . $link . '</a>';
				}

				$stringText = str_replace($search, $replace, $stringText);
			}
		}

		/** @var TYPE_NAME $identifiedStringText */
		return $stringText;
	}

}
