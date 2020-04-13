<?php

// custom display of recent post
class BP_Modal extends Cornerstone_Element_Base {

    public function data() {
        return array(
            'name'        => 'Modal',
            'title'       => __( 'Modal', csl18n() ),
            'section'     => 'content',
            'description' => __( 'Modal Fenster.', csl18n() ),
            'supports'    => array( 'id', 'class', 'style' )
        );
    }

    public function controls() {

        $this->addControl(
            'content',
            'editor',
            __( 'Content', csl18n() ),
            __( 'Enter your Promo content.', csl18n() ),
            ''
        );

        $this->addControl(
            'remodalId',
            'text',
            __( 'Modal ID', csl18n() ),
            __( 'Unique modal id as link to open modal', csl18n() ),
            ''
        );
    }

    public function render( $atts ) {

        extract( $atts );

        $type = ( isset( $post_type ) ) ? 'type="' . $post_type . '"' : '';

        $output = '';

        $output .= '<div class="remodal" data-remodal-id="'.$remodalId.'"><button data-remodal-action="close" class="remodal-close"></button>';
        $output .= $content;
        $output .= '</div>';

        return $output;
    }
}