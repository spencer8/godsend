<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 */
?>
</div><!--End role=main-->

<div class="footer">

	<div class="wrap">
		<div class="g-3up">
			<div class="gi">
				<?php wp_nav_menu( array( 'theme_location' => 'footer1', 'menu_class' => 'nav-foot', 'container' => '' ) ); ?>
			</div>
			<div class="gi">
				<?php wp_nav_menu( array( 'theme_location' => 'footer2', 'menu_class' => 'nav-foot', 'container' => '' ) ); ?>
			</div>
			<div class="gi credits">
				<div class="nav-social">
					<?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_class' => 'nav-social', 'container' => '' ) ); ?>
				</div>
				<p>&copy; 2009 - <?php echo date('Y'); ?> <?php bloginfo("name"); ?>. <?php echo get_theme_mod('details_1'); ?></p>
				<p><?php echo get_theme_mod('details_2'); ?></p>
			</div>
		</div>
	</div>
		
</div>
<?php wp_footer(); ?>

</body>
</html>