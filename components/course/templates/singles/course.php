<?php get_header(); ?>

<div class="course-page-wrap">

  <!-- Header -->
  <div class="course-header">

    <div class="course-header-left">

      <a class="catalog-return" href="<?php print $course->permalink; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> View Catalog</a>

      <div class="course-title">
        <h1><?php print $course->title; ?></h1>
      </div>

    </div>

    <div class="course-header-right">

      <div class="course-header-menu">

        <a href="">Download study guide</a>
        <a href="">Share</a>

      </div>
    </div>
  </div><!-- / .course-header -->

  <!-- Course Body -->
  <div class="course-body">

    <div class="course-body-left">

      <div class="course-menu">
        <div class="course-menu-collapse">
          <a href="">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i>
          </a>
        </div>

        <ul class="course-menu-list">

          <li class="course-menu-section">

            <div class="course-menu-section-header">
              <div class="course-menu-section-header-controls">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
              </div>
              <h2><?php print $course->title; ?></h2>
            </div>

            <ul class="course-menu-section-list">

              <?php foreach( $course->timeline as $timelineItem ): ?>
                <li
                  data-id="<?php print $timelineItem->id; ?>"
                  >
                  <h3><?php print $timelineItem->title; ?></h3>
                  <h5>5 minutes</h5>
                </li>
              <?php endforeach; ?>

            </ul>

          </li><!-- / .course-menu-section -->
        </ul><!-- / .course-menu-list -->

      </div>

    </div><!-- / .course-body-left -->

    <div class="course-body-right">

      <div id="lesson-canvas">

        <!-- Video Player -->
        <div data-vjs-player>
          <video id="videoPlayer" class="video-js">
            <source src="//vjs.zencdn.net/v/oceans.mp4">
          </video>
        </div>
        <!-- ./ video player -->

        <!-- Lesson Tabs -->
        <div id="lesson-tabs">

          <header>
            <a href="#">About this Lesson</a>
            <a href="#">Resources</a>
          </header>

          <ul>
            <li>

              <h4>Lesson overview</h4>

            </li>
          </ul>

        </div>

      </div>

    </div><!-- / .course-body-right -->

  </div>

</div><!-- / .course-page-wrap -->

<?php get_footer();
