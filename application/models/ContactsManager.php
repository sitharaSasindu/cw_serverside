<?php

class ContactsManager extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Fetch contacts details from the database
	 * @param string $id
	 * @return
	 */
	function fetchDetails($id = ""){
		if(!empty($id)){
			$this->db->select('tagName, tagID');
			$this->db->where('tagName', $id);
			$query = $this->db->get('contacts_tags');
			if($query->num_rows() >= 1)
			{
				foreach($query->result() as $row){
					$str = json_encode($row->tagID);
					return $this->fetchContactsByTags(trim($str, '"'));
				}
			}else {
				$query1 = $this->db->get_where('contacts', array('firstName' => $id))->result_array();
				$query2 = $this->db->get_where('contacts', array('lastName' => $id))->result_array();
				$query = array_merge($query1, $query2);
				return $query;
			}



//			$this->db->select('contactID, tagID');
//			$query = $this->db->get('contacts_connection');
//
//			$selectedContacts = Array();
//			foreach ($query->result() as $row) {
//
//				if ($id === $row->tagID) {
//					$selectedContacts[] = $row->contactID;
//				}
//			}
//			return $selectedContacts;



		}else{
			$query = $this->db->get('contacts');
			return $query->result_array();
		}
	}

	function fetchContactsByTags($tagID){
		$this->db->select("*");
		$this->db->from("contacts_connection");
		$this->db->where('tagID', $tagID);

		$query_data = $this->db->get()->result_array();
		return $query_data;




//		$this->db->select('contactID, tagID');
//		$query = $this->db->get('contacts_connection');
//
//		$selectedContacts = Array();
//		foreach ($query->result() as $row) {
//
//			if ($tagID === $row->tagID) {
//				$selectedContacts[] = $row->contactID;
//			}
//		}
//		return $selectedContacts;
	}

	/**
	 * Insert new contact details to database
	 * @param array $data
	 * @param $contactTags
	 * @return bool
	 */
	public function insertDetails($data = array(), $contactTags) {
		$data['created'] = date("Y-m-d H:i:s");
		$data['modified'] = date("Y-m-d H:i:s");
		$insertDetails = $this->db->insert('contacts', $data);

		foreach ($contactTags as $key => $item1) {//insert particular contact's tags to database
			$tagsOfContact = array('contactID' => $data['contactID'], 'tagID' => $contactTags[$key]);
			$this->db->insert('contacts_connection', $tagsOfContact);
		}

		return $insertDetails?true:false;
	}

	/**
	 * Update details of a selected contact
	 * @param $data
	 * @param $id
	 * @return bool
	 */
	public function updateDetails($data, $id) {
		if(!empty($data) && !empty($id)){
			$data['modified'] = date("Y-m-d H:i:s");
			$update = $this->db->update('contacts', $data, array('contactID'=>$id));
			return $update?true:false;
		}else{
			return false;
		}
	}

	/**
	 * Delete a contact
	 * @param $id
	 * @return bool
	 */
	public function deleteDetails($id){
		$delete = $this->db->delete('contacts',array('contactID'=>$id));
		return $delete?true:false;
	}


	/**
	 * Fetch all the tags from the database
	 * @param string $tagID
	 * @return array
	 */
	function fetchTags($tagID = ""){
		if(!empty($id)){
			$query = $this->db->get_where('contacts_tags', array('tagID' => $tagID));
			return $query->row_array();
		}else{
			$query = $this->db->get('contacts_tags');
			return $query->result_array();
		}
	}

	/**
	 * Insert a new tag to database
	 * @param array $data
	 * @return bool
	 */
	public function addTag($data = array()) {
		$insertDetails = $this->db->insert('contacts_tags', $data);
		return $insertDetails?true:false;
	}

	/**
	 * Update name of the existing tag
	 * @param $data
	 * @param $tagID
	 * @return bool
	 */
	public function updateTag($data, $tagID) {
		if(!empty($data) && !empty($tagID)){
			$update = $this->db->update('contacts_tags', $data, array('tagID'=>$tagID));
			return $update?true:false;
		}else{
			return false;
		}
	}

	/**
	 * Delete a tag
	 * @param $tagID
	 * @return bool
	 */
	public function deleteTag($tagID){
		$delete = $this->db->delete('contacts_tags',array('tagID'=>$tagID));
		return $delete?true:false;
	}

}
?>
