<?php

$classes = 'course-lesson-list-item-wrap saber-post-list-item-wrap';

if( $isCurrent ) {
  $classes .= ' current-lesson';
}

?>

<div class="<?php print $classes; ?>">
  <a href="<?php print get_permalink( $post->ID ); ?>">
    <div class="course-lesson-list-item saber-post-list-item">
      <h5>Lesson <?php print $order; ?></h5>
      <h2>
        <?php print $post->post_title; ?>
      </h2>
    </div>
  </a>
</div>
