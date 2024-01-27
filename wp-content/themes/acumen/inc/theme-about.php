<?php
/**
 * Adds Theme page
 *
 * @package JetBlack
 */

function acumen_about_admin_style( $hook ) {
	if ( 'appearance_page_acumen-about' === $hook ) {
		wp_enqueue_style( 'acumen-theme-about', get_theme_file_uri( 'css/theme-about.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'acumen_about_admin_style' );

/**
 * Add theme page
 */
function acumen_menu() {
	add_theme_page( esc_html__( 'About Theme', 'acumen' ), esc_html__( 'About Theme', 'acumen' ), 'edit_theme_options', 'acumen-about', 'acumen_about_display' );
}
add_action( 'admin_menu', 'acumen_menu' );

/**
 * Display About page
 */
function acumen_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="https://fireflythemes.com/themes/acumen" class="button button-secondary" target="_blank"><?php esc_html_e( 'Info', 'acumen' ); ?></a>

					<a href="https://fireflythemes.com/documentation/acumen/" class="button button-primary" target="_blank"><?php esc_html_e( 'Documentation', 'acumen' ); ?></a>

					<a href="https://demo.fireflythemes.com/acumen" class="button button-primary green" target="_blank"><?php esc_html_e( 'Demo', 'acumen' ); ?></a>

					<a href="https://fireflythemes.com/support" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support', 'acumen' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'acumen' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'acumen-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'acumen-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'acumen' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'acumen-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'acumen' ); ?></a>
		</nav>

		<?php acumen_main_screen(); ?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'acumen' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'acumen' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'acumen' ) : esc_html_e( 'Go to Dashboard', 'acumen' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function acumen_main_screen() {
	if ( isset( $_GET['page'] ) && 'acumen-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'acumen' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'acumen' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'acumen' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'acumen' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'acumen' ) ?></p>
				<p><a href="https://fireflythemes.com/support" class="button button-primary"><?php esc_html_e( 'Support Forum', 'acumen' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}
