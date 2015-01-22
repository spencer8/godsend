<?php
/**
 * The template for displaying all single posts
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
			<div class="ancmnts closed">

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
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		?>
		</div>
	<?php
	$next_post = get_adjacent_post(false, '', false );// set last param to true if you want post that is chronologically previous
	$thumbnail = '';
	?>
	<script type="text/javascript">
	    jQuery(document).ready(function(){
	        var images = '';
	        <?php $thumbnail = wp_get_attachment_image_src ( get_post_thumbnail_id ( $next_post->ID ), "large"); 
	        if ($thumbnail != false && $thumbnail != ''){
	            ?>
	            images += '<img src="<?php echo $thumbnail[0]; ?>" style="display:none" />';
	            <?php
	        }
	        ?>
	        if(images != ''){
	            jQuery('body').append(images);
	        }
	    });
	</script>	
	<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>