<?php
/**
 * functions.php
 * Funciones y soportes del tema Grupecsad
 */

// 1. Soporte para título automático <title>
add_theme_support( 'title-tag' );

// 2. Soporte para imágenes destacadas (thumbnails)
add_theme_support( 'post-thumbnails' );

// 3. Registro de ubicaciones de menú
register_nav_menus( array(
    'main-menu'   => __( 'Menú Principal', 'grupecsad' ),
    'footer-menu' => __( 'Menú de Pie de Página', 'grupecsad' ),
    'social-menu' => __( 'Menú de Redes Sociales', 'grupecsad' ),
) );

// 4. Soporte para logotipo personalizado
add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 300,
    'flex-width'  => true,
    'flex-height' => true,
) );

// 5. Salidas HTML5 para formularios, comentarios, galerías y captions
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script-loader',
) );

// 6. Registrar y cargar estilos y scripts
function grupecsad_registrar_activos() {
    // CSS principal (style.css generado por Gulp)
    wp_register_style(
        'grupecsad-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_style( 'grupecsad-style' );

    // JS principal (main.min.js compilado por Gulp), con jQuery como dependencia
    wp_register_script(
        'grupecsad-main',
        get_template_directory_uri() . '/dist/js/main.min.js',
        array( 'jquery' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
    wp_enqueue_script( 'grupecsad-main' );
}
add_action( 'wp_enqueue_scripts', 'grupecsad_registrar_activos' );

// 7. Seguridad ligera (no interfiere en desarrollo local)
// 7.1. Quitar la versión de WordPress del head
remove_action( 'wp_head', 'wp_generator' );

// 7.2. Desactivar XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// 7.3. Añadir cabeceras HTTP de seguridad
add_action( 'send_headers', function() {
    header( "X-Frame-Options: SAMEORIGIN" );
    header( "X-Content-Type-Options: nosniff" );
    header( "Referrer-Policy: no-referrer-when-downgrade" );
    header( "Strict-Transport-Security: max-age=31536000; includeSubDomains" );
} );

// 8. Añadir clases propias a los <li> de los menús
function grupecsad_add_li_class( $classes, $item, $args, $depth ) {
    // Agrega esta clase a todos los <li> de menús
    $classes[] = 'grupecsad-menu-item';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'grupecsad_add_li_class', 10, 4 );

// 9. Añadir clases propias a los <a> de los menús
function grupecsad_add_link_class( $atts, $item, $args, $depth ) {
    // Append a la clase existente en el <a>
    $atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . 'grupecsad-menu-link';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'grupecsad_add_link_class', 10, 4 );