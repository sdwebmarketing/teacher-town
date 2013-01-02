<?php

class Users extends CI_Controller {
	
	public function add_user() 
	{
		
		$this->form_validation->set_rules('fname', 'First name', 'required');
		$this->form_validation->set_rules('surname', 'Surname', 'required');
		$this->form_validation->set_rules('dob', 'Date of birth', 'required|convert_to_mysql_date');
		$this->form_validation->set_rules('ability', 'Ability', 'required');
		
		/* Only set validation on Monday. If other day timeslots are empty its assumed they inherit the same value */
		$this->form_validation->set_rules('mondayFromTime', 'Monday \'from\' time', 'required');
		$this->form_validation->set_rules('mondayToTime', 'Monday \'to\' time', 'required');
		
		$this->form_validation->set_rules('instrument', 'Instrument', 'required');
		$this->form_validation->set_rules('bio', 'Biography', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('confirmEmail', 'Confirm email', 'required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'Confirm password', 'required|matches[password]');
		$this->form_validation->set_rules('contactNumber', 'Contact number', 'required');
		
		$this->form_validation->set_rules('businessLocation', 'Business location', 'required|is_unique[locations.name]');
		$this->form_validation->set_rules('addressLine1', 'Line 1', 'required');
		$this->form_validation->set_rules('addressCity', 'Town/City', 'required');
		$this->form_validation->set_rules('postcode', 'Postcode', 'required');
		$this->form_validation->set_rules('lat', 'Latitude', 'required');
		$this->form_validation->set_rules('lng', 'Longitude', 'required');
		
		$this->form_validation->set_rules('cost', 'Cost', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->model('users_model');
			$data['instruments'] = $this->users_model->get_instruments();
			
			$this->load->view('templates/headers',$data);
			$this->load->view('pages/teacher-registration',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			$this->load->model('users_model');
			$this->users_model->set_users("1");
			$this->load->view('pages/registration-success');
		}
		
	}
	
}