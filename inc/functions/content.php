<?php 
/** content-func.php
 *
 * Various functions pertaining to site content and its options.
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

$options_content = get_option( 'vol_content_options' );

// Custom filters
$excerpt_link = apply_filters( 'excerpt_link', 'Read More &rarr;' );

// Add .top class to the first post in a loop
function vol_first_post_class( $classes ) {
	global $wp_query;
	
	if( 0 == $wp_query->current_post )
		$classes[] = 'top';
		return $classes;
}
add_filter( 'post_class', 'vol_first_post_class' );


/** Separate comments and pings
 *
 * Comments are a collection of comments and pings (pingbacks and
 * trackbacks). When the number of comments is displayed, the sum
 * total includes all three types of comments.
 * 
 * In the comments.php file, the regular comments have been
 * separated from the pings for organizational purposes and to
 * allow users to hide pings while still displaying comments. So,
 * when pings are hidden, the comment count needs to reflect that.
 *
 * In the byline.php file, the volatyl_post_meta() function displays
 * the "response" count totaling all comments and pings. If pings are
 * turned off, "response" is replaced with "comment" and only comments
 * are shown. Below is the count of comments only.
 *
 * @since Volatyl 1.0
 */
function comments_only_count( $count ) {

    // Filter the comments count in the front-end only
    if ( ! is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        
        return count( $comments_by_type['comment'] );
    }
    
    // When in the WP-admin back end, do NOT filter comments (and pings) count.
    else {
        return $count;
    }
}


// Show 'Pages' in search results? 
if ( $options_content[ 'searchpages' ] == 0 ) { 
	function vol_search_filter( $query ) {
		if ( $query->is_search )
			$query->set( 'post_type', 'post' );
		return $query;
	}
	add_filter( 'pre_get_posts','vol_search_filter' );
}


// Show excerpt/post link instead of [...]
if ( $options_content[ 'excerptlink' ] == 1 ) {

	//create a permalink after the excerpt
	function vol_replace_excerpt( $content ) {
		global $excerpt_link;
		return str_replace( '[...]',
			'<p><a class="read-more" href="' . get_permalink() . '">' . $excerpt_link . '</a></p>',
			$content
		);
	}
	add_filter( 'get_the_excerpt', 'vol_replace_excerpt' );
}