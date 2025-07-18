<?php
/**
 * page.php
 * Plantilla para páginas estáticas
 */

get_header();

// Si quieres un “hero” con fondo (imagen o video), aquí iría un partial tipo:
// get_template_part( 'template-parts/hero' );

?>

<main class="contenido-principal contenedor">
    <?php
    while ( have_posts() ) :
      the_post();
      the_content();
    endwhile;
  ?>
</main>

<?php get_footer(); ?>