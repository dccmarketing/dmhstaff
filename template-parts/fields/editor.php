<?php

/**
 * Provides the markup for any WP Editor field
 *
 * @package    TCCi
 */

// wp_editor( $content, $editor_id, $settings = array() );

wp_editor( $atts['value'], $atts['id'], $atts['settings'] );

?><span class="description"><?php echo wp_kses( $atts['description'], array( 'code' => array() ) ); ?></span>
