<?php
/*
 *  Author: Squatch Creative | @squatchcreative
 *  URL: squatch.us | @squatchcreative
 *  Custom functions, support, custom post types and more. Modified from HTMLBlank @toddmotto
 */

if (function_exists('add_theme_support')){
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
	add_theme_support ('align-wide');
	add_theme_support ('responsive-embeds');
	add_theme_support('editor-styles');
	add_editor_style( 'editor-styles.css' );
    load_theme_textdomain('squatch', get_template_directory() . '/languages');
	
	remove_image_size('1536x1536');
	remove_image_size('2048x2048');
	update_option( 'medium_size_h', 0 );
	update_option( 'medium_size_w', 0 );
	update_option( 'medium_large_size_w', 0 );
	update_option( 'medium_large_size_h', 0 );
	update_option( 'large_size_h', 0 );
	update_option( 'large_size_w', 0 );
	update_option('thumbnail_size_w', 720);
    update_option('thumbnail_size_h', 720);
	update_option('thumbnail_crop', 1);
}

function squatch_header_scripts() {
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr');
		
		//wp_enqueue_script( 'detect-swipe', get_stylesheet_directory_uri() . '/js/lib/jquery.detect_swipe.min.js', array( 'jquery' ), '1', true );
		
		//wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/lib/jquery.fancybox.min.js', array( 'jquery' ), '1', true );

		//wp_enqueue_script('slick', get_template_directory_uri() . '/js/lib/slick.min.js', array('jquery'), '1', true); 
		wp_enqueue_script( 'inview', get_stylesheet_directory_uri() . '/js/lib/jquery.inview.min.js', array( 'jquery' ), '1', true );

        wp_register_script('squatch-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.001'); 
        wp_enqueue_script('squatch-scripts'); 
    }
}

function squatch_styles() {
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');	
	//wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/js/lib/jquery.fancybox.min.css' );
	
	//wp_enqueue_style( 'slick', get_template_directory_uri() . '/js/lib/slick.css' );
	
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.10.0/css/all.css' );

    wp_register_style('squatch-styles', get_template_directory_uri() . '/style.css', array(), '1.001', 'all');
    wp_enqueue_style('squatch-styles');
}


function register_menu_positions() {
    register_nav_menus(array( 
        'header-menu' => __('Header Menu', 'squatch'),
        'footer-menu' => __('Footer Menu', 'squatch') 
    ));
}


// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}

//Dynamic Widget Area
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __('Widget Area 1', 'squatch'),
        'description' => __('Description for this widget-area...', 'squatch'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag) {
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}


// Threaded Comments
function enable_threaded_comments() {
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'squatch_header_scripts'); 
add_action('get_header', 'enable_threaded_comments'); 
add_action('wp_enqueue_scripts', 'squatch_styles');
add_action('init', 'register_menu_positions');
// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); 
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link'); 
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('body_class', 'add_slug_to_body_class');
add_filter('widget_text', 'do_shortcode');
add_filter('widget_text', 'shortcode_unautop'); 
add_filter('the_excerpt', 'shortcode_unautop'); 
add_filter('the_excerpt', 'do_shortcode'); 
add_filter('show_admin_bar', 'remove_admin_bar');
add_filter('style_loader_tag', 'html5_style_remove'); 
// Remove Filters
remove_filter('the_excerpt', 'wpautop'); 

//REMOVE MENUS
function remove_menus(){
	
	$user = array( 'rcneil' );
	$current_user = wp_get_current_user();
	if(!in_array( $current_user->user_login, $user )) {
  
		//remove_menu_page( 'index.php' );                  //Dashboard
		//remove_menu_page( 'edit.php' );                   //Posts
		//remove_menu_page( 'upload.php' );                 //Media
		//remove_menu_page( 'edit.php?post_type=page' );    //Pages
		//remove_menu_page( 'edit-comments.php' );          //Comments
		//remove_menu_page( 'themes.php' );                 //Appearance
		remove_menu_page( 'plugins.php' );                //Plugins
		//remove_menu_page( 'users.php' );                  //Users
		remove_menu_page( 'tools.php' );                  //Tools
		//remove_menu_page( 'options-general.php' );        //Settings
		remove_menu_page( 'edit.php?post_type=acf' );		//ACF
		remove_menu_page( 'edit.php?post_type=acf-field-group' );		//ACF PRO
		remove_menu_page( 'wpcf7' );						//CF7
		remove_menu_page( 'revslider' ); 					//REVOLUTION SLIDER
	}
}
add_action( 'admin_menu', 'remove_menus', 999 );

//SQUATCH WP LOGO
function add_squatch_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/squatch-wp-black.png);
		border: 0px;
		border-radius: 50%;
		background-size: 81px 81px;
		background-position: center center;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'add_squatch_logo' );

function squatch_custom_block_categories( $categories ) {
	$custom_category = array(
		'slug'  => 'squatch-blocks',
		'title' => 'Squatch Blocks'
	);
	array_unshift( $categories,$custom_category	);
	return $categories;
}
add_action( 'block_categories_all', 'squatch_custom_block_categories', 10, 2 );
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {	
	
	// Check function exists.
	if( function_exists('acf_register_block_type') ) {
				
		acf_register_block_type(array(
			'name'				=> 'hero-image',
			'title'				=> __('Hero Image'),
			'description'		=> __('A custom block built by Squatch Creative'),
			'render_template'	=> 'includes/blocks/hero-image.php',
			'category'			=> 'squatch-blocks',
			'icon'				=> file_get_contents( get_template_directory() . '/images/squatch-mark.php' ),
			'keywords'			=> array( 'block' ),
			'mode'	=> 'edit',
			'supports' => array('mode' => false, 'anchor' => true),
			'align' => 'wide',
		));
		acf_register_block_type(array(
			'name'				=> 'innerblock-example',
			'title'				=> __('Innerblocks Example'),
			'description'		=> __('A custom block built by Squatch Creative'),
			'render_template'	=> 'includes/blocks/innerblocks-example.php',
			'category'			=> 'squatch-blocks',
			'icon'				=> file_get_contents( get_template_directory() . '/images/squatch-mark.php' ),
			'keywords'			=> array( 'block' ),
			'mode'	=> 'preview',
			'supports' => array('anchor' => true, 'jsx' => true),
			'align' => 'wide',
		));
		
	}
}

//CF7 FILTER REMOVE AUTO P TAGS
add_filter('wpcf7_autop_or_not', '__return_false');

/*
function create_post_type() {

    register_post_type('new-post-type', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('New Post Type', 'squatch'), // Rename these to suit
            'singular_name' => __('New Post Type', 'squatch'),
            'add_new' => __('Add New', 'squatch'),
            'add_new_item' => __('Add New ', 'squatch'),
            'edit' => __('Edit', 'squatch'),
            'edit_item' => __('Edit ', 'squatch'),
            'new_item' => __('New ', 'squatch'),
            'view' => __('View ', 'squatch'),
            'view_item' => __('View ', 'squatch'),
            'search_items' => __('Search ', 'squatch'),
            'not_found' => __('No posts found', 'squatch'),
            'not_found_in_trash' => __('No posts found in Trash', 'squatch')
        ),
        'public' => true,
		'rewrite' => array( 'slug' => 'new-post-type' ),
		'menu_icon' => 'dashicons-businessman', 
		'menu_position' => 35,
        'hierarchical' => true, 
        'has_archive' => true,
		'show_in_rest' => true,
        'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions'
        ), 
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
        ) // Add Category and Post Tags support, see custom below
    ));	
}
add_action( 'init', 'create_post_type' );  //INITIALIZE POST TYPE

*/


?>
