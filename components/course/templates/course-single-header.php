<?php

$access = new \Saber\Access\Access;
$access->courseAccess( $course );

//var_dump($access);

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
