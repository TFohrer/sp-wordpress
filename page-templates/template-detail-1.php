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

//update_post_meta( get_the_ID(), '_x_entry_disable_page_title', 'on' );

get_template_part('template-parts/header/header', 'sp');
//get_header('sp');
?>
  <div class="x-container max width offset">
    <div class="x-main full" role="main">

      <?php while (have_posts()):
          the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php x_get_view('global', '_content', 'the-content'); ?>
        </article>

      <?php
      endwhile; ?>

    </div>
  </div>

<?php get_footer(); ?>
