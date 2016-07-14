<?php

/**
 * Provides the markup for an upload field
 *
 * Saves the Image ID in the hidden input.
 *
 * @package    DMHStaff
 */

$remove_class 	= ( empty( $atts['value'] ) ? 'hide' : '' );
$upload_class 	= ( empty( $atts['value'] ) ? '' : 'hide' );
$preview_class 	= ( empty( $atts['value'] ) ? 'image-upload-preview bordered' : 'image-upload-preview' );
$thumbnail 		= ( empty( $atts['value'] ) ? '' : wp_get_attachment_image_src( $atts['value'] )[0] );

?><div class="image-upload-field"><?php

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

}

	?><div class="<?php echo esc_attr( $preview_class ); ?>" id="<?php echo esc_attr( $atts['id'] . '-img' ); ?>" style="background-image:url(<?php echo esc_url( $thumbnail ); ?>);"></div>
	<input
		id="<?php echo esc_attr( $atts['id'] ); ?>"
		name="<?php echo esc_attr( $atts['name'] ); ?>"
		type="hidden"
		value="<?php echo esc_attr( $atts['value'] ); ?>" />
	<a href="#" class="<?php echo esc_attr( $upload_class ); ?>" id="upload-file"><?php echo wp_kses( $atts['label-upload'], array( 'code' => array() ) ); ?></a>
	<a href="#" class="<?php echo esc_attr( $remove_class ); ?>" id="remove-file"><?php echo wp_kses( $atts['label-remove'], array( 'code' => array() ) ); ?></a>
</div><!-- .file-upload-field -->
