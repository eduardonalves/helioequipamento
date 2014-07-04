<?php
 
 
   if( $_POST['submit']=="Salvar" ){
         
         $logoSite = trim($_POST['logoSite']);
         add_option('logoSiteWPSHOP',$logoSite,'','yes'); 
         update_option('logoSiteWPSHOP',$logoSite);
         
         $tipoSkinShop = trim($_POST['tipoSkinShop']);
         
         add_option('tipoSkinShop',$tipoSkinShop,'','yes'); 
          update_option('tipoSkinShop',$tipoSkinShop);
          
          
           $exibirFreteSingle = trim($_POST['exibirFreteSingle']);
          add_option('exibirFreteSingle',$exibirFreteSingle,'','yes'); 
           update_option('exibirFreteSingle',$exibirFreteSingle);
           
            $exibeQtdProd = trim($_POST['exibeQtdProd']);
           add_option('exibeQtdProd',$exibeQtdProd,'','yes'); 
            update_option('exibeQtdProd',$exibeQtdProd);
           
         
         
         
         
                                                   if (isset( $_POST['exibirTabela'] )) {
                                                               $exibirTabela = "sim"; 
                                                               add_option('exibirTabelaWPSHOP',$exibirTabela,'','yes'); 
                                                               update_option('exibirTabelaWPSHOP',$exibirTabela);
                                                     }else{
                                                          $exibirTabela = "não"; 
                                                           add_option('exibirTabelaWPSHOP',$exibirTabela,'','yes'); 
                                                           update_option('exibirTabelaWPSHOP',$exibirTabela);
                                                     }



                                           $imagemTabela= trim($_POST['imagemTabela']); 
                                           add_option('imagemTabelaWPSHOP',$imagemTabela,'','yes'); 
                                           update_option('imagemTabelaWPSHOP',$imagemTabela);
                                           
                                            
                                            
                                              $imagemTabela= trim($_POST['imagemTabela']); 
                                               add_option('imagemTabelaWPSHOP',$imagemTabela,'','yes'); 
                                               update_option('imagemTabelaWPSHOP',$imagemTabela);
                                               
                                                 $imagemTabela= trim($_POST['imagemTabela']); 
                                                  add_option('imagemTabelaWPSHOP',$imagemTabela,'','yes'); 
                                                  update_option('imagemTabelaWPSHOP',$imagemTabela);
                                                  
                                                    $totalPostListagemPRel= trim($_POST['totalPostListagemPRel']); 
                                                     add_option('totalPostListagemPRel',$totalPostListagemPRel,'','yes'); 
                                                     update_option('totalPostListagemPRel',$totalPostListagemPRel); 
                                  
                                                
                                                       $listagemPRelOrder= trim($_POST['listagemPRelOrder']); 
                                                          add_option('listagemPRelOrder',$listagemPRelOrder,'','yes'); 
                                                          update_option('listagemPRelOrder',$listagemPRelOrder);
                                                          
                                                
                                                      $listagemPRelOrderby = trim($_POST['listagemPRelOrderby']); 
                                                       add_option('listagemPRelOrderby',$listagemPRelOrderby ,'','yes'); 
                                                         update_option('listagemPRelOrderby',$listagemPRelOrderby ); 
                                                         
                                                
                                                                      
                                                                        $excludeCatsProdRel = ""; 
                                                                        if(!empty($_POST['excludeCatsProdRel'])) { 
                                                                            foreach($_POST['excludeCatsProdRel'] as $check) {  
                                                                                    $excludeCatsProdRel.=$check.","; 
                                                                            }  
                                                                        }
                                                                        add_option('excludeCatsProdRel',$excludeCatsProdRel ,'','yes'); 
                                                                        update_option('excludeCatsProdRel',$excludeCatsProdRel );   
                                                         
                         
 
    };


$logoSiteWPSHOP = get_option('logoSiteWPSHOP');
$tipoSkinShop = get_option('tipoSkinShop');

$exibirFreteSingle = get_option('exibirFreteSingle');

$exibeQtdProd = get_option('exibeQtdProd');   



$imagemTabela =  get_option('imagemTabelaWPSHOP');  
$exibirTabela =  get_option('exibirTabelaWPSHOP');   


 
   $totalPostListagemPRel  =  get_option('totalPostListagemPRel');    
   $listagemPRelOrder    = get_option('listagemPRelOrder');  
   $listagemPRelOrderby   = get_option('listagemPRelOrderby');  
   
   $excludeCatsProdRel  = get_option('excludeCatsProdRel');  

?>

 
<form action="<?php echo verifyURL(get_option( 'siteurl' )) ."/wp-admin/admin.php?page=lista_design";?>"  method="post" >

  
 
 
 
 
 
 
 
 
 
 
 <div id="cabecalho">
 	<ul class="abas">
 		<li>
 			<div class="aba gradient">
 				<span>Opções Gerais</span>
 			</div>
 		</li>  

 		 <?php /* 
 		<li>
 			<div class="aba gradient">
 				<span>Homepage</span>
 			</div>
 		</li>
 		<li>
 			<div class="aba gradient">
 				<span>Slide Home</span>
 			</div>
 		</li>
 		<li>
 			<div class="aba gradient">
 				<span>Sidebar</span>
 			</div>
 		</li>                   

 					*/ ?>      

 		<div class="clear"></div>
 	</ul>
 </div><!-- #cabecalho -->       





 <div id="containerAbas">  



 	<div class="conteudo">
 	
 
		<div class="bloco">      
			
			<h3>1) LOGO</h3>
			
			<span class="seta" rel='logo'></span>
			<div class="texto" id='logo'>
			 
			
			
            <p>Insira a URL do Logo : 
            <input type="text" id="logoSite" name="logoSite" value="<?php echo $logoSiteWPSHOP; ?>" />
            </p>
            
            
				  
			</div>
		</div><!-- .bloco -->
		
		
	  
	    <div class="bloco">      
			
			<h3>1) SKIN  </h3>
			
			<span class="seta" rel='skin'></span>
			<div class="texto" id='skin'>
			 
			
			
                <p>LIGHT : 
                <input type="radio" name="tipoSkinShop" value="LIGHT"  <?php  if($tipoSkinShop=='LIGHT' ||$tipoSkinShop=='' ){ echo "CHECKED"; }; ?> />
                </p>

                <p>DARK: 
                <input type="radio" name="tipoSkinShop" value="DARK"  <?php  if($tipoSkinShop=='DARK'){ echo "CHECKED"; }; ?> />
                </p>
            
                                <input type="submit"  name="submit" value="Salvar"   />   
				  
			</div>
		</div><!-- .bloco -->  
 

         

        <div class="bloco">      
			
			<h3>3) EXIBIR FRETE NA PAGINA DO PRODUTO  </h3>
			
			<span class="seta" rel='exibiFreteSingle'></span>
			<div class="texto" id='exibiFreteSingle'>
			 
			
	            <p>SIM : 
                <input type="radio" name="exibirFreteSingle" value="sim"  <?php  if($exibirFreteSingle=='sim' ||$tipoSkinShop=='' ){ echo "CHECKED"; }; ?> />
                </p>

                <p>NÃO: 
                <input type="radio" name="exibirFreteSingle" value="não"  <?php  if($exibirFreteSingle=='não'){ echo "CHECKED"; }; ?> />
                </p>
            
				                <input type="submit"  name="submit" value="Salvar"   />    
			</div>
		</div><!-- .bloco -->
		
		
		
 
 
                 <div class="bloco">      
			
			<h3>4) EXIBIR OPCAO  QUANTIDADE DE PRODUTOS NA PAGINA DO PRODUTO  </h3>
			
			<span class="seta" rel='exibiQtdProd'></span>
			<div class="texto" id='exibiQtdProd'>
			 
			
	           
               <p>SIM : 
               <input type="radio" name="exibeQtdProd" value="sim"  <?php  if($exibeQtdProd=='sim'  ){ echo "CHECKED"; }; ?> />
               </p>

               <p>NÃO: 
               <input type="radio" name="exibeQtdProd" value="não"  <?php  if($exibeQtdProd=='não' ||$tipoSkinShop=='' ){ echo "CHECKED"; }; ?> />
               </p>
			                  <input type="submit"  name="submit" value="Salvar"   />      
			</div>
		</div><!-- .bloco -->



 


         <div class="bloco">      
			
			<h3>5 ) Tabela de Tamanho   </h3>
			
			<span class="seta" rel='tabelaT'></span>
			<div class="texto" id='tabelaT'>
			 
			
	             <h3>Ativar Tabela de Tamanho</h3>
                 <p>Exibir tabela de tabela de tamanho no website : </p>     
                 <p><input type="checkbox" name="exibirTabela"  <?php if($exibirTabela=="sim"){ echo "CHECKED"; }; ?> /> Selecione para exibir a tabela de tamanhos na pagina do produto.</p>    
                </p> 
                <h3>URL da tabela de tamanho  </h3>
                <p>Copie e cole o código de imagem com a tabela padrão de tamanho . Será exibida caso o produto não possua uma tabela própria </p>
                 <br/> 
                   <input type="text" id="imagemTabela" name="imagemTabela" value="<?php echo $imagemTabela; ?>" style="width:50%"/>
                </p>       

                <br/>
                               <input type="submit"  name="submit" value="Salvar"   />   
				  
			</div>
		</div><!-- .bloco -->






        <div class="bloco">      

 			<h3>6 ) Opções de Listagem de produtos  </h3>

 			<span class="seta" rel='opcoesLista'></span>
 			<div class="texto" id='opcoesLista'>


 	             <h2>Listagem Produtos Relacionados</h2>


                        <h3>Quantidade de Posts da listagem Produtos Relacionados</h3>   
                       <p>Digite o numero correspondente a quantidade de publicações que você quer exibir  na listagem <br/>
                           <input type="text" id="totalPostListagemPRel" name="totalPostListagemPRel" value="<?php echo $totalPostListagemPRel; ?>"  style="width:40%"/>
                           <br/>
                           <span style="font-size:11px">Ex:6. Por padrão o sistema exibirá 9 publicações.</span>
                         </p>

                         <br/>   



                           <h3>Ordenar Por</h3>   
                             <p>Escolha o tipo de ordem para exibição<br/>
                               <select id='listagemPRelOrderby' name='listagemPRelOrderby' >
                                     <option <?php if($listagemPRelOrderby=='ID'){ echo 'selected="selected"'; };  ?> >ID</option>  
                                     <option <?php if($listagemPRelOrderby=='title'){ echo 'selected="selected"'; };  ?>  >title</option>
                                     <option <?php if($listagemPRelOrderby=='date'){ echo 'selected="selected"'; };  ?>  >date</option>
                                     <option <?php if($listagemPRelOrderby=='rand'){ echo 'selected="selected"'; };  ?>  >rand</option>
                                     <option <?php if($listagemPRelOrderby=='comment_count'){ echo 'selected="selected"'; };  ?>  >comment_count</option>
                               </select>

                             </p>    

                             <h3>Ordem</h3>   
                                 <p>Escolha se a listagem será ascendente ou descendente.<br/>
                                   <select id='listagemPRelOrder' name='listagemPRelOrder' >
                                         <option <?php if($listagemPRelOrder=='ASC'){ echo 'selected="selected"'; };  ?> >ASC</option>  
                                         <option <?php if($listagemPRelOrder=='DESC'){ echo 'selected="selected"'; };  ?>  >DESC</option>
                                     </select>
                                 </p>     




                                                 <h3>Excluir Categorias da listagem  Produtos Relacionados</h3>   
                                                <p>Selecione as categorias que deseja excluir da listagem de produtos relacionados <br/>

                                                     <?php            


                                                              $arrayCats  = explode(',',$excludeCatsProdRel); 

                                                               $categories=  get_categories();      

                                                               foreach($categories as $category){        


                                                     ?>

                                                   <input type='checkbox'  name='excludeCatsProdRel[]' value='<?php echo $category->term_id; ?>' <?php if(in_array("".$category->term_id, $arrayCats)){ echo "CHECKED"; }; ?>  /> <label for='idsCatExclude'> <?php echo $category->cat_name; ?> </label><br/>


                                                     <?php }; ?>




                                                    <br/>
                                                    <span style="font-size:11px">Ex:-3,-6,-9</span>
                                                  </p>

                                                  <br/>




                 <input type="submit"  name="submit" value="Salvar"   />


 			</div>
 		</div><!-- .bloco -->
 

      

 




 	</div>  


 	<?php /*
 	<div class="conteudo">
 		Conteúdo da aba 2
 	</div>


 	<div class="conteudo">
 		Conteúdo da aba 3
 	</div>    


 	<div class="conteudo">
 		Conteúdo da aba 4
 	</div>     
 	*/ ?>




 </div><!-- .content -->






 </form>





  <script>

  jQuery('.seta').click(function(){
      rel = jQuery(this).attr('rel');
      jQuery('.texto').hide();
      jQuery('#'+rel).show();
  });    




  </script>
 
