<?php

require 'inc/constants.php';

require 'inc/acf.php';
require 'inc/admin.php';
require 'inc/ajax.php';
require 'inc/enqueue.php';
require 'inc/misc.php';
require 'inc/register.php';


function is_blog () {
	return (is_archive() || is_author() || is_category() || is_single() || is_tag()) && 'post' == get_post_type();
}

// remove p around img
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// put a div around tables
function filter_div_on_table($content){
    return preg_replace('/(<table.*<\/table\>)/si','<div class="table-wrap">$0</div>', $content);
}
add_filter('the_content', 'filter_div_on_table');

// put a div around oembed
function filter_div_on_oembed($html, $url, $attr, $post_id) {
    return '<div class="oembed"><div class="oembed__inner">'.$html.'</div></div>';
}
add_filter('embed_oembed_html', 'filter_div_on_oembed', 100, 4);

// Add a search dropdown to header menu
/*function add_search_to_header_menu($items) {
	ob_start();
	include get_template_directory().'/partials/search-box.php';
	$html = ob_get_clean();

	return $items.$html;
}
add_filter('wp_nav_menu_header-menu_items', 'add_search_to_header_menu');*/

// Set the homepage <title> attribute;
/*function different_document_title($title) {
    if(lp_is_homepage()) {
        $title = get_bloginfo('name');
    }

    return $title;
}
add_filter('pre_get_document_title', 'different_document_title', 100);*/

// Filter the main queries
/*function filter_get_posts($query) {
	if(!is_admin()) {
		if($query->is_main_query() && $query->is_post_type_archive('project')) {
			$query->set('posts_per_page', 12);
		}
	}

	return $query;
}
add_filter('pre_get_posts', 'filter_get_posts');*/

// Reroute inaccessible pages to 404
/*function reroute_to_404($template) {
	if(get_field('page_inaccessible')) {
		return locate_template('404.php');
	}
	else {
		return $template;
	}
}
add_filter('template_include', 'reroute_to_404');*/

// Redirect to a URL
/*function redirect_to_url() {
	$redirect = get_field('page_redirect');
	if($redirect && $redirect['url']) {
		wp_redirect($redirect['url']);
	}
}
add_action('template_redirect', 'redirect_to_url');*/


// send thankyou edm
/*function lp_register($form) {
    // Fields
    $submission = WPCF7_Submission::get_instance();
    $data = $submission->get_posted_data();

    // $site_url = 'http://' . $_SERVER["SERVER_NAME"];
    // absolute URL to PROD for easy testing on stage / local
    $site_url = 'http://yoururl.com.au/wp-content/themes/yourtheme';

    // Full name
    $name = $data['first-name'];

    // Email
    $email = $data['email'];

    $to = $email;

    $subject = 'Site Name  - Registration';
    $body = file_get_contents(get_template_directory() . '/email/index.html');

    // TEMPLATE SET UP
    $body = str_replace('%%NAME%%', strtoupper($name), $body);
    $body = str_replace('%%SITEURL%%', $site_url, $body);

    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: Site Name <noreply@yoururl.com.au>');

    wp_mail( $to, $subject, $body, $headers );
}
add_action('wpcf7_before_send_mail', 'lp_register');*/


// Change 'Flamingo' admin menu title
/*function customize_post_admin_menu_labels() {
    global $menu;
    global $submenu;
    $menu[26][0] = 'Submissions';
    $submenu['flamingo'][1][0] = 'Submissions';
    echo '';
}
add_action( 'admin_menu', 'customize_post_admin_menu_labels' );*/
