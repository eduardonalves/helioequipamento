<?php
/* Register custom menus. */
add_action( 'init', 'omega_register_menus' );

/* Register sidebars. */
add_action( 'widgets_init', 'omega_register_sidebars' );

/* Add default theme settings */
add_filter( 'omega_default_theme_settings', 'omega_set_default_theme_settings');

add_action( 'wp_enqueue_scripts', 'omega_scripts' );
add_action( 'wp_head', 'omega_styles' );

/* Load the primary menu. */
add_action( 'omega_before_header', 'omega_get_primary_menu' );

/* Header actions. */
add_action( 'omega_header', 'omega_header_markup_open', 5 );
add_action( 'omega_header', 'omega_branding' );
add_action( 'omega_header', 'omega_header_markup_close', 15 );

/* footer insert to the footer. */
add_action( 'omega_footer', 'omega_footer_markup_open', 5 );
add_action( 'omega_footer', 'omega_footer_insert' );
add_action( 'omega_footer', 'omega_footer_markup_close', 15 );

/* load content */
add_action( 'omega_content', 'omega_content');

/* Add the title, byline, and entry meta before and after the entry.*/
add_action( 'omega_before_entry', 'omega_entry_header' );
add_action( 'omega_entry', 'omega_entry' );
add_action( 'omega_after_entry', 'omega_entry_footer' );

/* Add the primary sidebars after the main content. */
add_action( 'omega_after_main', 'omega_primary_sidebar' );

/* Filter the sidebar widgets. */
add_filter( 'sidebars_widgets', 'omega_disable_sidebars' );
add_action( 'template_redirect', 'omega_one_column' );

add_filter( 'omega_footer_insert', 'omega_default_footer_insert' );

add_filter( 'comment_form_defaults', 'omega_custom_comment_form' );


/**
 * Registers nav menu locations.
 *
 * @since  0.9.0
 * @access public
 * @return void
 */
function omega_register_menus() {
	register_nav_menu( 'primary',   _x( 'Primary', 'nav menu location', 'omega' ) );
}

/**
 * Registers sidebars.
 *
 * @since  0.9.0
 * @access public
 * @return void
 */

function omega_register_sidebars() {
	omega_register_sidebar(
		array(
			'id'          => 'primary',
			'name'        => _x( 'Primary', 'sidebar', 'omega' ),
			'description' => __( 'The main sidebar. It is displayed on either the left or right side of the page based on the chosen layout.', 'omega' )
		)
	);
}

/**
 * Adds custom default theme settings.
 *
 * @since 0.3.0
 * @access public
 * @param array $settings The default theme settings.
 * @return array $settings
 */

function omega_set_default_theme_settings( $settings ) {

	$settings = array(
		'comments_pages'            => 0,
		'content_archive'           => 'full',
		'content_archive_limit'		=> 0,
		'content_archive_thumbnail' => 1,
		'more_text'      		=> '[Read more...]',
		'no_more_scroll'		=> 1,
		'image_size'           	=> 'large',
	);

	return $settings;

}


function omega_header_markup_open() {
	echo '<header ' . omega_get_attr('header') . '>';
}


function omega_header_markup_close() {
	echo '</header><!-- .site-header -->';
}

function omega_footer_markup_open() {
	echo '<footer ' . omega_get_attr('footer') . '>';
}


function omega_footer_markup_close() {
	echo '</footer><!-- .site-footer -->';
}

/**
 * Dynamic element to wrap the site title and site description. 
 */

function omega_branding() {
	echo '<div class="' . omega_apply_atomic( 'title_area_class', 'title-area') .'">';
	
	/* Get the site title.  If it's not empty, wrap it with the appropriate HTML. */	
	if ( $title = get_bloginfo( 'name' ) ) {		
		if ( $logo = get_theme_mod( 'custom_logo' ) )
			$title = sprintf( '<div itemscope itemtype="http://schema.org/Organization" class="site-title"><a itemprop="url" href="%1$s" title="%2$s" rel="home"><img itemprop="logo" src="%3$s"/></a></div>', home_url(), esc_attr( $title ), $logo );		
		else
			$title = sprintf( '<h2 class="site-title" itemprop="headline"><a href="%1$s" title="%2$s" rel="home">%3$s</a></h2>', home_url(), esc_attr( $title ), $title );		
	}

	/* Display the site title and apply filters for developers to overwrite. */
	echo omega_apply_atomic( 'site_title', $title );

	/* Get the site description.  If it's not empty, wrap it with the appropriate HTML. */
	if ( $desc = get_bloginfo( 'description' ) )
		$desc = sprintf( '<h3 class="site-description"><span>%1$s</span></h3>', $desc );

	/* Display the site description and apply filters for developers to overwrite. */
	echo omega_apply_atomic( 'site_description', $desc );

	echo '</div>';
}

/**
 * default footer insert filter
 */
function omega_default_footer_insert( $settings ) {

	/* If there is a child theme active, use [child-link] shortcode to the $footer_insert. */
	return '<p class="copyright">' . __( 'Copyright &#169; [the-year] [site-link].', 'omega' ) . '</p>' . "\n\n" . '<p class="credit">' . __( 'Theme by [author-uri].', 'omega' ) . '</p>';	

}

/**
 * Loads footer content
 */
function omega_footer_insert() {
	
	echo '<div class="footer-content footer-insert">';
	
	if ( $footer_insert = get_theme_mod( 'custom_footer' ) ) {
		echo omega_apply_atomic_shortcode( 'footer_content', $footer_insert );		
	} else {
		echo omega_apply_atomic_shortcode( 'footer_content', apply_filters( 'omega_footer_insert','') );
	}
	
	echo '</div>';
}

/**
 * Loads the menu-primary.php template.
 */
function omega_get_primary_menu() {
	get_template_part( 'partials/menu', 'primary' );
}

/**
 * Display primary sidebar
 */
function omega_primary_sidebar() {
	get_sidebar();
}


/**
 * Display the default entry header.
 */
function omega_entry_header() {

	echo '<header class="entry-header">';

	get_template_part( 'partials/entry', 'title' ); 

	if ( 'post' == get_post_type() ) : 
		get_template_part( 'partials/entry', 'byline' ); 
	endif; 
	echo '</header><!-- .entry-header -->';
	
}

/**
 * Display the default entry metadata.
 */
function omega_entry() {

	if ( is_home() || is_archive() || is_search() ) {
		
		if(get_theme_mod( 'post_thumbnail' )) {
			get_the_image( array('attachment' => false, 'meta_key' => 'Thumbnail', 'default_size' => get_theme_mod( 'image_size' ) ) ); 
		}

		if ( 'excerpts' === get_theme_mod( 'post_excerpt' ) ) {
			if ( get_theme_mod( 'excerpt_chars_limit' ) )
				the_content_limit( (int) get_theme_mod( 'excerpt_chars_limit' ), get_theme_mod( 'more_text' ) );
			else
				the_excerpt();
		}
		else {
			the_content( get_theme_mod( 'more_text' ) );
		}
	} else {

		the_content();
		wp_link_pages( array( 'before' => '<p class="page-links">' . '<span class="before">' . __( 'Pages:', 'omega' ) . '</span>', 'after' => '</p>' ) );
	}

}


function omega_excerpt_more( $more ) {
	return ' ... <a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . get_theme_mod( 'more_text' ) . '</a>';
}
add_filter('excerpt_more', 'omega_excerpt_more');

/**
 * Display the default entry footer.
 */
function omega_entry_footer() {

	if ( 'post' == get_post_type() ) {
		get_template_part( 'partials/entry', 'footer' ); 
	} 

	if(is_singular()) {
		echo omega_apply_atomic_shortcode( 'entry_meta', '<div class="entry-meta">[post_edit]</div>' );
	}
	
}

/**
 * Enqueue scripts and styles
 */
function omega_scripts() {
	wp_enqueue_style( 'omega-style', get_stylesheet_uri() );
}

/**
 * Insert conditional script / style for the theme used sitewide.
 */
function omega_styles() {
?>
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
<?php 
}

/**
 * Function for deciding which pages should have a one-column layout.
 */
function omega_one_column() {

	if ( !is_active_sidebar( 'primary' ) )
		add_filter( 'theme_mod_theme_layout', 'omega_theme_layout_one_column' );

	elseif ( is_attachment() && wp_attachment_is_image() && 'default' == get_post_layout( get_queried_object_id() ) )
		add_filter( 'theme_mod_theme_layout', 'omega_theme_layout_one_column' );

}


/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 */
function omega_theme_layout_one_column( $layout ) {
	return '1c';
}


/**
 * Disables sidebars if viewing a one-column page.
 */

function omega_disable_sidebars( $sidebars_widgets ) {
	global $wp_customize;

	$customize = ( is_object( $wp_customize ) && $wp_customize->is_preview() ) ? true : false;

	if ( !is_admin() && !$customize && '1c' == get_theme_mod( 'theme_layout' ) )
		$sidebars_widgets['primary'] = false;

	return $sidebars_widgets;
}

function omega_index_content() {
	if ( have_posts() ) : 

		/* Start the Loop */ 
		while ( have_posts() ) : the_post(); 
		
			get_template_part( 'partials/content', get_post_format() );
	
		endwhile; 

		omega_content_nav( 'nav-below' ); 

	else :

		get_template_part( 'partials/no-results', 'index' );

	endif;
}

function omega_content() {
	if ( have_posts() ) : 
		if(is_archive() || is_search() ) {
	?>

		<header class="page-header">
			<h1 class="archive-title">
				<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_search() ) :
						printf( __( 'Search Results for: %s', 'omega' ), '<span>' . get_search_query() . '</span>' );

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						*/
						the_post();
						printf( __( 'Author: %s', 'omega' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'omega' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'omega' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'omega' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					else :
						_e( 'Archives', 'omega' );

					endif;
				?>
			</h1>
			<?php
				// Show an optional term description.
				$term_description = term_description();
				if ( ! empty( $term_description ) ) :
					printf( '<div class="taxonomy-description">%s</div>', $term_description );
				endif;
			?>
		</header><!-- .page-header -->

		<?php 
		}

		/* Start the Loop */ 
		while ( have_posts() ) : the_post(); 
				get_template_part( 'partials/content' );
		endwhile; 
		
		omega_content_nav( 'nav-below' );

		comments_template(); // Loads the comments.php template.  

	else : 
			get_template_part( 'partials/no-results', 'archive' ); 
	endif;	
}

function omega_custom_comment_form($fields) {
	$fields['comment_notes_after'] = ''; //Removes Form Allowed Tags Box
return $fields;
}


// add disqus compatibility
if (function_exists('dsq_comments_template')) {
	remove_filter( 'comments_template', 'dsq_comments_template' );
	add_filter( 'comments_template', 'dsq_comments_template', 12 ); // You can use any priority higher than '10'	
}
