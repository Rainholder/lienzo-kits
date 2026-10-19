<?php
/**
 * Listados: blog, archivos y búsqueda (cuando Lienzo no tiene una
 * plantilla de archivo para ellos).
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="lt-main" class="lt-main">
	<div class="lt-container">
		<header class="lt-page-header">
			<?php if ( is_search() ) : ?>
				<h1>
					<?php
					/* translators: %s: términos buscados */
					printf( esc_html__( 'Results for “%s”', 'lienzo-theme' ), esc_html( get_search_query() ) );
					?>
				</h1>
				<?php get_search_form(); ?>
			<?php elseif ( is_archive() ) : ?>
				<?php the_archive_title( '<h1>', '</h1>' ); ?>
				<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
			<?php elseif ( is_home() && ! is_front_page() ) : ?>
				<h1><?php single_post_title(); ?></h1>
			<?php else : ?>
				<h1><?php esc_html_e( 'Latest posts', 'lienzo-theme' ); ?></h1>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="lt-posts">
				<?php
				while ( have_posts() ) {
					the_post();
					lienzo_theme_card();
				}
				?>
			</div>
			<?php
			the_posts_pagination(
				array(
					'class'     => 'lt-pagination',
					'prev_text' => '‹',
					'next_text' => '›',
				)
			);
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'Nothing found. Try another search.', 'lienzo-theme' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
