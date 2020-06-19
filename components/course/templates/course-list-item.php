<?php // var_dump( $courseRegistration ); ?>

<div class="course-list-item-wrap saber-post-list-item-wrap">
  <a href="<?php print get_permalink( $post->ID ); ?>">
    <div class="course-list-item saber-post-list-item">

      <header class="course-list-item-header">
        <?php
          switch( $model->level ) {
            case 1:
              $levelKey = 'beginner';
              $level = 'Beginner Spanish';
              break;
            case 2:
              $levelKey = 'intermediate';
              $level = 'Intermediate Spanish';
              break;
            case 3:
              $levelKey = 'advanced';
              $level = 'Advanced Spanish';
              break;
          }
        ?>
        <div class="course-level-notice course-level-notice-<?php print $levelKey; ?>">
          <?php print $level; ?>
        </div>
      </header>

      <h5>ID <?php print $model->id; ?></h5>
      <h3>Course Number <?php print $model->displayOrder; ?></h3>
      <h2>
        <?php print $model->title; ?>
      </h2>
      <p><?php print $model->intro; ?></p>

      <footer class="course-list-item-footer">

        <?php if( $courseRegistration ) : ?>
          <div class="course-registration-notice">
            Registered since <?php print $courseRegistration->registrationDate; ?>
          </div>
        <?php endif; ?>

      </footer>

    </div>
  </a>
</div>
