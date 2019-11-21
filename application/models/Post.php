<?php

class Post extends CI_Model{

private $postId;
private $postBody;
private $userId;
private $timestamp;

public function __construct($userId, $postId, $postBody, $timestamp){
	$this->postId = $postId;
	$this->postBody = $postBody;
	$this->userId = $userId;
	$this->timestamp = $timestamp;
}}
