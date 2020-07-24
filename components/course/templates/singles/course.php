<link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />


<?php

/**
 *
 * Course single default template
 *
 *
 */

get_header();

/*
print '<pre>';
var_dump( $GLOBALS['course'] );
print '</pre>';
*/

?>

<div class="course-page-wrap">

  <!-- Header -->
  <div class="course-header">

    <div class="course-header-left">

      <a href="<?php print $course->permalink; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i> View Catalog</a>

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
                <li>
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


      <!-- Video Player -->
      <video
        id="my-video"
        class="video-js"
        controls
        preload="auto"
        width="640"
        height="264"
        poster="https://eatbuildplay.com/wp-content/uploads/2020/07/architect-on-construction-site.jpg"
        data-setup="{}"
      >
        <source src="https://eatbuildplay.com/wp-content/uploads/2020/07/video1.mp4" type="video/mp4" />
        <p class="vjs-no-js">
          To view this video please enable JavaScript, and consider upgrading to a
          web browser that
          <a href="https://videojs.com/html5-video-support/" target="_blank"
            >supports HTML5 video</a
          >
        </p>
      </video>


    </div><!-- / .course-body-right -->

  </div>

</div><!-- / .course-page-wrap -->


<?php

function saberRenderCatalogUrl() {
  print 'https://eatbuildplay.com/courses/';
}

function saberRenderCourseTitle() {
  print "Mastering Three.js";
  // print $course->title;
}

function hasStudyGuide() {
  return 1;
}

function saberRenderStudyGuideUrl() {
  print 'https://eatbuildplay.com/courses/';
}

?>

<script src="https://vjs.zencdn.net/7.8.3/video.js"></script>

<?php

get_footer();
