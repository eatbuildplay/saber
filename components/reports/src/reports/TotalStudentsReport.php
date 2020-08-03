<?php

namespace Saber\Reports;

class TotalStudentsReport extends ReportModel {

  public function __construct() {

    $dateSeries = $this->makeDateSeries();
    $labels = $this->makeLabels( $dateSeries );
    $data = $this->fetchData( $dateSeries );

    wp_localize_script(
      'saber-reports',
      'saberReportsData',
      [
        'totalStudentsReport' => [
          'labels' => $labels,
          'data'   => $data
        ]
      ]
    );

    /*
    print '<pre>';
    var_dump( $data );
    var_dump( $dateSeriesJson );
    print '</pre>';
    */

  }

  public function fetchData( $dateSeries ) {

    $data = [];

    foreach( $dateSeries as $date ) {
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

  public function makeLabels( $dateSeries ) {

    $labels = [];
    foreach( $dateSeries as $date ) {
      $labels[] = $date->format('m');
    }
    return $labels;

  }

}
