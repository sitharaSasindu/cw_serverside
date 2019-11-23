<?php

class Post extends CI_Model
{

	private $postId;
	private $postBody;
	private $userId;
	private $timestamp;

	public function __construct($userId, $postId, $postBody, $timestamp)
	{
		$this->postId = $postId;
		$this->postBody = $postBody;
		$this->userId = $userId;
		$this->timestamp = $timestamp;
	}

	/**
	 * @return mixed
	 */
	public function getPostId()
	{
		return $this->postId;
	}

	/**
	 * @return mixed
	 */
	public function getPostBody()
	{
		return $this->postBody;
	}

	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @return mixed
	 */
	public function getTimestamp()
	{
		return $this->timestamp;
	}
}
