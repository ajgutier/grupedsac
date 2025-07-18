<?php if ( has_nav_menu('main-menu') ) : ?>
<nav class="navegacion-principal contenedor" aria-label="<?php esc_attr_e('Menú Principal','grupecsad'); ?>">
    <?php
    wp_nav_menu( array(
      'theme_location' => 'main-menu',
      'container'      => false,
      'menu_class'     => 'menu menu-principal',
      'depth'          => 2,
      'fallback_cb'    => 'wp_page_menu',
    ) );
    ?>
</nav>
<?php else : ?>
<!-- No hay menú asignado a main-menu -->
<?php endif; ?>