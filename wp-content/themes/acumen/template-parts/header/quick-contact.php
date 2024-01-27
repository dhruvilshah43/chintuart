<?php
/**
 * Header Search
 *
 * @package Acumen
 */

$acumen_phone      = acumen_gtm( 'acumen_header_phone' );
$acumen_email      = acumen_gtm( 'acumen_header_email' );
$acumen_address    = acumen_gtm( 'acumen_header_address' );
$acumen_open_hours = acumen_gtm( 'acumen_header_open_hours' );

if ( $acumen_phone || $acumen_email || $acumen_address || $acumen_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $acumen_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'acumen' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $acumen_phone ) ); ?>"><?php echo esc_html( $acumen_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $acumen_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'acumen' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $acumen_email ) ) ); ?>"><?php echo esc_html( antispambot( $acumen_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $acumen_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'acumen' ); ?></span><?php echo esc_html( $acumen_address ); ?></li>
			<?php endif; ?>

			<?php if ( $acumen_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'acumen' ); ?></span><?php echo esc_html( $acumen_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

