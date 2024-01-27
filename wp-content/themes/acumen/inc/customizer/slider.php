<?php
/**
 * Slider Options
 *
 * @package Acumen
 */

class Acumen_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Add default options.
		add_filter( 'acumen_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'acumen_slider_visibility'     => 'disabled',
			'acumen_slider_number'         => 2,
			'acumen_slider_autoplay_delay' => 5000,
			'acumen_slider_pause_on_hover' => 1,
			'acumen_slider_navigation'     => 1,
			'acumen_slider_pagination'     => 1,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'acumen_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'choices'           => Acumen_Customizer_Utilities::section_visibility(),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'acumen_slider_number',
				'label'             => esc_html__( 'Number', 'acumen' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = acumen_gtm( 'acumen_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Acumen_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Acumen_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'acumen_text_sanitization',
					'settings'          => 'acumen_slider_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'acumen' )  . $j,
					'section'           => 'acumen_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
				)
			);

			Acumen_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Acumen_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'acumen_slider_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'acumen' ),
					'section'           => 'acumen_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
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
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_slider_autoplay',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Autoplay', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_slider_autoplay_delay',
				'type'              => 'number',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Autoplay Delay', 'acumen' ),
				'description'       => esc_html__( '(in ms)', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'input_attrs'           => array(
					'width' => '10px',
				),
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_slider_pause_on_hover',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Pause On Hover', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_slider_navigation',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Navigation', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_slider_pagination',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Pagination', 'acumen' ),
				'section'           => 'acumen_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( acumen_display_section( $control->manager->get_setting( 'acumen_slider_visibility' )->value() ) );
	}

	/**
	 * Slider autoplay check.
	 */
	public function is_slider_autoplay_on( $control ) {
		return ( $this->is_slider_visible( $control ) && $control->manager->get_setting( 'acumen_slider_autoplay' )->value() );
	}
}

/**
 * Initialize class
 */
$slider_ss_slider = new Acumen_Slider_Options();
