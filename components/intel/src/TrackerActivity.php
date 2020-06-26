<?php


/*
 * Track most recently activity 
 * Fires on events from other trackers to stash the most recent activity
 */

namespace Saber\Intel;

class TrackerActivity extends Tracker {

  public function __construct() {

    $this->initHooks();
    parent::__construct();

  }

}
