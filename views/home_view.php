
<div id="main_div">
    <div id="content1">
            <div id="t1" class="top_white-border">
                <span><?php echo $top_white_box['date']; ?></span>
                <div class="min_max-icon"><img class="icon" src="<?php echo base_url(); ?>images/minimize.gif" alt="" /></div>
            </div>
        <div class="content_div">
                                
            <div>
            <?php echo html_entity_decode($top_white_box['text']); ?>
            </div>
            
        </div>
            <div class="btm_white-border"></div>
    </div>
<!-- END content1 -->

    <div id="content2">        
            <div id="t2" class="top_white-border">
                <span><?php echo $middle_white_box['date']; ?></span>
                <div class="min_max-icon"><img class="icon" src="<?php echo base_url(); ?>images/minimize.gif" alt="" /></div>
            </div>
        <div class="content_div">
                            
            <div>
            <?php echo html_entity_decode($middle_white_box['text']); ?>
            </div>
            
        </div>
            <div class="btm_white-border"></div>
    </div> <!-- END content2 -->
    
    <div id="page_btm"> 
    <?php $this->load->view('site_links'); ?>
    </div>
    
</div> <!-- END main_div -->            
    
<div id="side_div">
    
    <div id="box1" class="home_black_box">	
            <div class="top_round-border"></div>
        <div class="box">
        	<div>
		   <?php if (empty($top_black_box) || $top_black_box['text'] == ''): ?>    
			  <h2 class="black_box_head">New Corals for<br /> <?php echo date('F'); ?></h2>
		   <?php else: echo html_entity_decode($top_black_box['text']); ?>
		   <?php endif; ?>
        	</div>
            
		<img id="down_arrow" src="<?php echo base_url(); ?>images/blue_arrow.png" alt="" />
            
        </div>
            <div class="btm_round-border"></div>
    </div> <!-- END box1 -->
    
    <div id="box2">    
            <div class="top_round-border"></div>
        <div class="box">
        <?php $this->load->view('featured_items'); ?>                    
        </div>
            <div class="btm_round-border"></div>
    </div> <!-- END box2 -->
    
    <div id="box3">    
            <div class="top_round-border"></div>
        <div class="box">
        <img class="center_box_item" src="<?php echo base_url(); ?>images/signup_mail_list.jpg" alt="Sign Up For Our Mailing List" />
            <div id="sign_up_form_div">
                <?php echo form_open('mailing/subscribe', array('id' => 'subscribe_form')); ?>
                    <div class="field">
                        <p>
                            <label for="name">Name</label>
                            <br />
                            <input id="name" class="txt" type="text" name="name" title="Full Name" />
                        </p>
                    </div>
                    <div class="field">    
                        <p>  
                            <label for="email">Email</label>
                            <br />
                            <input id="email" class="txt" type="text" name="email" title="you@mail.com" />
                        </p>
                    </div>
                        
                    <p class="center"><input id="subscribe" type="submit" name="subscribe" value="Subscribe" /></p>
                </form>
            </div> <!-- END sign_up_form_div -->
            
            <div id="processing">
                <img src="<?php echo base_url(); ?>images/page_loader.gif" alt="Loading..." />
            </div>
            
        </div>
            <div class="btm_round-border"></div>
    </div> <!-- END box3 -->
   
</div> <!-- END side_div -->
<div class="IEclear">&nbsp;</div>

<div id="donavons_banner">
<!--original width: 823; height: 73 -->
	<object id="Banner" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="823" height="73">
		<param name="movie" value="<?php echo base_url(); ?>Donavon_Banner.swf" />
		<param name="quality" value="high" />
		<param name="wmode" value="opaque" />
		<param name="swfversion" value="9.0.45.0" />
		<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you dont want users to see the prompt. -->
		<param name="expressinstall" value="<?php echo base_url(); ?>Scripts/expressInstall.swf" />
		<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
		<!--[if !IE]>-->
		<object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>Donavon_Banner.swf" width="823" height="73">
			<!--<![endif]-->
			<param name="quality" value="high" />
			<param name="wmode" value="opaque" />
			<param name="swfversion" value="9.0.45.0" />
			<param name="expressinstall" value="<?php echo base_url(); ?>Scripts/expressInstall.swf" />
			<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
			<div>
				<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
				<p>
					<a href="http://www.adobe.com/go/getflashplayer">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" />
					</a>
				</p>
			</div>
			<!--[if !IE]>-->
		</object>
		<!--<![endif]-->
	</object>
</div>
<script type="text/javascript">
<!--
swfobject.registerObject("Banner");
//-->
</script>
