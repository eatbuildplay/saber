<?php

namespace Saber\Reports;

class ReportModel {

  /*
   * $type | time span, supported options days, months
   * Return array of DateTime objects
   */
  public function makeDateSeries( $type = 'month', $units = 6 ) {

    $dates = [];

    // start of series
    $date = new \DateTime('last day of this month');

    $c = 1;
    while( $c <= $units ) {
      $dt = clone $date->modify('last day of previous month');
      $dates[] = $dt;
      $c++;
    }

    return $dates;

  }

  public function dateSeriesJson( $dateSeries ) {

    $labels = [];
    foreach( $dateSeries as $date ) {
      $labels[] = $date->format('m');
    }
    return json_encode( $labels );

  }

}
