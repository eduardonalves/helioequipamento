<?php
/*
Plugin Name: All In One Facebook
Plugin URI: http://wordpress.org/extend/plugins/all-in-one-facebook/
Description: With this widget and plugin combination , you can display a customizable JQUERY accordion which gathers Facebook social plugins together with option which to be display or which you don't want to display in your side bar or widget area, and by the plugin you can set short code for each and every thing what you want to put in your post on your website . 
Version: 1.0.1
Author: Rahul Mukherjee.
Author URI: http://www.facebook.com/rahulmukherjee85/
*/

define( 'CD_FBSP_PATH', plugin_dir_path( __FILE__ ) );
define( 'CD_FBSP_NAMe', plugin_basename( __FILE__ ) );

require( CD_FBSP_PATH . 'includes/class-fb-like.php' );
require( CD_FBSP_PATH . 'includes/class-fb-recommends.php' );
require( CD_FBSP_PATH . 'includes/class-fb-activity.php' );
require( CD_FBSP_PATH . 'includes/class-fb-comments.php' );
require( CD_FBSP_PATH . 'includes/class-twiter.php' );
require( CD_FBSP_PATH . 'includes/class-fb-likebtn.php' );
add_action( 'wp_footer', 'cd_fbsp_print_script' );
/**
 * Prints out the Facebook JavaScript code.
 */
function cd_fbsp_print_script()
{
    ?>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <?php
}

/**
* IE doesn't render facebook XFBML unless it finds a certain attribute on the <head>
* tag. This takes care of that.
*/
add_filter( 'language_attributes', 'cd_fbspw_ie_fix', 99 );
function cd_fbspw_ie_fix( $atts )
{
	// if the string already has what we need, bail
	if( preg_match( '/xmlns:fb="(.*)"/', $atts ) ) return $atts;
	$atts .= ' xmlns:fb="http://ogp.me/ns/fb#"';
	return $atts;
}
