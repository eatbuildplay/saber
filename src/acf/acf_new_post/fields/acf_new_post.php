<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

class saber_acf_field_new_post extends acf_field {

	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function __construct( $settings ) {

		$this->name = 'new_post';
		$this->label = __('New Post', 'saber');
		$this->category = 'basic';
		$this->defaults = array(
			'post_type'	=> 'post',
		);
		$this->settings = $settings;
    parent::__construct();

	}


	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*
	*/

	function render_field_settings( $field ) {

		acf_render_field_setting( $field, array(
			'label'			=> __('Post Type', 'saber'),
			'instructions'	=> __('Enter the post type to be added using this field.', 'saber'),
			'type'			=> 'text',
			'name'			=> 'post_type',
		));

	}

	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*/
	function render_field( $field ) {

		$template = new \Saber\Template;
		$template->path = 'src/acf/acf_new_post/templates/';
		$template->name = 'inputs';
		$template->render();

	}


	/*
	*  input_admin_enqueue_scripts()
	*
	*  This action is called in the admin_enqueue_scripts action on the edit screen where your field is created.
	*  Use this action to add CSS + JavaScript to assist your render_field() action.
	*/

	function input_admin_enqueue_scripts() {

		// register & include JS
		wp_register_script(
			'saber-acf-field-new-post-js',
			SABER_URL . "src/acf/acf_new_post/assets/js/input.js",
			array('acf-input', 'jquery-ui-dialog'),
			'1.0.0'
		);
		wp_enqueue_script('saber-acf-field-new-post-js');

		// register & include CSS
		wp_register_style(
			'saber-acf-field-new-post-css',
			SABER_URL . "src/acf/acf_new_post/assets/css/input.css",
			array('acf-input'),
			'1.0.0'
		);
		wp_enqueue_style('saber');

		wp_enqueue_style('wp-jquery-ui-dialog');

	}

	/*
	*  load_value()
	*
	*  This filter is applied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	function load_value( $value, $post_id, $field ) {

		return $value;

	}


	/*
	*  update_value()
	*
	*  This filter is applied to the $value before it is saved in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value found in the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*  @return	$value
	*/
	function update_value( $value, $post_id, $field ) {

		return $value;

	}

	/*
	*  validate_value()
	*
	*  This filter is used to perform validation on the value prior to saving.
	*  All values are validated regardless of the field's required setting. This allows you to validate and return
	*  messages to the user if the value is not correct
	*
	*  @type	filter
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$valid (boolean) validation status based on the value and the field's required setting
	*  @param	$value (mixed) the $_POST value
	*  @param	$field (array) the field array holding all the field options
	*  @param	$input (string) the corresponding input name for $_POST value
	*  @return	$valid
	*/

	/*

	function validate_value( $valid, $value, $field, $input ){

		// Basic usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = false;
		}


		// Advanced usage
		if( $value < $field['custom_minimum_setting'] )
		{
			$valid = __('The value is too little!','saber'),
		}


		// return
		return $valid;

	}

	*/

}

// initialize
new saber_acf_field_new_post( $this->settings );

?>
