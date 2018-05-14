<div id="comments">
	<h6><?php comments_number('0 comments', '1 comment', '% comments'); ?></h6>
	<?php if(have_comments()): ?>
		<ul class="commentlist">
			<?php wp_list_comments(array('callback' => 'woocommerce_comments')); ?>
		</ul>
		<?php if(get_comment_pages_count() > 1 && get_option('page_comments')): ?>
			<nav class="comment-pagination">
				<?php
					paginate_comments_links(array(
						'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i><span class="sr-only">Previous</span>',
						'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i><span class="sr-only">Next</span>',
						'type' => 'list',
					));
				?>
			</nav>
		<?php endif; ?>
	<?php endif; ?>
</div>

<div id="respond">
	<?php if(comments_open()): ?>
		<h6>Post a comment</h6>
		<?php if(get_option('comment_registration') && !is_user_logged_in()) : ?>
			<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
		<?php else: ?>
			<?php $commenter = wp_get_current_user(); ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if($commenter->ID == 0): ?>
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="input-wrap">
								<label for="author">Your full name*</label>
								<input type="text" name="author" id="author" value="<?php print $commenter->display_name; ?>" />
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="input-wrap">
								<label for="email">Email address*</label>
								<input type="text" name="email" id="email" value="<?php echo $commenter->user_email; ?>" />
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div class="input-wrap">
					<textarea name="comment" id="comment" rows="5" placeholder="Write your comment here..."></textarea>
				</div>
				<div class="input-wrap">
					<input name="submit" type="submit" id="submit" class="button blue red" value="Submit" />
					<input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" />
				</div>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; ?>
	<?php else: ?>
		<p>The comments are closed.</p>
	<?php endif; ?>
</div>