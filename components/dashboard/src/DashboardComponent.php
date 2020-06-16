<?php

namespace Saber\Dashboard;

class DashboardComponent {


  public function __construct() {

    require_once(SABER_PATH.'components/dashboard/src/DashboardShortcode.php');
    new DashboardShortcode();

  }

}
