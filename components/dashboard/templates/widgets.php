<div class="dashboard-widget dashboard-widget-courses">

  <h2>Registered Courses</h2>
  <div class="registered-courses-list">
    <?php
      if( !empty( $courses )) :
        foreach( $courses as $cr ):
    ?>
      <h3><?php print $cr->course->title; ?></h3>
      <a href="<?php print $cr->course->permalink ?>">Study</a>
    <?php endforeach; endif; ?>

    <?php if( empty( $courses )) : ?>
      <p>Register for your first <a href="<?php print site_url('courses'); ?>">course</a>.</p>
    <?php endif; ?>

  </div>

  <div class="view-all-courses">
    <a href="<?php print site_url('courses'); ?>">View All Courses</a>
  </div>

</div>

<div class="dashboard-widget dashboard-widget-membership">

  <h2>Membership Status</h2>
  <div class="membership-status-notice">

    <?php if( $student->membership == 'free' ): ?>
      <h4>You are a free member.</h4>
      <a href="https://spanish10.com/upgrade/">Upgrade to Premium Membership</button>
    <?php endif; ?>

    <?php if( $student->membership == 'premium' ): ?>
      <h4>You are a premium member.</h4>
      <a href="https://spanish10.com/account">Review your account</button>
    <?php endif; ?>

  </div>

</div>
