<?php
/**
 * Header One Style Template
 *
 * @package Acumen
 */
$acumen_phone      = acumen_gtm( 'acumen_header_phone' );
$acumen_email      = acumen_gtm( 'acumen_header_email' );
$acumen_address    = acumen_gtm( 'acumen_header_address' );
$acumen_open_hours = acumen_gtm( 'acumen_header_open_hours' );

$acumen_button_text   = acumen_gtm( 'acumen_header_button_text' );
$acumen_button_link   = acumen_gtm( 'acumen_header_button_link' );
$acumen_button_target = acumen_gtm( 'acumen_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-one<?php echo ! $acumen_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $acumen_phone || $acumen_email || $acumen_address || $acumen_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-one main-top-header-four dark-top-header">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i>
					<?php $acumen_top_bar_mobile_label = acumen_gtm( 'acumen_top_bar_mobile_label' );

					if ( $acumen_top_bar_mobile_label ) : ?>
					<span class="menu-label"><?php echo esc_html( $acumen_top_bar_mobile_label ); ?></span>
					<?php endif; ?>
				</button><!-- #header-top-toggle -->

				<div id="site-top-header-mobile-container">
					<?php if ( $acumen_phone || $acumen_email || $acumen_address || $acumen_open_hours ) : ?>
					<div id="quick-contact">
						<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social">
						<div class="social-nav no-border circle-icon">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'acumen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>

					<?php get_template_part( 'template-parts/header/header-mobile-search' ); ?>
				</div><!-- #site-top-header-mobile-container-->
			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $acumen_phone || $acumen_email || $acumen_address || $acumen_open_hours ) : ?>
				<div id="quick-contact" class="pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div>
				<?php endif; ?>

				<div class="top-head-right pull-right">
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border circle-icon">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'acumen' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>

					<?php if ( $acumen_button_text ) : ?>
						<a target="<?php echo esc_attr( $acumen_button_target );?>" href="<?php echo esc_url( $acumen_button_link );?>" class="ff-button header-button  pull-left"><?php echo esc_html( $acumen_button_text );?></a>
					<?php endif; ?>


				</div><!-- .top-head-right -->
			</div><!-- .container -->
		</div><!-- .site-top-header -->
	</div><!-- #top-header -->
	<?php endif; ?>

	<header id="masthead" class="site-header main-header-one clear-fix<?php echo acumen_gtm( 'acumen_header_sticky' ) ? ' sticky-enabled' : ''; ?>">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->

				<div class="right-head pull-right">
					<div id="main-nav" class="pull-left">
						<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
					</div><!-- .main-nav -->
					<div class="head-search-cart-wrap pull-left">
						<?php if ( function_exists( 'acumen_woocommerce_header_cart' ) ) : ?>
						<div class="cart-contents pull-left">
							<?php acumen_woocommerce_header_cart(); ?>
						</div>
						<?php endif; ?>
						<div class="header-search pull-right">
							<?php get_template_part( 'template-parts/header/header-search' ); ?>
						</div><!-- .header-search -->
					</div><!-- .head-search-cart-wrap -->

				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
</div><!-- .header-wrapper -->
