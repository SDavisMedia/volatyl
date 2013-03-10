<?php
/** footer-html.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * This is the main <footer> element of your site. 
 *
 * The footer_element() function is the <footer> itself while the
 * footer_frame() displays the footer based on the site structure.
 * 
 * @package Volatyl
 * @since Volatyl 1.0
 */

// The standard footer element
function footer_element() {
	global $options, $tab3, $tab6;
	$options = get_option('vol_hooks_options');
	$options_content = get_option('vol_content_options');
	$options_general = get_option('vol_general_options');

	echo "<footer class=\"site-footer\">\n";

	// vol_footer_top - Always hide on landing page
	if ($options['switch_vol_footer_top'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_top'] == 0 && $options['front_vol_footer_top'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_top'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_top'] == 0) ||
			(is_single() && $options['posts_vol_footer_top'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_top'] == 0) ||
			(is_archive() && $options['archive_vol_footer_top'] == 0) ||
			(is_search() && $options['search_vol_footer_top'] == 0) ||
			(is_404() && $options['404_vol_footer_top'] == 0)) {
				vol_footer_top();
		} else {
			do_action('vol_footer_top');
		}
	}
		
	/** Fat footer (widgetized)
	 *
	 * If the fat footer option is selected, three widgetized columns
	 * will display.
	 * 
	 * Always hide on landing page	
	 *
	 * @since Volatyl 1.0
	 */
	(($options_content['fatfooter'] == 1 && ! is_page_template()) ?
		printf("\t\t<div id=\"fat-footer\" class=\"clearfix\">\n
		{$tab3}<div class=\"footer-widget border-box\">\n") .
		((!dynamic_sidebar('footer-left')) ? default_widget() : '') .
		printf("{$tab3}</div>\n
		{$tab3}<div class=\"footer-widget border-box\">\n") .
		((!dynamic_sidebar('footer-middle')) ? default_widget() : '') .
		printf("{$tab3}</div>\n
		{$tab3}<div class=\"footer-widget border-box\">\n") .
		((!dynamic_sidebar('footer-right')) ? default_widget() : '') .
		printf("{$tab3}</div>\n
		\t\t</div>\n") : 
	'');

	// vol_footer_bottom - Always hide on landing page
	if ($options['switch_vol_footer_bottom'] == 0 && ! is_page_template('custom-landing.php')) {
		if 	((is_home() && is_front_page() && $options['home_vol_footer_bottom'] == 0 && $options['front_vol_footer_bottom'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_footer_bottom'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_footer_bottom'] == 0) ||
			(is_single() && $options['posts_vol_footer_bottom'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_footer_bottom'] == 0) ||
			(is_archive() && $options['archive_vol_footer_bottom'] == 0) ||
			(is_search() && $options['search_vol_footer_bottom'] == 0) ||
			(is_404() && $options['404_vol_footer_bottom'] == 0)) {
				vol_footer_bottom();
		} else {
			do_action('vol_footer_bottom');
		}
	}
	echo "\t<div class=\"site-info\">",

	// Footer attribution
	(($options_general['attribution'] == 1) ? 

		// DO NOT CHANGE text IF displayed
		__('<p>Built with ', 'volatyl') . 
		"<a href=\"" . THEME_URI . "\">Volatyl</a>" . 
		__(' for WordPress</p>', 'volatyl') : 
	'');

	// vol_site_info
	if ($options['switch_vol_site_info'] == 0) {
		if 	((is_home() && is_front_page() && $options['home_vol_site_info'] == 0 && $options['front_vol_site_info'] == 0) ||
			(is_home() && ! is_front_page() && $options['home_vol_site_info'] == 0) ||
			(is_front_page() && ! is_home() && $options['front_vol_site_info'] == 0) ||
			(is_single() && $options['posts_vol_site_info'] == 0) ||
			(is_page() && ! is_front_page() && $options['pages_vol_site_info'] == 0) ||
			(is_archive() && $options['archive_vol_site_info'] == 0) ||
			(is_search() && $options['search_vol_site_info'] == 0) ||
			(is_404() && $options['404_vol_site_info'] == 0)) {
				vol_site_info();
		} else {
			do_action('vol_site_info');
		}
	}
	
	echo "</div>\n
	</footer>";
}

// The above <footer> will display based on HTML structure options
function footer_frame() {
	$options_structure = get_option('vol_structure_options');
	
	(($options_structure['wide'] == 1) ? 
		printf("\t<div id=\"footer-area\" class=\"full\">\n\t<div class=\"main\">\n") . 
		footer_element() . 
		printf("\t</div>\n</div>\n") : 
		footer_element() . 
		printf("</div>\n"));
}