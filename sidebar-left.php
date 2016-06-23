<?php
/**
 * The sidebar for the Sidrbar Content page template
 *
 * @package DMHStaff
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The dmhstaff_sidebars_before action hook
 */
do_action( 'dmhstaff_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The dmhstaff_sidebar_top action hook
	 */
	do_action( 'dmhstaff_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The dmhstaff_sidebar_bottom action hook
	 */
	do_action( 'dmhstaff_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The dmhstaff_sidebars_after action hook
 */
do_action( 'dmhstaff_sidebars_after' );