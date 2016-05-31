<?php
/*
Plugin Name: My Posts Order Extended
Description: A plugin which allows you to sort posts, pages, custom post type in ANY order. This fork extends the plugin and adds the option to select a section to be Featured.
Author: Kapil Chugh | Extended by D.Marshall
Author URI: http://prospect7.com
Version: 1.2.1.1 (fork version 1.1)
*/

 	include 'includes/db-schema.php';//Custom table is added
	include 'includes/db-featured.php';//Custom table added for featured
	require_once 'includes/defines.php';
	require_once 'includes/functions.php';
	require_once 'includes/widget.php';
	require_once 'classes/Section/Section.php';
	require_once 'classes/Section/Section-Featured.php';

	register_activation_hook(__FILE__, 'install_sections_table');
	// need a table to hold the featured section that is selected
	register_activation_hook(__FILE__, 'install_section_featured_table');

 /**
	* Includes CSS and Javascript
  */
	//add_action( 'wp_print_scripts', 'mpo_custom_theme_scripts', 100);
  function mpo_custom_theme_scripts() {
		wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'my_posts_order-extended', MPO_JS_PATH . 'my_posts_order.js', 'jquery', '1.0', true );
    wp_enqueue_script( 'tablednd', MPO_JS_PATH . 'jquery.tablednd.js' ); ?>
    <script type="text/javascript">var MPO_IMAGES_PATH = '<?php echo MPO_IMAGES_PATH; ?>';</script>
    <link rel="stylesheet" href="<?php echo MPO_CSS_PATH; ?>theme-editor.css" type="text/css" media="screen" /> <?php
  }

 /**
	* Includes menu option
  */
  add_action('admin_menu', 'mpo_add_custom_admin_page');
	function mpo_add_custom_admin_page() {
		$mpo_mypage = add_menu_page('My Posts Order Extended Options', 'My Posts Order Extended Options', 'edit_published_posts', 'my-posts-order-extended', 'mpo_custom_optons_posts_order');
		//loads JS and CSS only on this page not on all Admin pages.
    add_action( "admin_print_scripts-$mpo_mypage", 'mpo_custom_theme_scripts');
	}

 /**
	* First function that will be called
  */
	function mpo_custom_optons_posts_order () {
		require_once('includes/select_criteria.php');
	}

 /**
	* Saves data in custom table
  */
	add_action( 'wp_ajax_save_section_data', 'mpo_save_section_data' );
  function mpo_save_section_data() {
    require_once ('includes/save_section_data.php');
    exit;
  }
  
 /**
	* Featured Section -dm
	* Function to Save SAVE_FEATURED_DATA in table
   */
   add_action( 'wp_ajax_save_featured_data', 'mpo_save_featured_data' );
   function mpo_save_featured_data() {
	require_once ('includes/save_featured_data.php');
	exit;
	}
 /**
	* Adds and Edits
  */
  add_action( 'wp_ajax_add_edit_section', 'mpo_add_edit_section' );

  function mpo_add_edit_section() {
    require_once ('includes/add_edit_criteria.php');
    exit;
  }
	
 /**
	* Select Section for Featured Posts -dm
	* This function brings up the dropdown list ot sections to select
   */
   add_action ( 'wp_ajax_select_section', 'mpo_select_section' );
   function mpo_select_section() {
	require_once ('includes/select_section.php');
	exit;
}

/**
	* Featured Section Selected -dm
	* This function shows the section that is selected and asks user
	* to confirm the selected section to use as featured.
*/
	add_action ( 'wp_ajax_featured_selection', 'mpo_featured_selection' );
	function mpo_featured_selection() {
		require_once ('includes/featured_selection.php');
		exit;
}

 /**
	* Edits section
  */
  add_action( 'wp_ajax_edit_section', 'mpo_edit_section' );
  function mpo_edit_section() {
    require_once ('includes/edit_section.php');
    exit;
  }

 /**
	* Deletes section
  */
  add_action( 'wp_ajax_delete_section_data', 'mpo_delete_section_data' );

  function mpo_delete_section_data() {
    require_once ('includes/delete_section_data.php');
    exit;
  }

 /**
	* Generates 'Settings' link on plugin page
  */
  add_filter( 'plugin_action_links', 'mpo_plugin_action_links', 10, 2 );

  function mpo_plugin_action_links( $links, $file ) {
    if ( $file == plugin_basename( dirname(__FILE__) . '/my-posts-order-extended.php' ) ) {
      $links[] = '<a href="admin.php?page=my-posts-order">'.__('Settings').'</a>';
    }

    return $links;
  }

   /**
  * Gives Drag and Drop options
  */
  add_action( 'wp_ajax_get_content_type', 'mpo_get_content_type' );
  function mpo_get_content_type() {
    require_once ('includes/get_content_type.php');
    exit;
  }

   /**
  * Gives Drag and Drop criteria
  */
  add_action( 'wp_ajax_drag_drop_criteria', 'mpo_drag_drop_criteria' );
  function mpo_drag_drop_criteria  () {
    require_once ('includes/drag_drop_criteria.php');
    exit;
  }
?>
