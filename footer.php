<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gaetan_Masson_2019
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

		<?php 
		$footer_tagline = get_field( 'footer__tagline', 'options' );
		$footer_email = get_field( 'footer__email', 'options' );

		if ( $footer_tagline ) :
		?>
			<p class="footer__tagline"><?php echo $footer_tagline ?></p>
		<?php 
		endif; 
		if ( $footer_email ) :
		?>
			<a href="mailto:<?php echo $footer_email ?>" class="footer__link"><?php echo $footer_email ?></a>  
		<?php 
		endif; 
		?>

		<nav id="footer-navigation" class="footer__navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'menu_id'        => 'footer-menu',
			) );
			?>
		</nav><!-- #footer-navigation -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
