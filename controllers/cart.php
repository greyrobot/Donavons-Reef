<?php
class Cart extends Controller {
	
	var $nvpStr;
	
	function Cart() {
		parent::Controller();
		session_start();
		require_once("./includes/functions.php");
	}
	
	function index() {
		redirect('cart/view');
	}

//view loaders	
	function load_headers($title, $data) {
		$vdata['head_data']['keywords'] = $this->products_model->get_keywords();
		$vdata['head_data']['description'] = "Your Shopping Cart at Donavon's Reef";
		$vdata['head_data']['title'] = $title." | Donavon's Reef";
		$vdata['head_data']['head_items'] = isset($data['head_data']['head_items']) ? $data['head_data']['head_items'] : array();
		array_push($vdata['head_data']['head_items'],"<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."css/shop.css\" media=\"all\" />");
		$vdata['view_data']['status'] = "empty";

		$this->data = array_merge_recursive($vdata, $data);
	}
	
	function view($checkout = false) {
		$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : 'empty';
		
		$fl = (isset($_SESSION['fl']) && $_SESSION['fl'] == 'y') ? 'y' : 'n';
		
		if (isset($_SESSION['shipping'])) $data['head_data']['head_items'][] = "<script type=\"text/javascript\">Settings.shipping = '{$_SESSION['shipping']}';</script>";
		
		$quantity = 0;
		if ($cart != "empty") { //we need more info about each product stored in the session
			$itm_amt = count($cart);
			foreach ($cart as $id => $array) {
				$details = $this->products_model->get_product($id);
				$data['view_data']['item'][$id]['stock'] = $details['quantity'];
				foreach ($array as $item_info => $value) {
					//die(var_dump($it));
					$data['view_data']['item'][$id][$item_info] = $value;
				}
				$quantity += $array['quantity'];
			}
			//die(var_dump($data['view_data']['items']));
			$data['view_data']['sub_total'] = (isset($_SESSION['fl']) && $_SESSION['fl'] == 'y') ? 
									    number_format($_SESSION['sub_total'] + ($_SESSION['sub_total'] * .065),2,'.',',') :
									    $_SESSION['sub_total'];
			$data['view_data']['quantity'] = $quantity;
			$data['view_data']['status'] = "active";
		} else $data['view_data']['item'] = "empty";
		
		if (isset($itm_amt)) $data['view_data']['single'] = $itm_amt == 1 ? true : false;
		
		$up_charge = ($quantity > 1) ? 10 : 0;
		$ship_cost = $this->cart_model->cart_ship_cost();
		//$this->test('SESSION', $_SESSION);
		if (isset($_SESSION['sub_total'])) $data['view_data']['total_price'] = isset($_SESSION['shipping']) ? number_format($_SESSION['total_price'], 2, '.', ',') : number_format(($_SESSION['sub_total'] + $ship_cost), 2, '.', ',');
		
		$data['view_data']['states'] = $this->get_states();	
		$data['view_data']['related_view_data']['related_items'] = $this->products_model->get_related_items($cart);
		$data['view_data']['related_view_data']['cart'] = true;	
		$data['view_data']['shipping'] = $ship_cost;
		
		if ($checkout) {
			$data['view_data']['calculated_tax'] = number_format((.065 * $ship_cost), 2, '.', ',');
			$data['head_data']['head_items'] = array("<script type=\"text/javascript\">
				Settings.page = 'checkout_page';		
			</script>");
			
			$data['view'] = "checkout_view";
			$this->load_headers("Confirm Your Order", $data);
		} else { //END if checkout true			
			//set variables needed in cart_view
			$data['view_data']['priority_shipping'] = (isset($fl) && $fl == 'y') ? (25 + $up_charge) : (59 + $up_charge);
			$data['view_data']['cart'] = $cart;
			$data['view_data']['priority_check'] = isset($_SESSION['priority_check']) ? true : false;
			$data['view_data']['fl'] = $fl; //the 'shipping in fl' checkbox
			$data['view_data']['nonFLShipping'] = $_SESSION['nonFLShipping'];
			$data['view_data']['FLShipping'] = $_SESSION['FLShipping'];
			$data['view_data']['priority_charge'] = $_SESSION['priority_charge']; //priority shipping charge
			$data['view_data']['bundle_charge'] = ($quantity > 1) ? 10 : 0;
		
			$ret = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url() . 'shop/browse/all';
			if (!strpos($ret, 'shop/')) $ret = base_url() . 'shop/browse/all';
			
			$data['view_data']['ret'] = $ret;
			$data['head_data']['head_items'] = array("<script type=\"text/javascript\">
			Settings.page = 'cart_page';											 
			Settings.priority_charge = {$_SESSION['priority_charge']}; Settings.FLShipping = {$_SESSION['FLShipping']}; Settings.nonFLShipping = {$_SESSION['nonFLShipping']}; Settings.fl = '{$fl}'; Settings.bundle_charge = {$_SESSION['bundle_charge']}; Settings.bulk_charge = {$_SESSION['bulk_charge']};</script>");
			$data['view'] = "cart_view"; 
			$this->load_headers("Your Shopping Cart", $data);
		} //END if checkout false
		$this->load->view('main_view', $this->data);
	} //END $this->view()

//checkout process	
	function checkout() {
		if ($this->input->post('update') || $this->input->post('continue')) {
			$this->update(); //update cart variables with post
			$this->view();
		//the next condition checks if the paypal image submit button was clicked, in IE7 it comes in as checkout_x or _y
		} elseif (isset($_POST['checkout']) || isset($_POST['checkout_x'])) { //Set Express Checkout after updating the cart.
			$this->update();
			$cart = $_SESSION['cart'];
			$ship_cost = number_format($_SESSION['ship_cost'],2);
			$sub_total = $_SESSION['sub_total'];
			
			//if we've previously clicked modify order, we already have a paypal token and dont need to login through paypal again
			if (isset($_SESSION['token'])) redirect('cart/confirm_order');
			
			$baseUrl = base_url();
			
			//paypal express checkout operations
			$environment = 'live'; //or live
			
			$paymentAmount = urlencode($_SESSION['total_price']);
			$currencyID = urlencode('USD');	// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
			$paymentType = urlencode('Sale');  // or 'Sale' or 'Order'
			
			$returnURL = urlencode($baseUrl.'cart/confirm_order');
			$cancelURL = urlencode($baseUrl.'cancel_checkout.php');
			
			if ($_SESSION['fl'] == 'y') {
				$tax = number_format(($_SESSION['sub_total'] * .065), 2);
			} else $tax = '0.00';
						
			// Add request-specific fields to the request string.
			$nvpStr = "&Amt=$paymentAmount&SHIPPINGAMT=$ship_cost&ITEMAMT=$sub_total&TAXAMT=$tax&ReturnUrl=$returnURL&CANCELURL=$cancelURL&PAYMENTACTION=$paymentType&CURRENCYCODE=$currencyID&ALLOWNOTE=1";
			
			//add item info to query string
			$i = 0;
			foreach ($cart as $id => $item) {
				$itm_info = $this->products_model->get_product($id);
				$nvpStr .= '&L_NAME'.$i.'='.urlencode($item['title']);	
				$nvpStr .= '&L_NUMBER'.$i.'='.urlencode($item['id']);	
				$nvpStr .= '&L_DESC'.$i.'='.urlencode($itm_info['description']);	
				$nvpStr .= '&L_AMT'.$i.'='.urlencode($itm_info['price']);	
				$nvpStr .= '&L_QTY'.$i.'='.urlencode($item['quantity']);
				$i++;
			}
			$this->nvpStr = $nvpStr;
			//echo "<pre>"; print_r($nvpStr); die();
		
			// Execute the API operation; see the PPHttpPost function in the ./includes/functions.php file.
			$httpParsedResponseAr = PPHttpPost('SetExpressCheckout', $nvpStr);
						
			if("Success" == $httpParsedResponseAr["ACK"]) {
				// Redirect to paypal.com.
				$token = urldecode($httpParsedResponseAr["TOKEN"]);
				$payPalURL = "https://www.paypal.com/webscr&cmd=_express-checkout&token=$token";
				if("sandbox" === $environment || "beta-sandbox" === $environment) {
					$payPalURL = "https://www.$environment.paypal.com/webscr&cmd=_express-checkout&token=$token";
				}
				header("Location: $payPalURL");
				exit;
			} else {
				$this->paypal_error($httpParsedResponseAr);
			}
			
			//redirect('cart/confirm_order');
		} else {
			$this->update(false, false, true); //update without post
			redirect('cart/confirm_order');
		}
	}
	
	function get_token() {
		//Since paypal sends the token string back in a query string and codeigniter doesnt 
		//like to mix segmented URLs with query strings, we need to parse the query string out 
		//of the $_SERVER['REQUEST_URI'] global variable.
		$pairs = explode('&', substr($_SERVER['REQUEST_URI'], strpos($_SERVER['REQUEST_URI'], '?') + 1) ); 
		$pairs_arr = array();
		foreach ($pairs as $val) {
			$arr = explode("=", $val);
			$pairs_arr += array($arr[0] => ($arr[1] ? $arr[1] : ''));	
		}
		return $pairs_arr;	
	}
	
	function confirm_order() {
		if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {			
			// Obtain the token from PayPal.
			if (!isset($_SESSION['token'])) $request = $this->get_token();
			
			// Set request-specific fields.
			$token = isset($_SESSION['token']) ? $_SESSION['token'] : $request['token'];
			
			if(!$token) exit('Error retrieving token');
					
			// Add request-specific fields to the request string.
			$this->nvpStr .= "&TOKEN=$token";
			
			// Execute the API operation; see the PPHttpPost function above.
			$httpParsedResponseAr = PPHttpPost('GetExpressCheckoutDetails', $this->nvpStr);
			
			if("Success" == $httpParsedResponseAr["ACK"]) {
				// Extract the response details.
				$payerID = $httpParsedResponseAr['PAYERID'];
				$street1 = $httpParsedResponseAr["SHIPTOSTREET"];
				$street2 = '';
				if(array_key_exists("SHIPTOSTREET2", $httpParsedResponseAr)) {
					$street2 = $httpParsedResponseAr["SHIPTOSTREET2"];
				}
				$city_name = $httpParsedResponseAr["SHIPTOCITY"];
				$state_province = $httpParsedResponseAr["SHIPTOSTATE"];
				$postal_code = $httpParsedResponseAr["SHIPTOZIP"];
				$country_code = $httpParsedResponseAr["SHIPTOCOUNTRYCODE"];
			
			} else  {
				$this->paypal_error($httpParsedResponseAr);
			}
			
			$_SESSION['user'] = urldecode($httpParsedResponseAr['FIRSTNAME']).' '.urldecode($httpParsedResponseAr['LASTNAME']);
			$_SESSION['email'] = urldecode($httpParsedResponseAr['EMAIL']);
			$_SESSION['street'] = urldecode($street1).' '.urldecode($street2);
			$_SESSION['city'] = urldecode($city_name);
			$_SESSION['state'] = urldecode($state_province);
			$_SESSION['zip'] = urldecode($postal_code);
			$_SESSION['payer_id'] = urldecode($payerID);
			$_SESSION['token'] = $token;
			
			$checkout = true; 
			$this->view($checkout);
		} else redirect('cart/view');
	}
	
	function process_order() { //post from shipping info form
		if (isset($_SESSION['cart'])) {
			//validation
			$this->load->helper('email');
			$error = '';
			
			$name = $this->input->post('name', true);
			if (!$name || $name == '' || strlen($name) < 4) $error .= "<div class='error'>*Name should be no less than 4 letters.</div>";
			
			$email = $this->input->post('email', true);
			if ($email == '' || !valid_email($email)) $error .= "<div class='error'>*Please check email address.</div>";
						
			//$phone = $this->input->post('phone', true);
			//if ($phone == '' || strlen($phone) < 10) $error .= "<div class='error'>*Invalid phone, include area code.</div>";
			
			$street = $this->input->post('street', true);
			if ($street == '' || strlen($street) < 7) $error .= "<div class='error'>*Invalid street address</div>";
			
			$city = $this->input->post('city', true);
			if ($city == '' || strlen($city) < 2) $error .= "<div class='error'>*Enter a city</div>";
			
			$state = $this->input->post('state', true);
			if ($state == '..' || strlen($state) < 2) $error .= "<div class='error'>*Select a state</div>";
			
			$zip = $this->input->post('zip', true);
			if ($zip == '' || strlen($zip) < 5 || !is_numeric($zip)) $error .= "<div class='error'>*Enter a valid zip code.</div>";
			
			$comment = $this->input->post('comment', true);
			$_SESSION['comment'] = $comment;
			
			//last minute check to see if items in cart are still in stock
			$stock = $this->in_stock($_SESSION['cart']);
			if (!$stock['all_available']) { //Not all items are in stock
				$depleted = ''; //$items_to_unset = array();
				//get the Names of the items that are depleted
				foreach ($stock['results'] as $array => $item) {
					if ($item['quantity'] < 0) {
						$depleted .= ucwords($item['title'])." is out of stock.<br />";
						//delete items that have been depleted from the inventory while the user was shopping
						$this->cart_model->delete_from_cart($item['id']);
					}
				}				
				$error .= "<div class='error'>".$depleted."</div>";
			}
			
			if ($error) {
				$this->session->set_flashdata('error', $error);
				redirect('cart/confirm_order');
			}			
			//END validation
			
			//overwrite in case user corrects the form values at the confirm order page
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['street'] = $street;
			$_SESSION['city'] = $city;
			$_SESSION['state'] = $state;
			$_SESSION['zip'] = $zip;
			
			
			$data['view'] = "success_view"; 
			$title = "Thank You For Your Order";
			
			//if they left the 'send me updates' checked, insert them into the subscribers table
			if ($this->input->post('optin', true)) $this->db->insert('subscribers', array('email' => $email, 'name' => $name));
			
			//if order is from florida, this later
			if ($state == 'FL') $_SESSION['fl'] = 'y';
			else $_SESSION['fl'] = 'n';
			
			// save the order
			$shipping_id = $this->cart_model->save_shipping();
			$order_id = $this->cart_model->save_order($shipping_id);
			
			//diminish item quantities from inventory
			if ($order_id > 0) {
				$items = array();
				foreach ($_SESSION['cart'] as $id => $item) {
					array_push($items, array('id' => $id, 'quantity' => $item['quantity']));
				}
				$updated = $this->cart_model->update_inventory($items);
			}

			if ($updated > 0) { //if update successful				
				//Do Express PayPal Checkout
				$payerID = urlencode($_SESSION['payer_id']);
				$token = urlencode($_SESSION['token']);
				
				$paymentType = urlencode("Sale");	// or 'Sale' or 'Order'
				$paymentAmount = urlencode(number_format($_SESSION['total_price'],2,'.',''));
				$currencyID = urlencode("USD");	// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
				
				// Add request-specific fields to the request string.
				$this->nvpStr .= "&TOKEN=$token&PAYERID=$payerID&PAYMENTACTION=$paymentType&AMT=$paymentAmount&CURRENCYCODE=$currencyID";
				//die($nvpStr);
				// Execute the API operation; see the PPHttpPost function above.
				$httpParsedResponseAr = PPHttpPost('DoExpressCheckoutPayment', $this->nvpStr);
				
				if("Success" == $httpParsedResponseAr["ACK"]) {
					//put the cart variables in a temporary variable
					$data['view_data']['final_array'] = $_SESSION;
					
					//finally, destroy the cart and user info
					$_SESSION = array();
					session_destroy();
					
					//exit('Express Checkout Payment Completed Successfully: <pre>'.print_r($httpParsedResponseAr, true));
				} else $this->paypal_error($httpParsedResponseAr);

			} else $this->test("Failed to update inventory <br />Items: ", $items);
			
			$data['view'] = "success_view";
			
			$this->load_headers($title, $data);
			$this->load->view('main_view', $this->data);
		} //END if isset session cart
		else redirect('cart/view');
	} //END process order
	
	function in_stock($cart) {
		$stock['results'] = array();
		$stock['all_available'] = true;
		foreach ($cart as $id => $item) { 
			//get item ids and their respective quantities in stock before transaction
			$itemNaQ = $this->cart_model->check_inventory($id, $item['quantity']);
			if ($itemNaQ[1] < 0) $stock['all_available'] = false; //if item is already depleted
			//array is product title = array(id => quantity)
			array_push($stock['results'], array('id' => $id, 'title' => $itemNaQ[0], 'quantity' => $itemNaQ[1]));
		}
		return $stock;
	}
	
//cart functions
	function add($id, $quantity, $ret = false, $buy_now = false) {
		$this->update($id, $quantity);
		
		if ($ret && !$buy_now) {
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		} elseif ($buy_now) redirect('cart/view');
	}
	
	function add_single() {
		$buy_now = (($this->uri->segment(5) && $this->uri->segment(5) == 'buy_now') || 
					 $this->uri->segment(4) == 'buy_now') ? true : false;
		$id = $this->uri->segment(3);
		if ($this->uri->segment(4) != 'buy_now') $quantity = $this->uri->segment(4) ? $this->uri->segment(4) : 1;
		else $quantity = $this->uri->segment(5) ? $this->uri->segment(5) : '1';
		
		$this->add($id, $quantity, true, $buy_now);
	}
	
	function add_selected() { //take all selected products and use the add method on each
		$ids = $_POST['id'];
		$quantity = $_POST['quantity'];
		
		$i = 0;
		foreach ($ids as $id) {
			$this->add($id, $quantity[$i]);
			$i++;
		}
		
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
		
	function update($id = false, $quantity = 1, $checkout = false) {
		//if an item id is being passed in by the add method
		if ($id) $this->cart_model->update_cart($id, $quantity);
		
		//if checkout view is navigated to, no post data
		if ($checkout) $this->cart_model->update_cart(false, false, true);
		
		//if update() is processing a form post from the cart view
		else $this->cart_model->update_cart();
		
		//return them to the appropriate page
		if ($this->input->post('noscript', true) || $this->input->post('update', true)) {
			$this->session->set_flashdata('msg', "Cart has been updated.");
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		} 
		if ($this->input->post('continue', true)) { //continue shopping
			header("Location: ".$this->input->post('ret'));
			exit();
		}
	}  
	
	function ajax_delete_item() {
		foreach ($_POST['check'] as $id) {
			$this->cart_model->update_cart($id, 0);
		}
		
		//get total items in cart to send back to javascript
		$quantity = $this->cart_model->cart_count();
		$sub_total = isset($_SESSION['sub_total']) ? $_SESSION['sub_total'] : 0;
		$total_price = $this->cart_model->cart_total_price();
		
		$data = array('sub_total' => $sub_total, 'quantity' => $quantity, 'total_price' => $total_price);
		echo json_encode($data);
		exit; //prevent output buffering error
	}
	
	function get_states() { //for dropdown
		$data = array();
		$Q = $this->db->get('states');
		if ($Q->num_rows() > 0) foreach ($Q->result() as $s) $data[$s->abbrev] = $s->abbrev;
		//echo "<pre>"; print_r($data); die();
		$Q->free_result();
		return $data;
	}
	
	function paypal_error($httpParsedResponseAr) {
		$error = "<p style='font-weight:bold;font-size:20px;'>Error: " . $httpParsedResponseAr['L_ERRORCODE0'] . "</p>\n";
		$error .= "<p style='font-weight:bold;font-size:16px;'>There was a problem processing your PayPal info,<br />\nI apologize for the inconvenience, please try again.</p>\n <p>" . urldecode($httpParsedResponseAr['L_SHORTMESSAGE0']) . "</p><p>" . urldecode($httpParsedResponseAr['L_LONGMESSAGE0']) . "</p>";
		exit($error);	
	}
	
	function test($title, $array = false, $dump = false) {
		echo $title."<pre>";
		if (is_array($array)) {
			if (!$dump) print_r($array);
			else var_dump($array);
		}
		//echo "Session:<br />";
			//print_r($_SESSION);
		else {
			echo "<br />Post:<br />";
				print_r($_POST);
		}
		die();		
	}	
	
}

/* End of file shop.php */
/* Location: ./controllers/shop.php */