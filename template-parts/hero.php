<?php
/**
 * template-parts/hero.php
 * Dispatcher para Hero dinámico según la opción de ACF “hero_layout”.
 */

// Si ACF no está activo, salimos
if ( ! function_exists( 'get_field' ) ) {
    return;
}

// Obtenemos el layout, o 'default' si no existe
$layout = get_field( 'hero_layout' ) ?: 'default';
$valid_layouts = array( 'home', 'history', 'programs', 'default' );
if ( ! in_array( $layout, $valid_layouts, true ) ) {
    $layout = 'default';
}

// Listado de archivos a buscar
$template_files = array(
    "template-parts/hero-{$layout}.php",
    'template-parts/hero-default.php',
);

// Cargamos el primero que exista
locate_template( $template_files, true, false );