<?php
//http://developers.facebook.com/docs/reference/plugins/like/
if( !class_exists( 'CD_Class_Twiter_Widget' ) )
{
	class CD_Class_Twiter_Widget extends WP_Widget
	{
		function CD_Class_Twiter_Widget()
		{
			$widget_ops = array(
				'classname' 	=> 'class-twiter',
				'description' 	=> __( 'Twiter Box', 'cd-fbspw' )
			);
			
			$this->WP_Widget( 'CD_Class_Twiter_Widget', __( 'Twiter Widget Profile', 'cd-fbspw' ), $widget_ops );
		}
		
		function form( $instance )
		{
			$defaults = array(
				
				'width'			=> 250,
				'height'		=>300,
				'user_name'		=>'twitter',
				'shell_bg_color_code' =>'#333333',
				'shell_color_code'=>'#ffffff',
				'tweets_bg_color_code'=>'#000000',
				'tweets_color_code'=>'#ffffff',
				'tweets_links_color_code'=>'#4aed05',
				
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			extract( $instance );
			
			?>
			
			
			
			
			<!-- Field for thr width -->
			<p>
				<label for="cd-fbr-width"><?php _e( 'Width:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-width" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			</p>
			
			
			<!-- Field for thr height -->
			<p>
				<label for="cd-fbr-height"><?php _e( 'Height:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-height" class="widefat" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo esc_attr( $height ); ?>" />
			</p>
			
			
			<!-- Field for thr user name -->
			<p>
				<label for="cd-fbr-user_name"><?php _e( 'User Name:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-user_name" class="widefat" name="<?php echo $this->get_field_name( 'user_name' ); ?>" type="text" value="<?php echo esc_attr( $user_name ); ?>" />
			</p>
			
			
			<!-- Field for thr shell_bg_color_code -->
			<p>
				<label for="cd-fbr-shell_bg_color_code"><?php _e( 'shell background color code:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-shell_bg_color_code" class="widefat" name="<?php echo $this->get_field_name( 'shell_bg_color_code' ); ?>" type="text" value="<?php echo esc_attr( $shell_bg_color_code ); ?>" />
			</p>
			
			
			<!-- Field for thr shell_color_code -->
			<p>
				<label for="cd-fbr-shell_color_code"><?php _e( 'shell Text color code:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-shell_color_code" class="widefat" name="<?php echo $this->get_field_name( 'shell_color_code' ); ?>" type="text" value="<?php echo esc_attr( $shell_color_code ); ?>" />
			</p>
			
			
			<!-- Field for thr tweets_bg_color_code -->
			<p>
				<label for="cd-fbr-tweets_bg_color_code"><?php _e( 'Tweets Background color code:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-tweets_bg_color_code" class="widefat" name="<?php echo $this->get_field_name( 'tweets_bg_color_code' ); ?>" type="text" value="<?php echo esc_attr( $tweets_bg_color_code ); ?>" />
			</p>
			
			
			<!-- Field for thr tweets_color_code -->
			<p>
				<label for="cd-fbr-tweets_color_code"><?php _e( 'Tweets Text color code:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-tweets_color_code" class="widefat" name="<?php echo $this->get_field_name( 'tweets_color_code' ); ?>" type="text" value="<?php echo esc_attr( $tweets_color_code ); ?>" />
			</p>
			
			
			<!-- Field for thr tweets_links_color_code -->
			<p>
				<label for="cd-fbr-tweets_links_color_code"><?php _e( 'Tweets Links color code:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-tweets_links_color_code" class="widefat" name="<?php echo $this->get_field_name( 'tweets_links_color_code' ); ?>" type="text" value="<?php echo esc_attr( $tweets_links_color_code ); ?>" />
			</p>
			
			
		
			
			
			
			
			
			<?php	
		}
		
		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;
		
			$instance['width'] = isset( $new_instance['width'] ) ? strip_tags( $new_instance['width'] ) : '250';
			
			$instance['height'] = isset( $new_instance['height'] ) ? strip_tags( $new_instance['height'] ) : '300';
			
			$instance['user_name'] = isset( $new_instance['user_name'] ) ? strip_tags( $new_instance['user_name'] ) : 'twitter';
			
			$instance['shell_bg_color_code'] = isset( $new_instance['shell_bg_color_code'] ) ? strip_tags( $new_instance['shell_bg_color_code'] ) : '#333333';
			
			$instance['shell_color_code'] = isset( $new_instance['shell_color_code'] ) ? strip_tags( $new_instance['shell_color_code'] ) : '#ffffff';
			
			$instance['tweets_bg_color_code'] = isset( $new_instance['tweets_bg_color_code'] ) ? strip_tags( $new_instance['tweets_bg_color_code'] ) : '#000000';
			
			$instance['tweets_color_code'] = isset( $new_instance['tweets_color_code'] ) ? strip_tags( $new_instance['tweets_color_code'] ) : '#ffffff';
			
			$instance['tweets_links_color_code'] = isset( $new_instance['tweets_links_color_code'] ) ? strip_tags( $new_instance['tweets_links_color_code'] ) : '#4aed05';
			
			return $instance;
		}
		
		function widget( $args, $instance )
		{
			extract( $args );
			
			// Get our widget variables
			
			$width = empty( $instance['width'] ) ? '250' : '' . $instance['width'] . '';
			$height = empty( $instance['height'] ) ? '300' : '' . $instance['height'] . '';
			$user_name = empty( $instance['user_name'] ) ? 'twitter' : '' . $instance['user_name'] . '';
			$shell_bg_color_code = empty( $instance['shell_bg_color_code'] ) ? '#333333' : '' . $instance['shell_bg_color_code'] . '';
			$shell_color_code = empty( $instance['shell_color_code'] ) ? '#ffffff' : '' . $instance['shell_color_code'] . '';
			$tweets_bg_color_code = empty( $instance['tweets_bg_color_code'] ) ? '#000000' : '' . $instance['tweets_bg_color_code'] . '';
			$tweets_color_code = empty( $instance['tweets_color_code'] ) ? '#ffffff' : '' . $instance['tweets_color_code'] . '';
			$tweets_links_color_code = empty( $instance['tweets_links_color_code'] ) ? '#4aed05' : '' . $instance['tweets_links_color_code'] . '';
			// Render the widget
			echo $before_widget;
			echo '<!--widget_profile-->
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script language="javascript">'."
new TWTR.Widget({ version: 2, type: 'profile', rpp: 4,interval: 30000, width: ".$width.", height: ".$height.", theme: {
    shell: { background: '".$shell_bg_color_code."', color: '".$shell_color_code."'},
    tweets: {background: '".$tweets_bg_color_code."',color: '".$tweets_color_code."',links:'".$tweets_links_color_code."'}
  },
  features: { scrollbar: false,loop: false,live: false,behavior: 'all'}
}).render().setUser('".$user_name."').start();
</script>";
			echo $after_widget;
		}
	} // end class
	
	/**
	* Register the widget here to make sure we get the right class...
	*/
	add_action( 'widgets_init', 'cd_fbsp_Twiter_Widget' );
	function cd_fbsp_Twiter_Widget()
	{		
		register_widget( 'CD_Class_Twiter_Widget' );
	}
	
} // end class_exists
