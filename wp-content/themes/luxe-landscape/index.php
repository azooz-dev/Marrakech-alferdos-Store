<?php
/**
 * Main Index Template (Fallback)
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main class="wc-main-content" style="padding-top: 8rem; min-height: 60vh;">
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1.5rem;">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1rem;">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div style="color: var(--slate-600); line-height: 1.7;">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php the_posts_navigation(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No content found.', 'luxe-landscape' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
