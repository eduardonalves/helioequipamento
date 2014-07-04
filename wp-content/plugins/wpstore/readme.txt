=== WP STORE ===

Contributors: jmorettoni
Plugin Name:Wp Store
Plugin URI:http://wpstore.com.br 
Tags:  shopping,loja,shop,e-commerce,loja virtual,loja online
Author URI: http://profiles.wordpress.org/jmorettoni/
Author: jmorettoni
Requires at least: 3.4
Tested up to: 3.5
Stable tag: 1.1.9
Version: 1.1.9   
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html   
Donate link: http://wpstore.com.br/download   
 
Crie sua loja virtual com um simples e completo plugin de ecommerce para wordpress.

== Description ==   

Este plugin adiciona um completo módulo de e-commerce em seu wordpress. Inclui os principais métodos de pagamento do mundo e do brasil (Paypal,Moip, Pagseguro e Cielo* ),controle de estoque, diversos calculos de frete incluíndo webservice Correios, promoções de frete  cupoms de desconto .
--          

This plugin Add a complete ecommerce module for wordpress , with global and brazilan payments. 


== Installation ==       
  
Instalar o wpStore em seu site wordpress é simples.    

 
1 – Faça o download da mais nova versão do wpStore em http://wordpress.org/extend/plugins/wpstore/

2 – Faça o upload do arquivo .ZIP através do menu PLUGIN na administração do WordPress. Você também pode baixar o plugin diretamente na aba Procurar Plugins do painel administrativo do WordPress. Outra opção é enviar a pasta do wpStore para o diretório wp-content/plugins/ de sua hospedagem .

3 – Instale e ative o Plugin no wordpress.

4 – Feito. Parabens! Seu plugin foi instalado com sucesso! Se você está usando um de nossos temas, tudo deve estar funcionando corretamente. É hora de começar a explorar o WpStore e se familiarizar com os recursos do sistema , administração de produtos, pedidos e preencher as informações básicas das configurações Gerais no Manual do Administrador e configurar o sistema com os métodos de pagamento que deseja usar, tipos de frete e envio , informações para contato e gestão de produtos.     

 Consulte o manual do administrador para configurar sua loja: http://wpstore.com.br/manual/    

5 – Caso você esteja instalando em um tema próprio veja agora como personalizar seu tema para explorar todas as funcionalidades do wpStore . Não é um bicho de sete cabeças. Enjoy IT! Consulte nosso tópico de Ajuda a Desenvolvedores e quando terminar, não esqueça de nos enviar seu projeto e divulgar seu trabalho colocando em nossa galeria .

 Mais ajuda ? Encontre em : http://wpstore.com.br/ajuda/


== Upgrade Notice ==
Upgrade notices :

== Screenshots ==   

1. screenshot-1.png   

2. screenshot-2.jpg    

3. screenshot-3.png  
  
4. screenshot-4.png  
  
5. screenshot-5.png   
 
6. screenshot-6.png 
   
7. screenshot-7.png 
  
8. screenshot-8.png 
   
9. screenshot-9.png 
   
10. screenshot-10.png 
   
11. screenshot-11.png 
   
12. screenshot-12.png  
  
13. screenshot-13.png  
  
14. screenshot-14.png
    
15. screenshot-15.png 
   
16. screenshot-16.png  
  
17. screenshot-17.png 
   
18. screenshot-18.png 
   
19. screenshot-19.png 
   
20. screenshot-20.png    

21. screenshot-21.png 
   
22. screenshot-22.png 
   
23. screenshot-23.png  
  
24. screenshot-24.png  
  
25. screenshot-25.png  
  
26. screenshot-26.png  
  
27. screenshot-27.png 
   
28. screenshot-28.png 
   
29. screenshot-29.png 
   
30. screenshot-30.png 
 
31. screenshot-31.png 
   

== Changelog ==    

1.0 :
    - wpstore born;    

1.1 :
    - Change names of plugin in  database   (wp_store to wpstore);
    - New : Add many admin  options in wpstore admin menu;   
    - fixed bugs in checkout (promo free shipping, coupons discounts );    

1.1.1 : 
      - New : Add MOIP and Paypal in payment methods;
      - New : Admin Plugin Style; 


1.1.2 : 
	      - FIXED ERROR : In version 1.1 Collum qtdProduto  in table wpstore_stock  was created with space. This version correct this.

1.1.3 : 
				  - Google Analytics Ecommerce
					
1.1.4 : 
			      - FIXED ERROR CEP / ZIPCODE      
			
1.1.8 : 
				  - FIXED ERROR PROMO ZIPCODE
			    

1.2 : SOON
      - New : unlimited sub-variations of stock product;  
      - New : General Control Stock List page in wpstore admin Menu;



== Frequently Asked Questions ==    

Perguntas Frequentes : Acesse http://wpstore.com.br/faq/     

1 - Como criar uma lista de produtos ou exibir um template especial em minha pagina single?  
   
Você pode facilmente criar listagens diferenciadas para seus produtos. WP STORE criar posts personalizados nomeados de 'produtos'. Assim para lista-los basta editar sua query wordpress para listar posts e produtos. Conforme exemplo a seguir : 
 
//php-------------   

query_posts( 'post_type=produtos' );    

//php------------- 

É muito comum você editar sua pagina category.php para exibir posts ou produtos. Para isto normalmente o indicado é fazer um tipo de listagem para cada tipo. Assim você pode editar o seu arquivo category.php da seguinte forma : 

//php-------------     

  if(is_category('blog')) {  

  include('category-blog.php'); 

  } else {  
       
   include('category-produtos.php');  
	
  };   

//php------------- 

O mesmo se costuma se aplicar em sua pagina single. Neste caso há uma ligeira modificação :


 //php-------------    

   if(get_post_type() == 'produtos'){
    include('single-produto.php');
   }else{ 
    include('single-blog.php');
   };      

 //php------------- 

   
== Donations ==    
Wp Store precisa de você!
Faça uma doação em : http://wpstore.com.br/download