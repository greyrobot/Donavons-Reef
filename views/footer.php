    </div> <!-- END content -->
        <div class="clear">&nbsp;</div>
        <div id="separator"></div>
   
</div> <!-- END wrapper -->

<div id="footer">
    <div>2008 <a class="<?php if (!isset($_SESSION['type'])) { echo 'nada'; } else { echo 'hidden'; } ?>"  href="<?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'admin') { echo base_url().'admin/manage_home'; } else { echo base_url().'login.php'; } ?>">&copy;</a> Donavon's Reef</div>
    
    <div id="footer_nav">
    	<ul>
        	<li><a href="<?php echo base_url(); ?>home">Home</a></li>
            	<li> | </li>
            <li><a href="<?php echo base_url(); ?>shop/browse/all">Shop</a></li>
            	<li> | </li>
            <li><a href="<?php echo base_url(); ?>home/about">About</a></li>
            	<li> | </li>
            <li><a href="<?php echo base_url(); ?>home/contact">Contact</a></li>
        </ul>
    </div>
    
    <div>Built by <a href="http://greyrobot.com">Grey Robot, Inc.</a></div>
</div> <!-- END footer -->

<script type="text/javascript">
<!--
	swfobject.registerObject("Logo");
//-->
</script>

</body>
</html>