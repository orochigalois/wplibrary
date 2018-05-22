<?php
the_post();
get_header(); 
?>

<div class="container">
	<?php the_content(); ?>
</div>
<?php



$output = wp_list_pages('echo=0&depth=1&title_li= &sort_column=menu_order' );
if (is_page( )) {
  $page = $post->ID;
  if ($post->post_parent) {
    $page = $post->post_parent;
  }

  $children=wp_list_pages( 'echo=0&depth=1&child_of=' . $page . '&title_li=&sort_column=menu_order' );
  if ($children) {
    $output = wp_list_pages ('echo=0&depth=1&child_of=' . $page . '&title_li= &sort_column=menu_order');
  }
}
?>
 <li><a href="<?php echo get_permalink( $post->post_parent ); ?>" class="active">Home</a></li>
<?php 
echo $output;


              ?>
<?php get_footer(); ?>