<?php
/**
 * Template Name: Chapters
 *
 */
get_header(); ?>

<?php
	$chapters = get_terms( 'chapter' );
?>
<div class="chapters page">
	<div class="wrap">
	<h1><?php the_title(); ?></h1>
		<?php
		foreach ( $chapters as $chapter ) { 
			$args = array(
				'post_type' => 'comic-page',
				'posts_per_page' => -1,
				'order' => 'ASC',
				'tax_query' => array(
					array(
						'taxonomy' => 'chapter',
						'terms'    => $chapter->term_id,
					),
				),
			);
		    $query1 = new WP_Query( $args );
				$chapter_title = "Chapter ".$chapter->name;

		    ?>
			
				
				<?php

				$first_page = 1;

				while ( $query1->have_posts() ) {
					$query1->the_post();

					$comic_title = str_replace( $chapter_title.', ', '', get_the_title() );

					if($first_page){
						?>
			<div class="title-card">
				<a href="<?php the_permalink(); ?>"><?php 
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('large', array( 'class' => 'comic-img' ) );
					} 
				?></a>
				<a href="<?php the_permalink(); ?>"><h2><?php bloginfo('name'); echo ' '.$chapter_title; ?></h2></a>
				<p><?php the_time('M j, Y'); ?></p>
			</div>
			<div class="chapter-list">
				<ul>
						<?php
						$first_page = 0;
					}else{

						?>
		<li><a href="<?php the_permalink(); ?>"><span><?php echo $comic_title; ?></span> <span><?php the_time('M j, Y'); ?></span></a></li>
						<?php

					}
				}
				?>
				
				</ul>
			</div>

			<?php
		    // Reset things, for good measure
		    $query1 = null;
		    wp_reset_postdata();
		}
		?>
	</div>
</div>


<?php get_footer(); ?>