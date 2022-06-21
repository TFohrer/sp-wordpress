<?php

$page_id = get_option('page_for_posts');
$headline = get_post_meta($page_id, 'headline', true);

get_template_part('template-parts/header/header', 'sp');
?>

<div class="x-container max width offset">
    <div class="x-main full" role="headline">
        <h1 class="mw-sm-75 hyphens-auto hyphens-sm-none headline--border-bottom text-center"><?php echo $headline; ?></h1>
    </div>
</div>

<div class="x-container max width">
    <div class="blog-list" role="main">
    <?php while (have_posts()):

      the_post();
      $isFirstPost = $wp_query->current_post == 0 && !is_paged();
      $permalink = get_the_permalink();
      ?>
                <article class="blog-list-item">
                    <div class="blog-list-item__image-container">
                        <?php
                        if (!$isFirstPost): ?>
                            <a href="<?php echo $permalink; ?>">
                        <?php endif;
                        the_post_thumbnail('blog-list-thumbnail size', [
                          'class' => 'blog-list-item__image',
                        ]);
                        if (!$isFirstPost): ?>
                            </a>
                        <?php endif;
                        ?>
                    </div>
                    
                    <div class="blog-list-item__text-container">
                        <a href="<?php echo $permalink; ?>">
                            <h3 class="blog-list-item__headline"><?php the_title(); ?></h3>
                        </a>
                        <?php if ($isFirstPost): ?>
                            <p class="blog-list-item__excerpt"><?php echo get_the_excerpt(); ?></p>
                            <a class="blog-list-item__read-more" href="<?php echo $permalink; ?>">Weiterlesen</a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php
    endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>
