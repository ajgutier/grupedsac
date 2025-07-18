<?php
/**
 * inc/acf-hero.php
 * Registra los campos ACF para el Hero dinámico
 */

add_action( 'acf/init', 'grupecsad_register_hero_fields' );
function grupecsad_register_hero_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'        => 'group_hero',
        'title'      => 'Hero',
        'fields'     => array(
            array(
                'key'           => 'field_hero_layout',
                'label'         => 'Hero Layout',
                'name'          => 'hero_layout',
                'type'          => 'select',
                'choices'       => array(
                    'home'     => 'Home (secciones)',
                    'history'  => 'Historia (timeline)',
                    'programs' => 'Programas (grid)',
                    'default'  => 'Default (título+texto)',
                ),
                'default_value' => 'default',
            ),
            array(
                'key'      => 'field_hero_title',
                'label'    => 'Hero Title',
                'name'     => 'hero_title',
                'type'     => 'text',
                'required' => 1,
            ),
            array(
                'key'      => 'field_hero_subtitle',
                'label'    => 'Hero Subtitle',
                'name'     => 'hero_subtitle',
                'type'     => 'textarea',
                'required' => 0,
            ),
            array(
                'key'      => 'field_hero_button_text',
                'label'    => 'Button Text',
                'name'     => 'hero_button_text',
                'type'     => 'text',
                'required' => 0,
            ),
            array(
                'key'      => 'field_hero_button_url',
                'label'    => 'Button URL',
                'name'     => 'hero_button_url',
                'type'     => 'url',
                'required' => 0,
            ),
            array(
                'key'           => 'field_hero_bg_image',
                'label'         => 'Background Image',
                'name'          => 'hero_bg_image',
                'type'          => 'image',
                'return_format' => 'array',
                'required'      => 0,
            ),
            array(
                'key'           => 'field_hero_bg_video',
                'label'         => 'Background Video',
                'name'          => 'hero_bg_video',
                'type'          => 'file',
                'return_format' => 'array',
                'mime_types'    => 'mp4,webm',
                'required'      => 0,
            ),
            array(
                'key'           => 'field_hero_has_bg_video',
                'label'         => 'Use Video Background',
                'name'          => 'hero_has_bg_video',
                'type'          => 'true_false',
                'ui'            => 1,
                'default_value' => 0,
            ),
        ),
        'location'   => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                ),
            ),
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'post',
                ),
            ),
        ),
        'position'   => 'acf_after_title',
        'style'      => 'seamless',
        'menu_order' => 0,
    ) );
}