<?php
/**
 * Featured Grid Options
 *
 * @package Acumen
 */

class Acumen_Featured_Grid_Options {
	public function __construct() {
		// Register Featured Grid Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'acumen_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'acumen_featured_grid_visibility'  => 'disabled',
			'acumen_featured_grid_number'      => 3,
			'acumen_featured_grid_button_link' => '#',
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
				'settings'          => 'acumen_featured_grid_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'acumen_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'choices'           => Acumen_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'acumen_featured_grid_visibility', array(
			'selector' => '#featured-grid-section',
		) );

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'settings'          => 'acumen_featured_grid_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_featured_grid_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_featured_grid_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_featured_grid_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'acumen' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		$numbers = acumen_gtm( 'acumen_featured_grid_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Acumen_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Acumen_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'acumen_featured_grid_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'acumen' ),
					'section'           => 'acumen_ss_featured_grid',
					'active_callback'   => array( $this, 'is_featured_grid_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'settings'          => 'acumen_featured_grid_button_text',
				'label'             => esc_html__( 'Button Text', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'acumen_featured_grid_button_link',
				'label'             => esc_html__( 'Button Link', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_featured_grid_button_target',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'acumen' ),
				'section'           => 'acumen_ss_featured_grid',
				'active_callback'   => array( $this, 'is_featured_grid_visible' ),
			)
		);
	}

	/**
	 * Featured Grid visibility active callback.
	 */
	public function is_featured_grid_visible( $control ) {
		return ( acumen_display_section( $control->manager->get_setting( 'acumen_featured_grid_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$acumen_ss_featured_grid = new Acumen_Featured_Grid_Options();
