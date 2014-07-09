<?php
  
   //criar tipo de post personalizado -------------post types ( PRODUTOS )

   add_action( 'init', 'create_post_type_produtos' );
   function create_post_type_produtos() {
   	register_post_type( 'Produtos',
   		array(
   			'labels' => array(
   				'name' => __( 'Produtos' ),
   				'edit_item' => __( 'Editar Produto' ),
   				'add_new_item' => __( 'Adicionar Novo Produto' ),
   				'singular_name' => __( 'Produtos' )
   			),
   		'public' => true,
   		'has_archive' => true,
   			'menu_position' => 7,
   		 		'supports' => array( 'title','excerpt','editor','author','thumbnail','revisions' )

   		)
   	); 
   	
   	flush_rewrite_rules();    

   }


       //Adds support for custom fields to Feature post type
       	add_action('init', 'my_custom_produtos_init');
       	function my_custom_produtos_init() {
       		add_post_type_support( 'produtos', 'custom-fields' );
       		register_taxonomy_for_object_type('category', 'produtos');
            register_taxonomy_for_object_type('post_tag', 'produtos');
       	};
  
   //final criar tipo de post personalizado ------------post types ( produtos )

   include('customFunctions-add-metaboxes_produtos.php');


     
?>