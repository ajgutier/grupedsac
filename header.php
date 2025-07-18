<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header class="encabezado-sitio">
        <div class="contenedor">
            <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
            <?php else : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-sitio">
                <?php bloginfo( 'name' ); ?>
            </a>
            <?php endif; ?>
        </div>

        <?php get_template_part( 'template-parts/navigation' ); ?>
    </header>