<?php

class Search extends CI_Controller {
	
	// get all teachers
	public function results() {
		$this->load->view('templates/headers');
		$this->load->view('pages/search-listings');
		$this->load->view('templates/footer');
	}
	
	// for on the fly results (doesn't load view)
	public function ajax_results() {
		$this->load->model('search_model');
		$this->search_model->get_teachers_by_location_r_xml();
	}
	
}