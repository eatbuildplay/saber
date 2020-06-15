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
    <h2><?php print $lesson->course->title; ?></h2>
    <h5>Lesson <?php print $lesson->displayOrder; ?></h5>
    <h3><?php print $lesson->title; ?></h3>
  <?php endif; ?>

</header>
