<?php


$emailPaypal = get_option('emailPaypal');        
$currentCodePaypal  = get_option('currentCodePaypal');         

//0.40 ->PRECO  
    $frete = str_replace(',','*', $frete);
    $frete = str_replace('.',',', $frete);
    $frete = str_replace('*','.', $frete);
    

$txtPrint .='

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="BLANK"> 
    
<input type="hidden" name="cmd" value="_cart">      

<input type="hidden" name="upload" value="1">       

<input type="hidden" name="business" value="'.$emailPaypal.'">
<input type="hidden" name="currency_code" value="'.$currentCodePaypal.'">
 

'.$inputsProdutos.'


<input type="hidden" name="shipping_1" value="'.$frete.'">
<input type="hidden" name="shipping_2" value="00.00"> 
 
<input type="hidden" name="lc" value="BR">
<INPUT TYPE="hidden" name="charset" value="utf-8"> 
 

<INPUT TYPE="hidden" NAME="first_name" VALUE="'.$current_user->user_firstname.'">
<INPUT TYPE="hidden" NAME="last_name" VALUE="'.$current_user->user_lastname.'">
<INPUT TYPE="hidden" NAME="address1" VALUE="'.$userEndereco.'">
<INPUT TYPE="hidden" NAME="address2" VALUE="'.$userBairro.'">  
<INPUT TYPE="hidden" NAME="city" VALUE="'.$userCidade.'">
<INPUT TYPE="hidden" NAME="state" VALUE="'.$userEstado.'">
<INPUT TYPE="hidden" NAME="zip" VALUE="'.$userCep.'">
<INPUT TYPE="hidden" NAME="email" VALUE="'.$userEmail.'">
<INPUT TYPE="hidden" NAME="night_phone_a" VALUE="'.$userDDD.'">
<INPUT TYPE="hidden" NAME="night_phone_b" VALUE="'.$userTelefone.'">  


<INPUT TYPE="hidden" NAME="shopping_url" VALUE="'.get_bloginfo('url').'"> 
<INPUT TYPE="hidden" NAME="return" VALUE="'.get_bloginfo('url').'"> 
<INPUT TYPE="hidden" NAME="rm" VALUE="0">    

<INPUT TYPE="hidden" NAME="notify_url" VALUE="'.get_bloginfo('url').'/?cdp='.$idPedido.'"> 
  

                                 
<input type="image" src="https://www.paypal.com/pt_BR/i/btn/btn_xpressCheckout.gif" name="submit" alt="Make payments with PayPal - its fast, free and secure!">

</form>
';   
 

?>