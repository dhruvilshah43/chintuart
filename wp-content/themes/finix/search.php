<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Finix
 * @subpackage finix
 * @since 1.0
 * @version 1.5
 */

get_header(); 
$finix_opt = get_option('finix_redux');
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
				<?php
				if ( class_exists( 'ReduxFramework' ) ) {
					$opt= $finix_opt['search_sidebar'];
					if($opt == 1)
					{
						if ( ! is_active_sidebar('sidebar-1') ) { ?>
							<div class="col-lg-12 col-md-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8 blog-content-area">
						<?php } 
					}
					else if($opt == 2)
					{
						if ( ! is_active_sidebar('sidebar-1') ) { ?>
							<div class="col-lg-12 col-md-12">
						<?php } else { ?>
							<div class="col-xl-9 col-lg-8 blog-content-area order-lg-2">
						<?php } 
					} 
					else if($opt == 3)
					{
						?>
							<div class="col-lg-12 col-md-12">
						<?php  
					}
				} else{ 
						if ( ! is_active_sidebar('sidebar-1') ) { ?>
							<div class="col-lg-12 col-md-12">
						<?php } else { ?>
							<div class="col-lg-9 col-md-8">
						<?php } 
				} ?>
					
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/post/content', 'excerpt' );

						endwhile; // End of the loop.

						finix_pagination();

					else :
						?>

						<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'finix' ); ?></p>
						<?php
							get_search_form();

					endif;
					?>
					</div>
					<?php
					if ( class_exists( 'ReduxFramework' ) ) {
						$opt= $finix_opt['search_sidebar'];
						if($opt == 1 || $opt == 2)
						{
						if ( is_active_sidebar('sidebar-1') ) { ?>		
						<div class="col-xl-3 col-lg-4 blog-sidebar sidebar">
							<?php get_sidebar(); ?>
						</div>
						<?php }
						}
						else if($opt == 3){ }
					}
					else{
						if ( is_active_sidebar('sidebar-1') ) { ?>		
						<div class="col-xl-3 col-lg-4 blog-sidebar sidebar">
							<?php get_sidebar(); ?>
						</div>
						<?php }
					} ?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
<?php
get_footer();
