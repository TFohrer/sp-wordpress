<?php

$values = cs_compose_values(['image', 'image:src', 'image:retina', 'image:dimensions', 'image:alt']);

cs_register_element('sp-logo-slider-item', [
  'title' => 'SP Logo Slider Item',
  'values' => $values,
  'builder' => 'sp_logo_slider_item_builder_setup',
  'render' => 'sp_logo_slider_item_render',
  'options' => [
    'library' => false,
    'shadow_parent' => false,
  ],
]);

function sp_logo_slider_item_builder_setup()
{
  $group_sp_logo_slider_item = 'sp-logo-slider-item';
  $group_sp_logo_slider_item_setup = $group_sp_logo_slider_item . ':setup';

  return cs_compose_controls(
    [
      'control_nav' => [
        $group_sp_logo_slider_item => 'Content',
        $group_sp_logo_slider_item_setup => cs_recall('label_setup'),
      ],
    ],
    cs_partial_controls('image', [
      'group' => $group_sp_logo_slider_item_setup,
      'has_link' => false,
      'has_object' => false,
    ])
  );
}

function sp_logo_slider_item_render($data)
{
}
