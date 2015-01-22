<?php
/**
 * The template for displaying all single posts
 *
 */

get_header(); ?>

<div class="ancmnts page">
	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="wrap">	
			<?php get_template_part( 'partials/ancmnt' ); ?>
		</div>
	<?php endwhile; // end of the loop. ?>
</div>

<?php get_footer(); ?>