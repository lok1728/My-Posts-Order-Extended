<p class="row1">
	<em> <?php
	// based off file add_edit_criteria.php
	 //echo 'featured_selection.php';
			$display_block = '';
			$section_identifier = isset($_POST['section_identifier']) ? $_POST['section_identifier'] : '';
			$content_type = '';
			$section_name = '';
			$post_ids = '';
			$category_id = '';
			$num_posts = '';
			$feed_url = '';
			$post_type = '';
			$is_checked = '';
			$section_featured_name = '';
			$size = '';
			$num_posts_xml_feed = '';
			//$section_id = '';
			$sec_obj = new Section;
			$sec_obj->section_identifier = $section_identifier;
			$section_object = $sec_obj->mpo_section_exists();
			$section_name = $section_object->section_name;
			//$section_id = $section_object->section_id;
			?>
			</em>
</p>
<p class="row1">
<label><?php echo 'Featured Section Name:';?></label>

	<?php	
	global $section_featured_name;
		$section_featured_name = $section_name;
		$section_featured_identifier = $section_identifier;
		echo '<span id="section_featured_name">'.$section_featured_name.'</span>';
		echo '<span id="section_featured_identifier" style="display:none;">' . $section_identifier . '</span>';
		
	?>
</p>
<?php
	if (empty($section_featured_identifier) ) { ?>
		<p class="row1">
			<label>&nbsp;</label>
			<em>
				<input onclick="validate_featured()" type="submit" class="button-primary" value="Submit" />
			</em>
		</p> <?php
	} ?>
	<input type="hidden" name="nonce_featured" id="nonce_featured" value="<?php echo wp_create_nonce( 'select_criteria' ); ?>"/>
	<input type="hidden" name="selected_entries" id="selected_entries" />
