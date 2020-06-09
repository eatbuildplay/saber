<?php


$access = $GLOBALS['saberAccess'];
$registration = $GLOBALS['saberRegisterCourse'];

//var_dump($access);
//var_dump($registration);

?>

<header>
  <h1><?php print $course->title; ?></h1>
  <div><?php print $course->intro; ?></div>

  <?php
    if( !$access->grant ):
      $access->renderBlockMessage();
    endif;
  ?>

  <?php if( !$registration->registered ):
      $registration->renderUnregisteredMessage();

      if( $registration->canRegister() ) :
        $registration->renderRegisterButton();
      endif;
      
    endif;
  ?>

</header>
