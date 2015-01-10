<?php
/**
 * The default template for displaying content
 *
 * Used for singles and maybe pages.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="article-header">
		<?php the_date('M j, Y | g:i a', '<h1>', '</h1>'); ?>
		<p>by <?php the_author(); ?></p>
	</header>
	<div class="pcont entry-content">
		<?php the_content(); ?>
	</div>
</article><!-- #post -->
