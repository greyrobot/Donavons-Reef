    	
        <div id="main_div">
        	<div id="cart_content">
            	<?php echo form_open('cart/checkout', array('id' => 'update_form')); ?>
                    <div id="cart_header" class="top_white-border">
                    
                        <div id="cart_btn_container">
                            <ul id="btn_list">
                            <?php if ($cart != "empty"): ?>
                    		<li><img class="tooltip" title="Discard Selected Item" id="delete" src="<?php echo base_url(); ?>images/trash_icon.png" width="35" alt="Delete" /></li>
                  			<li><img id="loading" src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></li>
                          <noscript>
                            <li>
                            	<input type="submit" name="update" src="<?php echo base_url(); ?>" />
                                <input type="hidden" name="noscript" value="true" />
                            </li>
                       	  </noscript>
                            <?php else: ?>
                                <li><a href="<?php echo (isset($_SERVER['HTTP_REFERER']) && 
															   $_SERVER['HTTP_REFERER'] != base_url().'cart/view' &&
															   $_SERVER['HTTP_REFERER'] != base_url().'cart/confirm_order') ? 
															   $_SERVER['HTTP_REFERER'] : 
															   base_url().'shop/browse/all'; ?>">Back</a></li>
                            <?php endif; ?>    
                            </ul>
                        </div>
                        
                        <div id="cart_heading"><h2>Your Shopping Cart</h2></div>
                        
                    </div>
                <div id="cart_wrapper" class="content_div">
                	<div id="cart_container">
                    	
                    <?php if ($cart != "empty"): ?>
                    	<?php if(!$single): ?>
                        <div id="c_div">
                        	<div id="check_all_div" class="item_check">
                            	<input type="checkbox" name="select_all" id="check_all" value="y" />
                            </div>
                            <div> - All</div>
                        </div>
                        <?php endif; ?>
                        <div id="items_container">
							
							<?php $i=1; foreach ($item as $id => $it): //die(var_dump($it)); ?>
                            <div class="product_listing" id="row_<?php echo $i; ?>">
                            	<div class="item_check">
                                	<input type="checkbox" name="check[]" class="check" id="check_<?php echo $i; ?>" value="<?php echo $id; ?>" />
                                    <input type="hidden" name="id[]" value="<?php echo $id; ?>" />
                                </div>
                                
                                <h4 class="product_title_cart"><?php echo ucwords($it['title']); ?></h4>
                                
                                <a href="<?php echo base_url()."images/products/".$id.".jpg"; ?>" class="product_thumb" 
                                	title="<?php echo "<a href='".base_url()."shop/browse/".$id."'>".$it['title']."</a>"; ?>">
                                	<img class="cart_pic" width="90" src="<?php echo base_url()."images/products/thumbs/".$id."_thumb.jpg"; ?>" alt="<?php echo $it['title']; ?>" /> 
                                </a>
                                
                                <div class="quantity_div">
                                	<label>$<?php echo $it['price']; ?> <code>x</code> </label>
                                	<input type="text" class="update" name="quantity[]" id="quantity_update[]" value="<?php echo $it['quantity']; ?>" />
                                    <input type="hidden" name="item_price[]" class="item_price" value="<?php echo $it['price']; ?>" />
                                    <input type="hidden" name="stock" value="<?php echo $it['stock']; ?>" />
                               		= $<span class='price'><?php echo ($it['price'] * $it['quantity'])."</span>.00"; ?>
                                </div>
                            
                            </div> <!-- END product_listing -->
                            
                            <?php $i++; endforeach; ?>
                        </div> <!-- END items_container --> 
                        	
					<br class="clear" />
					
                            <div id="cart_info">
                                <div id="left_cart_div">
                                    <div>Total Items:</div>
                                    
                                    <div>
                                        <input <?php echo ($fl == 'y') ? "checked='checked'" : ''; ?> id="fl" type="checkbox" name="fl" value="y"/>
                                        <label for="fl">Shipping in FL</label>
                                    </div>
                                    
                                    <div>Sub Total:</div>
                                    
                                    <div>Shipping:</div>
                                    
                                    <div>
                                <select name="shipping_options" id="shipping_options">
                                    <option value="standard<?php //echo $shipping; ?>" <?php echo (!$priority_check) ? "selected='selected'" : ''; ?> >Standard Fedex Overnight</option>
                                    <option value="<?php echo $priority_charge; ?>" <?php echo ($priority_check) ? "selected='selected'" : ''; ?> >Priority Fedex Overnight: +$10</option>
                                </select>
                                    </div>
                                    
                                    <div>Total:</div>
                                </div>
                                
                                <div id="mid_cart_div">
                                    <div id="quantity"><?php echo $quantity; ?></div>
                                                                        
                                	<div id="tax">Tax: %<span><?php echo ($fl == 'y') ? '6.5' : '0'; ?></span></div>
                                    
                                    <div id="sub_total">$<span><?php echo $sub_total; ?></span></div>
                                    
                                    <div id="shipping_field">$<span><?php echo $shipping; ?></span></div>
                                    <br />
                                    <div id="total">$<span><?php echo $total_price; ?></span>
                                    	<input type="hidden" name="ship_cost" id="ship_cost" value="" />
                                        <input type="hidden" name="total_price" id="total_price_field" value="0" />
                                        <input type="hidden" name="ret" value="<?php echo $ret; ?>" />
                                    </div>
                                </div>
                                
                                <div id="right_cart_div">
                                	<ul>
                                		<li>Orders ship 1-3 days after payment is received.</li>
                                    	<li>For orders where payment is received on Friday, orders will ship on Monday.</li>
                                    	<li>You will receive a tracking number by email.</li>
                                    </ul>
                                </div>
                                
                          	</div> <!-- END cart_info -->
                            
                        <div id="check_out-btn">
                       	<!--[if lte IE 7]><input type="submit" name="update" value="Update" /><![endif]-->
                        	<input type="submit" name="continue" id="continue" value="Continue Shopping" />
                            <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" name="checkout" value="Checkout" id="ppcheckout" value="Check Out" />
                        </div>
                        
                    <?php else: ?>
                    <div id="cart_empty">You have nothing in your cart. </div>
                    <div class="featured_items">	
						<?php $this->load->view('featured_items'); ?>
                    </div>
                    <?php endif; ?>
                    </div>
                    <div class="clear">&nbsp;</div>
                </div>
                    <div id="shop_btm_border" class="btm_white-border"></div>
                </form>
           	</div>
        <!-- END content1 -->
        	
            <?php $this->load->view('related_items', $related_view_data); ?>
            
        </div> <!-- END main_div -->            
        <div class="clear">&nbsp;</div>