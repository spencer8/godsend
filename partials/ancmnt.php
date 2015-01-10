<?php
/**
 * The default template for displaying content
 *
 * Used for singles and maybe pages.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?>>
	<header class="article-header">
		<?php the_date('M j, Y | g:i&\\nb\\sp;a', '<h1>', '</h1>'); ?>
		<p>by <?php the_author(); ?></p>
	</header>
	<div class="pcont cf entry-content">
		<?php the_content(); ?>
		<p class="readall"><a href="<?php echo site_url(); ?>/announcements">read all announcements <i class="icon-angle-double-right"></i></a></p>
	</div>
</article><!-- #post -->
