<?php $this->load->view('header', $head_data); ?>

<div id="admin_page_title">

</div>

<div id="main_div">
    <div id="admin_content">
        <div id="admin_header" class="top_white-border">
            
            <ul id="admin_nav">
            	<li><a class="page_btn<?php echo ($view == 'admin_views/home_control') ? ' selected_page' : ''; ?>" id="home_control" href="<?php echo base_url(); ?>admin/manage_home">Home Page</a></li>
                <li><a class="page_btn<?php echo ($view == 'admin_views/about_control') ? ' selected_page' : ''; ?>" id="about_control" href="<?php echo base_url(); ?>admin/manage_about">About Page</a></li>
                <li><a class="page_btn<?php echo ($view == 'admin_views/contact_control') ? ' selected_page' : ''; ?>" id="contact_control" href="<?php echo base_url(); ?>admin/manage_contact">Contact Page</a></li>
                <li><a class="page_btn<?php echo ($view == 'admin_views/products_control') ? ' selected_page' : ''; ?>" id="products_control" href="<?php echo base_url(); ?>admin/manage_products">Products</a></li>
                <li><a class="page_btn<?php echo ($view == 'admin_views/orders_control') ? ' selected_page' : ''; ?>" id="orders_control" href="<?php echo base_url(); ?>admin/manage_orders">Orders</a></li>
                <li><a class="page_btn<?php echo ($view == 'admin_views/banners_control') ? ' selected_page' : ''; ?>" id="site_links_control" href="<?php echo base_url(); ?>admin/manage_banners">Banners</a></li>
            </ul>
                             
        </div>
        <div id="admin_wrapper" class="content_div">
           
			<div id="admin_page_container">
            <?php $this->load->view($view, $view_data); ?>
            </div>
            
            <div class="clear">&nbsp;</div>
        </div>
            <div id="shop_btm_border" class="btm_white-border"></div>
    </div>
<!-- END content1 -->

</div> <!-- END main_div -->            
<div class="clear">&nbsp;</div>

<?php $this->load->view('footer'); ?>