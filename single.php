<?php

// =============================================================================
// SINGLE.PHP
// -----------------------------------------------------------------------------
// Handles output of individual posts.
//
// =============================================================================

//$page_id = get_option('page_for_posts');
//$headline = get_the_title();
$headline = get_post_meta(get_the_ID(), 'headline', true);

get_template_part('template-parts/header/header', 'sp');
?>

<article class="x-container max width offset blog-post" id="post-<?php echo get_the_id(); ?>">
    <section class="blog-post__entry text-center" role="headline">
        <div class="blog-post__entry-image">
            <?php the_post_thumbnail('blog-post-entry size'); ?>
        </div>
        
        <h1 class="mw-sm-75 hyphens-auto hyphens-sm-none headline--border-bottom text-center"><?php echo $headline; ?></h1>
    </section>
    <section class="blog-post__content" role="main">
        <?php x_get_view('global', '_content', 'the-content'); ?>
    </section>
</article>

<?php get_footer(); ?>
