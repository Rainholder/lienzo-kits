<?php
/**
 * Entradas y páginas. Las diseñadas con Lienzo ocupan todo el ancho (su
 * diseño ya trae los márgenes); el resto, columna de lectura.
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	if ( lienzo_theme_is_built() ) :
		?>
		<main id="lt-main" class="lt-main is-built">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
			</article>
		</main>
		<?php
		continue;
	endif;
	?>
	<main id="lt-main" class="lt-main">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'lt-container lt-narrow' ); ?>>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php if ( 'post' === get_post_type() ) : ?>
					<p class="entry-meta">
						<?php
						/* translators: 1: fecha, 2: autor */
						printf( esc_html__( '%1$s · by %2$s', 'lienzo-theme' ), esc_html( get_the_date() ), esc_html( get_the_author() ) );
						?>
					</p>
				<?php endif; ?>
			</header>
			<?php if ( has_post_thumbnail() && ! is_page() ) : ?>
				<figure class="entry-thumb"><?php the_post_thumbnail( 'large' ); ?></figure>
			<?php endif; ?>
			<div class="entry-content">
				<?php
				the_content();
				wp_link_pages();
				?>
			</div>
			<?php if ( 'post' === get_post_type() ) : ?>
				<footer class="entry-footer">
					<?php
					the_category( ', ' );
					the_tags( ' · ' );
					?>
				</footer>
				<?php
				the_post_navigation(
					array(
						'prev_text' => '<span class="lt-nav-label">' . esc_html__( 'Previous', 'lienzo-theme' ) . '</span>%title',
						'next_text' => '<span class="lt-nav-label">' . esc_html__( 'Next', 'lienzo-theme' ) . '</span>%title',
					)
				);
				?>
			<?php endif; ?>
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</article>
	</main>
	<?php
endwhile;

get_footer();
