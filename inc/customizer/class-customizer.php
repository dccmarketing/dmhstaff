<?php
/**
 * DMH Staff Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 		https://codex.wordpress.org/Theme_Customization_API
 * @since 		1.0.0
 * @package  	DMHStaff
 */
class DMHStaff_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for DMH Staff', 'dmhstaff' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'dmhstaff' ),
			)
		);

		/*
		// Theme Options Panel
		$wp_customize->add_panel( 'theme_options',
			array(
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( 'Options for DMH Staff', 'dmhstaff' ),
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Theme Options', 'dmhstaff' ),
			)
		);
		*/

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav 					100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		/*
		// New Section
		$wp_customize->add_section( 'new_section',
			array(
				'capability' 	=> 'edit_theme_options',
				'description' 	=> esc_html__( 'New Customizer Section', 'dmhstaff' ),
				'panel' 		=> 'theme_options',
				'priority' 		=> 10,
				'title' 		=> esc_html__( 'New Section', 'dmhstaff' )
			)
		);
		*/

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 *
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager Field
		$wp_customize->add_setting(
			'tag_manager',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			'tag_manager',
			array(
				'description' 		=> esc_html__( 'Paste in the Google Tag Manager code here. Do not include the comment tags!', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Google Tag Manager', 'dmhstaff' ),
				'priority' 			=> 90,
				'section' 			=> 'title_tagline',
				'settings' 			=> 'tag_manager',
				'type' 				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'tag_manager' )->transport = 'postMessage';




		/*
		// Fields & Controls



		// Text Field
		$wp_customize->add_setting( 'text_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'text_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label'  			=> esc_html__( 'Text Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section'  			=> 'new_section',
				'settings' 			=> 'text_field',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'text_field' )->transport = 'postMessage';



		// URL Field
		$wp_customize->add_setting( 'url_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'esc_url_raw',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'url_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'URL Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'url_field',
				'type' 				=> 'url'
			)
		);
		$wp_customize->get_setting( 'url_field' )->transport = 'postMessage';



		// Email Field
		$wp_customize->add_setting( 'email_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_email',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'email_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Email Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'email_field',
				'type' 				=> 'email'
			)
		);
		$wp_customize->get_setting( 'email_field' )->transport = 'postMessage';

		// Date Field
		$wp_customize->add_setting( 'date_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'date_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Date Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'date_field',
				'type' 				=> 'date'
			)
		);
		$wp_customize->get_setting( 'date_field' )->transport = 'postMessage';


		// Checkbox Field
		$wp_customize->add_setting( 'checkbox_field',
			array(
				'default'  			=> 'true',
				'sanitize_callback' => 'absint',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'checkbox_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Checkbox Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'checkbox_field',
				'type' 				=> 'checkbox'
			)
		);
		$wp_customize->get_setting( 'checkbox_field' )->transport = 'postMessage';




		// Password Field
		$wp_customize->add_setting( 'password_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'password_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Password Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'password_field',
				'type' 				=> 'password'
			)
		);
		$wp_customize->get_setting( 'password_field' )->transport = 'postMessage';



		// Radio Field
		$wp_customize->add_setting( 'radio_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'radio_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'dmhstaff' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'dmhstaff' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'dmhstaff' )
				),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Radio Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'radio_field',
				'type' 				=> 'radio'
			)
		);
		$wp_customize->get_setting( 'radio_field' )->transport = 'postMessage';



		// Select Field
		$wp_customize->add_setting( 'select_field',
			array(
				'default'  			=> 'choice1',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'select_field',
			array(
				'choices' 			=> array(
					'choice1' 		=> esc_html__( 'Choice 1', 'dmhstaff' ),
					'choice2' 		=> esc_html__( 'Choice 2', 'dmhstaff' ),
					'choice3' 		=> esc_html__( 'Choice 3', 'dmhstaff' )
				),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Select Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_field',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'select_field' )->transport = 'postMessage';



		// Textarea Field
		$wp_customize->add_setting( 'textarea_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'textarea_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Textarea Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'textarea_field',
				'type'				=> 'textarea'
			)
		);
		$wp_customize->get_setting( 'textarea_field' )->transport = 'postMessage';



		// Range Field
		$wp_customize->add_setting( 'range_field',
			array(
				'default'  			=> '',
				'sanitize_callback' => ''
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'range_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'input_attrs' 		=> array(
					'class' 		=> 'range-field',
					'max' 			=> 100,
					'min' 			=> 0,
					'step' 			=> 1,
					'style' 		=> 'color: #020202'
				),
				'label' 			=> esc_html__( 'Range Field', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'range_field',
				'type' 				=> 'range'
			)
		);
		$wp_customize->get_setting( 'range_field' )->transport = 'postMessage';



		// Page Select Field
		$wp_customize->add_setting( 'select_page_field',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'select_page_field',
			array(
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Select Page', 'dmhstaff' ),
				'priority' 			=> 10,
				'section' 			=> 'new_section',
				'settings' 			=> 'select_page_field',
				'type' 				=> 'dropdown-pages'
			)
		);
		$wp_customize->get_setting( 'dropdown-pages' )->transport = 'postMessage';



		// Color Chooser Field
		$wp_customize->add_setting( 'color_field',
			array(
				'default'  			=> '#ffffff',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'color_field',
				array(
					'description' 	=> esc_html__( '', 'dmhstaff' ),
					'label' 		=> esc_html__( 'Color Field', 'dmhstaff' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'color_field'
				),
			)
		);
		$wp_customize->get_setting( 'color_field' )->transport = 'postMessage';



		// File Upload Field
		$wp_customize->add_setting( 'file_upload' );
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'file_upload',
				array(
					'description' 	=> esc_html__( '', 'dmhstaff' ),
					'label' 		=> esc_html__( 'File Upload', 'dmhstaff' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'file_upload'
				),
			)
		);



		// Image Upload Field
		$wp_customize->add_setting( 'image_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'image_upload',
				array(
					'description' 	=> esc_html__( '', 'dmhstaff' ),
					'label' 		=> esc_html__( 'Image Field', 'dmhstaff' ),
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'image_upload'
				)
			)
		);
		$wp_customize->get_setting( 'image_upload' )->transport = 'postMessage';



		// Media Upload Field
		// Can be used for images
		// Returns the image ID, not a URL
		$wp_customize->add_setting( 'media_upload',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'media_upload',
				array(
					'description' 	=> esc_html__( '', 'dmhstaff' ),
					'label' 		=> esc_html__( 'Media Field', 'dmhstaff' ),
					'mime_type' 	=> '',
					'priority' 		=> 10,
					'section'		=> 'new_section',
					'settings' 		=> 'media_upload'
				)
			)
		);
		$wp_customize->get_setting( 'media_upload' )->transport = 'postMessage';




		// Cropped Image Field
		$wp_customize->add_setting( 'cropped_image',
			array(
				'default' 			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Cropped_Image_Control(
				$wp_customize,
				'cropped_image',
				array(
					'description' 	=> esc_html__( '', 'dmhstaff' ),
					'flex_height' 	=> '',
					'flex_width' 	=> '',
					'height' 		=> '1080',
					'priority' 		=> 10,
					'section' 		=> 'new_section',
					'settings' 		=> 'cropped_image',
					width' 			=> '1920'
				)
			)
		);
		$wp_customize->get_setting( 'cropped_image' )->transport = 'postMessage';


		// Country Select Field
		$wp_customize->add_setting( 'country',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'country',
			array(
				'choices' 			=> $this->country_list(),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'Country', 'dmhstaff' ),
				'priority' 			=> 250,
				'section' 			=> 'contact_info',
				'settings' 			=> 'country',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'country' )->transport = 'postMessage';


		// US States Select Field
		$wp_customize->add_setting( 'us_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'us_state',
			array(
				'choices' 			=> $this->states_list_unitedstates(),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'State', 'dmhstaff' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'us_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'us_state' )->transport = 'postMessage';


		// Canadian States Select Field
		$wp_customize->add_setting( 'canada_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'canada_state',
			array(
				'choices' 			=> $this->states_list_canada(),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'State', 'dmhstaff' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'canada_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'canada_state' )->transport = 'postMessage';


		// Australian States Select Field
		$wp_customize->add_setting( 'australia_state',
			array(
				'default'  			=> '',
				'transport' 		=> 'postMessage'
			)
		);
		$wp_customize->add_control( 'australia_state',
			array(
				'choices' 			=> $this->states_list_australia(),
				'description' 		=> esc_html__( '', 'dmhstaff' ),
				'label' 			=> esc_html__( 'State', 'dmhstaff' ),
				'priority' 			=> 230,
				'section' 			=> 'contact_info',
				'settings' 			=> 'australia_state',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'australia_state' )->transport = 'postMessage';


		*/

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 *
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 *
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( ! empty( $mod ) ) {

			$return = sprintf('%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);

			if ( $echo ) {

				echo $return;

			}

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// $this->generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// $this->generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );


		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 *
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 *
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'dmhstaff' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'dmhstaff' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'dmhstaff' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'dmhstaff' );
		$countries['AS'] = esc_html__( 'American Samoa', 'dmhstaff' );
		$countries['AD'] = esc_html__( 'Andorra', 'dmhstaff' );
		$countries['AO'] = esc_html__( 'Angola', 'dmhstaff' );
		$countries['AI'] = esc_html__( 'Anguilla', 'dmhstaff' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'dmhstaff' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'dmhstaff' );
		$countries['AR'] = esc_html__( 'Argentina', 'dmhstaff' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'dmhstaff' );
		$countries['AW'] = esc_html__( 'Aruba', 'dmhstaff' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'dmhstaff' );
		$countries['AU'] = esc_html__( 'Australia', 'dmhstaff' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'dmhstaff' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'dmhstaff' );
		$countries['BS'] = esc_html__( 'Bahamas', 'dmhstaff' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'dmhstaff' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'dmhstaff' );
		$countries['BB'] = esc_html__( 'Barbados', 'dmhstaff' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'dmhstaff' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'dmhstaff' );
		$countries['BZ'] = esc_html__( 'Belize', 'dmhstaff' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'dmhstaff' );
		$countries['BM'] = esc_html__( 'Bermuda', 'dmhstaff' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'dmhstaff' );
		$countries['BO'] = esc_html__( 'Bolivia', 'dmhstaff' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'dmhstaff' );
		$countries['BW'] = esc_html__( 'Botswana', 'dmhstaff' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'dmhstaff' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'dmhstaff' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'dmhstaff' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'dmhstaff' );
		$countries['BN'] = esc_html__( 'Brunei', 'dmhstaff' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'dmhstaff' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'dmhstaff' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'dmhstaff' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'dmhstaff' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'dmhstaff' );
		$countries['CA'] = esc_html__( 'Canada', 'dmhstaff' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'dmhstaff' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'dmhstaff' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'dmhstaff' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'dmhstaff' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'dmhstaff' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'dmhstaff' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'dmhstaff' );
		$countries['CL'] = esc_html__( 'Chile', 'dmhstaff' );
		$countries['CN'] = esc_html__( 'China (中国)', 'dmhstaff' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'dmhstaff' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'dmhstaff' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'dmhstaff' );
		$countries['CO'] = esc_html__( 'Colombia', 'dmhstaff' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'dmhstaff' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'dmhstaff' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'dmhstaff' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'dmhstaff' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'dmhstaff' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'dmhstaff' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'dmhstaff' );
		$countries['CU'] = esc_html__( 'Cuba', 'dmhstaff' );
		$countries['CW'] = esc_html__( 'Curaçao', 'dmhstaff' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'dmhstaff' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'dmhstaff' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'dmhstaff' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'dmhstaff' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'dmhstaff' );
		$countries['DM'] = esc_html__( 'Dominica', 'dmhstaff' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'dmhstaff' );
		$countries['EC'] = esc_html__( 'Ecuador', 'dmhstaff' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'dmhstaff' );
		$countries['SV'] = esc_html__( 'El Salvador', 'dmhstaff' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'dmhstaff' );
		$countries['ER'] = esc_html__( 'Eritrea', 'dmhstaff' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'dmhstaff' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'dmhstaff' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'dmhstaff' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'dmhstaff' );
		$countries['FJ'] = esc_html__( 'Fiji', 'dmhstaff' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'dmhstaff' );
		$countries['FR'] = esc_html__( 'France', 'dmhstaff' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'dmhstaff' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'dmhstaff' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'dmhstaff' );
		$countries['GA'] = esc_html__( 'Gabon', 'dmhstaff' );
		$countries['GM'] = esc_html__( 'Gambia', 'dmhstaff' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'dmhstaff' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'dmhstaff' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'dmhstaff' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'dmhstaff' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'dmhstaff' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'dmhstaff' );
		$countries['GD'] = esc_html__( 'Grenada', 'dmhstaff' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'dmhstaff' );
		$countries['GU'] = esc_html__( 'Guam', 'dmhstaff' );
		$countries['GT'] = esc_html__( 'Guatemala', 'dmhstaff' );
		$countries['GG'] = esc_html__( 'Guernsey', 'dmhstaff' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'dmhstaff' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'dmhstaff' );
		$countries['GY'] = esc_html__( 'Guyana', 'dmhstaff' );
		$countries['HT'] = esc_html__( 'Haiti', 'dmhstaff' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'dmhstaff' );
		$countries['HN'] = esc_html__( 'Honduras', 'dmhstaff' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'dmhstaff' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'dmhstaff' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'dmhstaff' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'dmhstaff' );
		$countries['ID'] = esc_html__( 'Indonesia', 'dmhstaff' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'dmhstaff' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'dmhstaff' );
		$countries['IE'] = esc_html__( 'Ireland', 'dmhstaff' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'dmhstaff' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'dmhstaff' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'dmhstaff' );
		$countries['JM'] = esc_html__( 'Jamaica', 'dmhstaff' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'dmhstaff' );
		$countries['JE'] = esc_html__( 'Jersey', 'dmhstaff' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'dmhstaff' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'dmhstaff' );
		$countries['KE'] = esc_html__( 'Kenya', 'dmhstaff' );
		$countries['KI'] = esc_html__( 'Kiribati', 'dmhstaff' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'dmhstaff' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'dmhstaff' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'dmhstaff' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'dmhstaff' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'dmhstaff' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'dmhstaff' );
		$countries['LS'] = esc_html__( 'Lesotho', 'dmhstaff' );
		$countries['LR'] = esc_html__( 'Liberia', 'dmhstaff' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'dmhstaff' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'dmhstaff' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'dmhstaff' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'dmhstaff' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'dmhstaff' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'dmhstaff' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'dmhstaff' );
		$countries['MW'] = esc_html__( 'Malawi', 'dmhstaff' );
		$countries['MY'] = esc_html__( 'Malaysia', 'dmhstaff' );
		$countries['MV'] = esc_html__( 'Maldives', 'dmhstaff' );
		$countries['ML'] = esc_html__( 'Mali', 'dmhstaff' );
		$countries['MT'] = esc_html__( 'Malta', 'dmhstaff' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'dmhstaff' );
		$countries['MQ'] = esc_html__( 'Martinique', 'dmhstaff' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'dmhstaff' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'dmhstaff' );
		$countries['YT'] = esc_html__( 'Mayotte', 'dmhstaff' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'dmhstaff' );
		$countries['FM'] = esc_html__( 'Micronesia', 'dmhstaff' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'dmhstaff' );
		$countries['MC'] = esc_html__( 'Monaco', 'dmhstaff' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'dmhstaff' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'dmhstaff' );
		$countries['MS'] = esc_html__( 'Montserrat', 'dmhstaff' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'dmhstaff' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'dmhstaff' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'dmhstaff' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'dmhstaff' );
		$countries['NR'] = esc_html__( 'Nauru', 'dmhstaff' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'dmhstaff' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'dmhstaff' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'dmhstaff' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'dmhstaff' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'dmhstaff' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'dmhstaff' );
		$countries['NG'] = esc_html__( 'Nigeria', 'dmhstaff' );
		$countries['NU'] = esc_html__( 'Niue', 'dmhstaff' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'dmhstaff' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'dmhstaff' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'dmhstaff' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'dmhstaff' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'dmhstaff' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'dmhstaff' );
		$countries['PW'] = esc_html__( 'Palau', 'dmhstaff' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'dmhstaff' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'dmhstaff' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'dmhstaff' );
		$countries['PY'] = esc_html__( 'Paraguay', 'dmhstaff' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'dmhstaff' );
		$countries['PH'] = esc_html__( 'Philippines', 'dmhstaff' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'dmhstaff' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'dmhstaff' );
		$countries['PT'] = esc_html__( 'Portugal', 'dmhstaff' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'dmhstaff' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'dmhstaff' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'dmhstaff' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'dmhstaff' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'dmhstaff' );
		$countries['RW'] = esc_html__( 'Rwanda', 'dmhstaff' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'dmhstaff' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'dmhstaff' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'dmhstaff' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'dmhstaff' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'dmhstaff' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'dmhstaff' );
		$countries['WS'] = esc_html__( 'Samoa', 'dmhstaff' );
		$countries['SM'] = esc_html__( 'San Marino', 'dmhstaff' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'dmhstaff' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'dmhstaff' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'dmhstaff' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'dmhstaff' );
		$countries['SC'] = esc_html__( 'Seychelles', 'dmhstaff' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'dmhstaff' );
		$countries['SG'] = esc_html__( 'Singapore', 'dmhstaff' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'dmhstaff' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'dmhstaff' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'dmhstaff' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'dmhstaff' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'dmhstaff' );
		$countries['ZA'] = esc_html__( 'South Africa', 'dmhstaff' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'dmhstaff' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'dmhstaff' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'dmhstaff' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'dmhstaff' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'dmhstaff' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'dmhstaff' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'dmhstaff' );
		$countries['SR'] = esc_html__( 'Suriname', 'dmhstaff' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'dmhstaff' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'dmhstaff' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'dmhstaff' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'dmhstaff' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'dmhstaff' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'dmhstaff' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'dmhstaff' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'dmhstaff' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'dmhstaff' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'dmhstaff' );
		$countries['TG'] = esc_html__( 'Togo', 'dmhstaff' );
		$countries['TK'] = esc_html__( 'Tokelau', 'dmhstaff' );
		$countries['TO'] = esc_html__( 'Tonga', 'dmhstaff' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'dmhstaff' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'dmhstaff' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'dmhstaff' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'dmhstaff' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'dmhstaff' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'dmhstaff' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'dmhstaff' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'dmhstaff' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'dmhstaff' );
		$countries['UG'] = esc_html__( 'Uganda', 'dmhstaff' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'dmhstaff' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'dmhstaff' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'dmhstaff' );
		$countries['US'] = esc_html__( 'United States', 'dmhstaff' );
		$countries['UY'] = esc_html__( 'Uruguay', 'dmhstaff' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'dmhstaff' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'dmhstaff' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'dmhstaff' );
		$countries['VE'] = esc_html__( 'Venezuela', 'dmhstaff' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'dmhstaff' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'dmhstaff' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'dmhstaff' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'dmhstaff' );
		$countries['ZM'] = esc_html__( 'Zambia', 'dmhstaff' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'dmhstaff' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

	/**
	 * Loads files for Custom Controls.
	 */
	public function load_customize_controls() {

		$files[] = 'control-editor.php';
		$files[] = 'control-layout-picker.php';
		$files[] = 'control-multiple-checkboxes.php';
		$files[] = 'control-select-category.php';
		$files[] = 'control-select-menu.php';
		$files[] = 'control-select-post.php';
		$files[] = 'control-select-post-type.php';
		//$files[] = 'control-select-recent-post.php';
		$files[] = 'control-select-tag.php';
		$files[] = 'control-select-taxonomy.php';
		$files[] = 'control-select-user.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_template_directory() ) . 'inc/customizer/' . $file );

		}

	} // load_customize_controls()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'dmhstaff' );
		$states['NSW'] = esc_html__( 'New South Wales', 'dmhstaff' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'dmhstaff' );
		$states['QLD'] = esc_html__( 'Queensland', 'dmhstaff' );
		$states['SA' ] = esc_html__( 'South Australia', 'dmhstaff' );
		$states['TAS'] = esc_html__( 'Tasmania', 'dmhstaff' );
		$states['VIC'] = esc_html__( 'Victoria', 'dmhstaff' );
		$states['WA' ] = esc_html__( 'Western Australia', 'dmhstaff' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_australia()



	/**
	 * Returns an array of the Canadian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_canada( $state = '' ) {

		$states = array();

		$states['AB'] = esc_html__( 'Alberta', 'dmhstaff' );
		$states['BC'] = esc_html__( 'British Columbia', 'dmhstaff' );
		$states['MB'] = esc_html__( 'Manitoba', 'dmhstaff' );
		$states['NB'] = esc_html__( 'New Brunswick', 'dmhstaff' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'dmhstaff' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'dmhstaff' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'dmhstaff' );
		$states['NU'] = esc_html__( 'Nunavut', 'dmhstaff' );
		$states['ON'] = esc_html__( 'Ontario', 'dmhstaff' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'dmhstaff' );
		$states['QC'] = esc_html__( 'Quebec', 'dmhstaff' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'dmhstaff' );
		$states['YT'] = esc_html__( 'Yukon', 'dmhstaff' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_canada()

	/**
	 * Returns an array of the US states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_unitedstates( $state = '' ) {

		$states = array();

		$states['AL'] = esc_html__( 'Alabama', 'dmhstaff' );
		$states['AK'] = esc_html__( 'Alaska', 'dmhstaff' );
		$states['AZ'] = esc_html__( 'Arizona', 'dmhstaff' );
		$states['AR'] = esc_html__( 'Arkansas', 'dmhstaff' );
		$states['CA'] = esc_html__( 'California', 'dmhstaff' );
		$states['CO'] = esc_html__( 'Colorado', 'dmhstaff' );
		$states['CT'] = esc_html__( 'Connecticut', 'dmhstaff' );
		$states['DE'] = esc_html__( 'Delaware', 'dmhstaff' );
		$states['DC'] = esc_html__( 'District of Columbia', 'dmhstaff' );
		$states['FL'] = esc_html__( 'Florida', 'dmhstaff' );
		$states['GA'] = esc_html__( 'Georgia', 'dmhstaff' );
		$states['HI'] = esc_html__( 'Hawaii', 'dmhstaff' );
		$states['ID'] = esc_html__( 'Idaho', 'dmhstaff' );
		$states['IL'] = esc_html__( 'Illinois', 'dmhstaff' );
		$states['IN'] = esc_html__( 'Indiana', 'dmhstaff' );
		$states['IA'] = esc_html__( 'Iowa', 'dmhstaff' );
		$states['KS'] = esc_html__( 'Kansas', 'dmhstaff' );
		$states['KY'] = esc_html__( 'Kentucky', 'dmhstaff' );
		$states['LA'] = esc_html__( 'Louisiana', 'dmhstaff' );
		$states['ME'] = esc_html__( 'Maine', 'dmhstaff' );
		$states['MD'] = esc_html__( 'Maryland', 'dmhstaff' );
		$states['MA'] = esc_html__( 'Massachusetts', 'dmhstaff' );
		$states['MI'] = esc_html__( 'Michigan', 'dmhstaff' );
		$states['MN'] = esc_html__( 'Minnesota', 'dmhstaff' );
		$states['MS'] = esc_html__( 'Mississippi', 'dmhstaff' );
		$states['MO'] = esc_html__( 'Missouri', 'dmhstaff' );
		$states['MT'] = esc_html__( 'Montana', 'dmhstaff' );
		$states['NE'] = esc_html__( 'Nebraska', 'dmhstaff' );
		$states['NV'] = esc_html__( 'Nevada', 'dmhstaff' );
		$states['NH'] = esc_html__( 'New Hampshire', 'dmhstaff' );
		$states['NJ'] = esc_html__( 'New Jersey', 'dmhstaff' );
		$states['NM'] = esc_html__( 'New Mexico', 'dmhstaff' );
		$states['NY'] = esc_html__( 'New York', 'dmhstaff' );
		$states['NC'] = esc_html__( 'North Carolina', 'dmhstaff' );
		$states['ND'] = esc_html__( 'North Dakota', 'dmhstaff' );
		$states['OH'] = esc_html__( 'Ohio', 'dmhstaff' );
		$states['OK'] = esc_html__( 'Oklahoma', 'dmhstaff' );
		$states['OR'] = esc_html__( 'Oregon', 'dmhstaff' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'dmhstaff' );
		$states['RI'] = esc_html__( 'Rhode Island', 'dmhstaff' );
		$states['SC'] = esc_html__( 'South Carolina', 'dmhstaff' );
		$states['SD'] = esc_html__( 'South Dakota', 'dmhstaff' );
		$states['TN'] = esc_html__( 'Tennessee', 'dmhstaff' );
		$states['TX'] = esc_html__( 'Texas', 'dmhstaff' );
		$states['UT'] = esc_html__( 'Utah', 'dmhstaff' );
		$states['VT'] = esc_html__( 'Vermont', 'dmhstaff' );
		$states['VA'] = esc_html__( 'Virginia', 'dmhstaff' );
		$states['WA'] = esc_html__( 'Washington', 'dmhstaff' );
		$states['WV'] = esc_html__( 'West Virginia', 'dmhstaff' );
		$states['WI'] = esc_html__( 'Wisconsin', 'dmhstaff' );
		$states['WY'] = esc_html__( 'Wyoming', 'dmhstaff' );
		$states['AS'] = esc_html__( 'American Samoa', 'dmhstaff' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'dmhstaff' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'dmhstaff' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'dmhstaff' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'dmhstaff' );
		$states['GU'] = esc_html__( 'Guam', 'dmhstaff' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'dmhstaff' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'dmhstaff' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'dmhstaff' );
		$states['PW'] = esc_html__( 'Palau', 'dmhstaff' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'dmhstaff' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

} // class
