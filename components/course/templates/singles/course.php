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

        <a class="course-study-guide-download" href="">Download study guide</a>

      </div>
    </div>
  </div><!-- / .course-header -->

  <!-- Course Body -->
  <div class="course-body">

    <div class="course-body-left">

      <div class="course-menu">
        <div class="course-menu-collapse">
          <i class="fa fa-angle-double-left" aria-hidden="true"></i>
        </div>

        <ul class="course-menu-list">

          <li class="course-menu-section">

            <div class="course-menu-section-header">
              <div class="course-menu-section-header-controls">
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
              </div>
              <h2><?php print $course->title; ?></h2>
            </div>

            <ul class="course-menu-section-list timeline">

              <?php foreach( $course->timeline as $timelineItem ): ?>
                <li class="timeline-item"
                  data-id="<?php print $timelineItem->id; ?>"
                  >
                  <div class="timeline-item-content">
                    <h3><?php print $timelineItem->title; ?></h3>
                    <h5><?php print $timelineItem->duration; ?> minutes</h5>
                  </div>
                </li>
              <?php endforeach; ?>

            </ul>

          </li><!-- / .course-menu-section -->
        </ul><!-- / .course-menu-list -->

      </div>

    </div><!-- / .course-body-left -->

    <div class="course-body-right"></div><!-- / .course-body-right -->

  </div>

</div><!-- / .course-page-wrap -->



<?php

$template = new \Saber\Template();
$template->path = 'components/exam/templates/';

$content = '';

// main template
$template->name = 'exam-single';
$template->data = array(
  'exam' => $exam,
  'examFields' => $examFields
);
$content .= $template->get();

// print out the exam canvas
print '<template id="exam-template">';
print $content;
print '</template>';

// make new content for existing template wrapped elements
$content = '';

// exam controls template
$template->name = 'exam-single-controls';
$template->data = array();
$content .= $template->get();

// question template
$template->name = 'question-single';
$content .= $template->get();

// question options template
$template->name = 'question-option-single';
$content .= $template->get();

// start screen template
$template->name = 'exam-single-start';
$template->data = array();
$content .= $template->get();

// end screen template
$template->name = 'exam-single-end';
$template->data = array();
$content .= $template->get();

// exam score results
$template->path = 'components/exam/templates/parts/';
$template->name = 'exam-score-results';
$template->data = array();
$content .= $template->get();

print $content;

?>

<!-- Lesson Template -->

<template id="lesson-template">

  <div id="lesson-canvas">

    <!-- Video Player -->
    <div data-vjs-player>
      <video id="videoPlayer" class="video-js"></video>
    </div>
    <!-- ./ video player -->

    <!-- Lesson Tabs -->
    <div id="lesson-tabs">

      <header>
        <a href="#" data-target="tab1">About this Lesson</a>
        <a href="#" data-target="tab2">Resources</a>
      </header>

      <ul>
        <li id="tab1" class="lesson-tabs-tab">

          <div class="lesson-overview">
            <h4>Lesson overview</h4>
            <p>{{lesson_overview}}</p>
          </div>

          <hr />

          <div class="lesson-author">
            <h4>Lesson professor</h4>
            <div class="lesson-author-box">
              <div class="lesson-author-box-left">
                <img class="lesson-author-profile" src="" />
              </div>
              <div class="lesson-author-box-right">
                <h5 class="lesson-author-name"></h5>
                <div class="lesson-author-bio"></div>
              </div>
            </div>
          </div>

        </li>

        <li id="tab2" class="lesson-tabs-tab">
          <div id="lesson-resources">
            <h4>Lesson resources</h4>
          </div>
        </li>

      </ul>

    </div>

  </div>

</template>
<!-- ./ #lesson-canvas / end lesson template -->



<?php get_footer();
