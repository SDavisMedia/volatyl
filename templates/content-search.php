<?php
/** content-search.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * Search results use this template to output content. To override this
 * template in a child theme, copy this file into the root/templates folder
 * of your child theme and make ADJUSTMENTS there. Use this file as a starting
 * point so you don't lose any variables, constants, etc.
 *
 * This template covers the search title, query, and results loop.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */
global $post;
$search_title = apply_filters('search_title', 'Search Results for:'); ?>

<header class="page-header">
	<h1 class="page-title">
		<?php echo sprintf(__($search_title . ' %s', 'volatyl'), '<span>' . get_search_query() . '</span>'); ?>
	</h1>
</header>

<?php
// Da loop		
while (have_posts()) { 
	the_post();
	if (is_search() && ($post->post_type=='page')) 
		continue;
	get_template_part('templates/content', get_post_format());
}
pagination_type();