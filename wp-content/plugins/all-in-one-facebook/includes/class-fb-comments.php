<?php

if( !class_exists( 'CD_FBSP_Comments_Widget' ) )
{
	class CD_FBSP_Comments_Widget extends WP_Widget
	{
		function CD_FBSP_Comments_Widget()
		{
			$widget_ops = array(
				'classname' 	=> 'cd-fb-comments-widget',
				'description' 	=> __( 'Facebook Comments Box', 'cd-fbspw' )
			);
			
			$this->WP_Widget( 'CD_FBSP_Comments_Widget', __( 'Facebook Comments', 'cd-fbspw' ), $widget_ops );
		}
		
		function form( $instance )
		{
			$defaults = array(
				'title'			=> 'Top Articles',
				'url' 			=> get_bloginfo('url'),
				'width'			=> 300,
				'no_of_post'		=> 2, 
				'border_color' 	=> '',
				'color_scheme' 	=> 'light',
				'show_header' 	=> 'off',
				'font' 			=> '',
			);
			
			$instance = wp_parse_args( (array) $instance, $defaults );
			extract( $instance );
			
			?>
			<p>
				<label for="cd-fbr-title"><?php _e( 'Title:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-title" class="widefat" name="<?php echo $this-> get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-url"><?php _e( 'Domain:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-url" class="widefat" name="<?php echo $this-> get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-width"><?php _e( 'Width:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-width" class="widefat" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>" />
			</p>
			<p>
				<label for="cd-fbr-no_of_post"><?php _e( 'no_of_post:', 'cd-fbspw' ); ?></label>
				<input id="cd-fbr-no_of_post" class="widefat" name="<?php echo $this->get_field_name( 'no_of_post' ); ?>" type="text" value="<?php echo esc_attr( $no_of_post ); ?>" />
			</p>
			
			
			
			
			<?php	
		}
		
		function update( $new_instance, $old_instance )
		{
			$instance = $old_instance;
			$instance['title'] = isset( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['url'] = isset( $new_instance['url'] ) ? esc_url( $new_instance['url'], array( 'http', 'https' ) ) : '';
			$instance['width'] = isset( $new_instance['width'] ) ? absint( $new_instance['width'] ) : 300;
			$instance['no_of_post'] = isset( $new_instance['no_of_post'] ) ? absint( $new_instance['no_of_post'] ) : 2;
			$instance['border_color'] = isset( $new_instance['border_color'] ) ? strip_tags( $new_instance['border_color'] ) : '';
			$instance['color_scheme'] = strip_tags( $new_instance['color_scheme'] );
			$instance['font'] = isset( $new_instance['font'] ) ? strip_tags( $new_instance['font'] ) : '';
			$instance['show_header'] = isset( $new_instance['show_header'] ) && $new_instance['show_header'] ? 'on' : 'off';
			
			return $instance;
		}
		
		function widget( $args, $instance )
		{
			extract( $args );
			
			// Get our widget variables
			$title = apply_filters( 'widget_title', $instance['title'] );
			$width = empty( $instance['width'] ) ? '300' : '' . $instance['width'] . '';
			$no_of_post = empty( $instance['no_of_post'] ) ? '2' : '' . $instance['no_of_post'] . '';
			$url = empty( $instance['url'] ) ? ' site="http://wordpress.org/"' : '' . $instance['url'] . '';
			$border = empty( $instance['border_color'] ) ? ' border_color=""' : ' border_color="' . $instance['border_color'] . '"';
			$color = $instance['color_scheme'] == 'light' ? '' : ' colorscheme="dark"';
			$font = empty( $instance['font'] ) ? '' : ' font="'. $instance['font'] . '"';
			$header = $instance['show_header'] == 'on' ? ' header="true"' : ' header="false"';
			
			// Render the widget
			echo $before_widget;
			if( !empty( $title ) )
			{
				echo $before_title . $title . $after_title;
			}
			
			echo '<div style="background:#FFFFFF; width:'.$width.'px;"><fb:comments href="'.$url.'" num_posts="'.$no_of_post.'" width="'.$width.'"></fb:comments></div>';
			echo $after_widget;
		}
	} // end class
	
	/**
	* Register the widget here to make sure we get the right class...
	*/
	add_action( 'widgets_init', 'cd_fbsp_comments_register' );
	function cd_fbsp_comments_register()
	{		
		register_widget( 'CD_FBSP_Comments_Widget' );
	}
	
} // end class_exists
