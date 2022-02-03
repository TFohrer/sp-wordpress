<?php

use Timber\Timber;

$values = cs_compose_values([
  'body' => cs_value(''),
  'image' => cs_value(null, 'markup'),
  'link_href' => cs_value('', 'markup', true),
  'link_blank' => cs_value(false, 'markup', true),
  'link_nofollow' => cs_value(false, 'markup', true),
]);

// TODO add namespace sp
cs_register_element('link-list-item', [
  'title' => __('SP - Link List Item', 'sp'),
  'values' => $values,
  'builder' => 'link_list_item_builder_setup',
  'render' => 'link_list_item_render',
  'options' => [
    'library' => false,
    'shadow_parent' => false,
    'inline' => [
      'body' => [
        'selector' => '.link-list__item-body',
      ],
      'image' => [
        'selector' => '.link-list__item-image',
      ],
    ],
  ],
]);

function link_list_item_builder_setup()
{
  $group_link_list_item = 'sp-link_list_item';
  $group_link_list_item_setup = $group_link_list_item . ':setup';

  $control_setup = [
    [
      'key' => 'body',
      'type' => 'text-editor',
      'label' => 'Body',
      'options' => [
        'height' => 4,
      ],
      'group' => $group_link_list_item_setup,
    ],
    [
      'key' => 'image',
      'type' => 'image',
      'label' => 'Image',
      'group' => $group_link_list_item_setup,
    ],
    [
      'keys' => [
        'url' => 'link_href',
        'new_tab' => 'link_blank',
        'nofollow' => 'link_nofollow',
      ],
      'type' => 'link',
      'label' => 'Link',
      'group' => $group_link_list_item_setup,
    ],
  ];

  return cs_compose_controls(
    [
      'controls' => [...$control_setup],
      'control_nav' => [
        $group_link_list_item => 'Content',
        $group_link_list_item_setup => cs_recall('label_setup'),
      ],
    ],
    cs_partial_controls('omega', ['add_toggle_hash' => true, 'add_custom_atts' => true])
  );
}

function link_list_item_render($data)
{
  $image = $data['image'];
  if ($image) {
    unset($data['image']);
    list($data['image']['id'], $data['image']['size']) = explode(':', $image);
  }

  Timber::render('@cornerstone/link-list/link-list-item.twig', $data);
}
