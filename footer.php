<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DMHStaff
 */

			/**
			 * The dmhstaff_content_bottom action hook
			 */
			do_action( 'dmhstaff_content_bottom' );

		?></div><!-- #content --><?php

		/**
		 * The dmhstaff_content_after action hook
		 */
		do_action( 'dmhstaff_content_after' );

		/**
		 * The dmhstaff_footer_before action hook
		 */
		do_action( 'dmhstaff_footer_before' );

		?><footer id="colophon" role="contentinfo"><?php

			/**
			 * The dmhstaff_footer_top action hook
			 */
			do_action( 'dmhstaff_footer_top' );

			/**
			 * The dmhstaff_footer_content action hook
			 *
			 * @hooked 		footer_content
			 */
			do_action( 'dmhstaff_footer_content' );

			/**
			 * The dmhstaff_footer_bottom action hook
			 */
			do_action( 'dmhstaff_footer_bottom' );

		?></footer><!-- #colophon --><?php

	/**
	 * The dmhstaff_footer_after action hook
	 */
	do_action( 'dmhstaff_footer_after' );

	wp_footer();

	/**
	 * The dmhstaff_body_bottom action hook
	 */
	do_action( 'dmhstaff_body_bottom' );

	?></body>
</html>
