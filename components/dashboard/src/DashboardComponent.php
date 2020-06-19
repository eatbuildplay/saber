<?php

namespace Saber\Dashboard;

class DashboardComponent {


  public function __construct() {

    require_once(SABER_PATH.'components/dashboard/src/DashboardShortcode.php');
    new DashboardShortcode();

    add_action('wp_enqueue_scripts', array( $this, 'scripts' ));

  }

  public function scripts() {

    wp_enqueue_script(
      'dashboard-js',
      SABER_URL . 'components/dashboard/assets/dashboard.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_style(
      'dashboard-css',
      SABER_URL . 'components/dashboard/assets/dashboard.css',
      array(),
      true
    );

  }

}
