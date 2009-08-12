<?php
class Home extends Controller {

	function Home() {
		parent::Controller();
		session_start();
		$this->load->model('content_model');
		$this->load->model('admin_model');
	}
	
	function index() {
		$data['view_data']['top_white_box'] = $this->content_model->get_content('home_page', 'top_white_box');
		$data['view_data']['middle_white_box'] = $this->content_model->get_content('home_page', 'middle_white_box');
		$data['view_data']['top_black_box'] = $this->content_model->get_content('home_page', 'top_black_box');
		$this->load_view('home_view', $data);
	}
	
	function about() {
		$data['view_data']['about'] = $this->content_model->get_content('about_page', 'top_white_box');
		$data['view_data']['site_links_data']['links'] = $this->admin_model->get_banners(true, true);
		$this->load_view('about_view', $data);
	}
	
	function contact() {
		$data['view_data']['contact'] = $this->content_model->get_content('contact_page', 'top_white_box');
		$this->load_view('contact_view', $data);
	}
	
	private function load_view($page, $vdata) {
		$title = str_replace('_view', '', $page);
		$data['head_data']['keywords'] = $this->products_model->get_keywords();
		$data['head_data']['description'] = "Buy Corals at Donavon's Reef";
		$data['head_data']['title'] = ucfirst($title)." Donavon's Reef";
		$data['head_data']['head_items'] = array("<script type='text/javascript'>
			Settings.page = '" . $title . "_page';	
		</script>");
		
		//append view data to data
		if($vdata) $data += $vdata;
		
		$data['view'] = $page;
		//echo "<pre>"; print_r($data); die();
		$this->load->view('main_view', $data);
	}
	
}

/* End of file home.php */
/* Location: ./controllers/home.php */