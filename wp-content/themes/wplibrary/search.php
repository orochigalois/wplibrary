<?php get_header(); ?>

<div class="container">
	<h1>Search results for <span><?php print get_query_var('s'); ?></span></h1>
	<?php if(have_posts()): ?>
		<div class="posts">
			<?php while(have_posts()): the_post(); ?>
				<div class="post">
					<?php include locate_template('partials/post.php'); ?>
				</div>
			<?php endwhile; ?>
			<div class="pagination">
				<?php
					print paginate_links(array(
						'current' => max( 1, get_query_var( 'paged' ) ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i><span class="sr-only">Previous</span>',
						'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i><span class="sr-only">Next</span>',
						'type' => 'list',
						'end_size' => 3,
						'mid_size' => 3
					));
				?>
			</div>
		</div>
	<?php else: ?>
		<div class="no-posts">
			<p>No results were found</p>
		</div>
	<?php endif; ?>
</div>

<?php get_footer(); ?>
