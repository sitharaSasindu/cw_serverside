<?php

class Genre extends CI_Model
{

	private $genreId;
	private $genreName;

	public function __construct($genreId, $genreName)
	{
		$this->genreId = $genreId;
		$this->genreName =$genreName;
	}

	/**
	 * @return mixed
	 */
	public function getGenreId()
	{
		return $this->genreId;
	}

	/**
	 * @return mixed
	 */
	public function getGenreName()
	{
		return $this->genreName;
	}

}
