<?php
// Template Name: video_with_image_overlay



the_post();
get_header(); 

?>
<!-- __________Note1__________Normally, this line shoud go into header.php -->
<script src="https://player.vimeo.com/api/player.js"></script>

<div id="video">
  <div class="video-container">
		<iframe src="https://player.vimeo.com/video/270251767" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
		<div class="video-overlay" style="background:url(<?php lp_image_dir(); ?>/videoOverlay.jpg) no-repeat center/cover;">
			<img src="<?php lp_image_dir(); ?>/videoPlay.png"  />
		</div>
	</div>
</div>

  


<?php get_footer(); ?>