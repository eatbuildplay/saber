<div id="reports-wrap">

  <header id="reports-header">
    <h1>Saber LMS Reports</h1>
  </header>

  <!-- Stats Grid -->
  <div class="stat-grid-3">

    <div class="report-stat">
      <h2><?php print $cts->course; ?></h2>
      <h4>Courses</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $cts->courseRegistration; ?></h2>
      <h4>Course Registrations</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $cts->lesson; ?></h2>
      <h4>Lesson Count</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $cts->exam; ?></h2>
      <h4>Exams</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $cts->examScore; ?></h2>
      <h4>Exam Attempts</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $cts->question; ?></h2>
      <h4>Questions</h4>
    </div>

    <div class="report-stat">
      <h2><?php print $userCount['total_users']; ?></h2>
      <h4>Registered Students</h4>
    </div>

  </div>
  <!-- / Stats Grid -->

  <div id="reports-grid">

    <div class="report-grid-item">
      <h2>Total Students Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="studentRegistrationReport" width="400" height="300"></canvas>
      </div>
    </div>

    <div class="report-grid-item">
      <h2>New Students Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="studentsNewReport" width="400" height="300"></canvas>
      </div>
    </div>

    <div class="report-grid-item">
      <h2>Student Status Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="studentStatusReport" width="400" height="300"></canvas>
      </div>
    </div>

    <div class="report-grid-item">
      <h2>Course Registration Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="courseRegistrationReport" width="400" height="300"></canvas>
      </div>
    </div>

    <div class="report-grid-item">
      <h2>Course Start Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="courseStartReport" width="400" height="300"></canvas>
      </div>
    </div>

    <div class="report-grid-item">
      <h2>Course Line Report</h2>
      <div class="chart-wrap" style="max-width: 400px;">
        <canvas id="courseLineReport" width="400" height="300"></canvas>
      </div>
    </div>

  </div><!-- / #reports-grid -->




</div><!-- / #reports-wrap -->
