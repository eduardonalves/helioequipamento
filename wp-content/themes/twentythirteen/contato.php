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
		padding: 0px 10px 0px 15px;
		text-align: left;
		width: 350px;
		height: 300px;
		float: left;
		margin-top: 30px;
	}
	
	#divForm{
		margin-left: 105px;
		float: left;
	}
	
	#mapaEndereco{
		margin: 170px -21.7% 50px;
		float: left;
		z-index: 1;
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
			
				<span class="spanContato"><span>Tel.:</span> (21) xxxx-xxxx / (21) xxxxx-xxxx</span>
				<br />
				<span class="spanContato"><span>E-mail:</span> Email@email.com </span>
				<br />
				<span class="spanContato"><span>Rua:</span> Nome da Rua, nº 100 - RJ, Nova Iguaçu</span>
				
			
			</p>
			
		</div>
			<iframe id="mapaEndereco" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3679.0563760475998!2d-43.44269800000001!3d-22.763289000000004!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9966febc23b75f%3A0x42deb1e90e2061a0!2sVENTO+Consulting+Ltda!5e0!3m2!1spt-BR!2sbr!4v1404936212866" width="500" height="250" frameborder="0" style="border:0"></iframe>


		</div><!-- #content -->
	
	</div><!-- #primary -->
<div style="clear:both;"></div>
<?php get_footer(); ?>
