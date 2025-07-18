<?php
/**
 * template-parts/hero-default.php
 * Hero por defecto: imagen o vídeo de fondo, título, subtítulo y botón CTA.
 */

// Obtener campos ACF
$title      = get_field('hero_title');
$subtitle   = get_field('hero_subtitle');
$btn_text   = get_field('hero_button_text');
$btn_url    = get_field('hero_button_url');
$bg_image   = get_field('hero_bg_image');
$bg_video   = get_field('hero_bg_video');
$use_video  = get_field('hero_has_bg_video');
?>

<section class="hero hero--default">
    <?php if ( $use_video && $bg_video ) : ?>
    <video class="hero__media" autoplay muted loop playsinline>
        <source src="<?php echo esc_url( $bg_video['url'] ); ?>"
            type="<?php echo esc_attr( $bg_video['mime_type'] ); ?>">
        <?php if ( $bg_image ) : ?>
        <img src="<?php echo esc_url( $bg_image['url'] ); ?>" alt="<?php echo esc_attr( $title ); ?>">
        <?php endif; ?>
    </video>
    <?php elseif ( $bg_image ) : ?>
    <div class="hero__media" style="background-image: url('<?php echo esc_url( $bg_image['url'] ); ?>');"></div>
    <?php endif; ?>

    <?php if ( $title || $subtitle || ( $btn_text && $btn_url ) ) : ?>
    <div class="hero__content contenedor">
        <?php if ( $title ) : ?>
        <h1 class="hero__title"><?php echo esc_html( $title ); ?></h1>
        <?php endif; ?>
        <?php if ( $subtitle ) : ?>
        <p class="hero__subtitle"><?php echo esc_html( $subtitle ); ?></p>
        <?php endif; ?>
        <?php if ( $btn_text && $btn_url ) : ?>
        <a href="<?php echo esc_url( $btn_url ); ?>" class="btn hero__btn">
            <?php echo esc_html( $btn_text ); ?>
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>