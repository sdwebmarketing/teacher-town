<?php

class Search extends CI_Controller {
	
	// get all teachers
	public function results() {	
		$this->load->model('search_model');
		$data["teachers"] = $this->search_model->get_teachers();
		
		$this->load->view('templates/headers',$data);
		$this->load->view('pages/search-listings',$data);
		$this->load->view('templates/footer',$data);
	}
	
	// for on the fly results (doesn't load view)
	public function ajax_results() {
		$this->load->model('search_model');
		$this->search_model->get_teachers_by_location_r_xml();
	}
	
}