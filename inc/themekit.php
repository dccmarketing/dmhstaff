<?php

/**
 * Returns an attachment by the filename
 *
 * @param 		string 			$post_name 				The post name
 *
 * @return 		object 									The attachment post object
 */
function dmhstaff_get_attachment_by_name( $post_name ) {

	if ( empty( $post_name ) ) { return 'Post name is empty'; }

	$args['name'] 			= trim ( $post_name );
	$args['post_per_page'] 	= 1;
	$args['post_status'] 	= 'any';

	$posts = $this->get_posts( 'attachment', $args, $post_name . '_attachments' );

	if ( $posts->posts[0] ) {

		return $posts->posts[0];

	}

	return FALSE;

} // dmhstaff_get_attachment_by_name()

/**
 * Returns a post object of the requested post type
 *
 * @param 	string 		$post 			The name of the post type
 * @param   array 		$params 		Optional parameters
 *
 * @return 	object 		A post object
 */
function dmhstaff_get_posts( $post, $params = array(), $cache = '' ) {

	if ( empty( $post ) ) { return -1; }

	$return = '';
	$cache_name = 'posts';

	if ( ! empty( $cache ) ) {

		$cache_name = '' . $cache . '_posts';

	}

	$return = wp_cache_get( $cache_name, 'posts' );

	if ( false === $return ) {

		$args['post_type'] 				= $post;
		$args['post_status'] 			= 'publish';
		$args['order_by'] 				= 'date';
		$args['posts_per_page'] 		= 50;
		$args['no_found_rows']			= true;
		$args['update_post_meta_cache'] = false;
		$args['update_post_term_cache'] = false;

		$args 	= wp_parse_args( $params, $args );
		$query 	= new WP_Query( $args );

		if ( ! is_wp_error( $query ) && $query->have_posts() ) {

			wp_cache_set( $cache_name, $query, 'posts', 5 * MINUTE_IN_SECONDS );

			$return = $query;

		}

	}

	return $return;

} // dmhstaff_get_posts()

/**
 * Returns the URL for the posts page
 *
 * @return 		string 						The URL for the posts page
 */
function dmhstaff_get_posts_page() {

	if( get_option( 'show_on_front' ) == 'page' ) {

		return get_permalink( get_option( 'page_for_posts' ) );

	} else  {

		return bloginfo( 'url' );

	}

} // dmhstaff_get_posts_page()

/**
 * Returns a Google Map link from an address
 *
 * @param 	string 		$address 		An address
 *
 * @return 	string 						URL for Google Maps
 */
function dmhstaff_make_map_link( $address ) {

	if( empty( $address ) ) { return FALSE; }

	$return = '';

	$query_args['q'] 	= urlencode( $address );
	$return 			= add_query_arg( $query_args, 'http://www.google.com/maps/' );

	return $return;

} // dmhstaff_make_map_link()

/**
 * Converts a phone number into a tel link
 *
 * @param 	string 		$number 			A phone number
 *
 * @return 	mixed 							Formatted HTML telephone link
 */
function dmhstaff_make_phone_link( $number ) {

	if ( empty( $number ) ) { return FALSE; }

	$return = '';

	$formatted 	= preg_replace( '/[^0-9]/', '', $number );

	$return .= '<span itemprop="telephone">';
	$return .= '<a href="tel:' . $formatted . '">';
	$return .= '<span class="screen-reader-text">';
	$return .= esc_html__( 'Call ', 'dmhstaff' ) . '</span>';
	$return .= $number . '</a>';
	$return .= '</span>';

	return $return;

} // dmhstaff_make_phone_link()

/**
 * Reduce the length of a string by character count
 *
 * @param 	string 		$text 		The string to reduce
 * @param 	int 		$limit 		Max amount of characters to allow
 * @param 	string 		$after 		Text for after the limit
 *
 * @return 	string 					The possibly reduced string
 */
function dmhstaff_shorten_text( $text, $limit = 100, $after = '...' ) {

	if ( empty( $text ) ) { return; }

	$length = strlen( $text );
	$text 	= substr( $text, 0, $limit );

	if ( $length > $limit ) {

		$text = $text . $after;

	} // Ellipsis

	return $text;

} // dmhstaff_shorten_text()
