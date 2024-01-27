<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Acumen
 */

if ( ! acumen_gtm( 'acumen_contact_form_page' ) ) {
	return;
}

$acumen_args = array(
	'page_id'        => absint( acumen_gtm( 'acumen_contact_form_page' ) ),
	'posts_per_page' => 1,
	'post_type'      => 'page',
);

$acumen_loop = new WP_Query( $acumen_args );

while ( $acumen_loop->have_posts() ) :
	$acumen_loop->the_post();

	$subtitle = acumen_gtm( 'acumen_contact_form_custom_subtitle' );
	?>
	<div id="contact-form-section" class="section no-map">
		<div class="section-contact clear-fix">
			<div class="container">
				<div class="custom-contact-form row">
					<div class="ff-grid-6 contact-thumb">
					<?php acumen_post_thumbnail('acumen-hero'); ?>
				</div>
				<div class="form-section ff-grid-6">
					<div class="section-title-wrap text-alignleft">
						<?php if ( $subtitle ) : ?>
							<p class="section-top-subtitle"><?php echo esc_html( $subtitle ); ?></p>
						<?php endif; ?>

							<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

							<span class="divider"></span>
					</div><!-- .section-title-wrap -->

					<?php the_content(); ?>
				</div>
			</div><!-- .custom-contact-form -->
			</div>
			<!-- .container -->
		</div><!-- .section-contact -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
