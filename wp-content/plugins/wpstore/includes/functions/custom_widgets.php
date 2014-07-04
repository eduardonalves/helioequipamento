<?php

//WIDGETS------------------------------------------------------------


//Criando o Widget menuTop Form

 function widget_menuTopForm() {
     
     
      $options = get_option("widget_menuTopForm");
       if (!is_array( $options ))
     {
     $options = array(
           'title' => 'menuTop'
           );
       }
       
       
       // $options['title'];  //TITULO DO WIDGET
       custom_get_menu_shop_top();  
 
 
 }

 function menuTopForm_init()
 {
   register_sidebar_widget(__('WP STORE - MENU TOP'), 'widget_menuTopForm');
 }
 
 
 
 
 function menuTopForm_control()
 {
   $options = get_option("widget_menuTopForm");
   if (!is_array( $options ))
 {
 $options = array(
       'title' => 'menuTop'
       );
   }

   if ($_POST['menuTopForm-Submit'])
   {
     $options['title'] = htmlspecialchars($_POST['menuTopForm-WidgetTitle']);
     update_option("widget_menuTopForm", $options);
   }

 ?>
   <p>
     <label for="menuTopForm-WidgetTitle">menuTop: </label>
     <input type="text" id="menuTopForm-WidgetTitle" name="menuTopForm-WidgetTitle" value="<?php echo $options['title'];?>" />
     <input type="hidden" id="menuTopForm-Submit" name="menuTopForm-Submit" value="1" />
   </p>
   
   
 <?php }; ?>
<?php
 
 add_action("plugins_loaded", "menuTopForm_init");
 register_widget_control('WP STORE - MENU TOP', 'menuTopForm_control', 200, 200 );
 
 
     
 //Criando o Widget boxComprar Form

  function widget_boxComprarForm() {


       $options = get_option("widget_boxComprarForm");
        if (!is_array( $options ))
      {
      $options = array(
            'title' => 'boxComprar'
            );
        }

  // $options['title'];  //TITULO DO WIDGET
 custom_product_single();   ?>
  <?php
  }

  function boxComprarForm_init()
  {
    register_sidebar_widget(__('WP STORE - BOX COMPRAR'), 'widget_boxComprarForm');
  }




  function boxComprarForm_control()
  {
    $options = get_option("widget_boxComprarForm");
    if (!is_array( $options ))
  {
  $options = array(
        'title' => 'boxComprar'
        );
    }

    if ($_POST['boxComprarForm-Submit'])
    {
      $options['title'] = htmlspecialchars($_POST['boxComprarForm-WidgetTitle']);
      update_option("widget_boxComprarForm", $options);
    }

  ?>
    <p>
      <label for="boxComprarForm-WidgetTitle">BoxComprar: </label>
      <input type="text" id="boxComprarForm-WidgetTitle" name="boxComprarForm-WidgetTitle" value="<?php echo $options['title'];?>" />
      <input type="hidden" id="boxComprarForm-Submit" name="boxComprarForm-Submit" value="1" />
    </p>

<?php }; ?><?php

  add_action("plugins_loaded", "boxComprarForm_init");
  
  register_widget_control('WP STORE - BOX COMPRAR', 'boxComprarForm_control', 200, 200 );
 
  //FINAL WIDGETS------------------------------------------------------------
 
  ?>