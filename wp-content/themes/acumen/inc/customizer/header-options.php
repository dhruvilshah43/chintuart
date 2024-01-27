<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Acumen
 */

class Acumen_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'acumen_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'acumen' ),
				'panel' => 'acumen_theme_options'
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_header_phone',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Phone', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_header_address',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Address', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_header_open_hours',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_header_button_text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'acumen_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_header_button_target',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'acumen' ),
				'section'           => 'acumen_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$acumen_theme_options = new Acumen_Header_Options();
