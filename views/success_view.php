<div id="main_div" class="success_page">
    <div id="cart_content">
            <div id="cart_header" class="top_white-border">
            
                <div id="cart_btn_container">
                    
                </div>
                
            </div>
        <div id="cart_wrapper" class="content_div">
            <div id="cart_container">

                <div id="items_container">
                    
                    
                </div> <!-- END items_container --> 
                    
                    <div id="cart_info">
                        <h3>Thanks for shopping at Donavons Reef!</h3>
                        <ul>
                        	<li>You ordered: 
                            	<ul>
								<?php foreach ($final_array['cart'] as $id => $item): ?>
                                    <li><?php echo $item['quantity']." ".ucwords($item['title']); ?></li>
                                <?php endforeach; ?>
                            	</ul>
                            </li>
                        </ul>
                        
                        <p>For a Total of <span class="bold">$<?php echo $final_array['total_price'].".</span> Shipped via <span class='bold'>"; 
							  echo ($final_array['shipping'] == 'standard') ? 'Fedex Standard Overnight' : 'Fedex Priority Overnight'; ?></span></p>
                        
                        <p>Shipped to: </p>
                        <code>
                        <?php
							echo $final_array['user']."<br />";
							echo $final_array['street']."<br />";
							echo "<span>".$final_array['city'].", ".$final_array['state']." ".$final_array['zip']."</span>";
						?>
                        </code>
                        
                        <hr />
                        
                        <div class="bottom_div">
                            <p>An order confirmation was emailed to you at: <i><?php echo $final_array['email']; ?></i></p>
                            
                            <p class="bottom_notice">Have A Nice <?php echo (date('G') >= 18) ? 'Night!' : 'Day!'; ?></p>
						</div>
                                                                        
                    </div> <!-- END cart_info -->
                    
                <div id="check_out-btn">
                    
                </div>
                                
            </div>
            <div class="clear">&nbsp;</div>
        </div>
            <div id="shop_btm_border" class="btm_white-border"></div>
                   
    </div>
<!-- END content1 -->
    
	<div id="page_btm" class="wide"> 
    	
        <?php $this->load->view('site_links'); ?> 
        
        <div id="box1" class="final_black_box">	
                <div class="top_round-border"></div>
            <div class="box">
            
            <p></p>
                        
            </div>
                <div class="btm_round-border"></div>
        </div> <!-- END box1 -->    
         
    </div> <!-- END page_btm -->
    
</div> <!-- END main_div class="success_page" -->            
<div class="clear">&nbsp;</div>