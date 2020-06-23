<?php

namespace Saber\Register;

class Register {

  public function __construct() {

    // init course registration
    require_once( SABER_PATH . 'components/register/src/Course.php' );
    new Course();

    // shortcode
    // [saber-register]
    $shortcode = new \Saber\Shortcode();
    $shortcode->tag = 'saber-register';
    $shortcode->templatePath = 'components/register/templates/';
    $shortcode->templateName = 'shortcode';
    $shortcode->templateData = [];

    // ajax hook
    add_action( 'wp_ajax_saber_register', array( $this, 'processRegistration'));
    add_action( 'wp_ajax_nopriv_saber_register', array( $this, 'processRegistration'));

    add_action('wp_enqueue_scripts', [$this, 'scripts']);

  }

  public function processRegistration() {

    $fieldData = $_POST['fieldData'];

    $userdata = new \stdClass;
    $userdata->user_email = $fieldData['email'];
    $userdata->user_login = $fieldData['username'];
    $uid = wp_insert_user( $userdata );

    // get post data
    $response = array(
      'userCreated' => $uid,
      'message' => 'This response message will become available in the return in your JS ajax call'
    );
    print json_encode( $response );

    // end ajax hook callbacks safely
    wp_die();

  }

  public function scripts() {

    wp_enqueue_script(
      'saber-register-js',
      SABER_URL . 'components/register/assets/register.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_style(
      'saber-register-css',
      SABER_URL . 'components/register/assets/register.css',
      [],
      '1.0.0'
    );

  }

}
