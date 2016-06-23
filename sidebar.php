<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package DMHStaff
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) { return; }

/**
 * The dmhstaff_sidebars_before action hook
 */
do_action( 'dmhstaff_sidebars_before' );

?><aside id="secondary" class="widget-area" role="complementary"><?php

	/**
	 * The dmhstaff_sidebar_top action hook
	 */
	do_action( 'dmhstaff_sidebar_top' );

	dynamic_sidebar( 'sidebar-1' );

	/**
	 * The dmhstaff_sidebar_bottom action hook
	 */
	do_action( 'dmhstaff_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The dmhstaff_sidebars_after action hook
 */
do_action( 'dmhstaff_sidebars_after' );