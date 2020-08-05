<?php

namespace Saber\Settings;

class SettingsComponent {

  public function __construct() {

    add_action('admin_enqueue_scripts', [$this, 'adminScripts']);

  }

  public function pageCallback() {

    $template = new \Saber\Template;
    $template->path = 'components/settings/templates/';
    $content = '';

    $template->name = 'main';
    $template->data = [];
    $content .= $template->get();

    $template->name = 'tabs';
    $template->data = [];
    $content .= $template->get();

    $template->name = 'footer';
    $template->data = [];
    $content .= $template->get();

    print $content;

  }

  public function adminScripts() {

    wp_enqueue_style(
      'saber-settings',
      SABER_URL . 'components/settings/assets/settings.css',
      array(),
      true
    );

    wp_enqueue_script(
      'saber-settings',
      SABER_URL . 'components/settings/assets/settings.js',
      array('jquery', 'chartjs', 'jquery-ui-tabs'),
      SABER_VERSION,
      true
    );

  }

}
