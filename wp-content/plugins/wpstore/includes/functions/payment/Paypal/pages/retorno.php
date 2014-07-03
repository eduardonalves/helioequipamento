<?php  

 
$id_transacao = $_POST['id_transacao'];
$valor = $_POST['valor'];
$status_pagamento = $_POST['status_pagamento']; 
$status = intval($status_pagamento);
$cod_moip = $_POST['cod_moip'];
$forma_pagamento  = $_POST['forma_pagamento']; 
$tipo_pagamento  = $_POST['tipo_pagamento'];
$email_consumidor = $_POST['email_consumidor'];  

$msg2 = "$id_transacao - $valor - $status_pagamento - $cod_moip - $forma_pagamento - $tipo_pagamento - $email_consumidor";     
 
 $ok = 0;
       
         //SALVANDO NO BANCO DE DADOS A ALTERACAO DO PEDIDO  
            
           if($id_transacao !=""){
              
              $idPedido = $id_transacao;
              
            if($status==1){ //1         autorizado
              $msg = "autorizado - Pagamento já foi realizado porém ainda não foi creditado na Carteira MoIP recebedora (devido ao floating da forma de pagamento)";
              alteraPedidoStatus($idPedido,'APROVADO',$msg, $msg2,$msg2);
              $ok = 1;
            }elseif($status==2){   //2         iniciado
              $msg = "iniciado -Pagamento está sendo realizado ou janela do navegador foi fechada (pagamento abandonado)";
              alteraPedidoStatus($idPedido,'PENDENTE',$msg, $msg2,$msg2); 
              $ok = 1;    
            }elseif($status==3){  //3    boleto impresso 
              $msg = "boleto impresso - Boleto foi impresso e ainda não foi pago"; 
              alteraPedidoStatus($idPedido,'PENDENTE',$msg, $msg2,$msg2);    
              $ok = 1; 
            }elseif($status==4){   //4     concluido 
              $msg = "concluido - Pagamento já foi realizado e dinheiro já foi creditado na Carteira MoIP recebedora"; 
              alteraPedidoStatus($idPedido,'PENDENTE',$msg, $msg2,$msg2);   
              $ok = 1;  
            }elseif($status==5){    //5         cancelado     
              $msg = "cancelado - Pagamento foi cancelado pelo pagador, instituição de pagamento, MoIP ou recebedor antes de ser concluído."; 
              alteraPedidoStatus($idPedido,'CANCELADO',$msg, $msg2,$msg2); 
              $ok = 1;    
            }elseif($status==6){    //6                em análise  
               $msg = "em análise - Pagamento foi realizado com cartão de crédito e autorizado, porém está em análise pela Equipe MoIP. Ainda Não existe garantia de que será concluído. Aguarde . :)"; 
               alteraPedidoStatus($idPedido,'VERIFICANDO',$msg, $msg2,$msg2);    
               $ok = 1; 
            }elseif($status==7){    //7                   estornado  
                $msg = "estornado - Pagamento foi estornado pelo pagador, recebedor, instituição de pagamento ou MoIP"; 
                alteraPedidoStatus($idPedido,'CANCELADO',$msg, $msg2,$msg2);   
                $ok = 1;  
           };   
        
          };  
          
          
          // TODO: inicio
          // Voce deve tratar cada parametro retornado de acordo com o seu sistema
          // pegue o id_transacao e relacione com o IdProprio enviado pelo seu sistema no XML do passo 1
          // Se o seu processamento ocorrer corretamente, responda com o codigo HTTP 2XX (200, por exemplo). Se ocorrer algum erro, //retorne outro codigo (3XX, 4XX ou 5XX). Caso seu sistema retorne erro, o MoIP continuara e enviar as notificações durante uma //semana, de 30 em 30 minutos ate que o seu sistema responda com o codigo 2XX.
          // TODO: fim

          if($ok ==1){
          // enviar resposta para MOIP
          header("HTTP/1.0 200 OK");
          }
          else { 

          // se tiver algum erro de processamento nao esperado
          // loga o erro em seu sistema e
          // o MoIP continua enviando os posts para o seu sistema

          header("HTTP/1.0 404 Not Found");
          }
          
          
          
          
?>
