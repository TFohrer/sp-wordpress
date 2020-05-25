<?php

// =============================================================================
// TEMPLATE NAME: SP - Detail Page | 50/50 Hero | Container | Header, Footer
// -----------------------------------------------------------------------------
// A blank page for creating unique layouts.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's index, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "template-blank-1.php," where you'll be able to
// find the appropriate output.
// =============================================================================

get_template_part('template-parts/header/header', 'sp');

$headline = get_post_meta(get_the_ID(), 'headline', true);
$subheadline = get_post_meta(get_the_ID(), 'subheadline', true);
?>
  <div class="x-container">
    <div class="x-main full" role="main">

      <?php while (have_posts()):
          the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <!-- HERO  -->
          <section class="page-hero page-hero--two-columns">

            <?php if (has_post_thumbnail()) {<?php
                //$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
                ?>
                 <div class="page-hero__image-container">
                  <?php the_post_thumbnail('large', [
                      'class' => 'page-hero__image',
                  ]); ?>
                </div>
                <?php } ?>
            <!--<picture class="page-hero__image"></picture>-->
            <div class="page-hero__headline-container">
              <h1 class="headline--border-bottom text-center"><?php echo $headline; ?></h1>
              <p class="no-margin-bottom"><?php echo $subheadline; ?></p>
              
            </div>
          </section>
            
          <!-- HERO END -->
          <?php x_get_view('global', '_content', 'the-content'); ?>
        </article>

      <?php
      endwhile; ?>
    </div>
  </div>
<?php get_footer(); ?>
