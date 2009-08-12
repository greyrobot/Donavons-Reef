<div id="main_div">
    <div id="shop_content">
        <?php echo form_open('cart/add_selected', array('id' => 'shop_form')); ?>
            <div id="shop_header" class="top_white-border">
                <?php if (count($products) > 2): ?>
                <div class="buy_link"><input type="submit" name="buy" class="buy_selected" value="Buy Selected" /></div>
                <?php endif; ?>
                
                <div id="view_cart_div">
                <a href="<?php echo base_url(); ?>cart/view" class="tooltip" 
                        title="<?php if ($cart != "empty"): ?>
                               <?php $i = 1; //Tooltip to show title of items in cart and their respective quantities
                                    echo $total_price ? "Total: $".$total_price."<br />" : "Subtotal: $".$sub_total."<br />";
                                    foreach ($cart as $id => $item) {
                                        echo $i.": ".$item['title']." <span class='multiplier'>x</span> ".$item['quantity']."<br />";
                                        $i++;
                                    }
                                    else: echo "Empty";
                                    endif;
                               ?>">View Cart
                    </a>
                </div>
                
                <div id="type_container">
                    <ul id="type_list">
                        <li id="all_link"><a <?php echo ($type == 'all') ? "class=\"active\"" : ''; ?> href="<?php echo base_url(); ?>shop/browse/all">All</a></li>
                        <?php foreach ($types as $c): ?>
                        <li><h3><a <?php if ($c['type'] == $type) echo 'class=\'active\''; ?> href="<?php echo base_url()."shop/browse/section/".str_replace(' ', '_', $c['type']); ?>"><?php echo ucwords($c['type']); ?></a></h3></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="buy_now_notice">Click on Buy Now to go straight to your cart.</div>
                
                <div class="paginate top"><?php echo $paginate; ?></div>
                
            </div> <!-- END shop_header -->
            
        <div class="content_div">
                    
            <?php foreach ($products as $val): $single = (count($products) == 1) ? true : false; ?>
            <div class="product_listing <?php echo $single ? "single_listing" : ''; ?>">
                <?php if (!$single && $val->quantity > 0): ?>
                    <div class="item_check"><input type="checkbox" name="id[]" value="<?php echo $val->id; ?>" /></div>
                <?php endif; ?>
                
                    <h4 class="product_title"><a href="<?php echo base_url()."shop/browse/".str_replace(' ','-',$val->title); ?>"><?php echo ucwords($val->title); ?></a></h4>
                
                <a class="product_thumb" 
                	href="<?php echo base_url(); ?>images/products/<?php echo $val->image; ?>" 
                    title="<?php 
								echo htmlspecialchars("<a href='".base_url()."shop/browse/".str_replace(' ','_',$val->title)."'>".$val->title."</a>
													   <br />");
													   if (!$single) echo htmlspecialchars("<span>".ucfirst($val->description)."</span><br />");
                                                       echo htmlspecialchars("Price: $".$val->price.".00 &nbsp;|&nbsp; Availability: ".$val->quantity.
													   "<br />"); ?>">
                <img class="product_image" width="180" height="145" src="<?php echo base_url(); ?>images/products/thumbs/<?php 
				echo ($val->image == 'placeholder.gif') ? $val->image : $val->id.'_thumb.jpg'; ?>" alt="<?php echo $val->title; ?>" />
                </a>
                
                <?php if ($single): ?>
                    <div class="description_div">
                        <p><?php echo $val->description; ?></p>
                    </div>
                <?php endif; ?>
                                                     
                <div class="details">
                    <ul class="product_extra_info_list">
                        <li><a class="price_link <?php echo ($val->quantity == 0) ? "disabled" : ''; ?>" href="<?php echo ($val->quantity > 0) ? base_url()."cart/add_single/".$val->id : '#'; ?>">$<?php echo $val->price; ?>.00</a></li>
                        <li>
                            <span class="availability">
                            <?php 
                                if ($val->quantity > 5) echo "<em>Available!</em>";
                                elseif ($val->quantity <= 5 && $val->quantity >= 1 ) echo "<i class=\"av_i\">Almost<br />Gone!</i>";
                                else echo "Sold Out!";
                            ?>
                            </span>
                        </li>
                        <li class="quantity_container">
                            <?php if ($val->quantity > 0): ?>
                            <a class="price_link" href="<?php echo base_url()."cart/add_single/".$val->id."/buy_now"; ?>">Buy Now</a>
                            <span class="multiplier">X</span>
                            <span class="quantity_text_container">
                                <input type="text" class="quantity_changer" size="1" />
                                <input type="hidden" name="quantity[]" value="1" />
                                <input type="hidden" name="stock" value="<?php echo $val->quantity; ?>" />
                            </span>
                            <span class="quantity_field_container"></span>
                            <?php endif; ?>
                        </li>
                    </ul>
                 </div>
            </div> <!-- END product listing -->    
            <?php endforeach; ?>          	
           
            <div class="clear">&nbsp;</div>
           
            <?php if (count($products) > 3): ?>
            <div class="buy_link bottom"><input type="submit" name="buy" class="buy_selected" value="Buy Selected" /></div>            
            <div class="buy_now_notice">Click on Buy Now to go straight to your cart.</div>
            <?php endif; ?>
            
            <div class="paginate"><?php echo $paginate; ?></div>
                                
        </div> <!-- END content_div -->
            <div class="btm_white-border"></div>
        </form>
    </div> <!-- END shop_content -->
     
	<?php 
		if (count($products) <= 3 || $single) {
			if ($this->uri->segment(3) == 'all') $this->load->view('site_links');
			else $this->load->view('related_items', $related_view_data); 
		}
	?> 
     
    <div class="clear">&nbsp;</div>           
</div> <!-- END main_div -->            
    

<div class="clear">&nbsp;</div>
    