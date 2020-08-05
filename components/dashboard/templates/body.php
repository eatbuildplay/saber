<!-- Course Content Management -->
<div id="dashboard-course-content">

  <div class="dashboard-course-content-link">
    <h2>Courses</h2>
    <a href="<?php print admin_url('edit.php?post_type=course'); ?>">
      <h2>Manage Courses</h2>
    </a>
  </div>

  <div class="dashboard-course-content-link">
    <h2>Lessons</h2>
    <a href="<?php print admin_url('edit.php?post_type=lesson'); ?>">
      <h2>Manage Lessons</h2>
    </a>
  </div>

  <div class="dashboard-course-content-link">
    <h2>Exams</h2>
    <a href="<?php print admin_url('edit.php?post_type=exam_score'); ?>">
      <h2>View Exam Scores</h2>
    </a>
    <a href="<?php print admin_url('edit.php?post_type=exam'); ?>">
      <h2>Manage Exams</h2>
    </a>
  </div>

  <div class="dashboard-course-content-link">
    <h2>Questions</h2>
    <a href="<?php print admin_url('edit.php?post_type=question'); ?>">
      <h2>Manage Questions</h2>
    </a>
  </div>

  <div class="dashboard-course-content-link">
    <h2>Reports</h2>
    <a href="<?php print admin_url('admin.php?page=saber-reports'); ?>">
      <h2>View All Reports</h2>
    </a>
  </div>

  <div class="dashboard-course-content-link">
    <h2>Settings</h2>
    <a href="<?php print admin_url('admin.php?page=saber-settings'); ?>">
      <h2>Manage Settings</h2>
    </a>
  </div>

</div>

<!-- Reports Section -->
<div id="dashboard-reports-section">

  <header class="dashboard-section">
    <h2>Summary Reports</h2>
    <a href="<?php print admin_url('admin.php?page=saber-reports'); ?>">View All Reports</a>
  </header>

  <div id="dashboard-reports-grid">

    <div>
      <h2>Total Students Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="studentRegistrationReport" width="400" height="300"></canvas>
      </div>
    </div>

  </div>

</div>

<!-- Support Section -->
<div id="dashboard-support-section">

  <header>
    <h2>Support</h2>
    <a href="">Open a Ticket</a>
  </header>

</div>
