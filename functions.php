<?php

//define( 'CS_APP_DEV_TOOLS', true );

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Overwrite or add your own custom functions to X in this file.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Enqueue Parent Stylesheet
//   02. Additional Functions
// =============================================================================

// Enqueue Parent Stylesheet
// =============================================================================

add_filter('x_enqueue_parent_stylesheet', '__return_true');

// Additional Functions
// =============================================================================

$manifestStr = file_get_contents(dirname(__FILE__) . '/build/manifest.json');
$manifest = json_decode($manifestStr, true);

/** add post-type "Seminar Bewertungen" **/
add_action('init', 'create_post_type');
function create_post_type()
{
  register_post_type('seminar_rating', [
    'labels' => [
      'name' => __('Seminar Bewertungen'),
      'singular_name' => __('Seminar Bewertung'),
    ],
    'public' => true,
    'has_archive' => false,
    'supports' => ['title', 'editor', 'comments', 'thumbnail'],
  ]);
}

function add_event_post_type($types)
{
  $types['seminar_rating'] = 'seminar_rating';
  return $types;
}
add_filter('cs_recent_posts_post_types', 'add_event_post_type', 999);

/** wp user frontend hook **/
add_action('custom_review_render_hook', 'custom_review_form_render', 10, 3);
function custom_review_form_render($form_id, $post_id, $form_settings)
{
  // do what ever you want

  $form_vars = get_post_meta($form_id, 'wpuf_form', true);
  $form_settings = get_post_meta($form_id, 'wpuf_form_settings', true);
}

/** additional styles */
function load_style_files($manifest)
{
  $cssFileURI = get_stylesheet_directory_uri() . '/build/' . $manifest['main.css'];
  wp_enqueue_style('main_css', $cssFileURI);

  //remove plugin styles
  wp_dequeue_style('wpuf-css');
}

add_action(
  'wp_enqueue_scripts',
  function () use ($manifest) {
    load_style_files($manifest);
  },
  99
);

/** additional js **/

function load_javascript_files($manifest)
{
  $mainJsFileName = $manifest['main.js'];

  wp_register_script('main_js', get_stylesheet_directory_uri() . '/build/' . $mainJsFileName, ['jquery'], true, true);
  wp_enqueue_script('main_js');
}

add_action(
  'wp_enqueue_scripts',
  function () use ($manifest) {
    load_javascript_files($manifest);
  },
  99
);

// Custom x-theme DE translations
function load_child_language()
{
  load_child_theme_textdomain('__x__', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'load_child_language');

// custom cornerstone elements
function register_custom_cornerstone_elements()
{
  require_once 'cornerstone/elements/image-text-link.php';
}

add_action('cs_register_elements', 'register_custom_cornerstone_elements');

// custom logo showcase shortcase (template)
//generating shortcode with post id
function smls_generate_shortcode($atts, $content = null)
{
  $args = [
    'post_type' => 'smartlogo',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'p' => $atts['id'],
  ];
  foreach ($atts as $key => $val) {
    $$key = $val;
  }
  $smls_logo = new WP_Query($args);
  if ($smls_logo->have_posts()):
    ob_start();
    include 'shortcodes/logo-showcase.php';
    $smls_showcase = ob_get_contents();
  endif;
  wp_reset_query();
  ob_end_clean();
  return $smls_showcase;
}
remove_shortcode('smls');
add_shortcode('smls', 'smls_generate_shortcode');

// clean / remove not needed styles and javascript files from plugins / themes

add_filter('use_block_editor_for_post', '__return_false', 10);
// Fully Disable Gutenberg editor
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action('wp_enqueue_scripts', 'remove_block_css', 100);
function remove_block_css()
{
  wp_dequeue_style('wp-block-library'); // WordPress core
  wp_dequeue_style('wp-block-library-theme'); // WordPress core
  wp_dequeue_style('wc-block-style'); // WooCommerce
  wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}

function remove_plugins_assets()
{
  // wordpress
  wp_dequeue_script('comment-reply');
}
add_action('wp_enqueue_scripts', 'remove_plugins_assets', 100);

function remove_plugins_actions()
{
  remove_action('wp_enqueue_scripts', 'smls_register_assets', 0);
}

add_action('wp', 'remove_plugins_actions');

// remove wordpress emoji
function remove_emoji()
{
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  add_filter('tiny_mce_plugins', 'remove_tinymce_emoji');
}
add_action('init', 'remove_emoji');
function remove_tinymce_emoji($plugins)
{
  if (!is_array($plugins)) {
    return [];
  }
  return array_diff($plugins, ['wpemoji']);
}

// remove smart logo showcase scripts
global $smls_obj;
remove_action('wp_enqueue_scripts', [$smls_obj, 'smls_register_assets']);

// custom image sizes
add_theme_support('post-thumbnails');

add_image_size('blog-list-thumbnail size', 400, 0);
add_image_size('blog-post-entry size', 475, 0);

// Remove Google Fonts
// =============================================================================
add_filter('cs_load_google_fonts', '__return_false');

// disable contact form 7 autop function
add_filter('wpcf7_autop_or_not', '__return_false');


// Add custom widget area
// =============================================================================
function register_custom_widget_area() {
register_sidebar(
array(
'id' => 'main-content-widget-area',
'name' => esc_html__( 'Main content widget area', 'x-child' ),
'description' => esc_html__( 'A new widget area made for main content to add events widget', 'x-child' ),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="widget-title-holder"><h3 class="widget-title">',
'after_title' => '</h3></div>'
)
);
}
add_action( 'widgets_init', 'register_custom_widget_area' );
