<?php $access = $GLOBALS['saberAccess']; ?>

<header class="lesson-single-header">

  <?php
    if( isset( $access ) && !$access->grant ):
      $access->renderBlockMessage();
    endif;
  ?>

  <?php
    if( isset( $access ) && $access->grant ):
  ?>
    <h3><?php print $lesson->course->title; ?> / Lesson <?php print $lesson->displayOrder; ?> / <?php print $lesson->title; ?></h3>

    <h5 class="return-course-link">
      <a href="<?php print $lesson->course->permalink; ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i> Return to Course</a>
    </h5>
  <?php endif; ?>

</header>
