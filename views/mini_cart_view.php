<img src="<?php echo base_url(); ?>images/cart_icon.gif" alt="Shopping Cart" />
<?php 
//if the user has a cart, display total items and total price
	if ($cart != "empty"): 
		
		//this is the total before they either update their cart in the cart page, 
		//or hit continue shopping, or checkout (they all call the same update() method
		
?>
    <h4 id="cart_head">Your Shopping Cart</h4>
    <div id="shopping_cart">
    
        <ul>
        	<li>
            	<a href="/ Items In Cart" class="tooltip" 
            	title="<?php $i = 1; //Tooltip to show title of items in cart and their respective quantities
							foreach ($cart as $id => $item) {
								echo $i.": ".$item['title']." <span class='multiplier'>x</span> ".$item['quantity']."<br />";
								$i++;
							}
					   ?>" 
                onclick="return false;">Items: <?php echo $total_items; ?></a>
            </li>
            <li><?php echo $total_price ? 'Total: $'.$total_price : 'Subtotal: $'.$sub_total.'.00'; ?></li>
        </ul>
    
    </div> <!-- END cart -->  
        
        <p id="cart_link"><a href="<?php echo base_url().'cart/view'; ?>">View Cart</a></p>
    
<?php else: ?>

	<div id="cart_empty">Your cart is empty.</div>
    
<?php endif; ?>