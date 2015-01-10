<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */

get_header(); ?>
		<div class="wrap comic">	
			    <article class="text">
			        <p><strong><img alt="Error 404" src="<?php echo get_template_directory_uri(); ?>/images/404.jpeg" width="700" height="558"></strong></p>
			        <h1>404. That page doesn't exist.</h1>
			        <p>It’s probably an outdated link. If you’re looking for a specifc comic page, try the <a href="<?php echo site_url(); ?>/chapters">archives</a>. Otherwise, try the <a href="<?php echo site_url(); ?>">homepage</a>.</p>
			    </article>
		</div>		
<?php get_footer(); ?>