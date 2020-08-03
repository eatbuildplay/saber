<div id="saber-dashboard">

  <header id="saber-dashboard-header">

    <div id="saber-logo">
      <img src="<?php print SABER_URL; ?>/assets/images/saber-logo.jpg" />
    </div>

    <div id="dashboard-header-main">
      <h1>DASHBOARD</h1>
    </div>

  </header>

  <!-- Breadcrumbs -->
  <div id="breadcrumbs" style="display: flex;">
    <span class="breadcrumb-element">DASHBOARD</span>
    <span class="breadcrumb-divider">/</span>
    <span class="breadcrumb-element breadcrumb-current">MAIN</span>
  </div>

  <!-- Course Content Management -->
  <div id="dashboard-course-content">

    <div class="dashboard-course-content-link">
      <a href="<?php admin_url('edit.php?post_type=course'); ?>">
        <h2>Manage Courses</h2>
      </a>
    </div>

    <div class="dashboard-course-content-link">
      <a href="<?php admin_url('edit.php?post_type=lesson'); ?>">
        <h2>Manage Lessons</h2>
      </a>
    </div>

    <div class="dashboard-course-content-link">
      <a href="<?php admin_url('edit.php?post_type=exam'); ?>">
        <h2>Manage Exams</h2>
      </a>
    </div>

    <div class="dashboard-course-content-link">
      <a href="<?php admin_url('edit.php?post_type=question'); ?>">
        <h2>Manage Questions</h2>
      </a>
    </div>

  </div>

  <!-- Reports Section -->
  <div id="dashboard-reports-section">

    <header class="dashboard-section">
      <h2>SABER LMS REPORTS</h2>
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

  <!-- Reports Section -->
  <div id="dashboard-support-section">

    <header>
      <h2>Support</h2>
    </header>

  </div>

</div>
