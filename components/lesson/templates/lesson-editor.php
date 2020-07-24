<?php

global $post;

$videoId = get_post_meta( $post->ID, 'saber_lesson_video', 1 );

if( $image = wp_get_attachment_image_src( $videoId ) ) {

	echo '<a href="#" class="saber-uploader"><img src="' . $image[0] . '" /></a>
	      <a href="#" class="saber-uploader-remove">Remove Video</a>
	      <input type="hidden" name="lesson-video" value="' . $image_id . '">';

} else {

	echo '<a href="#" class="saber-uploader">Upload image</a>
	      <a href="#" class="saber-uploader-remove" style="display:none">Remove Video</a>
	      <input type="hidden" id="lessonVideo" name="lessonVideo" value="">';

}

?>
