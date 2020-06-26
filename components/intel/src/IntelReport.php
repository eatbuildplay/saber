<?php

namespace Saber\Intel;

class IntelReport {

  public $courseRegistrations;

  public function getCourseCount() {
    return count($this->courseRegistrations);
  }

  public function loadCourseRegistrations() {

      $cr = new \Saber\Register\Model\CourseRegistration;
      $crs = $cr->fetchAllStudent();
      $this->courseRegistrations = $crs;
      return $crs;

  }

}
