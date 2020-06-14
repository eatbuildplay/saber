<?php

$access = $GLOBALS['saberAccess'];
$registration = $GLOBALS['saberRegisterCourse'];

?>

<header>
  <h1><?php print $course->title; ?></h1>
  <div><?php print $course->intro; ?></div>

  <?php
    if( !$access->grant ):
      $access->renderBlockMessage();
    endif;
  ?>

</header>
