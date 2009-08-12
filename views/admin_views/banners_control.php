<div id="site_links_control" class="control_page">
	
    <?php echo $this->session->flashdata('msg') ? "<div id=\"msg\">".$this->session->flashdata('msg')."</div>" : ''; ?>
    
	<?php echo form_open_multipart('admin/add_banner', array('id' => 'edit_banner_form')); ?>
    <div class="options"><input class="blue_btn" type="button" name="add" id="add-btn" value="Add Banner" /></div> 
    
    <fieldset id="add_div">
    	<legend>New Banner</legend>
        
    	<div class="left_div"> 
            <p><label for="title">Title</label></p>
            <div><input type="text" size="30" name="title" id="title"  /></div>
            
            <p><label for="link">Link</label></p>
            <div><input type="text" size="35" name="link" id="link" value="http://" /></div>
        </div>
        
        <div class="right_div">
            <p><label for="image">Image</label></p>
            <div><input type="file" name="image" id="image" /></div>
            
            	<div id="v_div"><label for="visible">Visible: </label><input type="checkbox" checked="checked" name="visible" id="visible" value="y" /></div>
            
                <p><input type="submit" name="submit" id="submit_banner" value="Add Banner" /></p>
        </div>
                    
    </fieldset>
    </form> <!-- END add_banner_form -->
    
	<?php if ($banners): foreach($banners as $b): ?>
    <?php echo form_open_multipart('admin/edit_banner/'.$b->id, array('id' => 'edit_banner_'.$b->id.'_form'))."\n"; ?>
        <div class="banner_div">
            
            <div class="options_div options">
                <ul class="options_list">
                    <li><input class="edit-btn blue_btn" type="button" name="edit" value="Edit" /></li>
                    <li><input class="delete-btn blue_btn" type="submit" name="delete" value="Delete" /></li>
                </ul>
            </div> <!-- END options_list -->
            
            <div class="b_title"><?php echo $b->title; ?></div>
            
            <div class="b_link"><a href="<?php echo $b->link; ?>"><?php echo $b->link; ?></a></div>
            
            <div class="b_img">
                <img src="<?php echo base_url().'images/logos/'.$b->image; ?>" alt="Banner" />
            </div>
            
            <div class="b_vis">
                <label for="visible">Visible: </label>
                <input type="checkbox" <?php echo ($b->visible == 'y') ? "checked=\"checked\"" : ''; ?> name="visible" class="visible" value="y" />
                <input type="hidden" name="orig_img" id="orig_img" value="<?php echo $b->image; ?>" />
            </div>
            
            <div class="submit_edit"><input class="blue_btn submit_edit-btn" type="submit" name="submit_edit" value="Save Banner" /></div>
            
        </div> <!-- END banner_div -->
    </form> <!-- END edit_banner_form -->
    
    <hr />
    
    <?php endforeach; endif; ?>
</div>