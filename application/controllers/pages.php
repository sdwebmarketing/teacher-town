<?php 
class Pages extends CI_Controller {
	
	public function view($page = 'home')
	{	
		if ($page == 'teacher-registration') 
		{
			$this->load->model('users_model');
			$data['instruments'] = $this->users_model->get_instruments();
		}
		
		if ( ! file_exists('application/views/pages/'.$page.'.php'))
		{
			// Whoops, we don't have a page for that!
			show_404();
		}
		
		$data['title'] = ucfirst($page);
		
		$this->load->view('templates/headers',$data);
		$this->load->view('pages/'.$page,$data);
		$this->load->view('templates/footer',$data);
	}
}