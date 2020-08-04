<?php

namespace Saber\Reports;

class TotalStudentsReport extends ReportModel {

  public function __construct() {

    $this->dateSeries = $this->makeDateSeries();
    $this->labels = $this->makeLabels();
    $this->data = $this->fetchData();

  }

  public function localizeReportData( $scriptKey ) {

    wp_localize_script(
      $scriptKey,
      'saberReportsData',
      [
        'totalStudentsReport' => [
          'labels' => $this->labels,
          'data'   => $this->data
        ]
      ]
    );

  }

  public function fetchData() {

    $data = [];

    foreach( $this->dateSeries as $date ) {
      $args = [
        'number' => -1,
        'date_query' => [
          [
            'before' => $date->format('Y-m-d')
          ]
        ]
      ];
      $userQuery = new \WP_User_Query( $args );
      $userCount = $userQuery->get_total();
      $data[] = $userCount;
    }

    return $data;

  }

  public function makeLabels() {

    $labels = [];
    foreach( $this->dateSeries as $date ) {
      $labels[] = $date->format('m');
    }
    return $labels;

  }

}
