<?php
class Admin extends Controller {

	function Admin() {
		parent::Controller();
		session_start();
		$this->load->model('admin_model');
		$this->load->model('content_model');
	}
	
	function index() {
		if (!isset($_SESSION['type'])) redirect('home');
		else redirect('admin/manage_home');
	}

//load views and data
	
	function manage_home() {
		if (!isset($_SESSION['type'])) redirect('home');
		$data['view_data']['top_white_box'] = $this->content_model->get_content('home_page', 'top_white_box', false);
		$data['view_data']['middle_white_box'] = $this->content_model->get_content('home_page', 'middle_white_box', false);
		
		//default top_black_box text = New Corals for [Month]
		$tbb_result = $this->content_model->get_content('home_page', 'top_black_box', false);
		$tbb_result['text'] = !empty($tbb_result['text']) ? $tbb_result['text'] : "New Corals for ".date('F');
		$data['view_data']['top_black_box'] = $tbb_result;
		
		$this->load_view('home', $data);
	}
	
	function manage_about() { 
		if (!isset($_SESSION['type'])) redirect('home');
		$data['view_data']['about'] = $this->content_model->get_content('about_page', 'top_white_box');
		$this->load_view('about', $data);
	}
	
	function manage_contact() { 
		if (!isset($_SESSION['type'])) redirect('home');
		$data['view_data']['contact'] = $this->content_model->get_content('contact_page', 'top_white_box');
		$this->load_view('contact', $data);
	}
	
	function manage_products() { 
		if (!isset($_SESSION['type'])) redirect('home');
		$data['view_data']['list'] = $this->products_model->product_list_by_type();
		$this->load_view('products', $data);
	}
	
	function manage_orders() { 
		if (!isset($_SESSION['type'])) redirect('home');
		
		//setup pagination
		if ($this->uri->segment(3)) {
			$offset = $this->uri->segment(3);
		} else $offset = 0;
		$total_orders = $this->admin_model->total_orders();
		$per_page = 22;
		$config['base_url'] = base_url().'/admin/manage_orders/';
		$config['total_rows'] = $total_orders;
		$config['uri_segment'] = '3';
		$config['per_page'] = $per_page;
		$config['full_tag_open'] = "<div class='paginate'>";
		$config['full_tag_close'] = '</div>';
			$this->load->library('pagination');
			$this->pagination->initialize($config);
		
		$data['view_data']['paginate'] = $this->pagination->create_links();
		$data['view_data']['total_orders'] = $total_orders;
		$data['view_data']['orders'] = $this->admin_model->get_orders($per_page, $offset);
		$this->load_view('orders', $data);
	}
	
	function manage_banners() { 
		if (!isset($_SESSION['type'])) redirect('home');
		$data['view_data']['banners'] = $this->admin_model->get_banners(true);
		$this->load_view('banners', $data);
	}
	
	function load_view($page, $data) {
		$vdata['head_data']['keywords'] = '';
		$vdata['head_data']['description'] = '';
		$vdata['head_data']['title'] = "Manage ".ucfirst($page)." Page | Donavon's Reef";
		
		//make comma separated list to pass to javascript's autocomplete function
		$types_array = $this->products_model->get_types();
		$i = 0; $types = '';
		foreach ($types_array as $t) {
			foreach ($t as $ts) {
				if ($i < count($types_array) - 1) $types .= "\"".$ts."\", "; //while theres a type, echo a comma
				else $types .= "\"".$ts."\""; //if its the end of the line dont echo comma
			}
			$i++;
		}
		
		//header links and scripts
		$vdata['head_data']['head_items'] = array("<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/admin.css\" media=\"screen\" />\n", "<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/jquery.wysiwyg.css\" media=\"screen\" />\n", "<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/jquery.autocomplete.css\" media=\"screen\" />\n","<script type=\"text/javascript\">Settings.page = 'manage_".$page."'; Settings.types = new Array(".$types.");</script>\n");
		
		$vdata['view'] = 'admin_views/'.$page.'_control';
		
		//append 'view' data to vdata
		if ($data) $vdata = array_merge_recursive($vdata, $data);
		//echo "<pre>"; print_r($vdata); die();
		$this->load->view('admin_views/admin_view', $vdata);
	}
	
//process input
	function edit_content() {
		if ($_POST['page']) {
			$updated = $this->admin_model->update_page_content();
			$this->session->set_flashdata('success', $_POST['section']);
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit;
			/*/ajax response
			if (!$updated) echo 'error';
			else echo "saved";
			*/
		}
	}
	
	function get_product($id) { //returns ajax response
		$item = $this->products_model->get_product($id);
		echo json_encode($item); 
		exit; //prevents output buffering error
	}
	
	function add_product() {
		//echo "<pre>"; print_r($_POST); print_r($_FILES);
		if ($_POST['upload_product']) {
			$id = $this->products_model->upload_product();
			$this->session->set_flashdata('msg', 'Uploaded!');
			redirect('admin/manage_products');
		} else $this->manage_products();	
	}
	
	function edit_product() {
		if (isset($_POST['delete'])) {
			$item = $this->products_model->delete_product($this->input->post('id', true));
			$this->session->set_flashdata('msg', 'Deleted '.$item);
			redirect('admin/manage_products');
		}
		elseif (isset($_POST['update_product'])) {
			$updated = $this->products_model->update_product();
			if ($updated) $this->session->set_flashdata('msg', 'Saved!');
			else $this->session->set_flashdata('msg', 'Error!');
		}
		redirect('admin/manage_products');
	}
	
	function get_banners() {
		$banner_images = $this->admin_model->get_banners(false, false); //get array of banners that visible = y
		echo json_encode($banner_images);
		exit;
	}
	
	function add_banner() {
		if ($_POST['submit']) {
			$added = $this->admin_model->create_banner();
			
			if ($added) {
				$this->session->set_flashdata('msg', 'Banner Added!');
				redirect('admin/manage_banners');
			} else {
				//echo "Error adding<pre>"; print_r($_POST); die();
				$this->session->set_flashdata('msg', 'Nothing to Add!');
				redirect('admin/manage_banners');
			}
		}
	}
	
	function edit_banner($id) {
		if ($this->input->post('delete')) {
			$disabled = $this->admin_model->delete_banner($id);
			
			if ($disabled) {
				$this->session->set_flashdata('msg', 'Banner Deleted!');
				redirect('admin/manage_banners');
			} else {
				//echo "Error updating<pre>"; print_r($_POST); die();
				$this->session->set_flashdata('msg', 'Nothing to Delete!');
				redirect('admin/manage_banners');
			}
		}
		elseif ($this->input->post('submit_edit')) {
			//echo "<pre>"; print_r($_POST); print_r($_FILES); die();
			$updated = $this->admin_model->update_banner($id);
			
			if ($updated) {
				$this->session->set_flashdata('msg', 'Banner Saved!');
				redirect('admin/manage_banners');
			} else {
				//echo "Error updating<pre>"; print_r($_POST); die();
				$this->session->set_flashdata('msg', 'Nothing to Save!');
				redirect('admin/manage_banners');
			}
		}
	}
	
	function ship_order($id) {
		$ship_date = $this->admin_model->ship_order($id);
		echo $ship_date;
		exit;
	}
	
	function login() { 
		if ($_POST['user'] && $_POST['pwd']) {
			$authenticated = $this->admin_model->authenticate_user();
			if ($authenticated) redirect('admin/manage_home');
			else redirect('home');
		} else {	
			redirect('home');
		}
	}
	
	function test($title, $ret = true) {
		echo $title."<hr><pre>";
		echo "POST:<br>"; print_r($_POST);
		if ($ret) return true;
		die();
	}
	
}

/* End of file admin.php */
/* Location: ./controllers/admin.php */