<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<style type="text/css">
	.foot{
		background-color: #1A355F;
		padding: 20px 0;
		border-top: 2px solid #030820;
		color: white;
		margin-top: 46px;
		text-decoration:none;
	}
	
	.empresa{
		float: left;
		text-align: left;
	}
	
	.creditos{
		float: right;
		position: relative;
		font-size: 16px;
		font-family: serif;
		text-decoration:none;
	}
	.creditos a{
		font-size: 16px;
		color:#85ad74;
	}
	.creditos a:hover{
		
		color:#51CC1C;
	}

</style>
	 </div>
	</div><!-- #main -->
		<footer id="colophon" class="site-footer foot" role="contentinfo">
			<?php //get_sidebar( 'main' ); ?>
			<div class="centralFooter">
				<div class="empresa">
					<span class="spanContato"><span>Tel.:</span> (21) 3474-1637 / (21) 2697-3629 / 81*89595</span>
					<br />
					<span class="spanContato"><span>E-mail:</span> suporte@helioequipamentos.com.br </span>
					<br />
					<span class="spanContato"><span>End:</span> Av. Getúlio de Moura nº 760, Centro - Nova Iguaçu | CEP: 26.221.040</span>
					<br />
				</div>
				<br />
				<br />
				<span class="creditos">​© 2014. Site desenvolvido por <a href="http://www.techinmove.com.br/">TechInMOVE</a></span>
			</div>
		<br />
		</footer><!-- #colophon -->
		
	</div><!-- #page -->

	<?php wp_footer(); ?>
	

</body>
</html>
