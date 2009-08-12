<div id="main_div">
    <div id="cart_content">
            <div id="cart_header" class="checkout top_white-border">
            
                <div id="cart_btn_container">
                    
                </div>
                
                <div id="cart_heading"><h2>Confirm Your Order</h2></div>
                
            </div>
        <div id="cart_wrapper" class="content_div">
            <div id="cart_container">

                <div id="items_container">
                    
                    <div id="product_listing_summary">
                        <ol>
                        	<li>
                            	<div class="c_li hdr">Item</div>
                            	<div class="c_li hdr">Quantity</div>
                                <div class="c_li hdr">Unit Price</div>
                            </li>
							<?php $i=1; foreach ($item as $id => $it): //die(var_dump($it)); ?>
                            <li>
                            	<div class="c_li"><?php echo ucwords($it['title']); ?></div>
                            	<div class="c_li amt"><?php echo $it['quantity']; ?></div>
                                <div class="c_li amt">$<?php echo $it['price']; ?></div>
                            </li>
                            <?php $i++; endforeach; ?>
                        </ol>
                    </div> <!-- END product_listing -->
                     
				 <br class="clear" />
				                    
                </div> <!-- END items_container --> 
                    
                    <div id="cart_info">
                        <dl>
				    	   <dt>Sub total: </dt>	<dd>$<?php print($sub_total); ?></dd>   
					   <?php if (isset($_SESSION['fl']) && $_SESSION['fl'] == 'y'): ?>
					   <dt>Tax: </dt>	<dd>$<?php print($calculated_tax); ?></dd>
					   <?php endif; ?>
					   <dt>Shipping: </dt>	<dd>$<?php print($shipping); ?></dd>
                            <dt>Total: </dt>	<dd>$<?php print($total_price); ?></dd>
                            <dt>Courier: </dt>	<dd><?php echo (isset($_SESSION['shipping']) && $_SESSION['shipping'] == 10) ? "Fedex Priority Overnight" : "Fedex Standard Overnight"; ?></dd>
                     	</dl>
                        
                        <hr />
                        
                        <!--<div id="checkout_links">
                            <div class="left_div">
                                <a class="btn_link" id="signup" href="<?php echo base_url(); ?>cart/sign_up_form">Sign up for Quick Checkout</a>
                            </div>
                            
                            <div class="right_div">
                                <a id="login" class="facebox" href="<?php echo base_url(); ?>customer_login.php">Already a Member? Log in Here</a>
                            </div>
						</div>-->
                                                                        
                        <div class="form_div">
                         <?php echo form_open('cart/process_order'); ?>	
                            <div id="signup_info_div">
                            </div>
                        	
                            <h3 class="ship_hdr">Confirm Your Shipping Info and Place Order</h3>
                            
                            <div class="left_form_div">
                                    <?php							
                                        echo "<label for=\"name\">Name</label>\n";
                                        $data = array('name'        => 'name',
                                                      'id'          => 'name',
                                                      'maxlength'   => '50',
                                                      'size'        => '30',
                                                      'value'       => $_SESSION['user']);
                                        echo "<div>".form_input($data)."</div>\n"; unset($data);
                                        
                                        echo "<label for=\"email\">Email</label>\n";
                                        $data = array('name'        => 'email',
                                                      'id'          => 'email',
                                                      'maxlength'   => '50',
                                                      'size'        => '30',
                                                      'value'       => $_SESSION['email']);
                                        echo "<div>".form_input($data)."</div>\n"; unset($data);
                                        
                                        /*echo "<label for=\"phone\">Phone</label>\n";
                                        $data = array('name'        => 'phone',
                                                      'id'          => 'phone',
                                                      'maxlength'   => '14',
                                                      'size'        => '15',
                                                      'value'       => $this->session->userdata('phone'));
                                        echo "<div>".form_input($data)."</div>\n"; unset($data);
                                        */
                                        echo "<label for=\"street\">Street</label>\n";
                                        $data = array('name'        => 'street',
                                                      'id'          => 'street',
                                                      'maxlength'   => '150',
                                                      'size'        => '40',
                                                      'value'       => $_SESSION['street']);
                                        echo "<div>".form_input($data)."</div>\n"; unset($data);
                                        echo "<br />";
                                        echo "<div id=\"adr_info\">";
                                            echo "<labe for=\"city\">City </label>\n";
                                            $data = array('name'        => 'city',
                                                          'id'          => 'city',
                                                          'maxlength'   => '50',
                                                          'size'        => '20',
                                                          'value'       => $_SESSION['city']);
                                        
                                            echo form_input($data); unset($data);
                                            
                                            echo "<label for=\"state\">State </label>\n";
                                            $selected = '..';
                                            if (isset($_SESSION['fl']) && $_SESSION['fl']  == 'y') $selected = 'FL';
                                            array_unshift($states, '..'); //prepend a string to use as dropdown default value
                                            if ($_SESSION['state']) $selected = $_SESSION['state'];
                                            echo form_dropdown('state', $states, $selected); unset($data);
                                            
                                            echo "<label for=\"zip\"> Zip </label>\n";
                                            $data = array('name'        => 'zip',
                                                          'id'          => 'zip',
                                                          'maxlength'   => '5',
                                                          'size'        => '5',
                                                          'value'       => $_SESSION['zip']);
                                            echo form_input($data); unset($data);
                                        echo "</div>";
                                        echo "<br />";
                                        
                                        echo "<div class=\"notice\">\n";
                                            $data = array('name'        => 'optin',
                                                          'id'          => 'optin',
                                                          'value'       => 'y',
                                                          'checked'     => 'checked');
											
											if ($this->users_model->is_subscribed()) $data['disabled'] = 'disabled';
                                            
											echo "<span>".form_checkbox($data)."</span>\n"; 
                                            echo "Send me updates and promotions.";
                                            unset($data);
                                        echo "</div>\n";
                                        
								echo "<div class=\"notice itl\">Your information is kept private.</div>\n";
								
								$data = array('id' => 'comment', 'name' => 'comment', 'value' => isset($_SESSION['comment']) ? $_SESSION['comment'] : '');
								echo "<div id='comment_div'><label>Leave Me a Note!</label>" . form_textarea($data)."</div>";
                                        
                                ?>
                            </div> <!-- END left form div -->
                            
                            <div class="right_form_div">
                            	<?php echo $this->session->flashdata('error') ? $this->session->flashdata('error') : ''; ?>
                            </div>
                            
                        </div> <!-- END form_div -->
                        
                    </div> <!-- END cart_info -->
                    
                <div id="check_out-btn">
                    <input type="submit" name="place_order" value="Place Order" />
				<a href="<?php echo base_url(); ?>cart/view">Modify Order</a>
                    </form>
				
                </div>
                                
            </div>
            <div class="clear">&nbsp;</div>
        </div>
            <div id="shop_btm_border" class="btm_white-border"></div>
    </div>
<!-- END content1 -->
    
    <?php $this->load->view('related_items', $related_view_data); ?>
    
</div> <!-- END main_div -->            
<div class="clear">&nbsp;</div>