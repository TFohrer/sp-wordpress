<?php
// custom recent posts output
function bp_content_box_shortcode( $atts, $icon_markup = null ) {
    extract( shortcode_atts( array(
        'id'              => '',
        'class'           => '',
        'style'           => '',
        'front_text'      => '',
        'additional_text' => '',
        'icon'            => '',
        'modal_target'    => ''
    ), $atts, 'x_recent_posts' ) );

    $front_text = ( $front_text != '') ? wp_specialchars_decode( $front_text, ENT_QUOTES ) : '';
    $additional_text = ( $additional_text != '') ? wp_specialchars_decode( $additional_text, ENT_QUOTES ) : '';


    $output = '';
    $output .= '<div class="content-box"><div class="text-wrapper"><h3>'.$front_text.'</h3></div>
                <div class="button-wrapper">
                  <div class="layer"></div>
                  <button class="main-button fa fa-info">'.do_shortcode($icon_markup).'</button>
                </div>
              <div class="layered-content">
                  <button class="close-button"><i class="x-icon x-icon-close" data-x-icon="" aria-hidden="true"></i></button>
                  <div class="content"><p>'.$additional_text.'</p>
                      <a class="more-button x-btn x-btn-regular" href '.$modal_target.'>mehr</a>
                  </div>
              </div>
            </div>';

    return $output;
}

add_shortcode('bp_content_box', 'bp_content_box_shortcode');

?>