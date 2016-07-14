/**
 * Shows/hides post format metaboxes based on the selected format.
 */
( function( $ ) {

	'use strict';

	$( '.post-format' ).on( 'change', function(){
		if ( $(this).prop('checked') ) {
			$( '#post_format_' + this.value ).show();
			$( '.post-format-metabox' ).not( '#post_format_' + this.value ).hide();
		}
	}).change();

})( jQuery );
