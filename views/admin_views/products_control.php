<div id="products_control" class="control_page">

	<fieldset>
    	<legend><div class="section_hdr">Edit Products</div></legend>
        	
		<?php echo form_open_multipart('admin/edit_product',  array('id' => 'edit_products_form')); ?>
        	<div class="p_list_hdr">
            
            <?php if ($this->session->flashdata('msg')): ?>
                <span class="msg"><?php echo $this->session->flashdata('msg'); ?></span>
            <?php else: ?>
            	<span>Select a Product </span>
            <?php endif; ?>
                
                <span class="item_loading">
                	<img height="13" src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." />
                </span>
            </div>
            
            <div id="products_list_container">
            	<ul>
                <?php foreach($list as $type => $items): ?>
					<?php //echo "<pre>"; print_r(var_dump($type)); echo "<br />"; print_r($items);  ?>
                    <li><p><?php echo ucwords($type); ?></p></li>
                    <li>
                        <ol>
                        <?php foreach ($items as $item): ?>
                            <li class="product_li <?php echo $item['stock']; ?>">
					   	<a class="product_link" href="<?php echo base_url()."admin/manage_products/".$item['id']; ?>">
							<?php 
								if ($item['featured'] == 'y') echo $item['title'].'*'; 
							 	else echo $item['title']; 
							?>
						</a>
					   </li>
                        <?php endforeach; ?>
                        </ol>
                    </li>
                <?php endforeach; ?>    
                </ul>
            </div>
   			    
            <div id="edit_form_container">
                <div class="top_form_div">
                    <div class="left_form_div">
                       
                        <div>Category</div>
                        <p><input type="text" size="15" name="type" id="edit_type" value="" /></p>
                        
                        <div>Name</div>
                        <p><input type="text" size="25" name="title" id="edit_title" value="" /></p>
                   
                    </div>
                    
                    <div class="right_form_div">
                    	
                        <div class="left_form_div">
                            
                            <div>Price</div>
                            <p><input class="num_input" type="text" size="7" name="price" id="edit_price" value="" /></p>
                            
                            <div>Quantity</div>
                            <p><input class="num_input" type="text" size="7" name="quantity" id="edit_quantity" value="" /></p>
                        
                        </div>
                        
                        <div class="right_form_div">
                            
                            <div>Active</div>
                            <p>
                            	<input type="checkbox" checked="checked" name="visible" id="edit_visible" value="y" />
                            	<label for="edit_visible">Yes</label>
                            </p>
                        	
                            <div>&nbsp;</div>
                            <p>
                            	<input type="hidden" name="id" id="edit_id" value="" />
                            	<input type="submit" name="delete" id="delete_btn" value="Delete" />
                            </p>
                            
                        </div>
                        
                    </div> <!-- END OUTER right_form_div -->
     			</div> <!-- END top_form_div -->
                                
                <div>Description</div>
                <p><textarea name="description" id="edit_description" cols="42" rows="4"></textarea></p>
                
                
                <div class="e_image"><a class="product_thumb" title="" href="#"><img id="p_image" width="100" src="<?php echo base_url(); ?>images/products/placeholder.gif" alt="" /></a></div>
                
                <div>Change Image</div>
                <p><input type="file" class="f_input" name="image" id="edit_image" /></p>
                <p><input type="hidden" name="id" id="id" /></p>
                
                <div class="small_opt">
				 <span>Add Watermark</span>
				 <p>
					<input type="checkbox" class="w_check" checked="checked" name="watermark" id="watermark" value="y" />
					<label for="watermark">Yes</label>
				 </p>
			 </div>
			 
			 <div class="small_opt">
				 <span>Featured</span>
				 <p>
					<input type="checkbox" class="f_check" name="featured" id="featured" value="y" />
					<label for="featured">Yes</label>
				 </p>
			 </div>
			 
                <p>
                	<input class="save-btn" type="submit" name="update_product" id="update_product" value="Save Changes" />
                	<span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
                </p>
            </div>
            
            <div class="break">&nbsp;</div>
            
        </form>        
    </fieldset>
    
    <hr />

	<fieldset>
    	<legend><div class="section_hdr">Upload New Product</div></legend>
        <?php echo form_open_multipart('admin/add_product', array('id' => 'upload_products')); ?>
        	
             <div class="top_form_div">
                
                <div class="left_form_div">
                   
                    <div>Category</div>
                    <p><input type="text" size="15" name="type" id="new_type" value="" /></p>
                    
                    <div>Name</div>
                    <p><input type="text" size="35" name="title" id="new_title" value="" /></p>
               
                </div>
                
                <div class="right_form_div">
                       
                    <div>Price</div>
                    <p><input class="num_input" type="text" size="7" name="price" id="new_price" value="" /></p>
                    
                    <div>Quantity</div>
                    <p><input class="num_input" type="text" size="7" name="quantity" id="new_quantity" value="" /></p>
                                            
                </div> <!-- END OUTER right_form_div -->
                
            </div> <!-- END top_form_div -->
            
                <div>Description</div>
                <p><textarea name="description" id="new_description" cols="60" rows="4"></textarea></p>
                
                <div class="left_form_div">
                   
                    <div>Image</div>
                    <p><input class="f_input" type="file" name="image" id="new_image" /></p>
                	
                    <p>
                        <input class="save-btn" type="submit" name="upload_product" id="upload_new_product" value="Add Product" />
                        <span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
                    </p>
                    
                </div>
                
                <div class="right_form_div">

                    <div class="small_opt">
					<span>Add Watermark</span>
					<p>
						<input type="checkbox" class="w_check" checked="checked" name="watermark" id="watermark" value="y" />
						<label for="watermark">Yes</label>
					</p>
			 	</div>
				
				<div class="small_opt">
					<span>Featured</span>
					<p>
						<input type="checkbox" class="w_check" name="featured" id="featured" value="y" />
						<label for="featured">Yes</label>
					</p>
				</div>
                </div>            
            
        </form>
    </fieldset>
    
</div>