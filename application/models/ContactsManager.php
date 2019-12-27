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
			$query = $this->db->get_where('contacts', array('contactID' => $id));
			return $query->row_array();
		}else{
			$query = $this->db->get('contacts');
			return $query->result_array();
		}
	}

	/**
	 * Insert new contact details to database
	 * @param array $data
	 * @return bool
	 */
	public function insertDetails($data = array()) {
		$data['created'] = date("Y-m-d H:i:s");
		$data['modified'] = date("Y-m-d H:i:s");
		$insertDetails = $this->db->insert('contacts', $data);
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
