<?php
/**
 * Página no encontrada (cuando Lienzo no tiene plantilla 404).
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>
<main id="lt-main" class="lt-main">
	<div class="lt-container lt-narrow">
		<header class="lt-page-header">
			<h1><?php esc_html_e( 'Page not found', 'lienzo-theme' ); ?></h1>
			<p><?php esc_html_e( 'The page you are looking for does not exist or has moved. Try searching or go back home.', 'lienzo-theme' ); ?></p>
		</header>
		<?php get_search_form(); ?>
		<p class="lt-404-home"><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'lienzo-theme' ); ?></a></p>
	</div>
</main>
<?php
get_footer();
