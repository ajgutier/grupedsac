<?php
/**
 * front-page.php
 * Plantilla para la página de inicio estática.
 *
 * WordPress la cargará automáticamente si has asignado una página
 * como “Página frontal” en Ajustes → Lectura.
 */

get_header(); 
?>

<?php
  // Hero dinámico (dispatcher que carga hero-home, hero-history, hero-programs o hero-default)
  get_template_part( 'template-parts/hero' );
?>

<main class="contenido-principal contenedor">
    <?php
    // Loop de WP para la página asignada como portada
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();
  ?>
    <section class="front-content">
        <?php the_content(); ?>
    </section>
    <?php
      endwhile;
    endif;
  ?>
</main>

<?php
get_footer();