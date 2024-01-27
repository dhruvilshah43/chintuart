<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acumen
 */

$acumen_visibility = acumen_gtm( 'acumen_slider_visibility' );

if ( ! acumen_display_section( $acumen_visibility ) ) {
	return;
}

?>
<div id="slider-section" class="section slider-section no-padding overlay-enabled style-two zoom-disabled">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->


	<?php
	// Pagination.
	if ( acumen_gtm( 'acumen_slider_pagination' ) ) : ?>
    <div class="swiper-pagination"></div>
	<?php endif; ?>

    <?php
	// Navigation.
	if ( acumen_gtm( 'acumen_slider_navigation' ) ) : ?>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <?php endif; ?>
</div><!-- .main-slider -->
