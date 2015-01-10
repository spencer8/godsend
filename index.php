<?php
/**
 * The main template file, also the homepage
 *
 */

get_header(); ?>

	<?php 
		$args = array( 
			'post_type' => 'post',
			'posts_per_page' => 1
		);
		$homep = new WP_Query( $args );
		
		if($homep->have_posts()) : 
		    while($homep->have_posts()) : 
		    	$homep->the_post();
 		?>
			<div class="ancmnts open">

				<div class="wrap">	
					<?php get_template_part( 'partials/ancmnt' ); ?>
				</div>		

				<?php get_template_part( 'partials/ancmnts-tog' ); ?>

			</div>
		<?php endwhile; endif; ?>
		<?php wp_reset_postdata(); ?>


	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div class="wrap comic">	
			<?php get_template_part( 'partials/comic' ); ?>
		<?php	
			global $withcomments; 
			$withcomments = 1;
			comments_template();

		?>
		</div>		
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>