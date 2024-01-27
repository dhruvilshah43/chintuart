<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Acumen
 */
if ( ! acumen_gtm( 'acumen_hero_content_page' ) ) {
	return;
}

$acumen_args = array(
	'page_id'        => absint( acumen_gtm( 'acumen_hero_content_page' ) ),
	'posts_per_page' => 1,
	'post_type'      => 'page',
);

$acumen_loop = new WP_Query( $acumen_args );

while ( $acumen_loop->have_posts() ) :
	$acumen_loop->the_post();

	$acumen_content_align = acumen_gtm( 'acumen_hero_content_position' );
	$acumen_text_align    = acumen_gtm( 'acumen_hero_content_text_align' );
	$acumen_subtitle      = acumen_gtm( 'acumen_hero_content_custom_subtitle' );

	$classes[] = 'hero-content-section section';
	$classes[] = acumen_gtm( 'acumen_hero_content_position' );
	$classes[] = acumen_gtm( 'acumen_hero_content_text_align' );

	if ( ! has_post_thumbnail() ) {
		$classes[] = 'thumbnail-disable';
	}
	?>

	<div id="hero-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<div class="hero-content-wrapper">
						<?php if ( has_post_thumbnail() ) : ?>
						<div class="ff-grid-6 featured-page-thumb">
							<div class=" featured-page-thumb-wrapper"><?php the_post_thumbnail( 'acumen-hero', array( 'class' => 'alignnone' ) );?>
						</div>
						</div>
						<?php endif; ?>

						<!-- .ff-grid-6 -->
						<div class="ff-grid-6 featured-page-content">
							<div class="featured-page-section">
								<div class="section-title-wrap text-alignleft">
									<?php if ( $acumen_subtitle ) : ?>
									<p class="section-top-subtitle"><?php echo esc_html( $acumen_subtitle ); ?></p>
									<?php endif; ?>

									<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

									<span class="divider"></span>
								</div>

								<?php acumen_display_content( 'hero_content' ); ?>
							</div><!-- .featured-page-section -->
						</div><!-- .ff-grid-6 -->
					</div><!-- .hero-content-wrapper -->

				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
