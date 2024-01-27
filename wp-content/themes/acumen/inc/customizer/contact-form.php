<?php
/**
 * Contact Form Options
 *
 * @package Acumen
 */

class Acumen_Contact_Form_Options {
	public function __construct() {
		// Register Contact Form Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'acumen_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'acumen_contact_form_visibility' => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_contact_form_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'acumen_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'acumen' ),
				'section'           => 'acumen_ss_contact_form',
				'choices'           => Acumen_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'acumen_contact_form_visibility', array(
			'selector' => '#contact-form-section',
		) );

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'acumen_contact_form_page',
				'label'             => esc_html__( 'Select Page', 'acumen' ),
				'section'           => 'acumen_ss_contact_form',
				'active_callback'   => array( $this, 'is_section_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'settings'          => 'acumen_contact_form_custom_subtitle',
				'label'             => esc_html__( 'Top Subtitle', 'acumen' ),
				'section'           => 'acumen_ss_contact_form',
				'active_callback'   => array( $this, 'is_section_visible' ),
			)
		);
	}

	/**
	 * Contact Form visibility active callback.
	 */
	public function is_section_visible( $control ) {
		return ( acumen_display_section( $control->manager->get_setting( 'acumen_contact_form_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$acumen_ss_contact_form = new Acumen_Contact_Form_Options();
