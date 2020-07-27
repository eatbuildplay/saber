<?php

global $post;

?>

<div class="saber-field">
	<?php

		$videoId = get_post_meta( $post->ID, 'lesson_video', 1 );
		$filename = basename ( get_attached_file( $videoId ) );

	?>
	<label for="lesson_video">Video Lesson</label>
	<input type="hidden"
		id="lesson_video"
		name="lesson_video"
		value="<?php print $videoId; ?>"
		data-filename="<?php print $filename; ?>"
		/>
</div>

<div class="saber-field">
	<label for="lesson_overview">Lesson Overview</label>
	<textarea id='lesson_overview' name="lesson_overview"><?php print get_post_meta( $post->ID, 'saber_lesson_overview', 1 ); ?></textarea>
</div>

<div class="saber-field">
	<label for="lesson_duration">Duration</label>
	<input
		type="text"
		id="lesson_duration"
		name="lesson_duration"
		value="<?php print get_post_meta( $post->ID, 'lesson_duration', 1 ); ?>"
		/>
</div>

<div class="saber-field">
	<?php $professor = get_post_meta( $post->ID, 'lesson_professor', 1 ); ?>
	<label>Professor</label>
	<select id="lesson_professor" name="lesson_professor">
		<?php foreach( $professors as $prof ): ?>
			<option value='<?php print $prof->ID; ?>'><?php print $prof->display_name; ?></option>
		<?php endforeach; ?>
	</select>
</div>

<div class="saber-field">
	<label>Resource Links</label>
	<input id="lesson_resources" name="lesson_resources" type="hidden" />
</div>

<pre>
<?php // var_dump($professors); ?>
</pre>
