jQuery(document).ready(function(){
    
    
    
    

          	jQuery('input, textarea').focus(function(){
          		if (jQuery(this).val() == jQuery(this).attr("title")){
          			jQuery(this).val("");
          		}
          	}).blur(function(){
          		if (jQuery(this).val() == "") {
          			jQuery(this).val(jQuery(this).attr("title"));
          		}
          	});





      
     var baseUrl = jQuery('meta[name=urlShop]').attr("content");
     var pgsUrl = jQuery('meta[name=pgsUrl]').attr("content");
     var urlSite = jQuery('meta[name=urlSite]').attr("content");
     
 
     //ABAS MAIS INFOS -----------------------------------
     
     
     
      jQuery("div.abas ul.botoes li").click(function () {

            var v = jQuery(this).attr('id');

            jQuery("ul.botoes li").removeClass('ativo');
            jQuery(this).addClass('ativo');

            jQuery('div.abas div').hide();
            jQuery('.'+v).fadeIn();

     });

     
     
     
     //FINAL ABA MAIS INFOS -----------------------------------
     
 
 
     //thumbs change galeria Imagem Produto
        jQuery('ul.galeriaThumb li a').click(function(){   

             	 var urlItem =    jQuery(this).attr('href');

             	 jQuery('.imagem img').hide();
             	 jQuery('.imagem img').attr('src','');
              	 jQuery('.imagem img').attr('src',urlItem);  
              	 
              	 jQuery('a.imageFirst').attr('href',urlItem);   
              	 
              	 jQuery('.imagem img').fadeIn();

 	             return false;

 	    });

 	     //FINAL  thumbs change galeria Imagem Produto
 	     
      
      
         //VARIACAO COR --------------------------
         
         jQuery('li.selectVaricaoCor').click(function(){
             
    
              jQuery('p.msg').html(''); jQuery('p.msg').hide();
            
             jQuery('p.indisp').fadeOut();   
             jQuery('.btComprar').fadeIn();
             jQuery('li.selectVaricaoCor').removeClass('ativo');
             jQuery("ul.tamanhos li").removeClass('ativo');
             jQuery(this).addClass('ativo');   
             
             var variacaoNome = ""+jQuery(this).attr('rel');
             var preEstoque = ""+jQuery(this).attr('rev');
             
             if(preEstoque=='esgotado'){
               jQuery('.btComprar').hide();  
               jQuery('p.indisp').fadeIn();   
               
             };
 
             jQuery('ul.tamanhos').hide();
             jQuery('ul.'+variacaoNome).fadeIn();
             
         });
         
          //FINAL VARIACAO COR --------------------------
          
          
          
          
          
          
               //VARIACAO TAMANHO--------------------------

               jQuery('li.selectVaricaoTamanho').click(function(){
 
                    jQuery('p.msg').html(''); jQuery('p.msg').hide();
                    
                     jQuery('p.indisp').fadeOut();   
                     jQuery('.btComprar').fadeIn();
                     jQuery('li.selectVaricaoTamanho').removeClass('ativo');
                     jQuery(this).addClass('ativo');   
 
                   var variacaoNome = ""+jQuery(this).attr('rel');
                   var preEstoque = ""+jQuery(this).attr('rev');

                   if(preEstoque=='esgotado'){
                     jQuery('.btComprar').hide();  
                     jQuery('p.indisp').fadeIn();   
                     
                   };
  

               });

                //FINAL VARIACAO TAMANHO --------------------------
                
                
                
                
                  //BT INDISPONIVEL-------------------------
                  
                   jQuery('a.btAviso').click(function() {
                       
                               msg = "";
                                 jQuery('p.msg').html('<span >'+msg+'</span>');
                                 jQuery('p.msg').fadeIn();
                       
                         var postIDP = ""+jQuery('#idP').val();
                         var variacaoCorP = "";
                         var variacaoTamanhoP = "";
                         var ed = false;
                         
                          if(  verificaCor()<1 && verificaTamanho()<1  ){
                              ed = true;
                           }else{
     
                               var vC = parseInt(verificaCor());
                               if(vC>=1){
                                     ativo = ""+jQuery('ul.cores li.ativo').attr('rel'); 
                                     if(ativo=='undefined'){
                                           msg = "Escolha uma cor disponível.";
                                      }else{
                                            variacaoCorP = ativo;
                                      }
                               }; 

                               var vT =  parseInt(verificaTamanho());
                                 if(vT>=1){
                                       ativo = ""+jQuery('ul.tamanhos li.ativo').attr('rel'); 
                                       if(ativo=='undefined'){
                                           if(msg ==""){
                                            msg = "Escolha um tamanho disponível.";
                                           }else{
                                            msg = "Escolha uma cor e tamnho disponível.";   
                                           };
                                       }else{
                                            variacaoTamanhoP = ativo; 
                                       }
                                  };

                           };
                           
                         var nomeAviso = ""+jQuery('#nomeAviso').val();
                         var emailAviso = ""+jQuery('#emailAviso').val();
      
                         if(nomeAviso =="Digite seu Nome" || emailAviso =="Digite seu Email" ){
                             msg = "Preencha os dados acima para ser avisado quando este produto chegar.";
                                 jQuery('p.msg').html('<span style="color:red">'+msg+'</span>');
                                 jQuery('p.msg').fadeIn();
                                 return false;
                         }else{
                    
                              jQuery.post(baseUrl+"avisarQuandoChegar.php", {nomeAvisoR:''+nomeAviso+'' ,emailAvisoR:''+emailAviso+'' ,postIDPR:''+postIDP+'',variacaoCorPR:''+variacaoCorP+'',variacaoTamanhoPR:''+variacaoTamanhoP+''} ,
                                          function(data) {
                                                  msg = data;
                                                  jQuery('p.msg').html('<span style="color:green;font-size:0.9em">'+msg+'</span>');
                                                  jQuery('p.msg').fadeIn();
                              });
                                  
                                  
                          
                         };
                         
                         
                         
 
                          return false;
                     
                     });
         //BT INDISPONIVEL-------------------------
         
         
         
         
          //BT COMPRAR--------------------------
             jQuery('.btComprar').click(function(){
            
                 jQuery('p.msg').html(''); jQuery('p.msg').hide();
                  
          
                  var variacaoCorP = "";
                  var variacaoTamanhoP = "";
                  
                  var qtdProdutoV = ''+jQuery('#qtdProd').val();
                  
                  var postIDP = ""+jQuery('#idP').val();
                  
                 /// alert(postIDP); alert(variacaoP);
             
                  var ed = false;
                  var msg = "";
         
                  if(  verificaCor()<1 && verificaTamanho()<1  ){
                     ed = true;
                  }else{
                      
                      var vC = parseInt(verificaCor());
                      if(vC>=1){
                            ativo = ""+jQuery('ul.cores li.ativo').attr('rel');    
                            if(ativo=='undefined'){
                                  msg = "Escolha uma cor disponível.";
                             }else{
                                   variacaoCorP = ativo;
                             }
                      }; 
                      
                      var vT =  parseInt(verificaTamanho());
                       if(vT>=1){
                              ativo = ""+jQuery('ul.tamanhos li.ativo').attr('rel'); 
                              if(ativo=='undefined'){
                                  if(msg ==""){
                                   msg = "Escolha um tamanho disponível.";
                                  }else{
                                   msg = "Escolha uma cor e tamnho disponível.";   
                                  };
                              }else{
                                   variacaoTamanhoP = ativo; 
                              }
                         };
                        
                     };
                     
                
                  if(msg ==""){ ed = true;   };
                  
                  
                  if(ed ==true){
                       jQuery('.carreg').fadeIn(); 
                       jQuery.post(baseUrl+"consultaEstoque.php", { postID:postIDP, variacaoCor: variacaoCorP , variacaoTamanho:variacaoTamanhoP , qtdProduto:qtdProdutoV  },
                               function(data) { 
                                   
                                  // alert(data);
                                
                                    var preEstoque = ""+data;   
                                    jQuery('.carreg').hide(); 
                                    var stk = parseInt(preEstoque);
                                    if(stk=='1'){
                                         jQuery('p.indisp').fadeIn();   
                                         jQuery('.btComprar').fadeOut();  
                                     }else{
                                         reloadQtdItems();
                                         //jQuery('p.msg').html(data);
                                         //jQuery('p.msg').fadeIn();
                                          window.location = ""+data; 
                                     };
                       });  
                       
                  }else{  
                      jQuery('.msg').html("<span style='color:red'>"+msg+"</span>");
                      jQuery('.msg').fadeIn();
                     
                 }; 
                 
                  return false;
                  
              });
          //FINAL BT COMPRAR--------------------------
         
         
         function verificaCor(){
              var variacaoCores =  jQuery("ul.cores li").size();
              return variacaoCores;
         };
         
         function verificaTamanho(){
               var verificaTamanho =  jQuery("ul.tamanhos li").size();
               return verificaTamanho;
          };
          
          
          function reloadQtdItems(){
              jQuery.post(baseUrl+"reloadQtdItems.php", {  },
                         function(data) { 
                           
                              jQuery('a.qtdItemsCart').text(data);
              });
          };
         

 
           jQuery('.btCalcularFrete').click(function(){
               jQuery('.freteInfo').remove();
               //jQuery('<span class="freteInfo" style="font-size:12px">  Total já Incluíndo o valor do Frete ( '+relV+' ) de  '+val.toFixed(2)+'  </span>').insertAfter('.totalCart');
               
               getEndereco(); 
           });
 
 
               getEndereco(); 
            
       
             function getEndereco() { 
                        var cepDestino = ""+jQuery('input.cep').val();
                        var bairro = "";
                        var cidade = "";
                        var estado = "";
                        // Se o campo CEP não estiver vazio
                      	if(cepDestino != ""){  
                             jQuery.getJSON(baseUrl+'shipping/buscaEndereco.php?cep='+cepDestino+'', function(data) {
                      	                  jQuery.each(data, function(key, val) {
                                                 if(key=='logradouro'){  rua = ""+val; };
                                                 if(key=='bairro'){  bairro = ""+val; };
                                                 if(key=='cidade'){  cidade = ""+val; };
                                                 if(key=='uf'){  estado = ""+val; };
                                          });
                 
                                       jQuery('input.cityEntrega').val(cidade);
                                       
                                       calculaFrete();
                                       if(cidade !="" || rua !="" || bairro!="" || estado !="" ){
                                       edereco = "<span>Referência:   "+rua+" "+bairro+" "+cidade+" "+estado+"</span>";
                                       jQuery(".endereco").html(edereco);
                                       };
                              });
                          };
               }
            
            
            
            
            
            
            
            
            
             
             
            var loadCep = false;
            jQuery('input.campoCep').focusout(function() {
                   
                     var cepDestino = ""+jQuery(this).val();
                     var bairro = "";
                     var cidade = "";
                     var estado = "";
                     var rua = ""; 
                     // Se o campo CEP não estiver vazio
                   	if(cepDestino != "" &&  loadCep ==false ){      
                   	                         loadCep = true;
                   	      jQuery('.carregaCep').fadeIn();
                   	    
                          jQuery.getJSON(baseUrl+'shipping/buscaEndereco.php?cep='+cepDestino+'', function(data) {
                   	                  jQuery.each(data, function(key, val) {
                                              if(key=='logradouro'){  rua = ""+val; };
                                              if(key=='bairro'){  bairro = ""+val; };
                                              if(key=='cidade'){  cidade = ""+val; };
                                              if(key=='uf'){  estado = ""+val; };  
                                               jQuery('.carregaCep').fadeOut(); 
                                       });
                                    loadCep = false;
                                    jQuery('input#enderecoUsuario').val(rua);
                                    jQuery('input#cidadeUsuario').val(cidade);
                                    jQuery('input#bairroUsuario').val(bairro);
                                     jQuery("select#estadoUsuario option").filter(function() { return jQuery(this).val() == estado; }).prop('selected', true);
                                    
                                  
                           });
                       };
                       
                       
             });
           
             
              jQuery('input.campoCep2').focusout(function() {

                          var cepDestino = ""+jQuery(this).val();
                          var bairro = "";
                          var cidade = "";
                          var estado = "";
                          var rua = ""; 
                          // Se o campo CEP não estiver vazio
                        	if(cepDestino != "" &&  loadCep ==false ){      
                        	                         loadCep = true;
                        	      jQuery('.carregaCep').fadeIn();

                               jQuery.getJSON(baseUrl+'shipping/buscaEndereco.php?cep='+cepDestino+'', function(data) {
                        	                  jQuery.each(data, function(key, val) {
                                                   if(key=='logradouro'){  rua = ""+val; };
                                                   if(key=='bairro'){  bairro = ""+val; };
                                                   if(key=='cidade'){  cidade = ""+val; };
                                                   if(key=='uf'){  estado = ""+val; };  
                                                    jQuery('.carregaCep').fadeOut(); 
                                            });
                                         loadCep = false;
                                         jQuery('input#enderecoUsuario2').val(rua);
                                         jQuery('input#cidadeUsuario2').val(cidade);
                                         jQuery('input#bairroUsuario2').val(bairro);
                                          jQuery("select#estadoUsuario2 option").filter(function() { return jQuery(this).val() == estado; }).prop('selected', true);
                                         
                                });
                            };


                  });
                  
                  
                  
             
             
             function calculaFrete(){
                                       
                         var cepDestino = ""+jQuery('input.cep').val();
                         if(cepDestino=="" || cepDestino=="undefined" ){
                             cepDestino = ""+jQuery('input#cepUsuario2').val(); 
                                 if(cepDestino=="" || cepDestino=="unefined" ){
                                    cepDestino = ""+jQuery('input#cepUsuario').val();  
                                 }
                         }    
                         
                         var peso = ""+jQuery('input.peso').val();
                         var cityUserE = ""+jQuery('input.cityEntrega').val();
                         var idPrdV  =   ""+jQuery('input.idPrd').val();   
                           
                         //alert(cepDestino);  alert(peso);  alert(cityUserE);  alert(idPrdV);  

                        if(cepDestino != ""+jQuery('input.cep').attr('title') ){

                         jQuery('.btCalcularFrete').val('Carregando');

                         jQuery.post(baseUrl+"shipping/frete.php", {CepDestinoR:''+cepDestino+'' ,PesoR:''+peso+'' ,cityUser:''+cityUserE+'',idPrd:idPrdV} ,
                                    function(data) { 
                                        
                                       // alert(data);
                                        jQuery('p.resultFrete').html(data);
                                        jQuery('.btCalcularFrete').val('Consultar Frete');
                                        somaFrete();
                               
                         });

                         };
 
              };
              
              
              
              
     
             
                     function somaFrete(){

                      jQuery('input.radioFrete').change(function(){
                          var relV = ""+jQuery(this).attr('id');
                          var val =  ""+jQuery(this).val().replace(",", ".");
                              val = parseFloat(val);
                          var subtotal = ""+jQuery('.subtotalCart').text().replace(".", "");
                              subtotal = subtotal.replace(",", ".");
                              subtotal = parseFloat(subtotal);
                              
                          var  descontoCart = ""+jQuery('.descontoCart').text().replace(".", "");
                               descontoCart = descontoCart.replace(",", ".");
                               descontoCart  = parseFloat(descontoCart);
                          
                          var totalCart = subtotal + val - descontoCart ;
                          jQuery('.totalCart').text('RS'+totalCart.toFixed(2));
                          jQuery('.freteInfo').remove();
                          jQuery('<span class="freteInfo" style="font-size:12px">  Total já Incluíndo o valor do Frete ( '+relV+' ) de  '+val.toFixed(2)+'  </span>').insertAfter('.totalCart');

                      });

                               var relV = ""+jQuery('input.radioFrete[checked=checked]').attr('id');
                               var val =  ""+jQuery('input.radioFrete[checked=checked]').val().replace(",", ".");
                                   val = parseFloat(val);
                               var subtotal = ""+jQuery('.subtotalCart').text().replace(".", "");;
                                   subtotal = subtotal.replace(",", ".");
                                   subtotal = parseFloat(subtotal);
                                   
                              var  descontoCart = ""+jQuery('.descontoCart').text().replace(".", "");
                                   descontoCart = descontoCart.replace(",", ".");
                                   descontoCart  = parseFloat(descontoCart);
                                   
                                   
                               var totalCart = subtotal + val - descontoCart;
                               jQuery('.totalCart').text('RS'+totalCart.toFixed(2));
                               jQuery('.freteInfo').remove();
                               jQuery('<span class="freteInfo" style="font-size:12px">  Total já Incluíndo o valor do Frete ( '+relV+' ) de  '+val.toFixed(2)+'  </span>').insertAfter('.totalCart');



                     };
                     
                     
                     
                     

           
            
            
            
          
            
               jQuery('.btSeguir2').click(function() {
                  
                               resultFrete = ""+jQuery('.resultFrete').text();
                                
                                var Self = jQuery('div.block-content').eq(2);
                                var irpara = parseInt(jQuery('.checkout').offset().top);
                                              
                                if(resultFrete ==""){ 
                                    Self = jQuery('div.block-content').eq(0);
                                    alert('Edite corretamente seu CEP para endereço de entrega.');
                                    irpara =parseInt(jQuery('#entregando').offset().top);
                               };
                                
                                 //if(jQuery('.checkout .block .block-content:visible').is(Self)) return;

                                 jQuery('.checkout .block .block-content:visible').slideUp(300);
                 			     Self.slideDown(300);
                                 jQuery('.msg').html('');
                     
                                 jQuery('html, body').animate({ scrollTop: irpara }, 1000);
                                 
                });
            
                 
                jQuery('.btSeguir3').click(function() {
                      
                                    jQuery('.msg2').html('');

                                    jQuery(".carregando").fadeOut();

                                    //getCidade();
                                    
                                    var cidade="";
                                    var commentOrder = ""+jQuery('#addComentOrder').val();
                                    var radioFreteV = ""+jQuery('input[name=radioFrete]:checked').val();
                                    var varSelect =    jQuery("input[name='tipoPagto']:checked").val();
                                    
                                      goCheckout( radioFreteV , commentOrder , cidade , varSelect );
                                    //redirectCheckout( radioFreteV , commentOrder , cidade , varSelect );
                  
               });    
                  
                  
                  
            
               function redirectCheckout(radioFreteV,commentOrder,cidade,varSelect ){

                              jQuery('.btSeguir3').text('Salvando Pedido...');
                              
                              var url = pgsUrl+"?confirma=true";
                              var form = jQuery('<form action="' + url + '" method="post">' +
                                '<input type="hidden" name="radioFrete" value="' + radioFreteV + '" />'  +
                                    '<input type="hidden" name="commentOrderV" value="' + commentOrder + '" />' +
                                   '<input type="hidden" name="cidadeV" value="' + cidade + '" />' +
                                    '<input type="hidden" name="varSelectV" value="' + varSelect + '" />' +
                                '</form>');
                              jQuery('body').append(form);
                              jQuery(form).submit();
                };
                       
                       
               function goCheckout(radioFreteV,commentOrder,cidade,varSelect ){
                   
                        jQuery('.btSeguir3').text('Salvando Pedido...');
                                                //alert(""+radioFreteV);
                                    jQuery.post(baseUrl+"shipping/checkoutAJAX.php", { radioFrete:radioFreteV , commentOrderV:commentOrder,cidadeV:cidade,varSelectV:varSelect  } ,
                                               function(data) { 
                                                   
                                                            // alert(data);
                                                           arrDat = data.split("-"); 
                                                            arrDat2 = data.split("****"); 
                                                            r = parseInt(""+arrDat[0]);
                                                            m = ""+arrDat2[0];
                                                            url = ""+arrDat2[1];
                                                            //alert(url);
                                                             if( r <= 0  ){ 
                                                             }else{
                                                             jQuery('.msg2').html(m);  jQuery('.msg2').fadeIn();
                                                             jQuery('.btSeguir3').text('Redirecionando para Pagamento');
                                                             jQuery('<a href="'+url+'">Ou clique aqui para redirecionar</a>').insertAfter(this);
                                                             verificaF(r, url);
                                                             };  

                                    });

                 };
                 
                 
                 function verificaF(formVerifica , url){
                     
                     
                         if(parseInt(formVerifica) > 0){

                         window.location = ''+url+''; 
                          
         			     }else{
         		
         			     jQuery('.msg2').html('<p class="red">'+data+'</p>');  jQuery('.msg2').fadeIn();
         			       
         			     };
         			     
         			     
                 }


          
                   jQuery('.btChangeO').click(function() {
                                  jQuery('.ctChan').hide();
                                   var relProd = ""+jQuery(this).attr('rel');
                                 jQuery('.'+relProd).fadeIn();
                                   
                    });
                                   
                                         
                         
                 jQuery('ul.setas li').click(function() {
                                
                                showBigLoad();
                          
                                var relProd = ""+jQuery(this).attr('rel');
                                var revProd = ""+jQuery(this).attr('rev');
                                var classProd = ""+jQuery(this).attr('class');
                                var qtdProd = ""+jQuery('input[rev='+revProd+']').val();
                                
                                jQuery.post(baseUrl+"reloadCart.php", { relProdP:relProd , qtdProdP:qtdProd ,revProdP:revProd,classProdP:classProd  },
                                     function(data) { 
                                         
                                         //alert(data);
                                         
                                         if( parseInt(data) >=1 ){
                                         window.location = location.href;
                                         jQuery('input[rev='+revProd+']').val(data);
                                        
                                         // hideBigLoad();
                                         
                                                    if(classProd =="setaUp"){ 
                                                     jQuery("input[rev="+revProd+"]").val( parseInt(qtdProd)+1 );
                                                    }else{
                                                     jQuery("input[rev="+revProd+"]").val( parseInt(qtdProd)-1 );  
                                                    }
                                                    
                                         }else{
                                             window.location = location.href;
                                              jQuery('.alerta').remove();
                                              //hideBigLoad();
                                              jQuery(data).insertAfter('input[rev='+revProd+']');
                                        }
                               });
                               
                              
           
              });
              
              
              function showBigLoad(){
                 
                  var txt  = "<div id='janela'><div class='popup'><div class='loading'><span>Carregando</span></div></div></div>";
                  jQuery(txt).insertAfter('body');
                  jQuery('#janela').fadeIn();
                  
              };
              
               function hideBigLoad(){

                     jQuery('#janela').fadeOut();
                     jQuery('#janela').remove();

                };

       
       
       
       //LOGIN REGISTRO----------------------------------------------------------------------
       
      
       jQuery('.btForgotPass').click(function() {
           //jQuery('#novoRegistroForm').hide();
    	  jQuery('#loginForm').hide();
       	   jQuery('#forgotPassFormConfirma').hide();
       	   jQuery('#forgotPassForm').fadeIn();	
       });



       jQuery('.btNovoCadastro').click(function() {
                    jQuery('#forgotPassFormConfirma').hide();
                    jQuery('#forgotPassForm').hide();
                    //jQuery('#loginForm').hide();
              	    jQuery('#novoRegistroForm').fadeIn();
       });



       jQuery('.btLogin').click(function() {
             jQuery('#forgotPassFormConfirma').hide();
             jQuery('#forgotPassForm').hide();
             //jQuery('#novoRegistroForm').hide();
       	     jQuery('#loginForm').fadeIn();

       });
       
       
       //FINAL LOGIN REGISTRO --------------------------------------------------------------
       
       
       
      
       
       // FINAL BOTOES PARA ESCOLHER TIPO DE FORM

              // GO LOGIN

              jQuery('#formLogin').validate({

       		 messages:{
                 	emp: "Digite seu email. Não utilize espaços antes ou depois do email."

       		 },

       			  rules: {
       				password: "required",
       				password_again: {
       				equalTo: "#pwp"
       			 }
       		  },

       		 submitHandler: function( form ){  

       		          var email= jQuery('#emp').val();
       		          var pass1 = jQuery('#pwp').val();
       		          
       		          var checkoutV = ""+jQuery('#checkout').val();
                      

                         jQuery('.carregando').fadeIn();     jQuery(".msg").html("");   jQuery(".msg").fadeOut();  
 
                                url= baseUrl+"editLoginAjax.php";
                   
                                jQuery.post(url, { emp:email, pwp:pass1 , checkout:checkoutV } , function(data) {
                                  
                                        dataArr = data.split('****');    
                                        numb = dataArr[0];
                                        urlRedirect = dataArr[1];
 

                                jQuery('.carregando').fadeOut(); jQuery(".msg").fadeOut();  

                                msg = "";

                                if(parseInt(numb)){
                                   msg = "<strong style='color:green'>Seu acesso foi confirmado com sucesso! - Redirecionando... </strong>";
                                   jQuery(".msg").html(msg); jQuery(".msg").fadeIn();  
                             
                                    var timeout = function(){ window.location = urlRedirect+"" };
                                      setTimeout(timeout,1000);
                                

                                   //jQuery('#janela').fadeOut();
                                }else{
                                   msg = "<strong style='color:red'>Houve erros no envio! Tente novamente </strong> | ERRO :"+data;    
                                   jQuery(".msg").html(msg);   jQuery(".msg").fadeIn();     
                                }



                                });




       		        return false;   
                }


       	    });


       		// END GO LOGIN
       		
       		
       		
       		
       		
       		
       		
       		
       			// GO RECOVER

        		jQuery('#formSenha').validate({

        			 messages:{
	                  emailr: "Digite seu email. Não utilize espaços antes ou depois do email."
        			 },

        				  rules: {
        					password: "required",
        					password_again: {
        					equalTo: "#emailr"
        				 }
        			  },

        			 submitHandler: function( form ){  



                           var emailr= jQuery('#emailr').val();

                             jQuery('.carregando').fadeIn();
                             jQuery(".msg").html("");   
                             jQuery(".msg").fadeOut();  

                                    url= baseUrl+"editLostPassAjax.php";

                                    jQuery.post(url, { emp:emailr  } , function(data) {

                                    jQuery('.carregando').fadeOut();

                                    msg = "";
                                 
                                    if(parseInt(data)){
                                        
                                        msg = "<strong style='color:green'>Pedido de nova senha realizado com  sucesso! Você receberá um email nos próximos 5 minutos. Caso demore, verifique também em seu filtro de SPAM e assine nosso email  como confiável.  </strong>";
                                        jQuery(".msg").html(msg);
                                        jQuery(".msg").fadeIn();  
                                        
                                     }else{
                                         
                                        msg = "<strong style='color:red'>Houve erros no envio! Tente novamente </strong> | ERRO :"+data;    
                                        jQuery(".msg").html(msg); 
                                         
                                     }



                                    });


        			        return false;   
                     }


        		});

        		// END GO RECOVER
        		
        		
        		
        		
        		
        		
        			// GO RECOVER NEW

            		jQuery('#formRSenha').validate({

            			    messages:{
            			        emailrS: "Digite seu email. Não utilize espaços antes ou depois do email."
            				},
                            rules: {
            					pwpR: "required",
            					pwpR2: {
            					equalTo: "#pwpR"
            				    }
            			    },

            			  submitHandler: function( form ){  

                               var pwpR= jQuery('#pwpR').val();
                               var pwpR2= jQuery('#pwpR2').val();
                               var emailr= jQuery('#emailrS').val();
                               var lkV= jQuery('#lk').val();



                                 jQuery('.carregando').fadeIn();     jQuery(".msg").html("");   jQuery(".msg").fadeOut();  

                                        url= baseUrl+"editPassAjax.php";

                                        jQuery.post(url, { emp:emailr ,pwp:pwpR ,pw2p:pwpR2 , lk:lkV } , function(data) {
                                            
                                        dataArr = data.split('****');    
                                        numb = dataArr[0];
                                        urlRedirect = dataArr[1];

                                        jQuery('.carregando').fadeOut();

                                        msg = "";

                                        if(parseInt(numb)){
                                           msg = "<strong style='color:green'>Senha Alterada com Sucesso!</strong>";
                                           jQuery(".msg").html(msg);
                                           window.location =  ''+urlRedirect;
                                        }else{
                                           msg = "<strong style='color:red'>Houve erros no envio! Tente novamente </strong> | ERRO :"+data;    
                                           jQuery(".msg").html(msg);   jQuery(".msg").fadeIn();  
                                        }



                                        });


            			        return false;   
                         }


            		});

            		// END GO RECOVER NEW
            
            
            
            
            
            
            
            
            
            
            
            
                     // GO NEW
                    		jQuery('#formCadastro').validate({

                    			 messages:{
                    					termos: "Para se cadastrar você deve aceitar os termos de uso.",
                    					emailc: "Digite seu email. Não utilize espaços antes ou depois do email.",
                    			 
                    			 },

                    				rules: {
                    					passc: "required",
                    					passc2: { equalTo: "#passc" },
                    				    termos: { required: true,  minlength: 1 }
                                    },

                    			 submitHandler: function( form ){  


                                          var name= ""+jQuery('#nome').val();
                                          var emailc= ""+jQuery('#emailc').val();
                    			          var passc = ""+jQuery('#passc').val();
                    			          var pass2c = ""+jQuery('#passc2').val();
                    			          var checkoutV = ""+jQuery('#checkout').val();
                                          var recebaV = "";   
                                          var boxes = jQuery('input[name=receba]:checked');
                                          jQuery(boxes).each(function(){ recebaV = 1; });
                                           
                                                 jQuery('.carregando').fadeIn();     jQuery(".msg").html("");    jQuery(".msg").fadeOut();  

                                                 url= baseUrl+"editCriarLoginAjax.php";

                                                 jQuery.post(url, { emp:emailc, pwp:  passc , pw2p: pass2c  , nome: name,checkout:checkoutV,receba:recebaV  } , function(data) {

                                                 jQuery('.carregando').fadeOut();

                                                 msg = "";
                                
                                                dataArr = data.split('****');    
                                                numb = dataArr[0];
                                                urlRedirect = dataArr[1];
                                                
                                           
                                                 if(parseInt(numb)){


                                                     msg = "<strong style='color:green'>Seu acesso foi confirmado com sucesso!- Redirecionando...</strong>";
                                                     jQuery(".msg").html(msg);
                                                     var lgan = ''+jQuery('#lganuncio').val();
                                                     var lgan2 = ''+jQuery('#lgsite').val();
                                                   
                                                   
                                                       var timeout = function(){ window.location = urlRedirect; };
                                                       setTimeout(timeout,1000);
                                              
                                                  


                                                 }else{
                                                    msg = "<strong style='color:red'>Houve erros no envio! Tente novamente </strong> | ERRO :"+data;    
                                                    jQuery(".msg").html(msg);    jQuery(".msg").fadeIn();  
                                                 }

                                                  return false;

                                                 });





                    			        return false;   
                                 }


                    		});

                  	    // END GO NEW
                  	    
                  	    
                  	    
            
       		            
                   	   jQuery( ".nascC" ).datepicker({
                   	       changeYear: true,
                                          changeMonth: true,
                                          yearRange: '-100:+0'
                       });



                        
       		
       		
       		            // GO  EDIT DADOS

                              jQuery('#infoPedido').validate({

                                  	 messages:{
                          				    telefoneUsuario: "Digite um número válido. Não utilize espaços antes ou depois do numero.",
                          					telefoneUsuarioCel: "Digite um número válido. Não utilize espaços antes ou depois do numero.", 
                          					userCpf: "Digite um número válido. Não utilize espaços, traços ou pontos antes ou depois dos numeros.",

                          			 }, 

                      			  rules: {
                      			  },

                       		    submitHandler: function( form ){  
                            
                       		        salvarDados();
                       		           
                                       return false;   
                                }


                       	    });


                       		// END GO  EDIT DADOS
       		
       		
       		 

             function msgP(data){
                 jQuery('.msgP').fadeIn();  
                 jQuery('.msgP').html(data);   
                 // setTimeout( function() { jQuery('.msgP').fadeOut(); }, 8000 );
             };


            /*
            function carregarEditarDados(){

                  jQuery('#btSalvarDados').click(function(){
             	    salvarDados();
                  });

            }
            */
            
 
                /*
                jQuery('.btSalvarDados').click(function(){
             	    salvarDados();
                  });
                  */
            
                  function  salvarDados(){
                      
                           //jQuery('#copiarEnderecoC').fadeOut();

                           var arrayData =  new Array();
 
                           jQuery('input.userData').each(function(index) {
                                var id = ""+jQuery(this).attr('id');
                                //var relV = ""+jQuery(this).attr('rel');
                                var text = ""+jQuery(this).val();
                                //jQuery('span#'+relV+'').html(text);
                                arrayData[id+"V"] = text;  
                            }); 
                     
                                   arrayData["sexoUsuarioV"]  =  ""+jQuery("select[name=sexoUsuario] option:selected").val();  
                                   
                                    
                                      
          
                                   var nomeUsuarioV = ""+arrayData['nomeUsuarioV'];
                                   var nascimentoUsuarioV =  ""+arrayData['nascimentoUsuarioV'];
                                   var sexoUsuarioV =  ""+arrayData['sexoUsuarioV'];  
                                   var enderecoUsuarioV  = ""+arrayData['enderecoUsuarioV'];
                                   var enderecoUsuarioNumeroV  = ""+arrayData['enderecoUsuarioNumeroV'];
                                   var complementoUsuarioV =  ""+arrayData['complementoUsuarioV'];
                                   var bairroUsuarioV = ""+arrayData['bairroUsuarioV'];
                                   var cidadeUsuarioV = ""+arrayData['cidadeUsuarioV'];    
                                  
                                   var userCpfV = ""+arrayData['userCpfV'];   
                                   
                                  // var estadoUsuarioV = ""+arrayData['estadoUsuarioV'];
                                  var estadoUsuarioV = ""+jQuery("#estadoUsuario option:selected").val();
                                   
                                   var cepUsuarioV =  ""+arrayData['cepUsuarioV'];
                                   var dddUsuarioV =  ""+arrayData['dddUsuarioV'];
                                   var telefoneUsuarioV= ""+arrayData['telefoneUsuarioV'];
                                   var dddUsuarioCelV =  ""+arrayData['dddUsuarioCelV'];
                                   var telefoneUsuarioCelV= ""+arrayData['telefoneUsuarioCelV'];
                                         
                                   
                                  
                                        var enderecoUsuario2V  = "";
                                        var enderecoUsuarioNumero2V  = "";
                                        var complementoUsuario2V =  "";
                                        var bairroUsuario2V = "";
                                        var cidadeUsuario2V = "";
                                        var estadoUsuario2V = "";  
                                        var estadoUsuario2V  =  ""; 
                                        var cepUsuario2V =  "";
                                      
                                       statusCheck =  jQuery('#abrirEnderecoEntrega').attr('checked');
                                       
                                       if(statusCheck =="checked"){ 
                                                 var enderecoUsuario2V  = ""+arrayData['enderecoUsuario2V'];
                                                 var enderecoUsuarioNumero2V  = ""+arrayData['enderecoUsuarioNumero2V'];
                                                 var complementoUsuario2V =  ""+arrayData['complementoUsuario2V'];
                                                 var bairroUsuario2V = ""+arrayData['bairroUsuario2V'];
                                                 var cidadeUsuario2V = ""+arrayData['cidadeUsuario2V'];
                                                 var estadoUsuario2V  =  ""+jQuery("#estadoUsuario2 option:selected").val(); 
                                                 var cepUsuario2V =  ""+arrayData['cepUsuario2V'];
                                       }else{
                                                var enderecoUsuario2V  = ""+enderecoUsuarioV ;
                                                var enderecoUsuarioNumero2V  = ""+enderecoUsuarioNumeroV;
                                                var complementoUsuario2V =  ""+complementoUsuarioV;
                                                var bairroUsuario2V = ""+bairroUsuarioV;
                                                var cidadeUsuario2V = ""+cidadeUsuarioV;
                                                var estadoUsuario2V =  ""+estadoUsuarioV;
                                                var cepUsuario2V =  ""+cepUsuarioV;
                                       };
                                       
                                      
                                     
                                      

                                   salvarForm(nomeUsuarioV,nascimentoUsuarioV,sexoUsuarioV,enderecoUsuarioV,enderecoUsuarioNumeroV,complementoUsuarioV,bairroUsuarioV,cidadeUsuarioV,estadoUsuarioV,cepUsuarioV,enderecoUsuario2V,enderecoUsuarioNumero2V,complementoUsuario2V,bairroUsuario2V,cidadeUsuario2V,estadoUsuario2V,cepUsuario2V,dddUsuarioV,telefoneUsuarioV,dddUsuarioCelV,telefoneUsuarioCelV,userCpfV);

                                   //jQuery('#btSalvarDados').remove();
                                  // editOpen = false;

                  };


                  function salvarForm(nomeUsuarioV,nascimentoUsuarioV,sexoUsuarioV,enderecoUsuarioV,enderecoUsuarioNumeroV,complementoUsuarioV,bairroUsuarioV,cidadeUsuarioV,estadoUsuarioV,cepUsuarioV,enderecoUsuario2V,enderecoUsuarioNumero2V,complementoUsuario2V,bairroUsuario2V,cidadeUsuario2V,estadoUsuario2V,cepUsuario2V,dddUsuarioV,telefoneUsuarioV,dddUsuarioCelV,telefoneUsuarioCelV,userCpfV){
                           jQuery(".carregando").fadeIn();   
                          
                           jQuery.post(baseUrl+"editAjaxDadosUsuario.php", {nomeUsuario:nomeUsuarioV,nascimentoUsuario:nascimentoUsuarioV,sexoUsuario:sexoUsuarioV,enderecoUsuario:enderecoUsuarioV,enderecoUsuarioNumero:enderecoUsuarioNumeroV,complementoUsuario:complementoUsuarioV,bairroUsuario:bairroUsuarioV,cidadeUsuario:cidadeUsuarioV,estadoUsuario:estadoUsuarioV,cepUsuario:cepUsuarioV,enderecoUsuario2:enderecoUsuario2V,enderecoUsuarioNumero2:enderecoUsuarioNumero2V,complementoUsuario2:complementoUsuario2V,bairroUsuario2:bairroUsuario2V,cidadeUsuario2:cidadeUsuario2V,estadoUsuario2:estadoUsuario2V,cepUsuario2:cepUsuario2V,dddUsuario:dddUsuarioV,telefoneUsuario:telefoneUsuarioV,dddUsuarioCel:dddUsuarioCelV,telefoneUsuarioCel:telefoneUsuarioCelV,userCpf:userCpfV },
                              
                              function(data) {  
                                     
                              jQuery(".carregando").fadeOut();
                             
                              msgP(data); 
                              
                              
                              //jQuery('.btEditarDatos').fadeIn();
                              
                               if( cepUsuario2V !='undefined' ){
                               jQuery('input.cep').val(cepUsuario2V);
                               jQuery('.cepEntrega').text(cepUsuario2V);
                               };    
                               
                               
                               getEndereco(); 
                               
                               
                               
                                    var checkout = jQuery('#checkout').val();
          		         
          		                        if(checkout=='TRUE'){  
          		                                  calculaFrete();
          		                                  var Self = jQuery('div.block-content').eq(1);
                                                  var irpara = parseInt(jQuery('.checkout').offset().top);
                                                  jQuery('html, body').animate({ scrollTop: irpara }, 1000);
                                                  //if(jQuery('.checkout .block .block-content:visible').is(Self)) return;
                                                  jQuery('.checkout .block .block-content:visible').slideUp(300);
                                   			      Self.slideDown(300);
                                                  jQuery('.msg').html('');
                                       };
                               
                               
                               
                           });
                  };

            /*FINAL EDITAR DADOS -------------------------- --------*/
            
            
            
            
            //CHECKOUT -------------------------------------------------
            
            
        	    jQuery('.checkout .block').not(jQuery('.checkout .block:first')).find('.block-content').hide();	
        		
        		
        		
        		jQuery('.checkout .block .block-head').click(function(){
        		    
        		    jQuery('.carregando').hide(); 
        		    jQuery('.msgP').text('');
        		    jQuery('.msg2').text('');
        		     
        			var Self = jQuery(this).next().find('.block-content');
        			
        			   var Self = jQuery('div.block-content').eq(0);

        			irpara = parseInt(jQuery('.checkout').offset().top);
                    jQuery('html, body').animate({ scrollTop: irpara }, 1000);
       


        			if(jQuery('.checkout .block .block-content:visible').is(Self)) return;

        			jQuery('.checkout .block .block-content:visible').slideUp(300);
        			
        			Self.slideDown(300);	
        			       	
        		 });


                 
              jQuery('#copiarEndereco').change(function() {
                      var statusCheck = jQuery(this).attr('checked');
                      if(statusCheck =="checked"){ 
                          var endereco = jQuery('#enderecoUsuario').val(); 
                          jQuery('#enderecoUsuario2').val( endereco );
                          var numero = jQuery('#enderecoUsuarioNumero').val();  
                          jQuery('#enderecoUsuarioNumero2').val( numero );
                          var complemento = jQuery('#complementoUsuario').val();  
                          jQuery('#complementoUsuario2').val( complemento );
                          var bairro = jQuery('#bairroUsuario').val();  
                          jQuery('#bairroUsuario2').val( bairro );
                          var cidade = jQuery('#cidadeUsuario').val(); 
                          jQuery('#cidadeUsuario2').val( cidade );
                          var estado = jQuery('#estadoUsuario').val();  
                          jQuery('#estadoUsuario2').val( estado );
                          var cep = jQuery('#cepUsuario').val();  
                          jQuery('#cepUsuario2').val( cep );
                          //salvarDados();
                      };
               });
            
                
             
               jQuery('#abrirEnderecoEntrega').change(function() {
                         var statusCheck = jQuery(this).attr('checked');
                         if(statusCheck =="checked"){      
                              //jQuery('#enderecoUsuario2').val( '' );
                             // jQuery('#enderecoUsuarioNumero2').val('');
                             // jQuery('#complementoUsuario2').val( '');
                              //jQuery('#bairroUsuario2').val( '');
                              //jQuery('#cidadeUsuario2').val( '' );
                              //jQuery('#estadoUsuario2').val( '');
                             // jQuery('#cepUsuario2').val( '' );
                                                
                                        
                              jQuery('.contentDadosEntrega').fadeIn(); 
                         }else{
                             jQuery('.contentDadosEntrega').hide();   
                         }
                  });
                  
                  




            //CHECKOUT ---------------------------------------------------
            
            
            
            //consulta descontos
            
            jQuery('.btCalcularDesconto').click(function(){
                
                    var cupomV = jQuery('#cupom').val();
                    
                    jQuery(this).val('Carregando...');
                  
                    jQuery('.carregando').fadeIn();     jQuery(".msg").html("");  

                              url= baseUrl+"consultaDescontoAjax.php";
                              
                              jQuery('.carregando').fadeIn();

                              jQuery.post(url, { cupom:cupomV } , function(data) {
                                  
                                  window.location = self.location; 
                 
                          
                              });
           
            });
            
            
            //consulta desconto
            
            
            
            //FILTRO PESQUISA
            
            
                   var tamanhoOpen = false;
                
                    
                       jQuery('.expandirT').click(function(){
                           key = jQuery(this).attr('rel');
                           
                           if(tamanhoOpen==false){
                           jQuery('.'+key).fadeIn();
                           tamanhoOpen = true;
                           }else{
                           jQuery('.tamanhoSelect .hide').hide(); 
                           tamanhoOpen = false;
                           };
                      });
            
     
                         var corOpen = false;
                         
                      jQuery('.expandirC').click(function(){
                               key = jQuery(this).attr('rel');
                               if(corOpen==false){
                                 jQuery('.'+key).fadeIn();
                                 corOpen = true;
                               }else{
                                  jQuery('.corSelect .hide').hide();
                                  corOpen = false;
                               };
                        });
            
            
               showCamisaMedida = false;
               
 



               jQuery('.camisaMedida').click(function(){
                   
                    if(showCamisaMedida==false){
                      
                      urlImg = ""+jQuery('#tabelaMedida').val();
                      htmlTabelaMedidas = "<div  class='containerMedidas'><p class='btFecharMedidas'></p><img src='"+urlImg+"' /></div><div id='fade' class='white_overlay'></div>";
                      jQuery('body').append( htmlTabelaMedidas );
                      jQuery('.containerMedidas,.white_overlay').fadeIn();
                      loadBtFecharTabelaTamanho();
                      showCamisaMedida = true;
                      
                      
                    }else{
                        
                      jQuery('.containerMedidas,.black_overlay').hide();
                      jQuery('.containerMedidas').remove();
                      jQuery('.white_overlay').remove();
                      showCamisaMedida = false;
                      
                    };

                });
            
            
            function loadBtFecharTabelaTamanho(){
            jQuery('.btFecharMedidas').click(function(){
                   jQuery('.containerMedidas,.white_overlay').hide();
                   showCamisaMedida = false;
            });
           };
            
            
                   subFechado = true;
                   jQuery('.temaSelect p.ativo').click(function(){
                             if(subFechado==true){
                               jQuery('.temaSelect p.sub').fadeIn();
                               subFechado = false;
                             }else{
                               jQuery('.temaSelect p.sub').fadeOut();    
                                subFechado = true;
                             }
                           
                    }); 
                    
                    
                       jQuery('.temaSelect p.sub').click(function(){
                                  valor = jQuery(this).text();
                                  jQuery('.temaSelect p.ativo').text(valor);
                                  jQuery('.temaSelect p.ativo').attr('rel',jQuery(this).attr('rel') );
                                  jQuery('.temaSelect p.sub').fadeOut();    
                                  subFechado = true;
                                  carregaFiltro();
                       });   
                            
                
                       jQuery('.tamanhoSelect li').click(function(){
                                 jQuery('.tamanhoSelect li').removeClass('ativo');
                                 jQuery(this).addClass('ativo');
                                 carregaFiltro();
                        });
                        
                        jQuery('.corSelect li').click(function(){
                                jQuery('.corSelect li').removeClass('ativo');
                                jQuery(this).addClass('ativo');
                                carregaFiltro();
                        });
                           
                           
                            
                        function carregaFiltro(){
                                tema =  ""+""+jQuery('.temaSelect p.ativo').attr('rel');
                                tamanho =  ""+jQuery('.tamanhoSelect li.ativo').attr('rel');
                                cor =  ""+jQuery('.corSelect li.ativo').attr('rel');
                                currentCat = ""+jQuery('#currentCat').val();
                                //alert(""+tema+""+tamanho+""+cor);
                                //alert( currentCat);
                                      url= baseUrl+"consultaFiltroBusca.php";

                                     showBigLoad();

                                      jQuery.post(url, { temaV:tema,tamanhoV:tamanho,corV:cor,currentCatV:currentCat } , function(data) {
                                           jQuery('.produtosRecentes').hide();
                                           jQuery('.produtosRecentes').html(data);
                                           jQuery('.produtosRecentes').fadeIn();
                                           hideBigLoad(); 
                                       });
                                
                             
                                
                         }
                         
                         
                         
                         
                         
                        //SOMENTE NUMEROS FIELD ----------------------------
                        
                        jQuery(".somenteNumeros").keydown(function(event) {
                                // Allow: backspace, delete, tab, escape, and enter
                                if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
                                     // Allow: Ctrl+A
                                    (event.keyCode == 65 && event.ctrlKey === true) || 
                                     // Allow: home, end, left, right
                                    (event.keyCode >= 35 && event.keyCode <= 39)) {
                                         // let it happen, don't do anything
                                         return;
                                }
                                else {
                                    // Ensure that it is a number and stop the keypress
                                    if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                                        event.preventDefault(); 
                                    }   
                                }
                            });
                            //SOMENTE NUMEROS FIELD ---------------------------- 
                            
                            
                               
                             
                           
                   
                   
                           jQuery('.facebook_connect').click(function(){
                                    showBigLoad();   
                           }); 
                        
                        
                           jQuery('.facebook_connect2').click(function(){
                                         showBigLoad();   
                            });
                        
                              
                         

}); 