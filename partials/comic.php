<?php
/**
 * The default template for displaying content
 *
 * Used for singles and maybe pages.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			the_post_thumbnail('large', array( 'class' => 'comic-img' ) );
		} 
	?>
	<header class="article-header cf">
		<p><?php the_time('M j, Y | g:i a'); ?></p>
		<h1><?php bloginfo('name'); ?>. <?php the_title(); ?></h1>
	</header>
	<?php godsend_comic_nav(); ?>
	<?php if($post->post_content != ""){ ?>
	<div class="pcont entry-content">
		<?php the_content(); ?>
	</div>
	<?php } ?>
</article><!-- #post -->
