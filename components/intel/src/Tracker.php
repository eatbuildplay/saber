<?php

namespace Saber\Intel;

class Tracker {

  public $userId;
  public $timestamp;
  public $objectType;
  public $objectId;
  public $trackType;
  public $trackData = 1;

  public function __construct() {
    $this->userId = get_current_user_id();
  }

  public function setObject( $objectType, $objectId ) {
    $this->objectType = $objectType;
    $this->objectId = $objectId;
  }

  /*
   * Track viewing of current object
   * Example, lesson viewed
   */
  public function objectView( $type ) {

    $this->timestamp = time();
    $this->trackType = 'view';

  }

  /*
   * Make meta key from current properties
   * Example "saber_student_lesson_8394"
   */
  public function metakey() {
    return 'saber_student_' . $this->objectType . '_' . $this->objectId;
  }

  public function fetch() {
    return get_user_meta(  $this->userId, $this->metakey(), 1 );
  }

  public function save() {

    // fetch current object record
    $objectRecord = $this->fetch();

    // check it is an object, or set
    if( !is_object( $objectRecord )) {
      $objectRecord = new \stdClass;
    }

    // check we have an array for this tracking type, or set new
    if( !isset($objectRecord->{$this->trackType}) || !is_array( $objectRecord->{$this->trackType} )) {
      $objectRecord->{$this->trackType} = [];
    }

    // add new tracking
    $objectRecord->{$this->trackType}[] = $this->trackData;

    update_user_meta( $this->userId, $this->metakey(), $objectRecord );
  }

}
