<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acumen
 */

$acumen_visibility = acumen_gtm( 'acumen_testimonial_visibility' );

if ( ! acumen_display_section( $acumen_visibility ) ) {
	return;
}

$image = acumen_gtm( 'acumen_testimonial_bg_image' );
?>
<div id="testimonial-section" class="testimonial-section section dark-background page" <?php echo $image ? 'style="background-image: url( ' .esc_url( $image ) . ' )"' : ''; ?>>
	<div class="section-testimonial testimonial-layout-1">
		<div class="container">
			<?php acumen_section_title( 'testimonial' ); ?>

			<?php get_template_part( 'template-parts/testimonial/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-testimonial  -->
</div><!-- .section -->
