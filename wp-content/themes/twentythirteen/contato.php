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

//get_template_part('headersemmenu');

$hideSideBar = true;
get_header();

?>
<style type="text/css">
	#endereco{
		border-left: 1px solid rgb(196, 194, 194);
	padding: 0px 10px 0px 15px;
	text-align: left;
	width: 460px;
	float: left;
	margin-top: 30px;
	margin-bottom: 26px;
	}
	
	#divForm{
		margin-left: 105px;
		float: left;
	}
	
	#mapaEndereco{
		margin: -15px 0px 0px;
	}
	
	#empresaSpan{
		margin-top: -12px !important;
		margin-bottom: 10px;
	}
	
	.spanContato{
		font-size: 14px;	
	}	
	.spanContato span{
		font-weight: bold;
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
			<p>
				<h5 id="empresaSpan">Contatos - Helio Equipamentos</h5>
			
				<span class="spanContato"><span>Tel.:</span> (21) 3474-1637 / (21) 2697-3629 / 81*89595</span>
				<br />
				<span class="spanContato"><span>E-mail:</span> suporte@helioequipamentos.com.br </span>
				<br />
				<span class="spanContato"><span>End:</span> Av. Getúlio de Moura nº 760, Centro - Nova Iguaçu | CEP: 26.221.040</span>
				
			
			</p>
			
			<iframe id="mapaEndereco" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d919.7542444458203!2d-43.44006339999996!3d-22.764751199999974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9966f94d94f153%3A0xf27e8fec90627906!2sAv.+Get%C3%BAlio+de+Moura%2C+760+-+Centro!5e0!3m2!1spt-BR!2sbr!4v1404997602299" width="500" height="250" frameborder="0" style="border:0"></iframe>

			
		</div>
			
		</div><!-- #content -->
	
	</div><!-- #primary -->
<div style="clear:both; height: 60px;"></div>
<?php get_footer(); ?>
