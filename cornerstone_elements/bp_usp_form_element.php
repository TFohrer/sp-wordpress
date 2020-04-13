<?php

class BP_USP extends Cornerstone_Element_Base {

    public function data() {
        return array(
            'name'        => 'customer_review',
            'title'       => __( 'Kurs Formular', csl18n() ),
            'section'     => 'social',
            'description' => __( 'Formular zur Bewertung der Kurse.', csl18n() ),
            'supports'    => array( 'id', 'class', 'style' )
        );
    }

    public function controls() {

        /*$this->addControl(
            'heading',
            'text',
            __( 'Title', csl18n() ),
            __( 'Enter in a title for your author information.', csl18n() ),
            __( 'About the Author', csl18n() )
        );*/
    }

    public function render( $atts ) {

        extract( $atts );

        //$shortcode = "[user-submitted-posts]";

        $shortcode = "[wpuf_form id='".$id."']";
        return $shortcode;

    }

}
