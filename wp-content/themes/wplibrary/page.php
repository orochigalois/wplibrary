<?php
the_post();
get_header(); 
?>

<?php

while(have_rows('flexible_content')) {
	the_row();

	lp_theme_partial('/partials/flexible/' . get_row_layout() . '.php');
}

?>

<?php get_footer(); ?>