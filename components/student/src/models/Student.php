<?php

namespace Saber\Student\Model;

define('SABER_PREMIUM_MEMBERSHIP_PRODUCT', 5111);

class Student {

  public $user;
  public $membership;

  public function __construct() {



  }

  public function getMembership() {
    return $this->membership;
  }

  public function hasPremiumMembership() {

    return false;

  }

  public function loadMembership() {

    $check = \WC_Subscriptions_Manager::user_has_subscription(
      $this->user->ID,
      SABER_PREMIUM_MEMBERSHIP_PRODUCT,
      'active'
    );

    if( $check ) {
      $membership = 'premium';
    } else {
      $membership = 'free';
    }

    return $membership;

  }

  public function loadById( $studentId ) {

  }

  public static function load() {
    $student = new Student;
    $student->user = wp_get_current_user();
    $student->membership = $student->loadMembership();
    return $student;
  }

}
