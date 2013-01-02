<?php
class Users_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_instruments()
	{
		$sql = $this->db->query('select id,name from instrumentstest order by name');
		return $sql;
	}
	
	public function set_users($userType)
	{
		
		$name = $this->input->post('fname') . " " . $this->input->post('surname');
		
		// timepicker post values
		$mondayAm = $this->input->post('mondayFromTime');
		$mondayPm = $this->input->post('mondayToTime');
		$tuesdayAm = set_default_time_if_empty($this->input->post('tuesdayFromTime'),$mondayAm);
		$tuesdayPm = set_default_time_if_empty($this->input->post('tuesdayToTime'),$mondayPm);
		$wednesdayAm = set_default_time_if_empty($this->input->post('wednesdayFromTime'),$mondayAm);
		$wednesdayPm = set_default_time_if_empty($this->input->post('wednesdayToTime'),$mondayPm);
		$thursdayAm = set_default_time_if_empty($this->input->post('thursdayFromTime'),$mondayAm);
		$thursdayPm = set_default_time_if_empty($this->input->post('thursdayToTime'),$mondayPm);
		$fridayAm = set_default_time_if_empty($this->input->post('fridayFromTime'),$mondayAm);
		$fridayPm = set_default_time_if_empty($this->input->post('fridayToTime'),$mondayPm);
		$saturdayAm = set_default_time_if_empty($this->input->post('saturdayFromTime'),$mondayAm);
		$saturdayPm = set_default_time_if_empty($this->input->post('saturdayToTime'),$mondayPm);
		$sundayAm = set_default_time_if_empty($this->input->post('sundayFromTime'),$mondayAm);
		$sundayPm = set_default_time_if_empty($this->input->post('sundayToTime'),$mondayPm);
		
		$availability = array(
				"Monday" => $mondayAm."-".$mondayPm,
				"Tuesday" => $tuesdayAm."-".$tuesdayPm,
				"Wednesday" => $wednesdayAm."-".$wednesdayPm,
				"Thursday" => $thursdayAm."-".$thursdayPm,
				"Friday" => $fridayAm."-".$fridayPm,
				"Saturday" => $saturdayAm."-".$saturdayPm,
				"Sunday" => $sundayAm."-".$sundayPm,
				);
		// serialize for mysql db array storage
		$availability = serialize($availability);
		
		$addressLine1 = $this->input->post('addressLine1');
		$addressLine2 = $this->input->post('addressLine2');
		
		// address line 2 can be empty so check if comma needed
		if (!empty($addressLine2)) {
			$addressLine2 .= ', ';
		}
		
		$city = $this->input->post('addressCity');
		
		// format address ready for sql insertion
		$address = $addressLine1 . $addressLine2 . ', ' . $city;
		
		// insert location first as need locationId for users table 
		$locationData = array(
			'name' => $this->input->post('businessLocation'),
			'address' => $address,
			'postcode' => $this->input->post('postcode'),
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng'),
		);
		
		$this->db->insert('locations', $locationData);
		$locationInsertId = $this->db->insert_id();
		
		// get ready for main insert
		$data = array(
				'name' => $name,
				'dob' => $this->input->post('dob'),
				'ability' => $this->input->post('ability'),
				'availability' => $availability,
				'instrumentIds' => $this->input->post('instrument'),
				'bio' => $this->input->post('bio'),
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
				'locationId' => $locationInsertId,
				'userTypeId' => $userType,
				'cost' => $this->input->post('cost'),
				'contactNumber' => $this->input->post('contactNumber'),
		);
		
		return $this->db->insert('users', $data);
		
	}
	
}