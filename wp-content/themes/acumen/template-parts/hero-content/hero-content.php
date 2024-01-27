<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Acumen
 */

$acumen_enable = acumen_gtm( 'acumen_hero_content_visibility' );

if ( ! acumen_display_section( $acumen_enable ) ) {
	return;
}

get_template_part( 'template-parts/hero-content/content-hero' );
