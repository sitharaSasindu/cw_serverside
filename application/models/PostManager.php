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
			$checkPostBody = $this->createHyperlinks($row->title);
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

		$currentUserPostList = array();
		foreach ($currentUserPosts as $row) { //get all the posts of the current user
			$checkPostBody = $this->createHyperlinks($row->getPostBody());
			$currentUserPostList[] = new Post($row->getUserId(), $row->getPostId(), $checkPostBody, $row->getTimestamp());
		}
//		print_r($currentUserPostList);

		$followingsUsersPosts = array();
		foreach ($followingsUsersId as $row) {//get all the posts of following user by user
			$followingsUsersPosts[] = $this->getPosts($row);
		}
		print_r($followingsUsersPosts);













//		print_r( ($this->getPosts($row))->$row->getUserId());

//		$followingsPostListArray = array();
//		foreach ($followingsUsersId as $row) {//get all the posts of the following users and assign them to array
//			$A = $this->getPosts($row);
//			$checkPostBody = $this->createHyperlinks($A->getPostBody());
//			$followingsPostListArray[] = new Post($A->getUserId(), $A->getPostId(), $checkPostBody, $A->getTimestamp());
//		}
//		print_r($followingsPostListArray);



		$allPosts = array_merge($currentUserPostList, $followingsUsersPosts); //merge users pots and followings posts
		$sortedAllPosts = $this->sortByDate($allPosts); //sort all posts by date
		return $sortedAllPosts;
	}

	/**
	 * Returns all the posts of a particular user
	 *
	 * @param $userId
	 *
	 * @return array of posts
	 */
	function getPublicHomePosts($userId)
	{
		$this->db->where('userId', $userId);
		$query = $this->db->get('posts');

		$userPosts = array();
		foreach ($query->result() as $row) {
			$checkPostBody = $this->createHyperlinks($row->title);
			$userPosts[] = new Post($row->userId, $row->postId, $checkPostBody, $row->timestamp);
		}
		$sortedPosts = $this->sortByDate($userPosts);
		return $sortedPosts;
	}

	/**
	 * Returns the input array sorted by date
	 *
	 * @param $postArray
	 *
	 * @return array of posts
	 */
	function sortByDate($postArray)
	{
		usort($postArray, function ($timestamp1, $timestamp2) { //sort all posts by date
			$time1 = new DateTime($timestamp2->getTimeStamp());
			$time2 = new DateTime($timestamp1->getTimeStamp());

			if ($time1 == $time2) {
				return 0;
			}
			return $time1 < $time2 ? -1 : 1;
		});
		return $postArray;
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
