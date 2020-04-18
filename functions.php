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


/** additional shortcodes **/

include_once "shortcodes/bp_button.php";
include_once "shortcodes/bp_content_box.php";



/** wp user frontend hook **/


add_action('custom_review_render_hook', 'custom_review_form_render', 10, 3 );
function custom_review_form_render( $form_id, $post_id, $form_settings ) {
    // do what ever you want

    $form_vars = get_post_meta( $form_id, 'wpuf_form' , true );
    $form_settings = get_post_meta( $form_id, 'wpuf_form_settings', true );
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

/** additional js **/


function load_javascript_files($manifest) {

    $mainJsFileName = $manifest['main.js'];

    wp_register_script('main_js', get_stylesheet_directory_uri() . '/build/'. $mainJsFileName, array('jquery'), true, true );
    wp_enqueue_script('main_js');
}

add_action('wp_enqueue_scripts', function() use ($manifest) { load_javascript_files($manifest); },99);

