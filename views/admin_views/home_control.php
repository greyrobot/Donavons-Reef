<div id="home_control" class="control_page">
	<?php echo form_open('admin/edit_content', array('id' => 'edit_top_white_box_form')); ?>
    	<div><p>Top White Box Content</p></div>
        <div>
        	<textarea name="text" class="text_edit" cols="70" rows="10"><?php echo $top_white_box['text']; ?></textarea>
        </div>
        <div class="radio_field">Visible: Yes<input type="radio" name="visible" value="y" <?php echo ($top_white_box['visible'] == 'y') ? "checked='checked'" : ''; ?> />  
        			   No<input type="radio" name="visible" value="n" <?php echo ($top_white_box['visible'] == 'n') ? "checked='checked'" : ''; ?> /></div>
        <div class="submit_field">
            <input type="hidden" name="page" value="home_page" />
            <input type="hidden" name="section" class="section" value="top_white_box" />
            <input type="submit" name="save" class="save" value="Save" />
            <span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
            <span class="success" 
            	style="display:<?php echo $this->session->flashdata('success') == 'top_white_box' ? 'inline':'none'; ?>">
                Success
            </span>
        </div>
    </form>
    
    <br style="clear:both" />
    <hr />
    
    <?php echo form_open('admin/edit_content', array('id' => 'edit_middle_white_box_form')); ?>
    	<div><p>Middle White Box Content</p></div>
        <div>
        	<textarea name="text" class="text_edit" cols="70" rows="10"><?php echo $middle_white_box['text']; ?></textarea>
        </div>
        <div class="radio_field">Visible: Yes<input type="radio" name="visible" value="y" <?php echo ($middle_white_box['visible'] == 'y') ? "checked='checked'" : ''; ?> />  
        			   No<input type="radio" name="visible" value="n" <?php echo ($middle_white_box['visible'] == 'n') ? "checked='checked'" : ''; ?> /></div>
        <div class="submit_field">
            <input type="hidden" name="page" value="home_page" />
            <input type="hidden" name="section" class="section" value="middle_white_box" />
            <input type="submit" name="save" class="save" value="Save" />
            <span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
            <span class="success" 
            	style="display:<?php echo $this->session->flashdata('success') == 'middle_white_box' ? 'inline':'none'; ?>">
                Success
            </span>
        </div>
    </form>
    
    <br style="clear:both" />
    <hr />
    
    <?php echo form_open('admin/edit_content', array('id' => 'edit_top_black_box_form')); ?>
    	<div><p>Top Black Box Content</p></div>
        <div>
        	<textarea name="text" class="text_edit" cols="70" rows="10"><?php echo $top_black_box['text']; ?></textarea>
        </div>
        <div class="radio_field">Visible: Yes<input type="radio" name="visible" value="y" <?php echo ($top_black_box['visible'] == 'y') ? "checked='checked'" : ''; ?> />  
        			   No<input type="radio" name="visible" value="n" <?php echo ($top_black_box['visible'] == 'n') ? "checked='checked'" : ''; ?> /></div>
        <div class="submit_field">
            <input type="hidden" name="page" value="home_page" />
            <input type="hidden" name="section" class="section" value="top_black_box" />
            <input type="submit" name="save" class="save" value="Save" />
            <span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
            <span class="success" 
            	style="display:<?php echo $this->session->flashdata('success') == 'top_black_box' ? 'inline':'none'; ?>">
                Success
            </span>
        </div>
    </form>
</div>