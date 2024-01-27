<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Acumen
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acumen_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class with respect to layout selected.
	$layout  = acumen_get_theme_layout();
	$sidebar = acumen_get_sidebar_id();

	$layout_class = "layout-no-sidebar-full-width";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'layout-no-sidebar-full-width';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-right-sidebar';
		}
	}

	$classes[] = $layout_class;

	// Add Site Layout Class.
	$classes[] = 'fluid-layout';

	// Add Archive Layout Class.
	$classes[] = 'grid';

	// Add header Style Class.
	$classes['header-class'] = 'header-one';

	// Add Color Scheme Class.
	$classes[] = esc_attr( acumen_gtm( 'acumen_color_scheme' ) . '-color-scheme' );

	$acumen_enable = acumen_gtm( 'acumen_header_image_visibility' );

	if ( ! acumen_display_section( $acumen_enable ) || ( ! has_header_image() && ! ( is_header_video_active() && has_header_video() ) ) ) {
    	$classes[] = 'no-header-media';
    }

	return $classes;
}
add_filter( 'body_class', 'acumen_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function acumen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'acumen_pingback_header' );

if ( ! function_exists( 'acumen_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 */
	function acumen_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Theme Options
		$length	= acumen_gtm( 'acumen_excerpt_length' );

		return absint( $length );
	} // acumen_excerpt_length.
endif;
add_filter( 'excerpt_length', 'acumen_excerpt_length', 999 );

if ( ! function_exists( 'acumen_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function acumen_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = acumen_gtm( 'acumen_excerpt_more_text' );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
		);

		return '&hellip;' . $link;
	}
endif;
add_filter( 'excerpt_more', 'acumen_excerpt_more' );

if ( ! function_exists( 'acumen_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function acumen_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = acumen_gtm( 'acumen_excerpt_more_text' );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
			);

			$output .= '&hellip;' . $link;
		}

		return $output;
	} // acumen_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'acumen_custom_excerpt' );

if ( ! function_exists( 'acumen_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 */
	function acumen_more_link( $more_link, $more_link_text ) {
		$more_tag_text = acumen_gtm( 'acumen_excerpt_more_text' );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	} // acumen_more_link.
endif;
add_filter( 'the_content_more_link', 'acumen_more_link', 10, 2 );

/**
 * Filter Homepage Options as selected in theme options.
 */
function acumen_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = acumen_gtm( 'acumen_front_page_category' );

		if ( $cats ) {
			$query->query_vars['category__in'] = explode( ',', $cats );
		}
	}
}
add_action( 'pre_get_posts', 'acumen_alter_home' );

/**
 * Display section as selected in theme options.
 */
function acumen_display_section( $option ) {
	if ( 'entire-site' === $option || ( is_front_page() && 'homepage' === $option ) || ( ! is_front_page() && 'excluding-home' === $option ) ) {
		return true;
	}

	// Section is disabled.
	return false;
}

/**
 * Return theme layout
 * @return layout
 */
function acumen_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = acumen_gtm( 'acumen_default_layout' );

		if ( is_home() || is_archive() ) {
			$layout = acumen_gtm( 'acumen_homepage_archive_layout' );
		}
	}

	return $layout;
}

/**
 * Return theme layout
 * @return layout
 */
function acumen_get_sidebar_id() {
	$sidebar = '';

	$layout = acumen_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout ) {
		return $sidebar;
	}

	return 'sidebar-1'; // sidebar-1 is main sidebar.
}


/**
 * Function to add Scroll Up icon
 */
function acumen_scrollup() {
	echo '<a href="#masthead" id="scrollup" class="backtotop">' . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'acumen' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'acumen_scrollup', 1 );

/**
 * Return args for specific section type
 */
function acumen_get_section_args( $section_name ) {
	$numbers = acumen_gtm( 'acumen_' . $section_name . '_number' );

	// If post or page or product, then set post__in argument.
	$post__in = array();

	for( $i = 0; $i < $numbers; $i++ ) {
		$post__in[] = acumen_gtm( 'acumen_' . $section_name . '_page_' . $i );
	}

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => absint( $numbers ),
		'post_type'           =>  'page',
		'orderby'             => 'post__in',
		'post__in'            => $post__in,
	);

	return $args;
}

/**
 * Add sections to appropriate hook.
 */
function acumen_sections() {
	$default_sections = acumen_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = acumen_gtm( 'acumen_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = $sortable_options + array_keys( $default_sections );

	$hook = 'acumen_before_content';

	foreach( $sortable_sections as $section ){
		if ( 'main_content' === $section ) {
			$hook = 'acumen_after_content';

			continue;
		}

		$template_part = 'template-parts/' . str_replace( '_', '-', $section ) .'/' . str_replace( '_', '-', $section );

		add_action( $hook, function() use ( $template_part ) {
			get_template_part( $template_part );
		});
	}
}
add_action( 'wp', 'acumen_sections', 10 );

/**
 * Display content.
 */
function acumen_display_content( $section ) {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
}

/**
 * Section class format.
 */
function acumen_display_section_classes( $classes ) {
	echo esc_attr( implode( ' ', $classes ) );
}
