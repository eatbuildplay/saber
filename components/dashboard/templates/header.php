
<div class="saber-dashboard">
  <header>

    <h1>DASHBOARD HEADER</h1>

  </header>

  <h2>Courses</h2>
  <div>
    <?php foreach( $courses as $cr ): ?>
      <h3><?php print $cr->course->title; ?></h3>
    <?php endforeach; ?>
  </di>

</div>
