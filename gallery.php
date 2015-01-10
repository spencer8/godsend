<?php
/*
Template Name: Gallery Page
*/

get_header(); ?>

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	<article class="menu-group">
		<div class="intro"><?php the_content(); ?></div>
	</article>
	
		<?php 
		// check for rows (repeater)
		if( get_field('gallery') ): ?>

	    <div class="g g-3up">
		
			<?php while( has_sub_field('gallery') ): ?>

			<?php 

			$attachment_id = get_sub_field('img');
			$size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
			$image = wp_get_attachment_image_src( $attachment_id, $size );
			$size = "full"; // (thumbnail, medium, large, full or custom size)
			$bigimage = wp_get_attachment_image_src( $attachment_id, $size );
			?>

			<div class="gi">
				<a rel="lightbox" href="<?php echo $bigimage[0]; ?>"><img src="<?php echo $image[0]; ?>" alt=""></a>
			</div>

			 
	    	<?php endwhile; ?>

		</div>
		
	<?php endif; // if( get_field('menu_section') ): ?>

	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>