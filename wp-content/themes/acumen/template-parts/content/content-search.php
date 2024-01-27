<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acumen
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clear-fix'); ?>>
	<div class="hentry-inner">
	<div class="post-thumbnail">
		<?php acumen_post_thumbnail(); ?>

		<?php acumen_posted_cats(); ?>
	</div><!-- .post-thumbnail -->
<div class="entry-container">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	</header><!-- .entry-header -->
	<?php if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta">
		<?php
		acumen_posted_on();
		acumen_posted_by();
		?>
	</div><!-- .entry-meta -->
	<?php endif; ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


</div>
</div><!-- .hentry-inner -->
</article><!-- #post-<?php the_ID(); ?> -->
