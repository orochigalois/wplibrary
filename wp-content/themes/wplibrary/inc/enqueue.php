<?php

function lp_enqueue_frontend() {
	// Dequeue existing scripts
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');

	// Third-party styles
	wp_enqueue_script('fa', '//use.fontawesome.com/releases/v5.0.6/js/all.js', '', '', true);

	// Our styles
	wp_enqueue_style('main-style', get_template_directory_uri().'/dist/css/main.min.css');

	// Third-party scripts
	wp_enqueue_script('jquery', '//code.jquery.com/jquery-2.2.4.min.js', '', '', true);
	wp_enqueue_script('bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', '', '', true);

	if(defined('LP_GMAPS_KEY') && LP_GMAPS_KEY) { wp_enqueue_script('gmaps_api', 'https://maps.googleapis.com/maps/api/js?key='.LP_GMAPS_KEY, '', '', true); }

	// Our scripts
	wp_enqueue_script('plugin-script', get_template_directory_uri().'/dist/js/plugins.min.js', '','', true);
	wp_enqueue_script('main-script', get_template_directory_uri().'/dist/js/main.min.js', '','', true);
}
add_action('wp_enqueue_scripts', 'lp_enqueue_frontend');

function lp_enqueue_admin() {
	//add_editor_style(get_template_directory_uri().'/dist/css/editor-styles.css');
}
add_action('admin_init', 'lp_enqueue_admin');
