<?php // create table for featured section -dm
  global $wpdb;
  $wpdb->section_featured = $wpdb->prefix . 'section_featured';
	function install_section_featured_table () {
    global $wpdb;
    $charset_collate = '';

    if ( ! empty($wpdb->charset) ) {
      $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
    }
    if ( ! empty($wpdb->collate) ) {
      $charset_collate .= " COLLATE $wpdb->collate";
    }
    if ( is_admin() ) {
      $wpdb->query( "CREATE TABLE IF NOT EXISTS $wpdb->section_featured (
				`section_featured_id` int(11) NOT NULL AUTO_INCREMENT,
				`section_identifier` varchar(256) DEFAULT NULL,
				`section_name` varchar(256) DEFAULT NULL,
				PRIMARY KEY (`section_featured_id`)
				) $charset_collate;"
			);
    }
  }
  ?>