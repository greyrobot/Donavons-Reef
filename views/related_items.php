<div id="related_items">	
    <div class="top_white-border">
        <h4>Other Items You Might Like...</h4>
    </div>
        <div class="content_div">
        	<ul>
            <?php foreach ($related_items as $id => $item): ?>
                <li class="item">
                    <h4 class="product_title"><a href="<?php echo base_url()."shop/browse/".str_replace(' ','_',$item['title']); ?>"><?php echo ucwords($item['title']); ?></a></h4>
                    <a class="product_thumb" href="<?php echo base_url()."images/products/".$item['image']; ?>" 
                        title="<?php echo htmlspecialchars("<a href='".base_url()."shop/browse/".str_replace(' ','_',$item['title'])."'>".$item['title']."</a><br />
                                             <span>".ucfirst($item['description'])."</span><br />Price: $".$item['price'].".00 &nbsp;|&nbsp;Availability: ".$item['quantity']."<br />"); ?>">
                        <img width="140" src="<?php echo ($item['image'] != 'placeholder.gif') ? base_url()."images/products/thumbs/".$id."_thumb.jpg" : base_url()."images/products/placeholder.gif"; ?>" alt="<?php echo $item['title']; ?>" />
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    <div id="featured_btm_border" class="btm_white-border"></div>
</div>
