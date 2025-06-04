<?php
# DUNE PEBBLER GUTNEBERG BLOCK
// include("custom-blocks.php");
// add_filter('allowed_block_types', 'allow_custom_blocks_only');
// add_filter('use_block_editor_for_post', '__return_true');
add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_action('admin_enqueue_scripts', 'enqueue_custom_admin_styles');

function remove_page_editor()
{
    remove_post_type_support('page', 'editor');
}
add_action('init', 'remove_page_editor');


#add thumbnail image for cpt
add_filter('register_post_type_args', 'add_thumbnail_support', 10, 2);

function add_thumbnail_support($args, $post_type)
{
    if ($post_type === 'diensten') {
        $args['supports'][] = 'thumbnail';
    }
    return $args;
}

function enqueue_custom_admin_styles()
{
    wp_enqueue_style('custom-admin-styles', get_template_directory_uri() . '/admin/style.css', false, '1.0', 'all');
}

/* VERSION CONTROL */
if (!defined('_S_VERSION')) {
    define('_S_VERSION', '1.0.0');
}

/* REMOVE TOPBAR NEW */
function remove_topbar_new($wp_admin_bar)
{
    $wp_admin_bar->remove_node('new-content');
}
add_action('admin_bar_menu', 'remove_topbar_new', 999);

/* REMOVE ADMIN BAR */
// add_filter( 'show_admin_bar', '__return_false' );

/* HIDE WP-VERSION */
function wpb_remove_version()
{
    return '';
}
add_filter('the_generator', 'wpb_remove_version');

/* SET DEFAULTS & NAVIGATION */
function wmc_theme_setup()
{
    register_nav_menus(
        array(
            'hoofdmenu' => esc_html__('Hoofdmenu', 'wmc_theme'),
            'footermenu' => esc_html__('Footermenu', 'wmc_theme'),
            'dienstenmenu' => esc_html__('Dienstenmenu', 'wmc_theme')
        )
    );
    load_theme_textdomain('wmc_theme', get_template_directory() . '/languages');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('customize-selective-refresh-widgets');
}
add_action('after_setup_theme', 'wmc_theme_setup');
function wmc_theme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('wmc_theme_content_width', 640);
}
add_action('after_setup_theme', 'wmc_theme_content_width', 0);

/* SET CUSTOM STYLES/SCRIPTS */
function wmc_theme_scripts()
{
    wp_enqueue_script('jquery');
    wp_style_add_data('wmc_theme-style', 'rtl', 'replace');

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.css', array(), _S_VERSION);
    wp_enqueue_style('owl-theme', get_template_directory_uri() . '/assets/owlCarousel/owl.theme.default.min.css', array('owl-carousel'), _S_VERSION);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/owlCarousel/owl.carousel.min.js', array('jquery'), _S_VERSION, true);

    wp_enqueue_style('wmc_theme-uikit', get_template_directory_uri() . '/assets/css/uikit.min.css', array(), _S_VERSION);
    wp_enqueue_style('wmc_theme-framework', get_template_directory_uri() . '/assets/css/framework.css', array('wmc_theme-uikit'), _S_VERSION);
    wp_enqueue_style('wmc_theme-flex', get_template_directory_uri() . '/assets/css/flex.css', array(), _S_VERSION);

    wp_enqueue_style('wmc_theme-gfont1', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&display=swap', array(), _S_VERSION);
    wp_enqueue_style('wmc_theme-gfont2', get_template_directory_uri() . '/assets/fonts/stylesheet.css', array(), _S_VERSION);
    wp_enqueue_script('wmc_theme-uikit-js', get_template_directory_uri() . '/assets/js/uikit.min.js', array('jquery'), _S_VERSION);
    wp_enqueue_script('wmc_theme-custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), _S_VERSION, true);
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'wmc_theme_scripts');

/* ADD DATA TO <NAV> WHEN SUBS */
add_filter('nav_menu_css_class', 'add_parent_class_when_children', 10, 3);
function add_parent_class_when_children($classes, $item, $args)
{
    if (in_array('menu-item-has-children', $classes)) {
        $classes[] = 'uk-parent';
    }
    return $classes;
}

add_filter('walker_nav_menu_start_el', 'add_span_to_menu_item', 10, 4);
function add_span_to_menu_item($item_output, $item, $depth, $args)
{
    if (in_array('menu-item-has-children', $item->classes)) {
        $item_output = str_replace('<a', '<span uk-navbar-parent-icon></span><a', $item_output);
    }
    return $item_output;
}


add_filter('nav_menu_submenu_css_class', 'add_submenu_class', 10, 3);
function add_submenu_class($classes, $args, $depth)
{
    $classes[] = 'uk-navbar-dropdown';
    return $classes;
}

/* DISABLE THEME EDITOR */
function disable_mytheme_action()
{
    define('DISALLOW_FILE_EDIT', TRUE);
}
add_action('init', 'disable_mytheme_action');

/* DISABLE BLOGS */
function remove_blog_menu()
{
    remove_menu_page('edit.php');
}
add_action('admin_menu', 'remove_blog_menu');

/* DISABLE COMMENTS */
add_action('admin_init', function () {
    // redirect any user trying to access comments page
    global $pagenow;
    if ($pagenow === 'edit-comments.php' || $pagenow === 'options-discussion.php') {
        wp_redirect(admin_url());
        exit;
    }
    // disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
// Remove comments and option page in menu 
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
});
// Remove comments icons from admin bar
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
});
// add_action('wp_before_admin_bar_render', 'remove_logo_wp_admin', 0);

/* REMOVE DEFAULT WP STYLES */
function remove_global_styles()
{
    wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'remove_global_styles');
function mywptheme_child_deregister_styles()
{
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'mywptheme_child_deregister_styles', 20);
function smartwp_remove_wp_block_library_css()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
}
add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function admin_style()
{
    echo '<style type="text/css">
    body.wp-admin{background:#fff;}
    #wpadminbar, #adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap{background-color:#000 !important;}
    #adminmenu .wp-has-current-submenu .wp-submenu{background-color:#222222 !important;}
    .postbox .postbox-header{background:#f3f3f3 !important;}
    .acf-tab-group li a{color:#999 !important;}
	.acf-tab-group li.active a{color:#000 !important; background-color:none !important;}
    .seamless .inside .acf-field{border-color:#ddd !important;}
    .seamless .acf-fields > .acf-tab-wrap{margin-bottom:0 !important;}
    .acf-field .acf-label{text-transform:uppercase;}
    .acf-field .acf-label p, .acf-fields.-left .acf-field .acf-label{text-transform:none;}	
</style>';
}
add_action('admin_enqueue_scripts', 'admin_style');
function remove_footer_admin()
{
    echo '<span id="footer-thankyou">Webontwikkeling: <a href="https://www.dunepebbler.nl" target="_blank">Dune pebbler</a></span> &nbsp;';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/* OTHERS */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

/* ALLOW SVG */
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }
    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext' => $filetype['ext'],
        'type' => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');
function fix_svg()
{
    echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action('admin_head', 'fix_svg');