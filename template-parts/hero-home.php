<?php
// template-parts/hero-home.php
$sections = array(
  'vision'    => get_field('hero_section_vision'),
  'objetivo'  => get_field('hero_section_objetivo'),
  'sobre'     => get_field('hero_section_sobre'),
);
?>
<section class="hero hero--home">
    <?php if ( $bg_image ) : ?>
    <div class="hero__media" style="background-image:url('<?php echo esc_url($bg_image['url']); ?>')"></div>
    <?php endif; ?>
    <div class="hero__content contenedor">
        <?php foreach( $sections as $slug => $html ) : ?>
        <?php if ( $html ) : ?>
        <div class="hero__section hero__section--<?php echo esc_attr($slug); ?>">
            <?php echo wp_kses_post( $html ); ?>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>