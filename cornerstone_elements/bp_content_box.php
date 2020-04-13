<?php

class BP_Content_Box extends Cornerstone_Element_Base {

    public function data() {
        return array(
            'name'        => 'bp_content_box',
            'title'       => __( 'BP Content Box', csl18n() ),
            'section'     => 'marketing',
            'description' => __( 'Button description.', csl18n() ),
            'supports'    => array( 'id', 'class', 'style' ),
            'autofocus' => array(
                'content' => '.x-btn'
            )
        );
    }

    public function controls() {

        $this->addControl(
            'front_text',
            'textarea',
            NULL,
            NULL,
            __( 'This is the content for the front ', csl18n() ),
            array(
                'expandable' => __( 'Content', csl18n() )
            )
        );

        $this->addControl(
            'additional_text',
            'textarea',
            NULL,
            NULL,
            __( 'This is the content for layer', csl18n() ),
            array(
                'expandable' => __( 'Content', csl18n() )
            )
        );

        //$this->addSupport( 'link' );


        $this->addControl(
            'icon_placement',
            'choose',
            __( 'Icon Placement', csl18n() ),
            __( 'Place the icon before or after the button text, or even override the button text.', csl18n() ),
            'before',
            array(
                'condition' => array( 'icon_toggle' => true ),
                'columns' => '3',
                'choices' => array(
                    array( 'value' => 'notext', 'label' => __( 'Icon Only', csl18n() ),  'icon' => fa_entity( 'ban' ) ),
                    array( 'value' => 'before', 'label' => __( 'Before', csl18n() ),  'icon' => fa_entity( 'arrow-left' ) ),
                    array( 'value' => 'after',  'label' => __( 'After', csl18n() ), 'icon' => fa_entity( 'arrow-right' ) )
                )
            )
        );

        $this->addControl(
            'icon_type',
            'icon-choose',
            __( 'Icon', csl18n() ),
            __( 'Icon to be displayed inside your button.', csl18n() ),
            'info'
        );

        $this->addControl(
            'modal_target',
            'text',
            __( 'Modal Target ID', csl18n() ),
            __( 'Enter Modal Target ID.', csl18n() )
        );
    }

    public function render( $atts ) {

        extract( $atts );

        $modal_target = !(empty($modal_target)) ? "data-remodal-target='".$modal_target."'" : '';

        $icon_markup = "[x_icon type=\"{$icon_type}\"]";

        $layeredContent = !(empty($layeredContent)) ? $layeredContent : '';

        //$shape = ($shape != 'global' ) ? "shape=\"$shape\"" : '';
        //$type = ($type != 'global' ) ? "type=\"$type\"" : '';

        $shortcode = "[bp_content_box front_text=\"$front_text\" additional_text=\"$additional_text\" modal_target=\"$modal_target\"]{$icon_markup}[/bp_content_box]";

        //$shortcode = "[bp_button {$modalTarget} modal_target=\"$modal_target\" size=\"$button_size\" block=\"$block\" icon_only=\"$icon_only\" href=\"$href\" title=\"$href_title\" target=\"$href_target\" info=\"$info\" info_place=\"$info_place\" info_trigger=\"$info_trigger\" info_content=\"$info_content\"{$extra}]{$content}[/bp_button]";

        return $shortcode;

    }

}