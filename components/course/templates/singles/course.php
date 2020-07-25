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
        <a href="">Share</a>

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
                    <h5>5 minutes</h5>
                  </div>
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
            <a href="#" data-target="tab1">About this Lesson</a>
            <a href="#" data-target="tab2">Resources</a>
          </header>

          <ul>
            <li id="tab1" class="lesson-tabs-tab">

              <h4>Lesson overview</h4>
              <p>A customer journey map is a visual representation of the stages or milestones a customer goes through with your company. As such, customer journey maps are an essential tool for building customer empathy throughout your entire organization. This lesson will go through why customer journey mapping is so important, best practices to creating them, and examples of maps in various industries.</p>

              <h4>Lesson professor</h4>
              <div class="lesson-author-box">
                <div class="lesson-author-box-left">
                  <img src="https://picsum.photos/150/150" />
                </div>
                <div class="lesson-author-box-right">
                  <h5>Author Name</h5>
                  <p>Adriti is currently an Inbound Professor for HubSpot Academy, focusing on Service Hub. Prior to HubSpot, Adriti worked at a non-profit educational program focusing on getting high school students into colleges and universities. She is passionate about ensuring education is accessible for all. Outside of work, Adriti can be found at your local Chinese restaurant, or at a spin class, trying to work off said Chinese food.</p>
                </div>
              </div>

            </li>

            <li id="tab2" class="lesson-tabs-tab">
              <h4>Lesson resources</h4>
            </li>

          </ul>

        </div>

      </div>

    </div><!-- / .course-body-right -->

  </div>

</div><!-- / .course-page-wrap -->

<?php get_footer();
