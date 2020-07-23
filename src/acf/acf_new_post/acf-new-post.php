<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

class AcfNewPostField {

	// vars
	var $settings;


	/*
	*  __construct
	*
	*  This function will setup the class functionality
	*/

	function __construct() {

		// settings
		// - these will be passed into the field class.
		$this->settings = array(
			'version'	=> '1.0.0',
			'url'			=> plugin_dir_url( __FILE__ ),
			'path'		=> plugin_dir_path( __FILE__ )
		);

		// include field
		add_action('acf/include_field_types', 	array($this, 'include_field')); // v5
		add_action('acf/register_fields', 		array($this, 'include_field')); // v4

		// process ajax hook
		add_action( 'wp_ajax_saber_new_post_form', array( $this, 'jxFormProcess'));

	}

	public function jxFormProcess() {

		$phr = new \Saber\Phrase\Model\Phrase;
		$phr->title = "test " . time();
		$phr->phrase = 'Test ' . time();
		$phr->translation = 'Test ' . time();
		$phr->save();

		$response = array(
			'phrase'  => $phr,
      'message' => 'This response message will become vailable in the return in your JS ajax call'
    );
    print json_encode( $response );

    // end ajax hook callbacks safely
    wp_die();

	}

	/*
	*  include_field
	*
	*  This function will include the field type class
	*
	*  @type	function
	*  @date	17/02/2016
	*  @since	1.0.0
	*
	*  @param	$version (int) major ACF version. Defaults to false
	*  @return	void
	*/

	function include_field( $version = false ) {

		include_once('fields/acf_new_post.php');

	}

}


// initialize
new AcfNewPostField();

?>