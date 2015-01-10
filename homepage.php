<?php
/*
Template Name: Home Page
*/

get_header(); ?>

	<?php /* The loop */ ?>
	<?php while ( have_posts() ) : the_post(); ?>
	
	<p class="intro"><?php the_content(); ?></p>
	
	<?php if( get_field('specials_hide') ) { 
	} else { ?>
	
	<article class="menu-group">
		<h2 class="ghead"><span><?php the_field('specials_title'); ?></span></h2>
		<p class="intro"><?php the_field('specials_note'); ?></p>
		<div class="menu-section">

			<?php if( have_rows('specials_items') ): ?>

			<section class="menu-item cf">
			 
			    <?php while ( have_rows('specials_items') ) : the_row(); ?>
			 
				<div class="item-title">
					<h3><?php the_sub_field('title'); ?></h3>
					<h5 class="subheading"><?php the_sub_field('price'); ?></h5>
				</div>
				<div class="item-desc">
					<?php the_sub_field('desc'); ?>
				</div>
			 
			    <?php endwhile; ?>

			</section>
			 
			<?php else :			 
			endif; ?>

		</div>				
	</article>
	
	<?php } ?>
	
	<?php if( get_field('open_table_script') ): ?>
		<div id="open-table"><?php the_field('open_table_script'); ?></div>
	<?php endif; ?>
	
	<?php endwhile; ?>

<?php get_footer(); ?>