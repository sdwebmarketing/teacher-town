<?php

class Teachers extends CI_Controller {
	
	public function get_teacher($id) {
		$this->load->model('search_model');
		
		// get single teacher
		$data["teacher"] = $this->search_model->get_teachers($id);
		$this->load->view('templates/headers',$data);
		$this->load->view('pages/search-detail',$data);
		$this->load->view('templates/footer',$data);
	}
	
}