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
    // Connect a function used to render this element
    'render' => 'image_text_link_render',
]);

function image_text_link_builder_setup()
{
    return [
        // Define the control groups that will appear in the inspector navigation bar
        'control_nav' => [
            'image-text-link' => __('Image Text Link', 'your-text-domain'),
            'image-text-link:setup' => __('Setup', 'your-text-domain'),
        ],
        // Define the controls that connect to our values.
        'controls_std_content' => [
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
    ];
}

function image_text_link_render($data)
{
    extract($data);

    $id = $id ?? '';
    $mod_id = $mod_id ?? '';
    $class = $class ?? '';

    $atts = cs_atts([
        'id' => $id,
        'class' => cs_attr_class($mod_id, 'image-text-link', $class),
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
                <!--<span class="arrow arrow--right"><span class="arrow__shaft"></span></span>-->
            </p>
        </div>
    </a>
    <?php return ob_get_clean();
}
