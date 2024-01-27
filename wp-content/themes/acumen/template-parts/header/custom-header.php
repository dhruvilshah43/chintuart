<?php
/**
 * Displays header site branding
 *
 * @package Acumen
 */

$acumen_enable = acumen_gtm( 'acumen_header_image_visibility' );

if ( acumen_display_section( $acumen_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php acumen_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
