<?php
class Users extends Controller {

	function Users() {
		parent::Controller();
		$this->load->model('users_model');
	}
		
	function login() { 
		$user = $this->users_model->get_user_account();
		redirect('cart/confirm_order');
	}
	
}

/* End of file users.php */
/* Location: ./controllers/users.php */