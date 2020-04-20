<?php

// =============================================================================
// VIEWS/GLOBAL/_BRAND.PHP
// -----------------------------------------------------------------------------
// Outputs the brand.
// =============================================================================

$site_name        = get_bloginfo( 'name' );
$site_description = get_bloginfo( 'description' );
$logo             = x_make_protocol_relative( x_get_option( 'x_logo' ) );
$logo_clean       = x_make_protocol_relative( get_stylesheet_directory_uri() . '/assets/images/logo_clean.png');
$site_logo        = '<img class="nav-primary__logo" src="' . $logo . '" alt="' . $site_description . '">';
$site_logo_clean  = '<img class="nav-primary__logo-clean" src="' . $logo_clean . '" alt="' . $site_description . '">';

?>

<?php echo ( is_front_page() ) ? '<h1 class="visually-hidden">' . $site_name . '</h1>' : ''; ?>

<a href="<?php echo home_url( '/' ); ?>" class="<?php x_brand_class(); ?>" title="<?php echo $site_description; ?>">
  <?php
        echo ( $logo == '' ) ? $site_name : $site_logo;
        if($logo_clean !== '') {
            echo $site_logo_clean;
        }
    ?>
</a>
