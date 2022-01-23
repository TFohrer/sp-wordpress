<?php
defined('ABSPATH') or die("No script kiddies please!");
$post_id = $atts['id'];
$smls_option = get_post_meta($post_id, 'smls_option', true);
$smls_settings = get_post_meta($post_id, 'smls_settings', true);
$smls_settings['logo_layout'] =
    $smls_settings['logo_layout'] == 'select'
        ? 'grid'
        : $smls_settings['logo_layout'];
$random_num = rand(111111111, 999999999);
?>

  <?php
  if ( isset( $smls_settings[ 'logo_layout' ] ) && $smls_settings[ 'logo_layout' ] == 'grid' ) {
      return "<p>Grid</p>"
  }
    ?>

<div class="logo-showcase-slider logo-showcase-slider--<?php echo $random_num; ?>">
    <div class="logo-showcase-slider__container">
        <?php foreach (
            $smls_option['logo']
            as $logo_index => $logo_serialized_detail
        ) {
            if (is_numeric($logo_index)) {
                parse_str($logo_serialized_detail, $logo_key_detail);
                reset($logo_key_detail);
                $logo_key = key($logo_key_detail);
                $logo_detail = $logo_key_detail[$logo_key];
                $smls_option['logo'][$logo_key] = $logo_detail;
            } else {
                $logo_key = $logo_index;
                $logo_detail = $logo_serialized_detail;
            } ?>
            <div class="logo-showcase-slider__slide">
                <img src="<?php echo esc_attr(
                    $smls_option['logo'][$logo_key]['logo_image_url']
                ); ?>"
                     alt="<?php if (
                         isset($smls_option['logo'][$logo_key]['title'])
                     ) {
                         echo esc_attr(
                             $smls_option['logo'][$logo_key]['title']
                         );
                     } ?>">
            </div>
            <?php
        } ?>
    </div>
</div>
