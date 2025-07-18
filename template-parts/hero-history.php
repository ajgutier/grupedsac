<?php
// template-parts/hero-history.php
$year = get_field('hero_history_year');
$text = get_field('hero_history_text');
?>
<section class="hero hero--history">
    <?php if ( $bg_image ) : ?>
    <div class="hero__media" style="background-image:url('<?php echo esc_url($bg_image['url']); ?>')"></div>
    <?php endif; ?>
    <div class="hero__content contenedor">
        <?php if ( $year ) : ?>
        <h2 class="hero__year"><?php echo esc_html($year); ?></h2>
        <?php endif; ?>
        <?php if ( $text ) : ?>
        <p class="hero__text"><?php echo esc_html($text); ?></p>
        <?php endif; ?>
    </div>
</section>