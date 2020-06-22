<?php $access = $GLOBALS['saberAccess']; ?>


<?php

$tracker = new Saber\Intel\TrackerCourse;
$tracker->setObject('course', $course->id);
$progress = $tracker->getCourseProgress();

?>

<header class="course-single">

  <h1><?php print $course->title; ?></h1>
  <div><?php print $course->intro; ?></div>

  <?php

    // block access message
    if( isset( $access ) && !$access->grant ):
      $access->renderBlockMessage();
    endif;

    // registered message
    if( isset( $access ) && $access->grant ):
      $access->renderGrantMessage();
    endif;

  ?>

  <?php if( isset( $access ) && $access->grant ): ?>

    <div class="course-progress">

      <div class="progress-bar">
        <span class="progress-bar-fill" style="width: <?php print $progress; ?>%;"></span>
      </div>

      <h5>Course Progress (<?php print $progress; ?>%)</h5>

    </div>

  <?php endif; ?>

</header>
