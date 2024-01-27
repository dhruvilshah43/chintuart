<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acumen
 */

$acumen_visibility = acumen_gtm( 'acumen_featured_grid_visibility' );

if ( ! acumen_display_section( $acumen_visibility ) ) {
	return;
}

$acumen_classes[] = 'featured-grid-section section page style-one';
?>
<div id="featured-grid-section" class="featured-grid-section section page style-one">
	<div class="container">
		<?php acumen_section_title( 'featured_grid' ); ?>

		<?php get_template_part( 'template-parts/featured-grid/post-type' ); ?>

		<?php
		$acumen_button_text   = acumen_gtm( 'acumen_featured_grid_button_text' );
		$acumen_button_link   = acumen_gtm( 'acumen_featured_grid_button_link' );
		$acumen_button_target = acumen_gtm( 'acumen_featured_grid_button_target' ) ? '_blank' : '_self';

		if ( $acumen_button_text ) : ?>
			<div class="more-wrapper clear-fix">
				<a href="<?php echo esc_url($acumen_button_link); ?>" class="ff-button" target="<?php echo esc_attr( $acumen_button_target ); ?>"><?php echo esc_html($acumen_button_text); ?></a>
			</div><!-- .more-wrapper -->
		<?php endif; ?>
	</div><!-- .container -->
</div><!-- .latest-posts-section -->

