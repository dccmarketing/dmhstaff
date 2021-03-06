<?php
/**
 * DMH Staff functions and definitions
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package DMHStaff
 */

/**
 * Custom template tags for this theme.
 */
require get_stylesheet_directory() . '/inc/template-tags.php';

/**
 * Load The image function library
 */
require get_stylesheet_directory() . '/inc/imagekit.php';

/**
 * Load Slushman Themekit
 */
require get_stylesheet_directory() . '/inc/themekit.php';

/**
 * Load Main Menu Walker
 */
require get_stylesheet_directory() . '/inc/main-menu-walker.php';

/**
 * Load Main Menu Walker
 */
require get_stylesheet_directory() . '/inc/class-controller.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new DMHStaff_Controller(), 'run' ) );
