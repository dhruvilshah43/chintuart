<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Acumen
 */

$acumen_visibility = acumen_gtm( 'acumen_contact_form_visibility' );

if ( ! acumen_display_section( $acumen_visibility ) ) {
	return;
}

get_template_part( 'template-parts/contact-form/content-contact' );
