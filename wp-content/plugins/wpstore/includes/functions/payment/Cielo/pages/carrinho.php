<?php 
	//require "../includes/include.php";
	
	$txtPrint .="

		<form action='".verifyURL(get_bloginfo('url'))."/pedido/?order=$idPedido#pagamento' method='post' >";
		
		
			 /*
					$txtPrint .=	"<p>Produto</p>
					<p>
						<select name='produto'>
							<option value='10000'>Celular - R$ 100,00</option>						
							<option value='37057'>Celular - R$ 370,57</option>					
							<option value='200000'>iPhone - R$ 2.000,00</option>
							<option value='999000000'>Legacy 500 - R$ 9.990.000,00</option>
							<option value='0'>Injeção - R$ 0,00</option>
							<option value='799990'>TV 46 LED - R$ 7.999,90</option>
							<option value='100'>Bala Chita - R$ 1,00</option>
						</select></p>";
					
					*/
					
					?>
					
					
					
					<?php
					
					/*
					    <td>
						<select name="codigoBandeira">
							<option value="visa">Visa</option>
							<option value="mastercard">Mastercard</option>
							<option value="elo">Elo</option>
						</select>
						<br/>	
						
										
						<input type="radio" name="formaPagamento" value="A">Débito
						<br><input type="radio" name="formaPagamento" value="1" checked>Crédito à Vista
						<br><input type="radio" name="formaPagamento" value="3">3x
						<br><input type="radio" name="formaPagamento" value="6">6x
						<br><input type="radio" name="formaPagamento" value="12">12x
						<br><input type="radio" name="formaPagamento" value="18">18x
						<br><input type="radio" name="formaPagamento" value="36">36x
						<br><input type="radio" name="formaPagamento" value="56">56x
						
						
					</td>
					
					(*/ ?>
					
					
					
					
					<?php
					
					
					
					
					$txtPrint .="
					
		          	<h3>Forma de pagamento</h3>
                          <span style='background:#ddd;margin-left:5px;padding:10px'> <input type='radio' class='tipoPagto' name='formaPagamento' value='1' checked='yes'>  CRÉDITO A VISTA </span>
                          <span style='background:#ddd;margin-left:5px;padding:10px' >   <input type='radio' class='tipoPagto' name='formaPagamento' value='2'>CRÉDITO PARCELADO  </span><br/><br/>";





                                             $txtPrint .="<div class='forme' id='parcelasDiv'  style='display:none' >
                                             	          <p style='font-size:10px' >  <select  id='parcelas' name='parcelas'  >
                                                               ";

                                             if($valorF/2 > 500){                       
                                             $txtPrint .="<option value='2' >2 Parcelas</option>";
                                             }
                                             if($valorF/3 > 500){   	                     
                                             $txtPrint .="<option value='3'>3 Parcelas</option>";
                                             } 
                                             if($valorF/4 > 500){ 	                     
                                             $txtPrint .=" <option value='4'>4 Parcelas</option>";
                                             } 
                                             if($valorF/5 > 500){ 	                     
                                             $txtPrint .="<option value='5'>5 Parcelas</option>";
                                             }  
                                             if($valorF/6 > 500){	                     
                                             $txtPrint .="<option value='6'>6 Parcelas</option>";
                                             }   
                                             
                                             
                                            // if($valorF > 100000){
                                             
                                                 if($valorF/7 > 500){	                     
                                                 $txtPrint .="<option value='7'>7 Parcelas</option>";
                                                 }
                                              
                                                  if($valorF/8 > 500){	                     
                                                  $txtPrint .="<option value='8'>8 Parcelas</option>";
                                                  }
                                               
                                                  if($valorF/9 > 500){	                     
                                                  $txtPrint .="<option value='9'>9 Parcelas</option>";
                                                  }
                                                
                                                  if($valorF/10 > 500){	                     
                                                   $txtPrint .="<option value='10'>10 Parcelas</option>";
                                                   }	
                                               
                                             //  }; // end if compra >100                    

                                                $totalParcela = get_totalParcela();   

                                             $txtPrint .="</select> 


                                                 *Parcelamento em até ".$totalParcela."X sem juros : Somente nas compras cima de  R$10.00  (Parcela mínima de R$5.00)</p>

                                             </div>

                                             ";


                              //$txtPrint .="DÉBITO <input type='radio' class='tipoPagto' name='formaPagamento' value='A'><br/><br/>";
                                 
                              $txtPrint .="<br/><br/>



                 			<h4>Selecione a bandeira do cartão</h4>

                             <div class='PagtoForm ' style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px;margin-top:5px;margin-top:5px'><input type='radio' name='codigoBandeira' value='mastercard' checked='yes'><img class='band' src='".$plugin_directory."images/mastercard2.png' alt='mastercard' width='69' height='44' />
                             MASTER</div>
                            
                             <div class='PagtoForm debito' style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px;margin-top:5px'> <input type='radio' name='codigoBandeira' value='visa'> <img class='band' src='".$plugin_directory."images/visa.png' alt='visa' width='69' height='44' />
                             VISA</div>
                      
                             <div class='PagtoForm' style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'><input type='radio' name='codigoBandeira' value='diners'> <img class='band' src='".$plugin_directory."images/diners.png' alt='dinners' width='69' height='44' />
                             DINERS</div>
                          ";
                             /*
                               $txtPrint .="
                             <div class='PagtoForm'><img class='band' src='".$plugin_directory."images/american.png' alt='amex' width='69' height='44' />
                             AMERICAN EXPRESS<input type='radio' name='codigoBandeira' value='amex'></div>
                             <br/>";
                             */
                             
                              $txtPrint .= "
                             <div class='PagtoForm' style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px' >  <input type='radio' name='codigoBandeira' value='elo'> <img class='band' src='".$plugin_directory."images/elo.png' alt='elo' width='69' height='44' />
                           ELO</div>
                          
                             <div class='PagtoForm discovery' style='float:left;background:#ddd;margin-left:5px;padding:10px;margin-top:5px'><input type='radio' name='codigoBandeira' value='discover'>  <img class='band' src='".$plugin_directory."images/discovery.png' alt='discovery' width='69' height='44' />
                            DISCOVER</div>
                            ";  
 
           $txtPrint .= "  
                 
                    <script>

                       jQuery('.tipoPagto').change(function() {

                            tipo = jQuery(this).val();
                            jQuery('#parcelasDiv').hide();
                            if(tipo=='A'){
                                  jQuery('.PagtoForm').hide();  
                                  jQuery('.debito').fadeIn();
                             }else{
                                    jQuery('.PagtoForm').fadeIn();
                                    if(tipo=='2'){
                                    jQuery('.discovery').hide();
                                    jQuery('#parcelasDiv').show();
                                    };
                             };

                       });





                            jQuery('#parcelas').change(function() {

                                     qtdParc = jQuery(this).val();
                                     enviaParcela(qtdParc);


                            });


                          function   enviaParcela(parcela){

                           // alert(parcela);
                             var baseUrl = jQuery('meta[name=urlShop]').attr('content');
                             baseUrl = baseUrl.replace('ajax', 'functions');
                            jQuery.post(baseUrl+'payment/Redecard/confirmaIntencaoPagtoRedecard.php', { parc: parcela },
                                function(data) {
                                 //alert('Enviou...');
                             });

                         };



                        </script>";
                        
                  
                    ?>
                    
             
				
				<?php /*
				<tr>
					<td>Configuração</td>
					<td>
						<table>
							<tr>
								<td>
									Parcelamento
								</td>
								<td>
									<select name="tipoParcelamento">
										<option value="2">Loja</option>
										<option value="3">Administradora</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Capturar Automaticamente?</td>
								<td>
									<select name="capturarAutomaticamente">
										<option value="true">Sim</option>
										<option value="false" selected="selected">Não</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Autorização Automática</td>
								<td>
									<select name="indicadorAutorizacao">
										<option value="3">Autorizar Direto</option>
										<option value="2">Autorizar transação autenticada e não-autenticada</option>
										<option value="0">Somente autenticar a transação</option>
										<option value="1">Autorizar transação somente se autenticada</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>	
				
				<?php */ ?>
				
				
					
			<?php
			
				$txtPrint .="	<div class='clear'></div><br/><p><input type='submit' value='Pagar' class='button' /></p>
				 
		</form>
		
		<br/><br/><br/><br/>"; ?>
		 