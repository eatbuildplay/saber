<?php

namespace Saber\Reports;

class ReportsComponent {

  public function __construct() {



  }

  public function pageCallback() {

    $userCount = count_users();

    // $cts = Content Counts []
    $cts = self::fetchContentCounts();

    $content = '';

    $content .= '<h2>' + $cts->course + '</h2>';
    $content .= '<h4>Course Count</h4>';

    $content .= '<h2>' + $cts->courseRegistration + '</h2>';
    $content .= '<h4>Course Registrations</h4>';

    $content .= '<h2>' + $cts->lesson + '</h2>';
    $content .= '<h4>Lesson Count</h4>';

    $content .= '<h2>' + $cts->exam + '</h2>';
    $content .= '<h4>Exam Count</h4>';

    $content .= '<h2>' + $cts->exam + '</h2>';
    $content .= '<h4>Exam Attempts</h4>';

    $content .= '<h2>' + $cts->question + '</h2>';
    $content .= '<h4>Question Count</h4>';

    $content .= '<h2>' + $userCount['total_users'] + '</h2>';
    $content .= '<h4>Student Count</h4>';

    print $content;

  }

  public function fetchContentCounts() {

    $cts = new \stdClass;

    $cts->course = \wp_count_posts('course')->publish;
    $cts->lesson = \wp_count_posts('lesson')->publish;
    $cts->exam = \wp_count_posts('exam')->publish;
    $cts->examScore = \wp_count_posts('exam_score')->publish;
    $cts->question = \wp_count_posts('question')->publish;
    $cts->courseRegistration = \wp_count_posts('course_registration')->publish;

    return $cts;

  }

}
