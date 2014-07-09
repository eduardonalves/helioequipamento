<?php


$emailMoip = get_option('emailMoip');        
 
/* */   


$total = getPriceFormat($total);
$total = str_replace(',','',$total);
$total = str_replace('.','',$total);

$txtPrint .='

<form action="https://www.moip.com.br/PagamentoMoIP.do" method="post" target="BLANK"> 
    
  

<input type="hidden" name="id_carteira" value="'.$emailMoip.'">
 
<input type="hidden" name="valor" value="'.$total.'">   

<input type="hidden" name="nome" value="'.get_bloginfo('name').'"> 

<input type="hidden" name="descricao" value="'.$descProdutos.'"> 


<input type="hidden" name="id_transacao" value="'.$idPedido.'">    


<input type="hidden" name="frete" value="1">   

<input type="hidden" name="peso_compra" value="'.$pesoTotal.'">  
 
<INPUT TYPE="hidden" NAME="pagador_nome" VALUE="'.$current_user->user_firstname.' '.$current_user->user_lastname.' ">

<INPUT TYPE="hidden" NAME="pagador_logradouro" VALUE="'.$userEndereco.'">   

<INPUT TYPE="hidden" NAME="pagador_numero" VALUE="'.$userNumero.'">   
 
<INPUT TYPE="hidden" NAME="pagador_complemento" VALUE="'.$userComplemento.'">              
 

<INPUT TYPE="hidden" NAME="pagador_bairro" VALUE="'.$userBairro.'">      

<INPUT TYPE="hidden" NAME="pagador_cidade" VALUE="'.$userCidade.'">
<INPUT TYPE="hidden" NAME="pagador_estado" VALUE="'.$userEstado.'">
<INPUT TYPE="hidden" NAME="pagador_cep" VALUE="'.$userCep.'"> 

<INPUT TYPE="hidden" NAME="pagador_email" VALUE="'.$userEmail.'">   

<INPUT TYPE="hidden" NAME="pagador_telefone" VALUE="'.$userDDD.' '.$userTelefone.'">  

<INPUT TYPE="hidden" NAME="pagador_celular" VALUE="'.$userDDDCelular.' '.$userCelular.'">  

<INPUT TYPE="hidden" NAME="pagador_cpf" VALUE="'.$userCpf.'"> 

<INPUT TYPE="hidden" NAME="pagador_sexo" VALUE="'.$userSexo.'">   
 
<INPUT TYPE="hidden" NAME="pagador_data_nascimento" VALUE="'.$userNascimento.'"> 

<INPUT TYPE="hidden" NAME="notify_url" VALUE="'.get_bloginfo('url').'/?cdp='.$idPedido.'"> 
  
 <input type="image" name="submit" src="https://static.moip.com.br/imgs/buttons/bt_pagar_c01_e04.png" alt="Pagar com Moip" border="0" />


</form>
';  

 
?>
 