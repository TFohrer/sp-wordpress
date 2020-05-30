<?php

// =============================================================================
// INDEX.PHP
// -----------------------------------------------------------------------------
// Handles output of pages and posts if a more specific template file isn't
// present. Used to add a custom template for the blog index page
//
// =============================================================================

if (!is_front_page() && is_home()) {
    // blog index page
    include_once "page-templates/blog.php";
} else {
    // default index.php action from x-theme
    x_get_view(x_get_stack(), 'wp', 'index');
}
