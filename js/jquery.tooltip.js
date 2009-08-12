/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 120;
		yOffset = 30;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").mouseover(function(e){
		this.t = this.title;
		//this.title = "";
				
		//var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='preview'><img width='250' src='/views/images/gallery/" + this.title + "' alt='" + this.title + "' />"+ /* uncomment this to show title c + */"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn(400);						
    });
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});	
	$("a.preview").mouseout(function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
			
};

this.tooltip = function(){	
	/* CONFIG */		
		xOffset = -20;
		yOffset = -100;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$(".tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";
		//alert(this.t.length);
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$(".tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});	
	
	xOffset2 = 5;
	yOffset2 = 25;	
	

//variation
	$("img.tooltip").hover(function(e){											  
		//this.t = this.title;
		//this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset2) + "px")
			.css("left",(e.pageX + yOffset2) + "px")
			.fadeIn("fast");		
    },
	function(){
		//this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("img.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset2) + "px")
			.css("left",(e.pageX + yOffset2) + "px");
	});	
};

this.screenshotPreview = function(x, y){	
	/* CONFIG */
		var xOffset = (x==null) ? 90 : x;
		var yOffset = (y==null) ? 30 : y;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$(".screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot'><img width='10' src='"+ this.rel +"' alt='Preview' />"+ c +"</p>");	
		//make the img look like its popping out
		$('#screenshot img').animate({ width: '300px' },300);
		$('#screenshot img').animate({ width: '270px' },100);
		//fade the img in next to the cursor
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn(400)
		},
		function(){
			this.title = this.t;	
			$("#screenshot").remove();
    });	
	$(".screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};
