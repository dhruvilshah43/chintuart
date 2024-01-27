<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acumen
 */

$acumen_visibility = acumen_gtm( 'acumen_wwd_visibility' );

if ( ! acumen_display_section( $acumen_visibility ) ) {
	return;
}

?>
<div id="wwd-section" class="wwd-section section page style-one">
	<div class="section-wwd">
		<div class="container">
			<?php acumen_section_title( 'wwd' ); ?>

			<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
