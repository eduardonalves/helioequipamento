<?php  

       require("../../../../../wp-load.php"); 	 
       
       
        global $current_user;
        
        $moedaCorrente  =  get_option('moedaCorrenteWPSHOP');
        if($moedaCorrente==""){
          $moedaCorrente = "R$" ; 
        }

        get_currentuserinfo(); 
        
        $msgError = "";
        $idUser = $current_user->ID;
        
        
        $postIDP = intval($_REQUEST['postIDP']);
        
             
        $user_email =  $current_user->user_email ;

        if(intval($current_user->ID)<=0){
           $msgError =  "Permissão Administrativa negada";
        }



         if ( current_user_can('edit_post',  $postIDP)  ) {

         }else{

          $msgError =  "Permissão Administrativa temporariamente indisponível";

         }
                   
                   
        if($msgError==""){
            
               $nome  = 'tamanhoCor';
               $contagemVariacao = 0;
               
               
               
               $arrayTamanhos = array();
               $arrayCores = array();
               $arrayCoresImg = array();
               
               
               
               
                global $wpdb; 
                $contagem = 0;
                


                $tabela = $wpdb->prefix."";
                $tabela .=  "wpstore_stock";

               $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$postIDP' AND  `tipoVariacao` = 'cor' ORDER BY `variacaoProduto` ASC  LIMIT 0 , 100";

               $fivesdraftsCor = $wpdb->get_results( $sql);

               foreach ( $fivesdraftsCor as $fivesdraftC ){



                   $arrayCores[] = $fivesdraftC->variacaoProduto; 
                   $arrayCoresImg[] = $fivesdraftC->imgAlternativa;
                   
               };
               
               
 
                      $tabela = $wpdb->prefix."";
                      $tabela .=  "wpstore_stock";

                      $sql = "SELECT * FROM `$tabela` WHERE  	`idPost` = '$postIDP' AND  `tipoVariacao` = 'tamanho'  ORDER BY `variacaoProduto` ASC   LIMIT 0 , 100";

                      $fivesdraftsTamanho = $wpdb->get_results( $sql);

                      foreach ( $fivesdraftsTamanho as $fivesdraftT ) 
                      {

                      $arrayTamanhos[] = $fivesdraftT->variacaoProduto;
                      
                       };
               
 

               if(count($arrayTamanhos )>0 && count($arrayCores) >0){ 

               foreach($arrayTamanhos as $tamanho){

                   echo "<h3> $tamanho</h3>";


                    foreach($arrayCores as $key=>$cor){ 

                        $corTamanho = trim( str_replace(' ','',$tamanho) )."-".trim( str_replace(' ','',$cor) );


                              $tabela = $wpdb->prefix."";
                               $tabela .=  "wpstore_stock";

                               $sql = "SELECT * FROM `$tabela` WHERE `variacaoProduto` = '$corTamanho'  AND  `tipoVariacao` = '$nome' AND idPost='$postIDP'  ORDER BY `variacaoProduto` ASC  ";

                               $fivesdraftsTamanhoCor = $wpdb->get_results( $sql);


                               $idTamanhoCor = '';
                               $qtd = 0 ;
                               $operacao ="";
                               $valor = "";
                                   
                               foreach ( $fivesdraftsTamanhoCor as $fivesdraftTC ) {
                                   
                                $qtd = 0 ;
                                $idTamanhoCor = intval($fivesdraftTC->id);
                                $qtd = intval($fivesdraftTC->qtdProduto);
                                
                                 $valor =  getPriceFormat($fivesdraftTC->precoAlternativo);

                                 if(trim($valor)=="" || $valor=="undefined" || $valor =='0'){
                                  $valor  = 0.00;
                                 }

                                $operacao = $fivesdraftTC->precoOperacao;
                                       

                               };


                                $contagemVariacao  += 1;
                                $idTamanhoCor =   "0000".$contagemVariacao;

                                $imgAlternativa =   $arrayCoresImg[$key];
                                if($imgAlternativa=="#F4F4F4"){
                                    
                                }
                                
                        
                        ?>


                                  <p  class='itemStock loadItem <?php echo $idTamanhoCor; ?>'  rel="<?php echo $idTamanhoCor; ?>" >
                                  <span style="display:block;width:15px;height:15px;margin:5px;padding:5px;background-color:<?php echo $imgAlternativa; ?>"><?php echo $tamanho; ?></span> 
                                  Nome <?php echo $nome; ?> : <input type='text' name='<?php echo $nome; ?>Nome<?php echo $idTamanhoCor; ?>' id="<?php echo $nome; ?>Nome<?php echo $idTamanhoCor; ?>"  value="<?php echo $corTamanho; ?>" style="width:300px"  readonly="readonly" />  
                                  Diferença de Preço : <select name="<?php echo $nome; ?>Symbol<?php echo $corTamanho; ?>" id="<?php echo $nome; ?>Symbol<?php echo $idTamanhoCor; ?>" ><option>+</option><option <?php if($operacao=="-"){ echo 'selected'; }; ?> >-</option></select>  
                                  <?php echo $moedaCorrente; ?> <input type='text'  class="preco" name='<?php echo $nome; ?>Valor<?php echo $corTamanho; ?>' value="<?php echo $valor; ?>" id="<?php echo $nome; ?>Valor<?php echo $idTamanhoCor; ?>" style="width:60px"/>
                                  <br/>Quantidade disponível :<input type='text'  class="qtd" name='<?php echo $nome; ?>Qtd<?php echo $corTamanho; ?>' value="<?php echo $qtd; ?>" id="<?php echo $nome; ?>Qtd<?php echo $idTamanhoCor; ?>" style="width:60px"/>
                                  <input type="button" id="<?php echo $nome; ?>Edit" name="<?php echo $nome; ?>Edit" style="width:110px" value="Atualizar"  class="editITem<?php echo $idTamanhoCor; ?>"  rel='<?php echo $nome; ?>' rev="<?php echo $idTamanhoCor; ?>" />
                                  
                                  
                                   <?php

          
                                    $qtd = custom_get_qtd_stock($postIDP,trim(str_replace(' ','',$cor)),trim( str_replace(' ','',$tamanho) ) , true); 
                                    

                                    $qtdReservaUsuario = custom_get_stock_reservaUsuario($postIDP, $corTamanho);

                                    $qtdVendida = custom_get_qtd_vendida($postIDP , $cor ,$tamanho);

                                    $qtdProdutoF =  ($qtd - $qtdReservaUsuario) - $qtdVendida;
                                  ?>

                                  <br/> <span >qtd Cadastrada: <?php echo  $qtd; ?>
                                  <br/> <span >qtd Vendida : <?php echo  $qtdVendida; ?>
                                  <br/>  </span> <span >qtd Disponível : <?php echo $qtdProdutoF; ?> </span>
                                  
                                   </p>




                        <?php
                     };
                 };  


                 };   

                 ?>

                      <?php 

                          if(intval( $contagemVariacao )==0){
                            echo "<p class='msg$nome'>Ainda Não foi cadastrada  mais de uma  variação de estoque para este produto. Se o produto possui mais de um tipo de variação, como por exemplo <strong>Tamanhos e Cores diferenciadas</strong> , cadastre nas opções  acima cada variante do produto e então retorne aqui para editar a quantidade de cada combinação gerada . Se seu produto possúi somente 1 tipo de variação, como por exemplo <strong> somente Cores ou somente tamanhos diferenciados</strong> basta editar a quantidade de cada variação diretamente nas ferramentas <strong>Editar Cores</strong> ou <strong>Editar Tamanhos</strong> localizadas logo acima.</p>";  
                          };
                          
                      }else{
                          echo $msgError;
                      };

                          ?>