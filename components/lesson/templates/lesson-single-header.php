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
  <?php endif; ?>

</header>
