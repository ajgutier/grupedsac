<?php
/**
 * footer.php
 * Pie de página del tema Grupecsad
 */
?>

<footer class="pie-sitio">
    <div class="contenedor">
        <!-- Widgets opcionales (puedes crear template-parts/footer-widgets.php si los necesitas) -->
        <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
        <div class="footer-widgets">
            <?php dynamic_sidebar( 'footer-1' ); ?>
        </div>
        <?php endif; ?>

        <!-- Menú de Pie de Página -->
        <nav class="navegacion-pie" aria-label="<?php esc_attr_e( 'Menú de Pie de Página', 'grupecsad' ); ?>">
            <?php
      wp_nav_menu( array(
        'theme_location' => 'footer-menu',
        'container'      => false,
        'menu_class'     => 'menu menu-pie',
        'depth'          => 1,
        'fallback_cb'    => false,
      ) );
      ?>
        </nav>

        <!-- Menú Social -->
        <nav class="navegacion-social" aria-label="<?php esc_attr_e( 'Redes Sociales', 'grupecsad' ); ?>">
            <?php
      wp_nav_menu( array(
        'theme_location' => 'social-menu',
        'container'      => false,
        'menu_class'     => 'menu menu-social',
        'depth'          => 1,
        'fallback_cb'    => false,
      ) );
      ?>
        </nav>

        <!-- Texto de copyright y datos de contacto -->
        <div class="pie-info">
            <p>© <?php echo date( 'Y' ); ?> GRUPECSAD | Desarrollado por Creative Factory MX</p>
            <p>AV. DE LAS FUENTES #184, LOCAL 517, NAUCALPAN, EDO. MÉXICO. C.P. 53950 | (55) 5294 4552</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>