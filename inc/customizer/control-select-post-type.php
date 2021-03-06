<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * recent posts select menu customizer control class.
 *
 * @author 		Paul Underwood
 * @since 		1.0.0
 * @access 		public
 */
class Select_Post_Type_Custom_Control extends WP_Customize_Control {

     private $postTypes = false;

     public function __construct( $manager, $id, $args = array(), $options = array() ) {

         $postargs = wp_parse_args($options, array('public' => true));
         $this->postTypes = get_post_types($postargs, 'object');

         parent::__construct( $manager, $id, $args );

     } // __construct()

     /**
     * Render the content on the theme customizer page
     */
     public function render_content() {

         if( empty( $this->postTypes ) ) { return false; }

		 ?><label>
			 <span class="customize-post-type-dropdown"><?php echo esc_html( $this->label ); ?></span>
			 <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"><?php

			 foreach ( $this->postTypes as $k => $post_type ) {

				 printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $post_type->labels->name);

			 }

			 ?></select>
		 </label><?php

     } // render_content()

 } // class
