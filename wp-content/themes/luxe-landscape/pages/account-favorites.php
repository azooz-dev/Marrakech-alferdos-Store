<?php
/**
 * Account Favorites Page
 *
 * From Stitch: MyAccount-Favorites.html
 * Static UI — can be integrated with a wishlist plugin later.
 *
 * @package Luxe_Landscape
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$fallback_favorites = array(
	array(
		'name'  => __( 'Modern Slate Planter', 'luxe-landscape' ),
		'price' => '$450.00',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCHtkOYh47qSYTlmqJPgTcomi-zlcq3cpuUho0fLatIPpsU-zBzzgpHH5knKBsVKseHE9LZ6-uIuyJZgbqJFctHcXYrBRzYeOa75CCtqs4cen-u--2li7yeYc1_-_MVOXECl5SDd8kn0dUEFLLFpgICpsyLqWBwz42DxsNosYb9Ip5VnQchI3DKpMl1t4fdVl42kHMyoXl_LZvX0q_D8lgpsVQkcaquqR4LWmEjeI4HR_wcLuF3pIqE8NfrvEpDQJIzgVbvuIIr11s',
	),
	array(
		'name'  => __( 'Zenith Tiered Fountain', 'luxe-landscape' ),
		'price' => '$2,450.00',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2mKdMZPs3G_ixrglA1usM5VwpTiHwN455aoOxlFw8CDT5g_PE7YT9QXmXwoxWdLXdimvat-2G6fBiaXTqeF9U_dn6liWu19ZjH0gxotgJywgaAt5nn7y8C0Nwob0xqJLp8NH7qIUCMZAihVlzlkSZy-pwlFZIZ8sbPve41IquHZOisXYHUvI2ElEiR8qS0ZF5zYB82cy1WCqrndRIrSnOuR0NhFAiPZ_EBVo6SE2_jj98qv_yvdfvyW3JH8c92h8lkDh5WJvC9i8',
	),
	array(
		'name'  => __( 'Artisan Planter Set', 'luxe-landscape' ),
		'price' => '$875.00',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB4nqMN2PetrM4g2J8KSHwkh_YMD-cP-bwCuQMXAWDvc-jbN5kX2um-iy-mII85btJ-l1EVvwC2hKudspJrulNmkahcjfNKMPzrVWBKewIjBRND2mTUKzZgaBLEE1R0BUpVI65DRoUlxI3IoG5x2P9GPAApTbjCiukmeuXuGG2prppyAirsEOEwCNDUJHB9zGGrcdEiaulP--EZ0iOI53coekTAZQWgkCRvOewukI4TBcvP5wgpfNqIpZlqoyi0kcWcQrQzeWrBrnM',
	),
	array(
		'name'  => __( 'Granite Sculptural Bench', 'luxe-landscape' ),
		'price' => '$3,100.00',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDj1YTO5uQZYAcZ3dakL7g2a0ciJjAsxTOFgGxmDNbtN4Zudgnv5NbDx3chsGecwyLp4lbhBXoA8nggPX7FL5gV9iRYjzgjnk84EGrtvJZyMPv19iacXM0HyqXFKoe2EcK2hcuDpgL959xetKd_tD7Z_5sVWWw5zVwtCUdQC5p3eS9zrkR06ddA2ZfbEnXaF5KkSgOfJRCsbGuQ_8V1Bi2mUThPsCNIQuuL-M7Oa9AVTwfSKz3qNLMTcc2OhgS54Q3N2lqn9_FQivE',
	),
	array(
		'name'  => __( 'Illuminated Path Stones', 'luxe-landscape' ),
		'price' => '$120.00/pc',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCHtkOYh47qSYTlmqJPgTcomi-zlcq3cpuUho0fLatIPpsU-zBzzgpHH5knKBsVKseHE9LZ6-uIuyJZgbqJFctHcXYrBRzYeOa75CCtqs4cen-u--2li7yeYc1_-_MVOXECl5SDd8kn0dUEFLLFpgICpsyLqWBwz42DxsNosYb9Ip5VnQchI3DKpMl1t4fdVl42kHMyoXl_LZvX0q_D8lgpsVQkcaquqR4LWmEjeI4HR_wcLuF3pIqE8NfrvEpDQJIzgVbvuIIr11s',
	),
	array(
		'name'  => __( 'Heritage Olive Tree', 'luxe-landscape' ),
		'price' => '$1,800.00',
		'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2mKdMZPs3G_ixrglA1usM5VwpTiHwN455aoOxlFw8CDT5g_PE7YT9QXmXwoxWdLXdimvat-2G6fBiaXTqeF9U_dn6liWu19ZjH0gxotgJywgaAt5nn7y8C0Nwob0xqJLp8NH7qIUCMZAihVlzlkSZy-pwlFZIZ8sbPve41IquHZOisXYHUvI2ElEiR8qS0ZF5zYB82cy1WCqrndRIrSnOuR0NhFAiPZ_EBVo6SE2_jj98qv_yvdfvyW3JH8c92h8lkDh5WJvC9i8',
	),
);
?>

<div class="mb-8">
	<h1 class="text-3xl font-black text-primary tracking-tight mb-2 acct-favorites-title"><?php esc_html_e( 'Your Favorites', 'luxe-landscape' ); ?></h1>
	<p class="text-slate-500 dark:text-slate-400 max-w-lg acct-favorites-desc"><?php esc_html_e( 'Curate your personal collection of biophilic masterpieces and luxury outdoor accents.', 'luxe-landscape' ); ?></p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
	<?php foreach ( $fallback_favorites as $fav ) : ?>
		<div class="glass-card rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all group">
			<div class="relative aspect-[4/3] bg-slate-100 dark:bg-slate-800">
				<img alt="<?php echo esc_attr( $fav['name'] ); ?>"
					 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
					 src="<?php echo esc_url( $fav['image'] ); ?>" />
				<button class="absolute top-3 right-3 size-8 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-full flex items-center justify-center text-accent shadow-sm">
					<span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">favorite</span>
				</button>
			</div>
			<div class="p-5">
				<h3 class="font-bold text-slate-800 dark:text-white mb-1"><?php echo esc_html( $fav['name'] ); ?></h3>
				<p class="text-primary font-black text-lg mb-4"><?php echo esc_html( $fav['price'] ); ?></p>
				<div class="flex gap-2">
					<button class="flex-1 py-2 rounded-lg text-xs font-bold border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-red-500 hover:border-red-200 transition-colors acct-fav-remove"><?php esc_html_e( 'Remove', 'luxe-landscape' ); ?></button>
					<button class="flex-[2] py-2 rounded-lg text-xs font-bold bg-primary text-white hover:bg-primary/90 transition-colors acct-fav-view"><?php esc_html_e( 'View Details', 'luxe-landscape' ); ?></button>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>
