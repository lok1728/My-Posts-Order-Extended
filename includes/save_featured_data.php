<?php //save the featured section data to the database, hopefully
		//based off file save_section_data.php
		
  check_ajax_referer( "select_criteria" );
  global $selection_criteria;
  //$section_featured_name = 'mysection';

  //$_POST      = array_map( 'stripslashes_deep', $_POST );
  //$_GET       = array_map( 'stripslashes_deep', $_GET );
  //$_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
  //$_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
  global $wpdb;
  ?>
<?php// $wpdb->show_errors(); ?>
<?php
    // Escape with wpdb.
	//exit('EXIT: '.var_dump($_POST));
	$section_featured_name = $_POST['section_featured_name'];
	$section_featured_identifier = $_POST['section_featured_identifier'];
	$section_name = isset($_POST['section_featured_name']) ? trim($_POST['section_featured_name']) : '';
	
	$section_identifier = isset($_POST['section_featured_identifier']) ? $_POST['section_featured_identifier'] : '';
	
	//$section_name = 'test0';
	//$section_identifier = 'test0';
	
	$secfeat_obj = new Section_Featured;

	$secfeat_obj->section_identifier = $section_identifier;
	$secfeat_obj->section_name = $section_name;
	
	$results = $secfeat_obj->mpo_save_featured_data();
	if ($results) {
		echo 'Featured Section Updated Successfully' . AJAX_SEPARATOR . '1';
		} else {
		echo 'Sorry, could not update the database...' . AJAX_SEPARATOR . '0';
		}
	
?>
<?php //$wpdb->hide_errors(); ?>