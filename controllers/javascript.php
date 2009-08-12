<?php
class Javascript extends Controller {

	function Javascript() {
		parent::Controller();
	}
	
	function index() {
		$this->needed();
	}
	
	function needed() {
		echo "You must have javascript enabled";
	}
	
}

/* End of file javascript.php */
/* Location: ./controllers/javascript.php */