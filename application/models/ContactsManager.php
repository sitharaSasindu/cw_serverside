<?php

class ContactsManager extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Fetch contacts details from the database
	 * @param string $id
	 * @return array
	 */
	function fetchDetails($id = "")
	{
		$userId = $this->session->userdata('userId');
		if (!empty($id)) {
			$searchResult = array();
			$searchTerm = explode('%20', $id); //creating an array of search words

			foreach ($searchTerm as $value) {  //loop through search words
				$this->db->select('tagName, tagID');
				$this->db->where('tagName', $value);
				$query = $this->db->get('contacts_tags');
				foreach ($query->result() as $row) {
					$str = json_encode($row->tagID);
					$result = $this->fetchContactsByTags(trim($str, '"'));
					$searchResult[] = $this->getContactTags($result);
				}
				$this->db->like('surName', $value);
				$query2 = $this->db->get_where('contacts', array('userId' => $userId)) -> result();
				$searchResult[] = $this->getContactTags($query2);
			}
			return $searchResult[0];
		} else {
			$query = $this->db->get_where('contacts', array('userId' => $userId));
			$query = $this->db->get('contacts');
			return $this->getContactTags($query->result());
		}
	}

	/**
	 * Add particular tags to user details array
	 * @param $queryResult
	 * @return array
	 */
	function getContactTags($queryResult)
	{
		$queriedContactIds = array();
		$userDetails = array();
		$arrayOfTagNames = array();
		foreach ($queryResult as $row) {
			if ($this->getTagsByContact($row->contactID)->num_rows() <= 1) {
				foreach ($this->getTagsByContact($row->contactID)->result() as $row2) {
					$tagId = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $row2->tagID);
					$tagNamesOfContact = $this->getTagNameByID($tagId);
					$queriedContactIds[] = $tagNamesOfContact;
					$array = json_decode(json_encode($row), True);
					$array['contactTags'] = $tagNamesOfContact;
					$userDetails[] = $array;
				}
			} else {
				foreach ($this->getTagsByContact($row->contactID)->result() as $row2) {
					$tagId = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $row2->tagID);
					$tagNamesOfContact = $this->getTagNameByID($tagId);
					$arrayOfTagNames[] = $tagNamesOfContact;
				}
				$array = json_decode(json_encode($row), True);
				$array['contactTags'] = implode(", ", $arrayOfTagNames);
				$userDetails[] = $array;
				unset($arrayOfTagNames);
			}
		}
		return $userDetails;
	}

	/**
	 * Fetch tag ids under one particular contact id
	 * @param $contactID
	 * @return array
	 */
	function getTagsByContact($contactID)
	{
		$this->db->select('tagID');
		$this->db->from("contacts_connection");
		$this->db->where('contactID', $contactID);
		$query_data = $this->db->get();
		return $query_data;
	}

	/**
	 * Find tag Name by it's id
	 * @param $tagID
	 * @return array
	 */
	function getTagNameByID($tagID)
	{
		$this->db->select("tagName");
		$this->db->from("contacts_tags");
		$this->db->where('tagID', $tagID);
		$query_data = $this->db->get();
		foreach ($query_data->result() as $row) {
			return $row->tagName;
		}
	}

	/**
	 * Fetch contacts under one particular tag id
	 * @param $tagID
	 * @return array
	 */
	function fetchContactsByTags($tagID)
	{
		$userId = $this->session->userdata('userId');
		$this->db->select("*");
		$this->db->from("contacts_connection");
		$this->db->where('tagID', $tagID);
		$query_data = $this->db->get();

		$selectedContactsOfTag = array();
		foreach ($query_data->result() as $row) {
			$myJsonString = preg_replace('/"([^"]+)"\s*:\s*/', '$1:', $row->contactID);
			$query = $this->db->get_where('contacts', array('contactID' => ($myJsonString), 'userId' => $userId))->result();
			if (!empty($query)) {
				$selectedContactsOfTag[] = $query;
			}
		}
		$selected = array();
		foreach ($selectedContactsOfTag as $row) {
			$selected[] = $row[0];
		}
		return $selected;
	}

	/**
	 * Insert new contact details to database
	 * @param array $data
	 * @param $contactTags
	 * @return bool
	 */
	public function insertDetails($data = array(), $contactTags)
	{
		$data['created'] = date("Y-m-d H:i:s");
		$data['modified'] = date("Y-m-d H:i:s");
		$insertDetails = $this->db->insert('contacts', $data);

		foreach ($contactTags as $key => $item1) {//insert particular contact's tags to database
			$tagsOfContact = array('contactID' => $data['contactID'], 'tagID' => $contactTags[$key]);
			$this->db->insert('contacts_connection', $tagsOfContact);
		}

		return $insertDetails ? true : false;
	}

	/**
	 * Update details of a selected contact
	 * @param $data
	 * @param $contactID
	 * @param $updatedTags
	 * @return bool
	 */
	public function updateDetails($data, $contactID, $updatedTags)
	{
		if (!empty($data) && !empty($contactID)) {
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update('contacts', $data, array('contactID' => $contactID));

			$contactCurrentTags = array();
			foreach ($this->getTagsByContact($contactID)->result() as $row) {
				$contactCurrentTags[] = $row->tagID;
			}
			$updated = explode(',', str_replace(array('[', ']'), '', $updatedTags));

			print_r($updatedTags);

			foreach ($contactCurrentTags as $value) {//delete current tags from contact
				$tagsOfContact = array('contactID' => $contactID, 'tagID' => $value);
				$this->db->delete('contacts_connection', $tagsOfContact);
			}

			foreach ($updated as $value) {//add new tags to contacts
				$tagsOfContact = array('contactID' => $contactID, 'tagID' => $value);
				$this->db->insert('contacts_connection', $tagsOfContact);
			}

			return $update ? true : false;
		} else {
			return false;
		}
	}

	/**
	 * Delete a contact
	 * @param $contactId
	 * @return bool
	 */
	public function deleteDetails($contactId)
	{
		$delete = $this->db->delete('contacts', array('contactID' => $contactId));
		return $delete ? true : false;
	}


	/**
	 * Fetch all the tags from the database
	 * @param string $tagID
	 * @return array
	 */
	function fetchTags($tagID = "")
	{
		if (!empty($tagID)) {
			$query = $this->db->get_where('contacts_tags', array('tagID' => $tagID));
			return $query->row_array();
		} else {
			$query = $this->db->get('contacts_tags');
			return $query->result_array();
		}
	}

	/**
	 * Insert a new tag to database
	 * @param array $data
	 * @return bool
	 */
	public function addTag($data = array())
	{
		$insertDetails = $this->db->insert('contacts_tags', $data);
		return $insertDetails ? true : false;
	}

	/**
	 * Update name of the existing tag
	 * @param $data
	 * @param $tagID
	 * @return bool
	 */
	public function updateTag($data, $tagID)
	{
		if (!empty($data) && !empty($tagID)) {
			$update = $this->db->update('contacts_tags', $data, array('tagID' => $tagID));
			return $update ? true : false;
		} else {
			return false;
		}
	}

	/**
	 * Delete a tag
	 * @param $tagID
	 * @return bool
	 */
	public function deleteTag($tagID)
	{
		$delete = $this->db->delete('contacts_tags', array('tagID' => $tagID));
		return $delete ? true : false;
	}

}

?>
