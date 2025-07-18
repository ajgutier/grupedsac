<?php
/**
 * functions.php
 * Funciones y soportes del tema Grupecsad mejorado para seguridad, SEO y rendimiento
 */
// Carga el archivo que registra los campos ACF para el Hero
require get_template_directory() . '/inc/acf-hero.php';
// 1. Soportes Básicos
add_theme_support( 'title-tag' );                           // Título dinámico
add_theme_support( 'post-thumbnails' );                     // Imágenes destacadas
add_theme_support( 'automatic-feed-links' );                // Feed RSS en head
add_theme_support( 'responsive-embeds' );                   // Embeds responsivos
add_theme_support( 'custom-logo', array(                    // Logo personalizable
    'height'      => 100,
    'width'       => 300,
    'flex-width'  => true,
    'flex-height' => true,
) );
add_theme_support( 'html5', array(                          // Salidas HTML5
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'script-loader',
) );

// 2. Registros de Menús
register_nav_menus( array(
    'main-menu'   => __( 'Menú Principal', 'grupecsad' ),
    'footer-menu' => __( 'Menú de Pie de Página', 'grupecsad' ),
    'social-menu' => __( 'Menú de Redes Sociales', 'grupecsad' ),
) );

// 3. Registrar y cargar estilos y scripts
function grupecsad_registrar_activos() {
    // CSS principal
    wp_register_style(
        'grupecsad-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );
    wp_enqueue_style( 'grupecsad-style' );

    // Script principal, pospuesto en footer, con jQuery
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

// 4. Seguridad ligera
remove_action( 'wp_head', 'wp_generator' );                  // Ocultar versión WP
add_filter( 'xmlrpc_enabled', '__return_false' );            // Desactivar XML-RPC
add_action( 'send_headers', function() {
    header( "X-Frame-Options: SAMEORIGIN" );
    header( "X-Content-Type-Options: nosniff" );
    header( "Referrer-Policy: no-referrer-when-downgrade" );
    header( "Strict-Transport-Security: max-age=31536000; includeSubDomains" );
} );

// 5. SEO: Meta tags y Open Graph
function grupecsad_meta_tags() {
    if ( is_singular() ) {
        global $post;
        $desc = get_the_excerpt( $post );
        $url  = get_permalink( $post );
        $title = get_the_title( $post );
        $img = get_the_post_thumbnail_url( $post, 'full' );
        $type = 'article';
    } else {
        $desc  = get_bloginfo( 'description' );
        $url   = home_url();
        $title = get_bloginfo( 'name' );
        $img   = ''; // podrías colocar un fallback
        $type  = 'website';
    }
    echo "<meta name=\"description\" content=\"" . esc_attr( $desc ) . "\" />
";
    echo "<link rel=\"canonical\" href=\"" . esc_url( $url ) . "\" />
";
    echo "<meta property=\"og:site_name\" content=\"" . esc_attr( get_bloginfo('name') ) . "\" />
";
    echo "<meta property=\"og:title\" content=\"" . esc_attr( $title ) . "\" />
";
    echo "<meta property=\"og:description\" content=\"" . esc_attr( $desc ) . "\" />
";
    echo "<meta property=\"og:url\" content=\"" . esc_url( $url ) . "\" />
";
    echo "<meta property=\"og:type\" content=\"" . esc_attr( $type ) . "\" />
";
    if ( $img ) {
        echo "<meta property=\"og:image\" content=\"" . esc_url( $img ) . "\" />
";
    }
    echo "<meta name=\"twitter:card\" content=\"summary_large_image\" />
";
}
add_action( 'wp_head', 'grupecsad_meta_tags', 1 );

// 6. Rendimiento: Resource Hints
function grupecsad_resource_hints( $urls, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' => '' );
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'grupecsad_resource_hints', 10, 2 );

// 7. Rendimiento: Preload CSS principal
function grupecsad_preload_style( $html, $handle, $href, $media ) {
    if ( 'grupecsad-style' === $handle ) {
        return "<link rel=\"preload\" href=\"{$href}\" as=\"style\" onload=\"this.onload=null;this.rel='stylesheet'\" media=\"{$media}\" />" . $html;
    }
    return $html;
}
add_filter( 'style_loader_tag', 'grupecsad_preload_style', 10, 4 );

// 8. Rendimiento: Defer main JS
function grupecsad_defer_scripts( $tag, $handle ) {
    if ( 'grupecsad-main' === $handle ) {
        return str_replace( '<script ', '<script defer ', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'grupecsad_defer_scripts', 10, 2 );

// 9. Añadir clases propias a elementos de menú
function grupecsad_add_li_class( $classes, $item, $args, $depth ) {
    $classes[] = 'grupecsad-menu-item';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'grupecsad_add_li_class', 10, 4 );

function grupecsad_add_link_class( $atts, $item, $args, $depth ) {
    $atts['class'] = ( isset( $atts['class'] ) ? $atts['class'] . ' ' : '' ) . 'grupecsad-menu-link';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'grupecsad_add_link_class', 10, 4 );