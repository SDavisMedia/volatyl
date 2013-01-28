<?php
/** byline.php
 *
 * So many byline (meta data) options! 
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */

/** Single Post Byline
 *
 * Each element in a post byline can be controlled in the Volatyl
 * Options. Each of them has a switch to display or hide them.
 *
 * @since Volatyl 1.0
 */
if ( ! function_exists( 'volatyl_post_meta' ) ) {
 
	function volatyl_post_meta() {
		global $count;
		$options_content = get_option( 'vol_content_options' );
		
		// Custom filters
		$publish_date = apply_filters( 'publish_date', 'on ' );
		$author_text = apply_filters( 'author_text', 'by ' );
		$comments_off = apply_filters( 'comments_off', 'Comments off ' );
		$category_text = apply_filters( 'category_text', 'Filed under: ' );

		// Show post date
		if ( $options_content[ 'by-date-post' ] == 1 ) {

			echo 	__( $publish_date, 'volatyl' ),
					"<a href=\"", the_permalink(), "\" title=\"",
					esc_attr( sprintf( __( 'Permalink', 'volatyl' ), the_title_attribute( 'echo=0' ) ) ), 
					"\" rel=\"bookmark\">";
			the_time( get_option( 'date_format' ) );
			echo "</a> \n";
		
		}
	
		// Show post author
		echo ( ( $options_content[ 'by-author-post' ] == 1 ) ? __( $author_text, 'volatyl' ) . '<a class="fn" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '">' . get_the_author() . '</a>' : '' );
	
		// Show post comment count
		if ( $options_content[ 'by-comments-post' ] == 1 ) {
	
			// Only show dash before comments if byline items are in front of it
			echo ( ( $options_content[ 'by-date-post' ] == 0 && $options_content[ 'by-author-post' ] == 0 ) ? "" : " - " );
				
			
			// Only mark comments as closed in byline of comment count is 0	
			$response_count = get_comments_number();
			$comment_count = comments_only_count( $count );
		
			if ( ! comments_open() && $response_count == 0 ) {
		
				// No need to show a count if comments are off and there are none!
				$comments = __( $comments_off, 'volatyl' );
				
			} else {
			
				/** Return "response" count with or without pings! ;)
				 *
				 * If pings are disabled, only "comments" will show
				 * See the functions/content.php file for more information
				 */
				if ( $options_content[ 'postpings' ] == 1 ) { 
		
					// Get the total number of comments and pings
					$num_comments = get_comments_number();
			
					if ( $num_comments == 0 )
						$comments = __( '0 Responses', 'volatyl' );
					elseif ( $num_comments > 1 )
						$comments = $num_comments . __( ' Responses', 'volatyl' );
					else
						$comments = __( '1 Response', 'volatyl' );
			
				} else {
		
					// Only get the comments... no pings
					$num_comments = comments_only_count( $count );
			
					if ( $num_comments == 0 )
						$comments = __( '0 Comments', 'volatyl' );
					elseif ( $num_comments > 1 )
						$comments = $num_comments . __( ' Comments', 'volatyl' );
					else
						$comments = __( '1 Comment', 'volatyl' );
			
				}
				
			} 
			echo $comments;
		}
	
		// Show post edit link
		if ( $options_content[ 'by-edit-post' ] == 1 )
			edit_post_link( __( 'Edit', '_s' ), '<span class="edit-link"> ', '</span> ' );
	
		// Show post categories
		if ( $options_content[ 'by-cats' ] == 1 ) {
	
			// Only place cats on new line if other byline items are removed
			if ( $options_content[ 'by-date-post' ] == 1 || $options_content[ 'by-author-post' ] == 1 || $options_content[ 'by-comments-post' ] == 1 )
				echo "<br>";
		
			_e( $category_text, 'volatyl' );
			the_category( ', ' );
		}
	}
}