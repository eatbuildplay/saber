<?php

namespace Saber\Reports;

class ReportsComponent {

  public function __construct() {

    require_once(SABER_PATH . 'components/reports/src/reports/ReportModel.php');
    require_once(SABER_PATH . 'components/reports/src/reports/TotalStudentsReport.php');

    add_action('admin_print_scripts-saber-lms_page_saber-reports', [$this, 'adminScripts']);

  }

  public function pageCallback() {

    $template = new \Saber\Template;
    $template->path = 'components/reports/templates/';
    $content = '';

    // init reports
    $tsr = new TotalStudentsReport();

    $userCount = count_users();

    // $cts = Content Counts []
    $cts = self::fetchContentCounts();

    $template->name = 'chart';
    $template->data = [
      'userCount' => $userCount,
      'cts'       => $cts
    ];
    $content .= $template->get();

    print $content;

  }

  public function fetchContentCounts() {

    $cts = new \stdClass;

    $cts->course = \wp_count_posts('course')->publish;
    $cts->courseRegistration = \wp_count_posts('course_registration')->publish;
    $cts->lesson = \wp_count_posts('lesson')->publish;
    $cts->exam = \wp_count_posts('exam')->publish;
    $cts->examScore = \wp_count_posts('exam_score')->publish;
    $cts->question = \wp_count_posts('question')->publish;

    return $cts;

  }

  public function adminScripts() {

    wp_enqueue_style(
      'saber-reports',
      SABER_URL . 'components/reports/assets/reports.css',
      array(),
      true
    );

    wp_enqueue_script(
      'saber-reports',
      SABER_URL . 'components/reports/assets/reports.js',
      array('jquery', 'chartjs'),
      SABER_VERSION,
      true
    );

  }

}
