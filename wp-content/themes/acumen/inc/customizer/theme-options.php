<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Acumen
 */

class Acumen_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );

		// Add default options.
		add_filter( 'acumen_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'acumen_header_image_visibility' => 'entire-site',

			// Breadcrumb
			'acumen_breadcrumb_show' => 1,

			// Layout Options.
			'acumen_default_layout'          => 'right-sidebar',
			'acumen_homepage_archive_layout' => 'no-sidebar-full-width',

			// Excerpt Options
			'acumen_excerpt_length'    => 30,
			'acumen_excerpt_more_text' => esc_html__( 'Continue reading', 'acumen' ),

			// Footer Options.
			'acumen_footer_editor_style'      => 'one-column',
			'acumen_footer_editor_text'       => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'acumen' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . ' &#124; ' . esc_html__( 'Acumen by', 'acumen' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',
			'acumen_footer_editor_text_left'  => sprintf( _x( 'Copyright &copy; %1$s %2$s. All Rights Reserved. %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'acumen' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ),
			'acumen_footer_editor_text_right' => esc_html__( 'Acumen by', 'acumen' ). '&nbsp;<a target="_blank" href="'. esc_url( 'https://fireflythemes.com' ) .'">Firefly Themes</a>',

			// Homepage/Frontpage Options.
			'acumen_front_page_category'   => '',
			'acumen_show_homepage_content' => 1,

			// Search Options.
			'acumen_search_text'         => esc_html__( 'Search...', 'acumen' ),
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'acumen_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'acumen' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'acumen_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'acumen' ),
				'panel' => 'acumen_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Acumen_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Acumen_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'acumen' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'acumen' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_breadcrumb_show',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'acumen' ),
				'section'           => 'acumen_breadcrumb_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_breadcrumb_show_home',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Show on homepage?', 'acumen' ),
				'section'           => 'acumen_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'acumen_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'acumen' ),
				'panel' => 'acumen_theme_options'
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'acumen_default_layout',
				'sanitize_callback' => 'acumen_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'acumen' ),
				'section'           => 'acumen_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'acumen' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'acumen' ),
				),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'acumen_homepage_archive_layout',
				'sanitize_callback' => 'acumen_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'acumen' ),
				'section'           => 'acumen_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'acumen' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'acumen' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'acumen_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'acumen' ),
				'panel' => 'acumen_theme_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'acumen_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'acumen' ),
				'section'           => 'acumen_excerpt_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'acumen_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'acumen' ),
				'section'           => 'acumen_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'acumen_text_sanitization',
				'settings'          => 'acumen_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'acumen' ),
				'label'             => esc_html__( 'Categories', 'acumen' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'acumen' ) => Acumen_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Acumen_Toggle_Switch_Custom_control',
				'settings'          => 'acumen_show_homepage_content',
				'sanitize_callback' => 'acumen_switch_sanitization',
				'label'             => esc_html__( 'Show Home Content/Blog', 'acumen' ),
				'section'           => 'static_front_page',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'acumen_search',
			array(
				'title' => esc_html__( 'Search', 'acumen' ),
				'panel' => 'acumen_theme_options',
			)
		);

		Acumen_Customizer_Utilities::register_option(
			array(
				'settings'          => 'acumen_search_text',
				'sanitize_callback' => 'acumen_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'acumen' ),
				'section'           => 'acumen_search',
				'type'              => 'text',
			)
		);
	}
}

/**
 * Initialize class
 */
$acumen_theme_options = new Acumen_Theme_Options();
