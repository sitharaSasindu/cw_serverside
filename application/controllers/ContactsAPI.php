<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use chriskacerguis\Restserver;
require BASEPATH . 'libraries/chriskacerguis/Restserver/RestController.php';
require BASEPATH . 'libraries/chriskacerguis/Restserver/Format.php';

class ContactsAPI extends \chriskacerguis\RestServer\RestController
{

	public function __construct()
	{
		parent::__construct();
		//load contacts model
		$this->load->model('ContactsManager', 'contact');
	}


	/**
	 * CRUD for contacts
	 */
	public function contact()
	{
        $method = $this->input->server('REQUEST_METHOD');

        switch ($method) {
            case 'GET':
                $this->contact_get();
                break;
            case 'POST':
                $this->contact_post();
                break;
            case 'DELETE':
				$this->contact_delete();
				break;
            case 'PUT':
				$this->contact_put();
				break;
        }
    }

	/**
	 * returns all rows of contacts table if the id parameter doesn't exist,
	 * if exists single row will be returned related to contactID
	 * @param string $contactID
	 *
	 *
	 */
	public function contact_get($contactID = '')
	{
		$getContactDetails = $this->contact->fetchDetails($contactID);

		//check if the user data exists
		if (!empty($getContactDetails)) {
			$this->response($getContactDetails,  \chriskacerguis\RestServer\RestController::HTTP_OK);
		} else {
			$this->response(array(
				'status' => FALSE,
				'message' => 'Contact Not Found.'
			), \chriskacerguis\RestServer\RestController::HTTP_NOT_FOUND);
		}
	}

	/**
	 * add new contact's details into database
	 *
	 * @return void
	 */
	public function contact_post()
	{
		$contactData = array();
		$contactData['userId'] = $this->session->userdata('userId');
		$contactData['contactID'] = $this->post('contactID');
		$contactData['firstName'] = $this->post('firstName');
		$contactData['surName'] = $this->post('surName');
		$contactData['address'] = $this->post('address');
		$contactData['email'] = $this->post('email');
		$contactData['phone'] = $this->post('phone');
		$contactTags = $this->post('tags');

		if (!empty($contactData['firstName']) && !empty($contactData['surName']) && !empty($contactData['email']) && !empty($contactData['phone'])) {
			if (empty($contactData['address'])){
				$contactData['address'] = "No address";
			}
			$insertContactDetails = $this->contact->insertDetails($contactData, $contactTags);

			if ($insertContactDetails) { //check if the contact details are inserted or not
				$this->response(array(
					'status' => TRUE,
					'message' => 'Contact Details has been added Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response("Provide all the required information to create the contact.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * update existing details of a selected contact
	 * @param $contactID
	 * @return void
	 */
	public function contact_put($contactID)
	{
		$updatedContactData = array();
		$updatedContactData['firstName'] = $this->put('firstName');
		$updatedContactData['surName'] = $this->put('surName');
		$updatedContactData['address'] = $this->put('address');
		$updatedContactData['email'] = $this->put('email');
		$updatedContactData['phone'] = $this->put('phone');
		$updatedTags = $this->put('tagss');
		$updatedDetails = $this->contact->updateDetails($updatedContactData, $contactID, $updatedTags);

			if ($updatedDetails) {  //check if the contacts details are updated or not
				$this->response(array(
					'status' => TRUE,
					'message' => 'Contact Details has been updated Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
	}


	/**
	 * delete a selected contact details from the db
	 * @param $contactID
	 */
	public function contact_delete($contactID)
	{
		if ($contactID) {
			$deleteContact = $this->contact->deleteDetails($contactID);

			if ($deleteContact) {
				$this->response(array(
					'status' => TRUE,
					'message' => 'Contact has been removed Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response(array(
				'status' => FALSE,
				'message' => 'Contact not Found.'
			), \chriskacerguis\RestServer\RestController::HTTP_NOT_FOUND);
		}
	}




	/**
	 * CRUD for tags
	 */
	public function tag()
	{
		$method = $this->input->server('REQUEST_METHOD');

		switch ($method) {
			case 'GET':
				$this->tag_get();
				break;
			case 'POST':
				$this->tag_post();
				break;
			case 'DELETE':
				$this->tag_delete();
				break;
			case 'PUT':
				$this->tag_put();
				break;
		}
	}

	/**
	 * returns tags available in the db
	 * @param int $tagID
	 */
	public function tag_get($tagID = 0)
	{
		$getTags = $this->contact->fetchTags($tagID);

		//check if the tags exist
		if (!empty($getTags)) {
			$this->response($getTags,  \chriskacerguis\RestServer\RestController::HTTP_OK);
		} else {
			$this->response(array(
				'status' => FALSE,
				'message' => 'Tags Not Found.'
			), \chriskacerguis\RestServer\RestController::HTTP_NOT_FOUND);
		}
	}


	/**
	 * add a new tag
	 *
	 * @return void
	 */
	public function tag_post()
	{
		$tagData = array();
		$tagData['tagName'] = $this->post('tagName');
		if (!empty($tagData['tagName'])) {
			$insertTagDetails = $this->contact->addTag($tagData);

			if ($insertTagDetails) { //check if the tag name is inserted or not
				$this->response(array(
					'status' => TRUE,
					'message' => 'A new tag has been added Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response("Provide a tag name", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
		}
	}

	/**
	 * edit existing tag name
	 * @param $tagID
	 * @return void`
	 */
	public function tag_put($tagID)
	{
		$updatedTagData = array();
		$updatedTagData['tagName'] = $this->put('tagName');
		if (!empty($updatedTagData['tagName'])) {
			$updatedTagName = $this->contact->updateTag($updatedTagData, $tagID);

			if ($updatedTagName) {  //check if the tag name is updated or not
				$this->response(array(
					'status' => TRUE,
					'message' => 'Tag Name has been updated Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response("Provide a new tag name.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
		}
	}


	/**
	 * delete a selected tag
	 * @param $tagID
	 */
	public function tag_delete($tagID)
	{
		if ($tagID) {
			$deleteTag = $this->contact->deleteTag($tagID);

			if ($deleteTag) {
				$this->response(array(
					'status' => TRUE,
					'message' => 'Tag has been removed Successfully.'
				), \chriskacerguis\RestServer\RestController::HTTP_OK);
			} else {
				$this->response("Request not Successful. Please try again.", \chriskacerguis\RestServer\RestController::HTTP_BAD_REQUEST);
			}
		} else {
			$this->response(array(
				'status' => FALSE,
				'message' => 'Tag not Found.'
			), \chriskacerguis\RestServer\RestController::HTTP_NOT_FOUND);
		}
	}

}

