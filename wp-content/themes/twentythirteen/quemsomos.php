<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 * Template Name: quemsomos
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_template_part('headersemmenu');

?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php the_content(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
