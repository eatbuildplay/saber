
<div class="saber-dashboard">
  <header></header>

  <div>
    <h2>Registered Courses</h2>
    <div>
      <?php foreach( $courses as $cr ): ?>
        <h3><?php print $cr->course->title; ?></h3>
      <?php endforeach; ?>
    </div>
  </div>

</div>
