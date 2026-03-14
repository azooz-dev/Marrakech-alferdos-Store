<?php
/**
 * Index Template (Fallback)
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

luxe_landscape_get_header();
?>

<main class="max-w-7xl mx-auto px-6 py-32">
	<?php if ( have_posts() ) : ?>
		<div class="grid gap-8">
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class( 'bg-white dark:bg-slate-900 rounded-3xl p-8 shadow-sm' ); ?>>
					<h2 class="text-2xl font-bold mb-4">
						<a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors"><?php the_title(); ?></a>
					</h2>
					<div class="text-slate-600 dark:text-slate-400">
						<?php the_excerpt(); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="mt-12">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<p class="text-slate-500 text-center text-xl"><?php esc_html_e( 'No posts found.', 'luxe-landscape' ); ?></p>
	<?php endif; ?>
</main>

<?php luxe_landscape_get_footer(); ?>
