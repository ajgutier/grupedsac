<?php
/**
 * index.php
 * Template principal (fallback) del tema Grupecsad
 */

get_header(); ?>

<main class="contenido-principal contenedor">
    <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'entrada' ); ?>>
        <header class="entrada-header">
            <h2 class="entrada-titulo">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="entrada-meta">
                <time datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
            </div>
        </header>
        <div class="entrada-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </article>
    <?php endwhile; ?>

    <nav class="paginacion">
        <?php
        the_posts_pagination( array(
          'mid_size'  => 2,
          'prev_text' => __( '« Anterior', 'grupecsad' ),
          'next_text' => __( 'Siguiente »', 'grupecsad' ),
        ) );
      ?>
    </nav>

    <?php else : ?>
    <p><?php esc_html_e( 'Lo sentimos, no hay contenido que mostrar.', 'grupecsad' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>