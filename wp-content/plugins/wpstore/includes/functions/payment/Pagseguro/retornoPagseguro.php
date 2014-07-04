<?php

 if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
     
     
     $emailPagseguro = get_option('emailPagseguro');
     $tokenPagseguro =  get_option('tokenPagseguro');


     $email = "$emailPagseguro";
     $token = "$tokenPagseguro";
     //montando URL de verificacao
     $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $email . '&token=' . $token;
     //Agora vamos chamar o CURL e passar como endereço, a URL que acabamos de montar.
     $curl = curl_init($url);
     //Vamos configurar o CURL para não verificar os certificados SSL do PagSeguro.
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     //Como precisamos da resposta do servidor do PagSeguro então vamos marcar no CURL que é para ele trazer uma resposta.
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     //Hora de executar o CURL, ele deverá retornar a resposta do servidor do PagSeguro, que deverá ser um XML, iremos gravar essa informação na variavel $transaction
     $transaction= curl_exec($curl);
     
     /*
     
     Se seu token estiver errado dentro de $transaction irá ter o texto: Unauthorized
     Nesse caso podemos verificar se tem isso e chamar uma função para enviar um e-mail informando informando a alguém responsável para inserir novo token ou e-mail , ou o que se adaptar melhor ao seu sistema. Aconselho inserir um exit para não correr o risco de o código continuar e sair dando erro em tudo que é coisa pela frente
     
     */

     
     if($transaction == 'Unauthorized'){
         //Insira seu código avisando que o sistema está com problemas, sugiro enviar um e-mail avisando para alguém fazer a manutenção 
         //CRIANDO LOG ----------------------------------
         $dataLog = gmdate('d/m/Y');
         $name = 'logPagseguro.txt';
         $text = "-------------TRANSACAO NAO AUTORIZADA ($dataLog)__________".$transaction;
         $file = fopen($name, 'a');
         fwrite($file, $text);
         fclose($file);
         //FINAL CRIANDO LOG ----------------------------------
        exit;//Mantenha essa linha
     }
     
     //Não iremos precisar mais do CURL, então vamos fechar
     curl_close($curl);
     
     //O XML recebido é inutil se não conseguirmos manipular, então vamos transformar o XML em um objeto.
     $transaction = simplexml_load_string($transaction);
     
     //EMAIL COMPRADOR ==>   $transaction -> sender -> email;
     
     //STATUS ==>  $transaction -> status;
     
     //REFERENCE ==>$transaction -> reference;
     
      $date = $transaction->date;
      $idPedido = $transaction->reference;
      $status = $transaction->status; // STATUS MAIS IMPORTANTES : Aguardando pagamento, Em análise, Paga, Disponível, Em disputa, Devolvida, Cancelada,
   
      $metododePagamento = $transaction->paymentMethod->type;
      $meiodePagamento = $transaction->paymentMethod->code;
      
      $valorTotal = $transaction->grossAmount;
      $valorTaxaPagseguro = $transaction->feeAmount;
      $dataDisponibilidade = $transaction->escrowEndDate;
      $numeroParcelas = $transaction->installmentCount;
      $numeroItems = $transaction->itemCount;
      
      
      //METODOS DE PAGTO -----------------------------
      if(intval($metododePagamento)==1 ){
          $metododePagamento = "Cartão de crédito";
      }elseif(intval($metododePagamento)==2 ){
           $metododePagamento = "Boleto";
      }elseif(intval($metododePagamento)==3 ){
           $metododePagamento = "Débito online (TEF)";
      }elseif(intval($metododePagamento)==4 ){
           $metododePagamento = "Saldo PagSeguro";
      }elseif(intval($metododePagamento)==5 ){
           $metododePagamento = "Oi Paggo";
      }
      //FINAL METODOS DE PAGTO ----------------
      
      
      
     
      
      // BANDEIRA/BANCO DE PAGTO ----------------
      if( intval($meiodePagamento)  == 101 ){	//Cartão de crédito Visa.
           $meiodePagamento = "Cartão de crédito Visa";
      }elseif( intval($meiodePagamento)  == 102 ){	//Cartão de crédito MasterCard.
           $meiodePagamento = "Cartão de crédito MasterCard";
      }elseif( intval($meiodePagamento)  == 103 ){	//Cartão de crédito American Express.
           $meiodePagamento = "Cartão de crédito American Express";
      }elseif( intval($meiodePagamento)  == 104 ){	//Cartão de crédito Diners.
           $meiodePagamento = "Cartão de crédito Diners";
      }elseif( intval($meiodePagamento)  == 105 ){	//Cartão de crédito Hipercard.
           $meiodePagamento = "Cartão de crédito Hipercard";
      }elseif( intval($meiodePagamento)  == 106 ){	//Cartão de crédito Aura.
           $meiodePagamento = "Cartão de crédito Aura";
      }elseif( intval($meiodePagamento)  == 107 ){	//Cartão de crédito Elo.
           $meiodePagamento = "Cartão de crédito Elo";
      }elseif( intval($meiodePagamento)  == 108 ){	//Cartão de crédito PLENOCard.
           $meiodePagamento = "Cartão de crédito PLENOCard";
      }elseif( intval($meiodePagamento)  == 109 ){	//Cartão de crédito PersonalCard.
           $meiodePagamento = "Cartão de crédito PersonalCard";
      }elseif( intval($meiodePagamento)  == 110 ){	//Cartão de crédito JCB.
           $meiodePagamento = "Cartão de crédito JCB";
      }elseif( intval($meiodePagamento)  == 111 ){	//Cartão de crédito Discover.
           $meiodePagamento = "Cartão de crédito Discover";
      }elseif( intval($meiodePagamento)  == 112 ){	//Cartão de crédito BrasilCard.
           $meiodePagamento = "Cartão de crédito BrasilCard";
      }elseif( intval($meiodePagamento)  == 113 ){	//Cartão de crédito FORTBRASIL.
           $meiodePagamento = "Cartão de crédito FORTBRASIL";
      }elseif( intval($meiodePagamento)  == 201 ){	//Boleto Bradesco. *
           $meiodePagamento = "Boleto Bradesco";
      }elseif( intval($meiodePagamento)  == 202 ){	//Boleto Santander.
           $meiodePagamento = "Boleto Santander";
      }elseif( intval($meiodePagamento)  == 301 ){	//Débito online Bradesco.
           $meiodePagamento = "Débito online Bradesco";
      }elseif( intval($meiodePagamento)  == 302 ){	//Débito online Itaú.
           $meiodePagamento = "Débito online Itaú";
      }elseif( intval($meiodePagamento)  == 303 ){	//Débito online Unibanco. *
           $meiodePagamento = "Débito online Unibanco";
      }elseif( intval($meiodePagamento)  == 304 ){	//Débito online Banco do Brasil.
           $meiodePagamento = "Débito online Banco do Brasil";
      }elseif( intval($meiodePagamento)  == 305 ){	//Débito online Banco Real. *
           $meiodePagamento = "Débito online Banco Real";
      }elseif( intval($meiodePagamento)  == 306 ){	//Débito online Banrisul.
           $meiodePagamento = "Débito online Banrisul";
      }elseif( intval($meiodePagamento)  == 307 ){	//Débito online HSBC.
           $meiodePagamento = "Débito online HSBC";
      }elseif( intval($meiodePagamento)  == 401 ){	//Saldo PagSeguro.
           $meiodePagamento = "Saldo PagSeguro";
      }elseif( intval($meiodePagamento)  == 501 ){	//Oi Paggo.
      $meiodePagamento = "Oi Paggo";
      };
      //BANDEIRA BANCO DE PAGTO ----------------
      
      
      
      
      
      //SALVANDO NO BANCO DE DADOS A ALTERACAO DO PEDIDO
        if(intval($status) == 1){  //Aguardando Pagamento
              $msg = "$status - Pagseguro Aguardando Pagamento - $idPedido : $metododePagamento $meiodePagamento - Notificado em:".$date ; 
               
              $statusPedido = getStatusPedido($idPedido);
              if($statusPedido != "APROVADO"){
              alteraPedidoStatus($idPedido,'PENDENTE',$msg,'','');     
              };
              
         }elseif(intval($status) ==   2){//'Em análise'
           $msg = " $status - Pagseguro Verificando pagamento - $idPedido : $metododePagamento $meiodePagamento - Notificado em:".$date ;
               $statusPedido = getStatusPedido($idPedido);
             if($statusPedido != "APROVADO"){
               alteraPedidoStatus($idPedido,'VERIFICANDO',$msg,'','');
                };   
         }elseif(intval($status) == 3){  //Paga
           $msg = "$status - Pagseguro Autoriza Pagamento  - $idPedido : $metododePagamento $meiodePagamento - Notificado em:".$date ;
           calteraPedidoStatus($idPedido,'APROVADO',$msg,'','');
         }elseif(intval($status) == 7 ){//'Cancelada'
           $origemCancelamento = $transaction ->cancellationSource;
           $msg = "$status - Pagseguro Cancela Pagamento  - $idPedido : $metododePagamento $meiodePagamento  |  Origem : $origemCancelamento - Notificado em:".$date;
                 $statusPedido = getStatusPedido($idPedido);
             if($statusPedido != "APROVADO"){
               alteraPedidoStatus($idPedido,'CANCELADO',$msg,'','');
           };
         }else{
               $msg = "$status - Pagseguro Aguardando Retorno Pagamento  - $idPedido : $metododePagamento $meiodePagamento - Notificado em:".$date ;
                 $statusPedido = getStatusPedido($idPedido);
                 if($statusPedido != "APROVADO"){
               alteraPedidoStatus($idPedido,'PENDENTE',$msg,'','');  
               };
        
         };
      //SALVANDO NO BANCO DE DADOS A ALTERACAO DO PEDIDO
     
     
     
     //CRIANDO LOG ----------------------------------
     $dataLog = $date ;
     $name = 'logPagseguro.txt';
     $text = "-------------TRANSACAO ($dataLog)__________".$transaction;
     $file = fopen($name, 'a');
     fwrite($file, $text);
     fclose($file);
     //FINAL CRIANDO LOG ----------------------------------
     
 };
 
 	
 
?>