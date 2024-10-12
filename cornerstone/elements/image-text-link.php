<?php

cs_register_element('image-text-link', [
  'title' => __('Image Text Link', 'domain'),
  'values' => [
    'headline' => cs_value('Headline goes here', 'markup', false),
    'content' => cs_value('Content', 'markup', false),
    'background_image' => cs_value('', 'markup', false),
    'link' => cs_value('', 'style', false),
  ],
  'builder' => 'image_text_link_builder_setup',
  'render' => 'image_text_link_render',
]);

function image_text_link_builder_setup()
{
  return cs_compose_controls([
    'control_nav' => [
      'image-text-link' => __('Image Text Link', 'your-text-domain'),
      'image-text-link:setup' => __('Setup', 'your-text-domain'),
    ],
    'controls' => [
      [
        'key' => 'headline',
        'type' => 'text',
        'group' => 'image-text-link:setup',
        'label' => __('Headline', 'your-text-domain'),
      ],
      [
        'key' => 'content',
        'type' => 'text',
        'group' => 'image-text-link:setup',
        'label' => __('Content', 'your-text-domain'),
      ],
      [
        'key' => 'background_image',
        'type' => 'image',
        'group' => 'image-text-link:setup',
        'label' => __('Background Image', 'your-text-domain'),
      ],
      [
        'key' => 'link',
        'type' => 'text',
        'group' => 'image-text-link:setup',
        'label' => __('Link', 'your-text-domain'),
      ],
    ],
  ]);
}

function image_text_link_render($data)
{
  extract($data);

  $id = $id ?? '';
  $mod_id = $mod_id ?? '';
  $class = $class ?? '';

  $atts = cs_atts([
    'id' => $id,
    'class' => [$mod_id, 'image-text-link', $class],
  ]);

  ob_start();
  ?>
    <a <?php echo $atts; ?> href="<?php echo $link; ?>">
        <img class="image-text-link__image" src="<?php echo $background_image; ?>">
        <div class="image-text-link__overlay-container">
            <p class="image-text-link__headline"><?php echo $headline; ?></p>
            <p class="image-text-link__text"><?php echo $content; ?></p>
            <p class="image-text-link__read-more">
                Mehr erfahren
            </p>
        </div>
    </a>
    <?php return ob_get_clean();
}
