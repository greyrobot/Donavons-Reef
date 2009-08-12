<div id="main_div" class="page">
    <div id="contact_content" class="page_content">
        
        <div id="contact_header" class="top_white-border">
           
            <div id="type_container">
                <ul id="type_list">
                    <li></li>
                   
                </ul>
            </div>
            
        </div>
        
        <div class="content_div">
        	
        <?php echo isset($contact['text']) ? html_entity_decode($contact['text']) : "<center>COMING SOON!</center>"; ?>
                                
        </div> <!-- END content_div -->
            <div class="btm_white-border"></div>

    </div> <!-- END contact_content -->
     
    <div id="page_btm"> 
    	
        <?php $this->load->view('site_links'); ?> 
        
        <div id="box1" class="home_black_box">	
                <div class="top_round-border"></div>
            <div class="box">
            
            <?php $this->load->view('featured_items'); ?> 
                        
            </div>
                <div class="btm_round-border"></div>
        </div> <!-- END box1 -->    
         
    </div> <!-- END page_btm -->
     
    <div class="clear">&nbsp;</div>           
</div> <!-- END main_div -->            
    

<div class="clear">&nbsp;</div>