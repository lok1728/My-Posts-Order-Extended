<?php
  class Section_Featured {
    public $section_identifier = '';

   // public $content_type;

    //public $post_ids;

   // public $status = 0;

   // public $length = 0;

    public $section_name = '';

	 /**
	  * Saves section featured data
    */
    function mpo_save_featured_data () {
      global $wpdb, $user_ID;
      if ($this->section_identifier) {
		$result = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}section_featured" );
		if ( empty($result) ){
			return $wpdb->insert( "{$wpdb->prefix}section_featured", array( 'section_featured_id' => 1, 'section_identifier' => $this->section_identifier, 'section_name' => $this->section_name) );
		} else {

		  return $wpdb->update("{$wpdb->prefix}section_featured", array( 'section_identifier' => $this->section_identifier, 'section_name' => $this->section_name),array( 'section_featured_id' => 1));
         }
      }
    }

   /**
	  * Fetches section name to post on template
    */
	function mpo_query_section_name () {
		global $wpdb;
		$featuredsection =  $wpdb->get_var( $wpdb->prepare("SELECT section_name FROM {$wpdb->prefix}section_featured" ));
		return $featuredsection;
		
	}
	
	/**
	  * Fetches section data
    */
    function mpo_get_section_featured_data () {
      global $wpdb;
      if ($this->section_identifier) {
        $res = $wpdb->get_row( $wpdb->prepare("SELECT section_name FROM {$wpdb->prefix}section_featured WHERE section_identifier = %s AND status = %s ORDER BY created_on DESC LIMIT 1", $this->section_identifier) );
        return $res;
      }
    }

		/**
	   * Verifies if a section exists
     */
    function mpo_section_featured_exists () {
      global $wpdb;
      if ($this->section_identifier) {
         $res = $wpdb->get_row( $wpdb->prepare("SELECT section_name FROM {$wpdb->prefix}section_featured WHERE section_identifier = %s", $this->section_identifier) );
         return $res;
      }
    }

   /**
	  * Gets value of a section
    */
    function mpo_get_section_featured_var ($var) {
      global $wpdb;
      if ($this->section_identifier && !empty($var)) {
         $res = $wpdb->get_var( $wpdb->prepare("SELECT $var FROM {$wpdb->prefix}section_featured WHERE section_identifier = %s", $this->section_identifier) );
         return $res;
      }
    }
   /**
	  * Saves section featured data
    */
    function mpo_get_all_section_featured () {
      global $wpdb;
        $res = $wpdb->get_results("SELECT section_identifier, section_name FROM {$wpdb->prefix}section_featured", OBJECT_K );
        return $res;
    }


   /**
    * Fetches section data by section name
    */
    public function mpo_get_section_featured_data_by_name () {
      global $wpdb;
      if ($this->section_featured_name) {
        $res = $wpdb->get_row( $wpdb->prepare("SELECT section_name FROM {$wpdb->prefix}section_featured WHERE section_name = %s ORDER BY created_on DESC LIMIT 1", $this->section_name) );
        return $res;
      }
    }

  }//End of Class
?>
