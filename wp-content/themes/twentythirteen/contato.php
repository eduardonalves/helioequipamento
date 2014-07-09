<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 * Template Name: contato
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_template_part('headersemmenu');

?>
<style type="text/css">
	#endereco{
		border-left: 1px solid rgb(196, 194, 194);
		padding: 10px 10px 0px 15px;
		text-align: left;
		width: 300px;
		height: 300px;
		float: left;
		margin-top: 30px;
	}
	
	#divForm{
		margin-left: 300px;
		float: left;
	}
</style>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<div id="divForm">
		<?php echo do_shortcode('[form form-1]');
				the_content(); 
		?>
		</div>
		<div id="endereco">
			<p>Nome da Empresa</p>
			<p>Nome da Empresa</p>
			<p>Nome da Empresa</p>
			<p>Nome da Empresa</p>
			<p>Nome da Empresa</p>
		</div>

		</div><!-- #content -->
	
	</div><!-- #primary -->
<div style="clear:both;"></div>
<?php get_footer(); ?>
