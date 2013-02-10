<?php
/** searchform.php
 *
 ***** THIS IS A CORE VOLATYL FILE AND SHOULD NOT BE EDITED!
 ***** ALL CUSTOM CODING SHOULD BE DONE IN A CHILD THEME.
 ***** MORE INFORMATION - http://volatylthemes.com/why-child-themes/
 *******************************************************************
 *
 * The template for displaying search forms in Volatyl
 *
 * @package Volatyl
 * @since Volatyl 1.0
 */	
$search_text = apply_filters( 'search_text', array(
	'search_field_text'		=> 'Enter Keyword(s)&hellip;',
	'search_submit_text'	=> 'Search'
	) 
);

echo "<form method=\"get\" id=\"searchform\" action=\"", esc_url( home_url( '/' ) ), "\" role=\"search\">\n
\t<label for=\"s\" class=\"assistive-text\">", 
__( 'Search', 'volatyl' ), "</label>\n
\t<input type=\"text\" class=\"field\" name=\"s\" value=\"", esc_attr( get_search_query() ), "\" id=\"s\" placeholder=\"", esc_attr_e( $search_text[ 'search_field_text' ], 'volatyl' ), "\" />\n
\t<input type=\"submit\" class=\"submit\" name=\"submit\" id=\"searchsubmit\" value=\"", esc_attr_e( $search_text[ 'search_submit_text' ], 'volatyl' ), "\" />\n
</form>";