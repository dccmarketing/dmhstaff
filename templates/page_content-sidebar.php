<?php
/**
 * Template Name: Content Sidebar
 *
 * Description: Page template with sidebar on the right-side
 *
 * @package DMHStaff
 */

get_header();

	?><div id="primary" class="content-area content-sidebar">
		<main id="main" role="main"><?php

			/**
			 * The dmhstaff_while_before action hook
			 */
			do_action( 'dmhstaff_while_before' );

			while ( have_posts() ) : the_post();

				/**
				 * The dmhstaff_entry_before action hook
				 */
				do_action( 'dmhstaff_entry_before' );

				get_template_part( 'template-parts/content', 'page' );

				/**
				 * The dmhstaff_entry_after action hook
				 *
				 * @hooked 		comments 		10
				 */
				do_action( 'dmhstaff_entry_after' );

			endwhile; // loop

			/**
			 * The dmhstaff_while_after action hook
			 */
			do_action( 'dmhstaff_while_after' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_sidebar();
get_footer();