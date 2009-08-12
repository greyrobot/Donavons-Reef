<div id="main_div" class="page">
    <div id="about_content" class="page_content">
        
        <div id="about_header" class="top_white-border"></div>
        
        <div class="content_div">
        	
        <?php echo html_entity_decode($about['text']); ?>
                                
        </div> <!-- END content_div -->
            <div class="btm_white-border"></div>

    </div> <!-- END about_content -->
    
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