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

<style type="text/css">
	.somos-top{
		margin: 0 auto;
		padding-bottom: 35px;
		width: 700px;
		
	}
	

	
	p{
		text-align: justify;
	}

</style>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php the_content(); ?>
		
		<div class="somos-top">
					
				<h2>Quem Somos</h2>
				<p>
					<span>&nbsp; &nbsp; &nbsp; </span>Helio Equipamentos é uma empresa carioca, fundada em ____ na cidade de Mesquita com o objetivo de facilitar a vida do comerciante,
					   em especial do setor de alimentos. Se você quer ser um empresário mas não sabe por onde começar, invista em alimentos e seu lucro 
					   será garantido.
					</p>
					<p>
					   <span>&nbsp; &nbsp; &nbsp; </span>Além de fornecer os equipamentos necessários para abrir o seu negócio e alavancar suas vendas, também oferecemos consultoria para quem 
					   tem dúvidas em qual equipamento se encaixa melhor às suas necessidades. Aqui você encontra soluções para lanchonetes, pizzarias, 
					   restaurantes, açougues, além de utensílios de cozinha industrial, comercial e doméstica.
					</p>					

				<p>
					<span>&nbsp; &nbsp; &nbsp; </span> Nossa diferença em relação à concorrência é que não vendemos equipamentos que ultrapassam as necessidades, pesam no bolso consumidor e 
					ainda dificultam a decolagem de seu negócio. Oferecermos por um preço acessível, máquinas que serão 100% úteis para alcançar os objetivos 
					de produção e qualidade do negócio do nosso cliente. Assim proporcionamos ao empresário a economia que ele tanto precisa para continuar 
					investindo de maneira cadenciada em seu empreendimento, podendo assim crescer constantemente, sempre contando com a Helio Equipamentos 
					para oferecer as ferramentas certas para acompanhar sua evolução e impulsionar ainda mais seu crescimento.
				</p>
				
				<p>
					<span>&nbsp; &nbsp; &nbsp; </span>Atendemos pequenas, médias e grandes empresas no Rio e Grande Rio.
					Aceitamos todos os cartões. Parcelamentos em 6x sem juros a partir de R$1000,00.
				</p>
		</div>	
		
		</div><!-- #content -->
	</div><!-- #primary -->

<div style="clear:both;"></div>

<?php get_footer(); ?>
