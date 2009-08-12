<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $keywords; ?>" />
<meta name="description" content="<?php echo $description; ?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/lightbox.css" type="text/css" media="all" />
<!--[if lte IE 7]><link rel="stylesheet" href="<?php echo base_url(); ?>css/ie7.css" type="text/css" media="all" /><![endif]-->
<!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/ie6.css" media="screen" /><style type="text/css"> img, div { behavior: url(<?php echo base_url(); ?>iepngfix.htc) } </style><![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript"><!--
var Settings = {
	anim : false,
	welcome : false,
	total_items : <?php echo isset($_SESSION['cart']) ? $this->cart_model->cart_count() : 0; ?>,
	baseUrl : "<?php echo base_url(); ?>"
}
//-->
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/lightbox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/facebox.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/hint.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/ac.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>Scripts/swfobject_modified.js"></script>
<?php if (count($head_items) > 0) foreach ($head_items as $item) echo $item . "\n"; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/main.js"></script>
<title><?php echo $title; ?></title>
</head>
<body>

<div id="wrapper">

<div id="header">
     <h1>Donavon's Reef</h1>
		
		<div id="flash_container">
			<object id="Logo" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="400" height="163">
				<param name="movie" value="/donavons_logo_slow.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<param name="swfversion" value="6.0.65.0" />
				<!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
				<param name="expressinstall" value="/Scripts/expressInstall.swf" />
				<!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="/donavons_logo_slow.swf" width="400" height="163">
					<!--<![endif]-->
					<param name="quality" value="high" />
					<param name="wmode" value="transparent" />
					<param name="swfversion" value="6.0.65.0" />
					<param name="expressinstall" value="/Scripts/expressInstall.swf" />
					<!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
					<div>
						<h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
						<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="400" height="163" /></a></p>
					</div>
					<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>
		</div>
	
	<h2>Your Source for Quality Corals &amp; Livestock</h2>
</div> <!-- END header -->
   
<div id="content">
    
	<div id="nav_div">
		<div>
			<a href="<?php echo base_url(); ?>home">
				<img class="rollover<?php echo ($this->uri->segment(1) == 'home' && !$this->uri->segment(2)) ? ' active' : ''; ?>" src="<?php echo base_url(); ?>images/home-btn.png" alt="Home" />
			 </a>
		</div>
		<div>
			<a href="<?php echo base_url(); ?>shop/browse/all">
				<img class="rollover<?php echo ($this->uri->segment(1) == 'shop' || $this->uri->segment(1) == 'cart') ? ' active' : ''; ?>" src="<?php echo base_url(); ?>images/shop-btn.png" alt="Shop" />
			 </a>
		</div>
		<div>
			<a href="<?php echo base_url(); ?>home/about">
				<img class="rollover<?php echo ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'about') ? ' active' : ''; ?>" src="<?php echo base_url(); ?>images/about-btn.png" alt="About Us" />
			 </a>
		</div>
		<div>
			<a href="<?php echo base_url(); ?>home/contact">
				<img class="rollover<?php echo ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'contact') ? ' active' : ''; ?>" src="<?php echo base_url(); ?>images/contact-btn.png" alt="Contact Me" />
			 </a>
		</div>
	</div> <!-- END nav_div -->
