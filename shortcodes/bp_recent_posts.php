<?php
// custom recent posts output
function bp_recent_posts_shortcode( $atts ) {
extract( shortcode_atts( array(
'id'          => '',
'class'       => '',
'style'       => '',
'type'        => 'post',
'count'       => '',
'category'    => '',
'offset'      => '',
'orientation' => '',
'no_sticky'   => '',
'no_image'    => '',
'fade'        => ''
), $atts, 'x_recent_posts' ) );

$allowed_post_types = apply_filters( 'cs_recent_posts_post_types', array( 'post' => 'post' ) );

$output = '[rev_slider alias="seminar-reviews"]';

return $output;
}

add_shortcode('custom_recent_posts', 'bp_recent_posts_shortcode');

?>