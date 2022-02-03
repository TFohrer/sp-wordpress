<?php

$values = cs_compose_values();

cs_register_element('link-list', [
  'title' => 'SP - Link List',
  'values' => $values,
  'icon' => 'native',
  'builder' => 'link_list_builder_setup',
  'render' => 'link_list_render',
  'options' => [
    'valid_children' => ['link-list-item'],
    'add_new_element' => ['_type' => 'link-list-item'],
  ],
]);

function link_list_builder_setup()
{
  $group_link_list = 'link-list';
  $group_list_item_children = $group_link_list . ':items';

  return cs_compose_controls(
    [
      'controls' => [['type' => 'sortable', 'group' => $group_list_item_children]],
      'control_nav' => [
        $group_link_list => 'Link List',
        $group_list_item_children => 'Items',
      ],
    ],
    cs_partial_controls('effects'),
    cs_partial_controls('omega', ['add_custom_atts' => true])
  );
}

function link_list_render($data)
{
  $atts = [
    'class' => array_merge(['link-list'], $data['classes']),
    'role' => 'tablist',
  ];

  $atts = cs_apply_effect($atts, $data);

  return cs_tag('ul', $atts, $data['custom_atts'] ?? '', cs_render_child_elements($data));
}
