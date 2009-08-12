<?php 
class Mailing extends Controller {
	
	function Mailing() {
		parent::Controller();
		$this->load->model('mailing_model');
	}
	
	function index() {
		redirect('/');
	}
	
	function subscribe() {
		if ($this->input->post('email')) {
			$do = $this->mailing_model->add_subscriber();
			if ($do) echo "Thanks for subscribing";
			exit; //prevent output buffering error
		} else redirect('home');
	}
	
}

/* End of file mailing.php */
/* Location: ./controllers/mailing.php */