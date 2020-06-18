<?php $access = $GLOBALS['saberAccess']; ?>

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

</header>
