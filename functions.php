<?php
/*
 *  Author: Squatch Creative | @squatchcreative
 *  URL: squatch.us | @squatchcreative
 *  Custom functions, support, custom post types and more. Modified from HTMLBlank @toddmotto
 */

if (!isset($content_width)) { $content_width = 900;	}

if (function_exists('add_theme_support')){
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr');

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr');
		
		//wp_enqueue_script( 'detect-swipe', get_stylesheet_directory_uri() . '/js/lib/jquery.detect_swipe.min.js', array( 'jquery' ), '1', true );
		//wp_enqueue_script( 'fancybox', get_stylesheet_directory_uri() . '/js/lib/jquery.fancybox.min.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'inview', get_stylesheet_directory_uri() . '/js/lib/jquery.inview.min.js', array( 'jquery' ), '1', true );

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('html5blankscripts'); 
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize');
	
	//wp_enqueue_style( 'fancybox', get_stylesheet_directory_uri() . '/js/lib/jquery.fancybox.min.js' );
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.10.0/css/all.css' );

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank');
}


function register_html5_menu()
{
    register_nav_menus(array( 
        'header-menu' => __('Header Menu', 'html5blank'),
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), 
        'footer-menu' => __('Footer Menu', 'html5blank') 
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
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

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
   // return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
    return '...';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); 
add_action('get_header', 'enable_threaded_comments'); 
add_action('wp_enqueue_scripts', 'html5blank_styles');
add_action('init', 'register_html5_menu');
add_action('widgets_init', 'my_remove_recent_comments_style');
add_action('init', 'html5wp_pagination');
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
add_filter('avatar_defaults', 'html5blankgravatar'); 
add_filter('body_class', 'add_slug_to_body_class');
add_filter('widget_text', 'do_shortcode');
add_filter('widget_text', 'shortcode_unautop'); 
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');
add_filter('the_category', 'remove_category_rel_from_category_list');
add_filter('the_excerpt', 'shortcode_unautop'); 
add_filter('the_excerpt', 'do_shortcode'); 
add_filter('excerpt_more', 'html5_blank_view_article');
add_filter('show_admin_bar', 'remove_admin_bar');
add_filter('style_loader_tag', 'html5_style_remove'); 
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
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

//CUSTOM ACF MIN HEIGHT ROWS
add_filter('admin_head','textarea_temp_fix');
function textarea_temp_fix() {
	echo '<style type="text/css">.acf_postbox .field textarea {min-height:0 !important;}</style>';
}
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

//ALLOW WEBP
function webp_upload_mimes($existing_mimes) {
    $existing_mimes['webp'] = 'image/webp';
    return $existing_mimes;
}
add_filter('mime_types', 'webp_upload_mimes');
function webp_is_displayable($result, $path) {
    if ($result === false) {
        $displayable_image_types = array( IMAGETYPE_WEBP );
        $info = @getimagesize( $path );
        if (empty($info)) {
            $result = false;
        } elseif (!in_array($info[2], $displayable_image_types)) {
            $result = false;
        } else {
            $result = true;
        }
    }
    return $result;
}
add_filter('file_is_displayable_image', 'webp_is_displayable', 10, 2);


add_theme_support ('align-wide');
add_theme_support('editor-styles');
add_editor_style( 'editor-styles.css' );
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




/*
function create_post_type() {

    register_post_type('new-post-type', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('New Post Type', 'html5blank'), // Rename these to suit
            'singular_name' => __('New Post Type', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New ', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit ', 'html5blank'),
            'new_item' => __('New ', 'html5blank'),
            'view' => __('View ', 'html5blank'),
            'view_item' => __('View ', 'html5blank'),
            'search_items' => __('Search ', 'html5blank'),
            'not_found' => __('No posts found', 'html5blank'),
            'not_found_in_trash' => __('No posts found in Trash', 'html5blank')
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
