<?php

function lp_is_plugin_active($plugin_file) {
	static $plugins = null;

	if(!$plugins) {
		$plugins = get_option('active_plugins');
	}

	return in_array($plugin_file, $plugins);
}

function lp_parse_mime($mime) {
	preg_match('/.*\/(\w*)\+?.*/', $mime, $matches);
	return $matches[1];
}

/*
	Query utils
*/
function lp_has_next_page($query = null) {
	if(!$query) {
		global $wp_query;
		$query = $wp_query;
	}

	$paged = $query->get('paged');
	if($paged < 1) {
		$paged = 1;
	}

	return $paged < $query->max_num_pages;
}

function lp_acf_source($source = null) {
	if(is_front_page()) {
		$source = get_option('page_on_front');
	}
	else if(is_home()) {
		$source = get_option('page_for_posts');
	}
	else if(!$source && !is_search() && !is_404()) {
		global $post;
		$source = $post->ID;
	}

	return $source;
}

function lp_get_primary_term($taxonomy, $id = false) {
    $id = ($id ? $id : get_the_ID());

    $term = false;
    if(class_exists('WPSEO_Primary_Term')) {
        $primary_term = new WPSEO_Primary_Term($taxonomy, $id);
        $term = get_term($primary_term->get_primary_term());
    }

    if(!$term || is_wp_error($term)) {
        $terms = get_the_terms($id, $taxonomy);

        foreach($terms as $t) {
        	if($t->parent !== 0) {
        		$term = $t;
        		break;
        	}
        }

        if(!$term) {
        	$term = $terms[0];
        }
    }

    return $term;
}

/*
	Template utilities
*/
function lp_theme_url() {
	return get_stylesheet_directory_uri();
}

function lp_theme_dir() {
	return get_stylesheet_directory();
}

function lp_theme_partial($path, $args = array()) {
	extract($args);
	include lp_theme_dir().$path;
}

function lp_image_dir(){
	echo lp_theme_url().'/images';
}

/*
	SVG icons
*/
function lp_icon($id) {
	$viewboxes = array(
	);

	return '<svg class="icon" viewBox="'.(isset($viewboxes[$id]) ? $viewboxes[$id] : '0 0 64 64').'"><use xlink:href="#Icons/'.$id.'"></use></svg>';
}

function lp_icon_file($name) {
	return file_get_contents(lp_theme_dir().'/images/'.$name.'.svg');
}

/*
	Font Awesome
*/
function lp_fa($icon, $alt = '') {
	return '<i class="fa '.$icon.'" aria-hidden="true"></i>'.($alt ? '<span class="sr-only">'.$alt.'</span>' : '');
}


// convert string to slug
function lp_slugify($text){
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, '-');
	$text = preg_replace('~-+~', '-', $text);
	$text = strtolower($text);

	if (empty($text)) {
	return 'n-a';
	}

	return $text;
}