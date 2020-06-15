<?php $access = $GLOBALS['saberAccess']; ?>

<header>
  <h1><?php print $course->title; ?></h1>
  <div><?php print $course->intro; ?></div>

  <?php
    if( isset( $access ) && !$access->grant ):
      $access->renderBlockMessage();
    endif;
  ?>

</header>
