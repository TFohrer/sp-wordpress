<?php

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

add_filter( 'x_enqueue_parent_stylesheet', '__return_true' );


// Additional Functions
// =============================================================================

static $meta_key = 'wpuf_form';

$manifestStr = file_get_contents(dirname(__FILE__)."/build/manifest.json");
$manifest = json_decode($manifestStr, true);


/** add post-type "Seminar Bewertungen" **/
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'seminar_rating',
        array(
            'labels' => array(
                'name' => __( 'Seminar Bewertungen' ),
                'singular_name' => __( 'Seminar Bewertung' )
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
        )
    );
}

function add_event_post_type( $types ) {
    $types['seminar_rating'] = 'seminar_rating';
    return $types;
}
add_filter( 'cs_recent_posts_post_types', 'add_event_post_type', 999 );


/** custom cornerstone elements **/
add_action( 'cornerstone_load_elements', 'my_custom_elements' );
function my_custom_elements() {

    /*require_once 'cornerstone_elements/bp_usp_form_element.php';
    cornerstone_add_element('BP_USP');

    require_once 'cornerstone_elements/bp_custom_recent_posts_element.php';
    cornerstone_add_element('BP_RP');

    require_once 'cornerstone_elements/bp_modal_element.php';
    cornerstone_add_element('BP_Modal');

    require_once 'cornerstone_elements/bp_custom_button.php';
    cornerstone_add_element('BP_Button');

    require_once 'cornerstone_elements/bp_content_box.php';
    cornerstone_add_element('BP_Content_Box');*/
}

/** additional shortcodes **/

include_once "shortcodes/bp_button.php";
include_once "shortcodes/bp_recent_posts.php";
include_once "shortcodes/bp_content_box.php";



/** wp user frontend hook **/


add_action('custom_review_render_hook', 'custom_review_form_render', 10, 3 );
function custom_review_form_render( $form_id, $post_id, $form_settings ) {
    // do what ever you want

    $form_vars = get_post_meta( $form_id, 'wpuf_form' , true );
    $form_settings = get_post_meta( $form_id, 'wpuf_form_settings', true );

    /*var_dump('<pre>');
    var_dump($form_vars);
    var_dump('</pre>');*/

}

/** additional styles */
function load_style_files($manifest)
{
    $cssFileURI = get_stylesheet_directory_uri() . '/build/' . $manifest['main.css'];
    wp_enqueue_style( 'main_css', $cssFileURI );

    //remove plugin styles
    wp_dequeue_style('wpuf-css');

}

add_action( 'wp_enqueue_scripts', function() use ($manifest) {load_style_files($manifest);} );

/*add_action('wp_head','additional_polymer_imports');
function additional_polymer_imports() {
    echo '<link rel="import" href="'.get_stylesheet_directory_uri().'/bower_components/paper-button/paper-button.html" />';
}*/

/** additional js **/


function load_javascript_files($manifest) {

    wp_register_script('buttons', get_stylesheet_directory_uri() . '/js/buttons.js', array('jquery'), true );
    wp_enqueue_script('buttons');

    wp_register_script('content-box', get_stylesheet_directory_uri() . '/js/content-box.js', array('jquery'), true );
    wp_enqueue_script('content-box');

    wp_register_script('forms', get_stylesheet_directory_uri() . '/js/forms.js', array('jquery'), true );
    wp_enqueue_script('forms');

    $mainJsFileName = $manifest['main.js'];

    wp_register_script('main_js', get_stylesheet_directory_uri() . '/build/'. $mainJsFileName, array('jquery'), true );
    wp_enqueue_script('main_js');

    /*wp_register_script('remodal', get_stylesheet_directory_uri() . '/node_modules/remodal/dist/remodal.js', array('jquery'), true );
    wp_enqueue_script('remodal');*/

    wp_register_script('headroom', get_stylesheet_directory_uri() . '/node_modules/headroom.js/dist/headroom.js', array('jquery'), true );
    wp_enqueue_script('headroom');
}

add_action('wp_enqueue_scripts', function() use ($manifest) { load_javascript_files($manifest); },99);

