<?php
/**
 * Template part for displaying posts on the front-page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gaetan_Masson_2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php gaetanmasson_2019_post_thumbnail(); ?>

	<div class="entry__content">
		<?php
		$case_study_type = get_field( 'case_study_type' );
		if ($case_study_type) :
		?>
			<p class="entry__type"><?php echo $case_study_type; ?></P>
		<?php
		endif;

		the_title( '<h2 class="entry__title">', '</h2>' );
		
		$the_excerpt = get_the_excerpt();
		if ( $the_excerpt ) :
		?>
			<p class="entry__excerpt"><?php echo $the_excerpt; ?></p>
		<?php
		endif;
		?>
		<a href="<?php the_permalink(); ?>">Read case study</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
