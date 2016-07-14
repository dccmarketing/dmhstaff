<?php

/**
 * Provides the markup for an upload field
 *
 * @package    DMHStaff
 */

$remove_class = ( empty( $atts['value'] ) ? 'hide' : '' );
$upload_class = ( empty( $atts['value'] ) ? '' : 'hide' );

?><div class="file-upload-field"><?php

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

}

	?><input
		class="<?php echo esc_attr( $atts['class'] ); ?>"
		data-id="url-file"
		id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="<?php echo esc_attr( $atts['type'] ); ?>"
		value="<?php echo esc_attr( $atts['value'] ); ?>" />
	<a href="#" class="<?php echo esc_attr( $upload_class ); ?>" id="upload-file"><?php echo wp_kses( $atts['label-upload'], array( 'code' => array() ) ); ?></a>
	<a href="#" class="<?php echo esc_attr( $remove_class ); ?>" id="remove-file"><?php echo wp_kses( $atts['label-remove'], array( 'code' => array() ) ); ?></a>
</div><!-- .file-upload-field -->
