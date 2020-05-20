<?php

namespace Frame\Register;

class Register {

  public function __construct() {

    // shortcode
    // [frame-register]
    $shortcode = new \Frame\Shortcode();
    $shortcode->tag = 'frame-register';
    $shortcode->templatePath = 'components/register/templates/';
    $shortcode->templateName = 'shortcode';
    $shortcode->templateData = [];

    // ajax hook
    add_action( 'wp_ajax_frame_register', array( $this, 'processRegistration'));
    add_action( 'wp_ajax_nopriv_frame_register', array( $this, 'processRegistration'));

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



}
