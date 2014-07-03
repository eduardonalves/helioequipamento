<?php
/*
Template Name: Custom Feed
*/
 
$numposts = -1;
 
function yoast_rss_date( $timestamp = null ) {
  $timestamp = ($timestamp==null) ? time() : $timestamp;
  echo date(DATE_RSS, $timestamp);
}
 
function yoast_rss_text_limit($string, $length, $replacer = '...') { 
  $string = strip_tags($string);
  if(strlen($string) > $length) 
    return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;   
  return $string; 
}            


 
 
$posts = query_posts('post_type=produtos&showposts='.$numposts);
 
$lastpost = $numposts - 1;
 
header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0"?>';
?><rss xmlns:g="http://base.google.com/ns/1.0" version="2.0"> 
<channel>

       <title><?php bloginfo('name'); ?></title>
		<link><?php bloginfo('url'); ?></link>
		<description><?php bloginfo('description'); ?></description>


  <language>en-us</language>
  <pubDate><?php yoast_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></pubDate>
  <lastBuildDate><?php yoast_rss_date( strtotime($ps[$lastpost]->post_date_gmt) ); ?></lastBuildDate>  
  
  <managingEditor><?php echo get_option('emailAdminWPSHOP'); ?></managingEditor>    
  
   <?php   
   
    $rss .= "";
   while ( have_posts() ) : the_post(); 
             
    
    $titulo = get_the_title();     
    $url = get_permalink();   
    
    $idP =  get_the_id();
    
    $preco = get_post_meta($idP,'price',true);       
    $specialprice = get_post_meta($idP,'specialprice',true);
    if($specialprice !=""){$preco = $specialprice; };  
    
    
    $image_url = wp_get_attachment_image_src( get_post_thumbnail_id($idP ) , 'full' );
    $image_url =  $image_url[0];
                         
    
      $categoria =   ""; 
      
      foreach((get_the_category()) as $category) { 
         $categoria.= $category->cat_name.' ; '; 
      }
       
      
      $peso = floatval(get_post_meta($idP,'weight',true)); 
      $frete = $peso*8.70;  
      
      
        $gtim = get_post_meta($idP,'sku',true);   
         if($gtim==""){  
               $qtd = strlen($idP);    
               $qtd = 12 - $qtd;  
               $st="";
               for($z=0;$z<=$qtd;$z++){
                 $st.="5";  
               }
               $gtim = $idP.$st;
        }
          
        
     
       
        
        $marca =   get_post_meta($idP,'marca',true);
        if($marca==""){
               $marca = get_option('googleMarca'); 
        } ;
        
        $googleCategories =  get_option('googleCategorias');  
      
        $pmn =  get_post_meta($idP,'codFab',true); 
              if($pmn==""){
                   $pmn = $idP;
            }
      
      
      
    $rss = " 
 
<!-- First example shows what attributes are required and recommended for items that are not in the apparel category -->
<item>
	<!-- The following attributes are always required -->
	<title>$titulo</title>
	<link>$url</link>        
	<google_product_category>$googleCategories</google_product_category>
	<description>";
   echo $rss;       
   
   the_content_rss('', TRUE, '', 50);
   
    $rss = "</description>
	<g:id>$idP</g:id>
	<g:condition>new</g:condition>
	<g:price>$preco BRL</g:price>
	<g:availability>in stock</g:availability>
	<g:image_link>$image_url</g:image_link>
	<g:shipping>
		<g:country>BR</g:country>
		<g:service>Terrestre</g:service>
		<g:price>$frete BRL</g:price>
	</g:shipping>
	
	<!-- The following attributes are required because this item is not apparel or a custom good -->
	<g:gtin>$gtim</g:gtin>
	<g:brand>$marca</g:brand>
	<g:mpn>$pmn</g:mpn>
	
	<!-- The following attributes are not required for this item, but supplying them is recommended if applicable -->
	<g:product_type>$categoria</g:product_type>
</item>  ";   

echo $rss;

 ?>

   <?php endwhile;    ?>  






</channel>
</rss> 
<?php die; ?>    
