<?php

namespace Saber\Dashboard;

class DashboardComponent {

  public function __construct() {

    require_once(SABER_PATH.'components/dashboard/src/DashboardShortcode.php');
    new DashboardShortcode();

    add_action('admin_enqueue_scripts', array( $this, 'adminScripts' ));

  }

  public function pageCallback() {

    $template = new \Saber\Template;
    $template->path = 'components/dashboard/templates/';
    $content = '';

    $template->name = 'header';
    $template->data = [
      'userCount' => $userCount,
      'cts'       => $cts
    ];
    $content .= $template->get();


    print $content;

  }

  public function adminScripts() {

    wp_enqueue_script(
      'saber-dashboard',
      SABER_URL . 'components/dashboard/assets/dashboard.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_style(
      'saber-dashboard',
      SABER_URL . 'components/dashboard/assets/dashboard.css',
      array(),
      true
    );

  }

}
