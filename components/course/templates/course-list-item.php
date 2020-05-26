<div class="saber-post-list-item-wrap">
  <a href="<?php print get_permalink( $post->ID ); ?>">
    <div class="course-list-item saber-post-list-item">
      <h5>ID <?php print $model->id; ?></h5>
      <h3>Course Number <?php print $model->displayOrder; ?></h3>
      <h2>
        <?php print $model->title; ?>
      </h2>
      <p><?php print $model->intro; ?></p>
    </div>
  </a>
</div>

<?php

// var_dump( $model );

?>
