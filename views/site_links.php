<div id="extra_content">        
        <div id="t4" class="top_white-border">
            <p>My Friends'<br />Sites</p>
        </div>
    <div id="banners" class="content_div">
   
    </div>
        <div class="btm_white-border"></div>
</div> <!-- END extra_content -->
<script type="text/javascript"><!--
$(function(){
	$.getJSON(Settings.baseUrl+'admin/get_banners/ajax/', function(data){
		var images = [];
		
		for (var i = 0, len = data.length; i < len; i++) {
			images[i] = new Image;
			images[i].src = Settings.baseUrl + 'images/logos/' + data[i].image;
		}
		
		$("#banners").append(images);
		
		var max_width = 370;
		$("#banners img").each(function(i){
			//this works in IE7
			if (this.width >= max_width) this.width = max_width;
			//this works in all other browsers
			$(this).load(function(){
				if ($(this).width() >= max_width) $(this).width(max_width);			  
			});
			$(this).wrap("<a href='" + data[i].link + "'></a>");
		}); 
	});			 
});
//--></script>