<?php
/**
 * index.php
 * Plantilla principal (fallback) de tu tema Grupecsad
 */

get_header(); ?>

<main class="contenido-principal contenedor">
    <?php
  if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      the_content();
    endwhile;
  else :
    echo '<p>No se encontró contenido.</p>';
  endif;
  ?>
</main>

<?php get_footer(); ?>