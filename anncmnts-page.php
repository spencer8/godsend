<?php
/**
 * Template Name: Announcements
 *
 */
get_header(); ?>

<div class="ancmnts page">
	<div class="wrap">
	<h1><?php the_title(); ?></h1>
		<?php 
		  $temp = $wp_query; 
		  $wp_query = null; 
		  $wp_query = new WP_Query(); 
		  $wp_query->query('showposts=6&post_type=post'.'&paged='.$paged); 

		  while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>

		  <?php get_template_part( 'partials/ancmnt', 'page' ); ?>

		<?php endwhile; ?>

		<nav>
		    <?php previous_posts_link('<i class="icon-angle-double-left"></i> Newer') ?>
		    <?php next_posts_link('Older <i class="icon-angle-double-right"></i>') ?>
		</nav>
	</div>
</div>

<?php 
  $wp_query = null; 
  $wp_query = $temp;  // Reset
?>

<?php get_footer(); ?>