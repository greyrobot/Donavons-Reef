<div id="home_control" class="control_page">
	<?php echo form_open('admin/edit_content', array('id' => 'edit_about_form')); ?>
    	<div><p>About Text</p></div>
        <div>
        	<textarea name="text" class="text_edit" cols="70" rows="19"><?php echo $about['text']; ?></textarea>
        </div>
        <div class="radio_field">Visible: Yes<input type="radio" name="visible" value="y" <?php echo ($about['visible'] == 'y') ? "checked='checked'" : ''; ?> />  
        			   No<input type="radio" name="visible" value="n" <?php echo ($about['visible'] == 'n') ? "checked='checked'" : ''; ?> /></div>
        <div class="submit_field">
            <input type="hidden" name="page" value="about_page" />
            <input type="hidden" name="section" class="section" value="top_white_box" />
            <input type="submit" name="save" class="save" value="Save" />
            <span class="loader"><img src="<?php echo base_url(); ?>images/ajax-loader.gif" alt="Loading..." /></span>
            <span class="success" 
            	style="display:<?php echo $this->session->flashdata('success') == 'top_white_box' ? 'inline':'none'; ?>">
                Success
            </span>
        </div>
    </form>
</div>