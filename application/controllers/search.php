<?php

class Search extends CI_Controller {
	
	public function results() {
		
		$this->load->model('search_model');
		
		// get all teachers
		$data["teachers"] = $this->search_model->get_teachers();	
		$this->load->view('templates/headers',$data);
		$this->load->view('pages/search-listings',$data);
		$this->load->view('templates/footer',$data);	
	}
	
	public function ajax_results() {
		$this->load->model('search_model');
		
		$data["teachers"] = $this->search_model->get_teachers_by_location();
	}
	
}