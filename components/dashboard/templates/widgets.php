<div class="dashboard-widget dashboard-widget-courses">

  <h2>Registered Courses</h2>
  <div class="registered-courses-list">

    <table>
      <thead>
        <tr>
          <th>Course</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>

        <?php
          if( !empty( $courses )) :
            foreach( $courses as $cr ):
        ?>
          <tr>
            <td><?php print $cr->course->title; ?></td>
            <td><a href="<?php print $cr->course->permalink ?>">Study</a></td>
          </tr>

          <?php endforeach; endif; ?>

          <?php if( empty( $courses )) : ?>
            <tr>
              <td colspan="2">
                <p>Register for your first <a href="<?php print site_url('courses'); ?>">course</a>.</p>
              </td>
            </tr>
          <?php endif; ?>

      </tbody>
    </table>



  </div>

  <div class="view-all-courses">
    <a class="block-link" href="<?php print site_url('courses'); ?>">View All Courses</a>
  </div>

</div>

<div class="dashboard-widget dashboard-widget-membership">

  <h2>Membership Status</h2>
  <div class="membership-status-notice">

    <?php if( $student->membership == 'free' ): ?>
      <h4>You are a free member.</h4>
      <a class="block-link" href="https://spanish10.com/upgrade/">Upgrade to Premium Membership</a>
    <?php endif; ?>

    <?php if( $student->membership == 'premium' ): ?>
      <h4>You are a premium member.</h4>
      <a href="https://spanish10.com/account">Review your account</a>
    <?php endif; ?>

  </div>

</div>

<!-- Activity Log -->
<div class="dashboard-widget dashboard-widget-activity">

<?php

$intel = new \Saber\Intel\IntelReport;
$intel->loadCourseRegistrations();
// var_dump( $intel );

?>


  <h2>Activity Log</h2>
  <div class="activity-log">

    <div class="activity-log-stat">
      <h3>Active Courses</h3>
      <div>
        <?php
          print $intel->getCourseCount();
        ?>
      </div>
    </div>

    <table>
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>
    </table>

  </div>

</div>

<!-- Achievements -->
<div class="dashboard-widget dashboard-widget-achievement">

  <h2>Student Achievements</h2>
  <div class="achievements-list">

    <table>
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>
    </table>

  </div>

</div>
