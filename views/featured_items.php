<?php //check to see if we are being called inside codeigniter
	if ($this) {
		$featured = $this->products_model->get_featured_products(4, true);
		$base_url = base_url();
	} else { //if we are being called by an ajax request
		//we must make a manual connection to the db
		$con = mysql_connect("localhost", "donavo5_donavo5", "reefmaster");
		if (!$con) die("Cannot Connect to DB: ".mysql_error());
		mysql_select_db("donavo5_donavonsreefdb", $con) or die(mysql_error());
		
		$result = mysql_query("SELECT * FROM `products` 
								WHERE `visible` = 'y' 
								AND (`featured` = 'y'
								     AND `quantity` > '0')
								ORDER BY `quantity` 
								DESC LIMIT 4", $con) or die("query failed: ".mysql_error());
		$i = 0;
		while($f = mysql_fetch_assoc($result)) {
			$featured[$i]['id'] = $f['id'];
			$featured[$i]['title'] = $f['title'];
			$featured[$i]['image'] = $f['image'];
			$featured[$i]['description'] = $f['description'];
			$i++;
		}
		
		$base_url = 'http://www.donavonsreef.com/';
	}
?>
<script type="text/javascript"><!-- 
$(function(){$('#gallery4x4 a').lightBox();});
//--></script>
<div id="gallery4x4">
    <span>Featured Products</span>
<?php foreach($featured as $f): ?>
    <a title="<?php echo "&lt;a href='/shop/browse/".str_replace(' ','_',$f['title'])."'&gt;".ucwords($f['title']).":&lt;/a&gt; ".ucfirst($f['description']); ?>" href="<?php echo $base_url.'images/products/'.$f['image']; ?>">
        <img width="95" height="75" src="<?php echo $base_url; ?>images/products/thumbs/<?php echo $f['id'].'_thumb.jpg'; ?>" alt="<?php echo $f['title']; ?>" />
    </a>
<?php endforeach; ?>
</div>