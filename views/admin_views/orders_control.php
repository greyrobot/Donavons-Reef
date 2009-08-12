<div id="orders_control" class="control_page">
	<div class="total_orders">Total Orders: <?php echo $total_orders; ?></div>
    	<table width="100%" cellpadding="0" cellspacing="0" style="font-size:1.2em; border:0px solid #888">
            <tr>
                <th>ID</th><th>Amount</th><th>Total</th><th>In FL</th><th>Order Date</th>
            </tr>
        </table>
    <div id="table_scroll">
        <table id="orders_grid" width="100%" cellpadding="0" cellspacing="0" style="font-size:1.2em; text-align:center; border:0px solid #888">
            <?php if ($orders): foreach ($orders as $o): ?>
            <tr class="row" id="row_<?php echo $o['id']; ?>">
                <td><?php echo ($o['shipped'] == 'y') ? "<image class='checkmark' src='".base_url()."images/check.gif' />".$o['id'] :$o['id'];  ?></td>
                <td>
                    <div class="items">
                    <?php echo count(explode(', ',$o['product_ids'])); ?>
                    </div>
                </td>
                <td>$<?php echo number_format($o['total'], 2); ?></td>
                <td><?php echo (isset($o['in_fl']) && $o['in_fl'] == 'y') ? '<span class=\'red\'>Yes</span>' : '' ?></td>
                <td><?php echo substr($o['order_date'], 0, 10); ?>
                    <div>
                        <form method="" action="" id="form_<?php echo $o['id']; ?>">
                            <?php foreach ($o as $name => $val): ?>
                            <div>
                            	<input type="hidden" name="<?php echo $name; ?>" id="<?php echo $o['id']."_".$name; ?>" value="<?php echo is_array($val) ? json_encode($val) : $val; ?>" />
                            </div>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; endif; ?>
        </table>
    </div>
    
    <div id="paginater"><?php echo $paginate; ?></div>
    
    <div id="order_details">
    	<div class="o_section" id="left_div">
        </div>
        
        <div class="o_section" id="middle_div">
        </div>
        
        <div class="o_section" id="right_div">
        </div>
    </div>
    <?php //echo "<pre>"; print_r($orders); ?>
</div>