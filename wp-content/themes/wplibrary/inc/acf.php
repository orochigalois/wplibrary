<?php

function setup_acf() {
	// Hide from admin menu
	//acf_update_setting('show_admin', false);

	// Google maps
	if(defined('LP_GMAPS_KEY') && LP_GMAPS_KEY) {
		acf_update_setting('google_api_key', LP_GMAPS_KEY);
	}

	if(function_exists('acf_add_options_page')) {
		/*acf_add_options_page(array(
			'page_title' => 'Project Options',
			'post_id' => 'projects',
			'parent_slug' => 'edit.php?post_type=project',
		));*/

		acf_add_options_page(array(
			'page_title' => 'Theme Options',
		));
	}
}
add_action('acf/init', 'setup_acf');

function lp_acf_license($value) {
	return (defined('LP_ACF_LICENSE') ? LP_ACF_LICENSE : $value);
}
apply_filters('pre_option_acf_pro_license', 'lp_acf_license', 10, 1);

/*function append_fc_labels($title, $fields, $layout, $i) {
	if($layout['name'] == 'anchor') {
		if($fields['value']) {
			// On load
			foreach($layout['sub_fields'] as $sf) {
				if($sf['name'] == 'id') {
					if(isset($fields['value'][$i][$sf['key']])) {
						$title .= ' - '.$fields['value'][$i][$sf['key']];
						break;
					}
				}
			}
		}
		else {
			// On AJAX update
			foreach($layout['sub_fields'] as $sf) {
				if($sf['name'] == 'id') {
					if(isset($_POST['value'][$sf['key']])) {
						$title .= ' - '.$_POST['value'][$sf['key']];
						break;
					}
				}
			}
		}
	}

	return $title;
}
add_filter('acf/fields/flexible_content/layout_title/name=content_sections', 'append_fc_labels', 10, 4);*/