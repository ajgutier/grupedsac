<?php
// template-parts/hero-programs.php
$items = get_field('hero_programs'); // repeater con subcampos title, link, icono
?>
<section class="hero hero--programs">
    <?php if ( $bg_image ) : ?>
    <div class="hero__media" style="background-image:url('<?php echo esc_url($bg_image['url']); ?>')"></div>
    <?php endif; ?>
    <div class="hero__content contenedor grid">
        <?php if ( $items ): ?>
        <?php foreach( $items as $i ) : ?>
        <a href="<?php echo esc_url($i['link']); ?>" class="hero__program">
            <img src="<?php echo esc_url($i['icon']['url']); ?>" alt="">
            <span><?php echo esc_html($i['title']); ?></span>
        </a>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>