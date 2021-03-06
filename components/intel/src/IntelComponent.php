<?php

namespace Saber\Intel;


class IntelComponent {

  public function __construct() {

    add_action('wp_enqueue_scripts', [$this, 'scripts']);

    require_once( SABER_PATH . 'components/intel/src/Tracker.php' );
    require_once( SABER_PATH . 'components/intel/src/TrackerCourse.php' );
    require_once( SABER_PATH . 'components/intel/src/IntelReport.php' );


    // init the trackers
    add_action('init', function() {
      new Tracker();
      new TrackerCourse();
    });

  }

  public function scripts() {

    wp_enqueue_style(
      'saber-intel-css',
      SABER_URL . 'components/intel/assets/intel.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-intel-js',
      SABER_URL . 'components/intel/assets/intel.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
