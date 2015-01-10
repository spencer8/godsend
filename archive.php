<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 *
 */

get_header(); ?>

    <?php /* The loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'partials/content' ); ?>
    <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>