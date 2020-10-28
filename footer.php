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

		<nav id="footer-navigation" class="footer__navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				) );
				?>
		</nav><!-- #footer-navigation -->

		<?php 
		$footer_tagline = get_field( 'footer__tagline', 'options' );
		$footer_email = get_field( 'footer__email', 'options' );
		$footer__linkedin = get_field( 'footer__linkedin', 'options' );
		$footer__resume = get_field( 'footer__resume', 'options' );

		if ( $footer__linkedin ) {
			$footer__linkedin_url = $footer__linkedin['url'];
			$footer__linkedin_title = $footer__linkedin['title'];
			$footer__linkedin_target = $footer__linkedin['target'] ? $footer__linkedin['target'] : '_self';
		}

		if ( $footer__resume ) {
			$footer__resume_url = $footer__resume['url'];
			$footer__resume_title = $footer__resume['title'];
			$footer__resume_target = $footer__resume['target'] ? $footer__resume['target'] : '_blank';
		}

		if ( $footer_tagline ) :
		?>

			<p class="footer__tagline"><?php echo $footer_tagline ?></p>
		
		<?php 
		endif;
		?>

		<div class="footer__links">

		<?php 
		if ( $footer_email ) :
		?>

			<a href="mailto:<?php echo esc_attr($footer_email); ?>" target="_blank" class="footer__email">Email</a>
		
		<?php 
		endif;

		if ( $footer__linkedin ) :
		?>

		<div class="footer__separator"></div>
			<a class="button" href="<?php echo esc_url($footer__linkedin_url); ?>" target="<?php echo esc_attr($footer__linkedin_target); ?>"><?php echo esc_html($footer__linkedin_title); ?></a>
		
		<?php 
		endif; 

		if ( $footer__resume ) :
		?>

			<div class="footer__separator"></div>
			<a href="<?php echo esc_attr($footer__resume_url); ?>" target="<?php echo esc_attr($footer__resume_target); ?>" title="<?php echo esc_attr($footer__resume_title); ?>"><?php echo esc_html($footer__resume_title); ?></a>
		
		<?php 
		endif; 
		?>

		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
