<?php
/**
 * template-parts/hero.php
 * Dispatcher para Hero dinámico según la opción de ACF “hero_layout”.
 */

// Salir si ACF no está activo
if ( ! function_exists( 'get_field' ) ) {
    return;
}

// Obtener la opción elegida (o usar 'default' si no existe)
$layout = get_field( 'hero_layout' ) ?: 'default';

// Listado de layouts válidos
$valid_layouts = array( 'home', 'history', 'programs', 'default' );
if ( ! in_array( $layout, $valid_layouts, true ) ) {
    $layout = 'default';
}

// Plantillas a buscar: primero la específica, luego la default
$template_files = array(
    "template-parts/hero-{$layout}.php",
    'template-parts/hero-default.php',
);

// Carga la primera plantilla que exista
locate_template( $template_files, true, false );