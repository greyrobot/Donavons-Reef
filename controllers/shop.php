<?php
class Shop extends Controller {

	function Shop() {
		parent::Controller();
		session_start();
		$this->load->model('admin_model');
	}
	
	function index() {
		redirect('shop/browse/all');
	}
	
	function browse() {
		$data['head_data']['keywords'] = $this->products_model->get_keywords();
		$data['head_data']['description'] = "Buy Corals at Donavon's Reef";
		
		$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : "empty";
		
		//we must have a certain url for paginate to work
		if (!$this->uri->segment(3)) redirect('shop/browse/all');
		
		//set up shared cart data
		/*$_SESSION['FLShipping'] = 25;	$_SESSION['nonFLShipping'] = 49;	
		$_SESSION['priority_charge'] = 10; //depends on shipping option
		
		//charge $10 extra for shipping on more than 1 item, up to 6
		$_SESSION['bundle_charge'] = 10; //charge 10 for over 1 item;
		$_SESSION['bulk_charge'] = 5; //charge 5 for each item over 6;
		*/
		$_SESSION['FLShipping'] = 15;	$_SESSION['nonFLShipping'] = 45;	
		$_SESSION['priority_charge'] = 0; //depends on shipping option
		
		//charge $10 extra for shipping on more than 1 item, up to 6
		$_SESSION['bundle_charge'] = 0; //charge 10 for over 1 item;
		$_SESSION['bulk_charge'] = 0; //charge 5 for each item over 6;
		
		//pass donavons phone number to javascript for the too many items alert box
		$owner_info = $this->admin_model->get_owner_info();
				
		$data['head_data']['head_items'] = array("<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/shop.css\" media=\"all\" />", "<script type=\"text/javascript\">Settings.page = 'shop_page';</script>");
		$data['view_data']['types'] = $this->products_model->get_all_categories();
		$data['view_data']['cart'] = $cart;
		
		if ($cart != "empty") { //pass in cart info for the mini cart view
			$sub_total = $_SESSION['sub_total']; 
			$total_items = 0;
			
			//sum up quantities of each item
			foreach ($cart as $id => $item) {
				$total_items += $item['quantity'];
			}
			$data['view_data']['sub_total'] = $sub_total;
			$data['view_data']['total_items'] = $total_items;
			$data['view_data']['total_price'] = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : NULL;
		}
		
		//get the base url for pagination, if 3rd url seg is not all, paginate url = shop/browse/section/
		$paginate_url = $this->uri->segment(3) != 'all' ? 
					 'shop/browse/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'
				    : 'shop/browse/all/';
		
		//paginate settings to share with the model methods
		$per_page = '9'; 
		$uri_segment = 4;
		
		//if they selected a type, call the appropriate model function
		$seg3 = $this->uri->segment(3); //can either be all, section, or {product title}. if section, 4th segment is the type
		switch ($seg3) {
			case 'all':
				$total = $this->products_model->total_products($seg3);
				$paginate_url = 'shop/browse/all';
				$offset = $this->uri->segment(4); //for the db
				$type = 'all';
				$data['view_data']['products'] = $this->products_model->get_all_products($per_page, $offset);
				$data['head_data']['title'] = "Shop | Donavon's Reef";
				$data['view_data']['related_view_data']['related_items'] = $this->products_model->get_related_items($data['view_data']['products']);
				$data['view_data']['related_view_data']['cart'] = true;
			break;
			case 'section': 
				$total = $this->products_model->total_products($this->uri->segment(3), $this->uri->segment(4));
				$uri_segment = 5;
				$offset = $this->uri->segment(5); //for the db
				$seg4 = $this->uri->segment(4); //product title from url
				$paginate_url = 'shop/browse/section/' . $seg4;
				if (strpos($seg4, '_')) $seg4 = str_replace('_', ' ', $seg4); //if type is intended to have spaces
				$type = $seg4;
				$data['view_data']['products'] = $this->products_model->get_products_by_type($seg4, $per_page, $offset);
				$data['head_data']['title'] = ucwords($seg4)." | Shop | Donavon's Reef";
				$data['view_data']['related_view_data']['related_items'] = $this->products_model->get_related_items($this->uri->segment(4), true);
				$data['view_data']['related_view_data']['cart'] = true;
			break;
			default: // single product is displayed
				$total = 1;
				$paginate_url = 'shop/browse/' . $seg3;
				$offset = $this->uri->segment(4); //for the db
				$data['view_data']['products'] = $this->products_model->get_product(str_replace('-',' ',$seg3), false);
				$type = $this->what_type_is_this($data['view_data']['products']);
				$data['head_data']['title'] = isset($data['view_data']['products'][0]->title) ? $data['view_data']['products'][0]->title : 'General' . " | Shop | Donavon's Reef";
				$data['view_data']['single'] = true;
				$data['view_data']['related_view_data']['related_items'] = $this->products_model->get_related_items($this->uri->segment(3), true, true);
				$data['view_data']['related_view_data']['cart'] = true;
		}
		
		//setup pagination
		$this->load->library('pagination');
		$config['first_link'] = '&lt;&lt;';
		$config['last_link'] = '&gt;&gt;';
		$config['base_url'] = base_url().$paginate_url;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = $total;
		$config['per_page'] = $per_page;
		$config['full_tag_open'] = "<div class='pagination'>";
		$config['full_tag_close'] = '</div>';
		$this->pagination->initialize($config);
		
		$data['view_data']['type'] = $type; //to highlight a product category tab
		$data['view_data']['site_links_data']['links'] = $this->admin_model->get_banners(true, true);
		$data['view_data']['total'] = $total;
		$data['view_data']['paginate'] = $this->pagination->create_links();
		
		$data['view'] = "shop_view";
		$this->load->view('main_view', $data);
	}
	
	function what_type_is_this($product) {
		$id = $product[0]->id;
		$p = $this->db->query("SELECT type FROM products WHERE id = '{$id}'");
		$type = $p->row_array();
		return $type['type'];
	}
}

/* End of file shop.php */
/* Location: ./controllers/shop.php */