<?php

$access = new \Saber\Access\Access;
$access->courseAccess( $course );

//var_dump($access);

?>

<header>
  <?php
    if( !$access->grant ):
      $access->renderBlockMessage();
    endif;
  ?>
</header>
