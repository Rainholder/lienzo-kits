<?php
/**
 * Cabecera del tema. Si Lienzo tiene una plantilla de cabecera activa, la
 * pinta él y este archivo no se usa.
 *
 * @package lienzo-theme
 */

defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text lt-skip" href="#lt-main"><?php esc_html_e( 'Skip to content', 'lienzo-theme' ); ?></a>
<header class="lt-header">
	<div class="lt-container">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a class="lt-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		<?php endif; ?>
		<button type="button" class="lt-toggle" aria-expanded="false" aria-controls="lt-nav"><span aria-hidden="true"></span><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'lienzo-theme' ); ?></span></button>
		<nav id="lt-nav" class="lt-nav" aria-label="<?php esc_attr_e( 'Main menu', 'lienzo-theme' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 2,
					'fallback_cb'    => 'lienzo_theme_page_menu',
				)
			);
			?>
		</nav>
	</div>
</header>
