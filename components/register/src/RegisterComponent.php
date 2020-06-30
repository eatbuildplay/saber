<?php

namespace Saber\Register;

class Register {

  public function __construct() {

    // init site registration
    require_once( SABER_PATH . 'components/register/src/Site.php' );
    new Site();

    // init course registration
    require_once( SABER_PATH . 'components/register/src/Course.php' );
    new Course();

  }

  public function scripts() {}

}
